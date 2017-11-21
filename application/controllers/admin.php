<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
/**
* 
*/
class Admin extends CI_Controller 
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('adminM', 'm');
		date_default_timezone_set('Asia/Manila');	
	}

	function index() 
	{
		$this->loginM->is_loggin();
		$this->load->view('admin');
	}

	public function click_notify() {
		$result 		= $this->m->click_notify();
		$msg['success'] = FALSE;
		if ($result) 
		{
			$msg['success'] = TRUE;
			$msg['msg'] 	= 'Succssfully Edit';
		}
		echo json_encode($msg);
	}
	public function edit_profile() 
	{
		$result 		= $this->m->edit_profile();
		$msg['success'] = FALSE;
		if ($result) 
		{
			$msg['success'] = TRUE;
			$msg['msg'] 	= 'Succssfully Edit';
		}
		echo json_encode($msg);
	}

	public function executeFiles() 
	{
		// initialze all the posible location of the device into an array
		// so that it will be easy to execute. 
		$printerList = array(
			'C:\Program Files (x86)\Microsoft Office\Office15\test.EXE', 
			'C:\Program Files (x86)\Microsoft Office\Office15\test.EXE', 
			// 'C:\Program Files\HP\HP Deskjet 1510 series\Bin\HP Deskjet 1510 series.exe',
			'C:\Program Files (x86)\HP\HP Deskjet 1510 series\bin\HPScan.exe'
		);
		// count the number of printer location
		$numberOfPrinter = count($printerList);
		$app 			 = ""; // initialize find variable into nullN
		$msg['success']  = false; // set $msg['success'] to false
		for ($i=0; $i < $numberOfPrinter; $i++) 
		{ 
			$cmd = $printerList[$i]; // set $cmd to $printerlist the list location of the device.
			$file_exists = file_exists($cmd); 
			if ($file_exists === TRUE)  // if they have an existing device 
			{
				$app = $cmd; // set $find equal to $cmd the existing location of your device.  
				break; // then stop looping or break the loop.
			}
		}
		if ($app) // if this value is not null
		{
			exec($app); // launch or excecute your device or application.
			$msg['success'] = true;
		}
		else 
		{
			$msg['success'] = false;
			$msg['msg'] = "Can't find the device in this location C:\Program Files (x86)\Microsoft Office\Office15\yourDevice.exe or you may try to install within this location";
		}
		echo json_encode($msg);
	}

	public function logout() 
	{
		$this->m->logout();
	}

	public function save_faculty() 
	{
		$iptID  = $this->input->post('factID');
		$facID  = $this->db->query('SELECT fac_ID FROM faculty WHERE fac_ID = '.$iptID.' ');
		$facID1 = $this->db->query('SELECT fac_Id FROM users WHERE fac_Id = '.$iptID.' ');
		if (!$facID->row() && !$facID1->row()) 
		{
			$result = $this->m->save_faculty();

			$msg['success'] = false;
			if ($result) 
			{
				$msg['success'] = true;
				$msg['msg'] 	= 'Succssfully save';
			}
		} 
		else 
		{
			$msg['idExist'] 	= 'ID Exist';
		}
		echo json_encode($msg);
	}

	public function show_faculty() 
	{
		$query = $this->db->query('SELECT * 
									FROM faculty 
									WHERE fac_ID != "'.$this->session->userdata('fac_Id').'"');
		echo json_encode($query->result());
	}

	public function category() 
	{
		$query = $this->db->query('SELECT * FROM title');

		echo json_encode($query->result());
	}

	public function save_upload() 
	{
		$result 		= $this->m->save_upload();
		$f_ID  = $this->input->post('check'); // get all selected checkboxes faculty id
		$msg['success'] = false;
		$msg['sendTrue'] = false;
		foreach ($f_ID as $id => $value) 
		{
			$queryPhone_num = $this->db->query('SELECT phone_num FROM faculty WHERE fac_ID = "'.$value.'" ');
			$phone_num  	= $queryPhone_num->row()->phone_num;
			$sendOk 		= $this->m->send_sms([$phone_num]);
		}
		if ($result) {
			$msg['success'] = true;
			$msg['msg']		= 'Success Uploaded';
			if ($sendOk === 'sent') {
				$msg['sendTrue'] = true;
				$msg['sendOk'] 		= $sendOk;
			} else {
				 $msg['sendFailed'] = $sendOk;
			}
		} else {
			$msg['invalid'] = 'Invalid file type';
		}
		echo json_encode($msg);
	}
	

	public function doc_details() 
	{
		echo json_encode($this->m->docDetails());
	}

	public function notification() 
	{
		$this->db->select('*');
		$this->db->from('notifications');
		$this->db->join('documents', 'documents.doc_id = notifications.doc_id');
		$this->db->where('notifications.seen', 0);
		$this->db->where('documents.fac_ID', $this->session->userdata('fac_Id'));
		$results = $this->db->count_all_results();
		echo $results;
	}

	public function getLogs() 
	{
		$query = $this->db->query('SELECT l.task, l.file_title, l.log_date, f.fac_fname, f.fac_mname, f.fac_lname 
									FROM logs l 
									INNER JOIN faculty f ON f.fac_ID = l.fac_ID
									ORDER BY l.log_date DESC');
		echo json_encode($query->result());
	}

	public function faculty_data() 
	{
		$query = $this->db->query('SELECT f.fac_fname, f.fac_mname, f.fac_lname, f.phone_num, f.fac_ID, f.img, f.gender
									FROM faculty f 
									INNER JOIN users u 
									ON u.fac_Id = f.fac_ID 
									WHERE f.f_id = "'.$this->input->post("id").'" ');
		echo json_encode($query->row());
	}

	public function edit_faculty() 
	{
		$result 		= $this->m->edit_faculty();
		$msg['success'] = false;
		if ($result) 
		{
			$msg['success'] = true;
			$msg['msg']		= 'Edited Succssfully';	
		}

		echo json_encode($msg);
	}

	public function listFile() 
	{
		$f_id = $this->session->userdata('fac_Id');
		$this->db->order_by('date_upload DESC');
		$this->db->select('fac_fname, fac_mname, fac_lname, date_upload, file, open, title_name, documents.doc_id, documents.title, faculty.fac_ID');
		$this->db->from('documents');
		$this->db->join('faculty', 'faculty.fac_ID = documents.fac_ID');
		$this->db->join('views', 'views.doc_id = documents.doc_id');
		$this->db->join('title', 'title.title_id = documents.title_id');
		$this->db->where('views.fac_ID', $f_id);
		$query = $this->db->get();
		echo json_encode($query->result());
	}

	public function openfile() 
	{
		$result 		= $this->m->openfile();
		$msg['success'] = false;
		if ($result) 
		{
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

	public function list_uploaded() 
	{
		echo json_encode($this->m->listUploaded());
	}

	public function faculty_seen() 
	{
		echo json_encode($this->m->facultySeenDoc());	
	}

	public function list_upload() 
	{
		echo json_encode($this->m->list_upload());
	}

	public function change_pic() 
	{
		$result 		= $this->m->change_pic();
		$msg['success'] = false;
		if ($result) 
		{
			$msg['success'] = true;
			$msg['msg']		= 'Edited Succssfully';
		}
		echo json_encode($msg);
	}

	public function receive_notif() 
	{
		echo json_encode($this->m->receive_notif());
	}

	public function update_seen() 
	{
		$result 		= $this->m->update_seen();
		$msg['success'] = false;
		if ($result) 
		{
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

	public function backup() 
	{
		$this->load->dbutil();
		$prefs = array(
		        'tables'        => array(),   // Array of tables to backup.
		        'ignore'        => array(),                     // List of tables to omit from the backup
		        'format'        => 'zip',                       // gzip, zip, txt
		        'filename'      => 'ict_archive.sql',              // File name - NEEDED ONLY WITH ZIP FILES
		        'add_drop'      => TRUE,                        // Whether to add DROP TABLE statements to backup file
		        'add_insert'    => TRUE,                        // Whether to add INSERT data to backup file
		        'newline'       => "\n"                         // Newline character used in backup file
		);
		
		// Backup your entire database and assign it to a variable
		$backup = $this->dbutil->backup($prefs);

		// Load the file helper and write the file to your server
		$this->load->helper('file');
		write_file('/path/to/ict_archive_backup.zip', $backup);

		// Load the download helper and send the file to your desktop
		$this->load->helper('download');
		force_download('ict_archive_backup.zip', $backup);
	}

}