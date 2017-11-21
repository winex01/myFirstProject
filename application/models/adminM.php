<?php
defined('BASEPATH')OR exit('No direct script access allowed');
/**
* 
*/
class AdminM extends CI_Model {
	public function click_notify()
	{
		$this->db->where('not_id', $this->input->post('not_id'));
		$this->db->update('notifications', array('click_notification' => 1));
		return $this->db->affected_rows()>0?TRUE:FALSE;
	}

	// edit profile data 
	public function edit_profile() 
	{
		$data = array(
			'fac_fname' => ucfirst($this->input->post('fname')),
			'fac_mname' => ucfirst($this->input->post('mname')),
			'fac_lname' => ucfirst($this->input->post('lname'))
		);
		$this->db->where('fac_ID', $this->session->userdata('fac_Id'));
		$this->db->update('faculty', $data);
		return $this->db->affected_rows()>0?true:false;
	}

	public function update_seen() 
	{
		$this->db->where('upload_id', $this->session->userdata('fac_Id'));
		$this->db->update('notifications', array('seen' => 1));
		return $this->db->affected_rows()>0?true:false;
	}

	public function receive_notif() 
	{
		$this->db->order_by('date_notify DESC');
		$this->db->select('faculty.fac_fname, faculty.fac_lname, faculty.fac_mname, documents.title, documents.file, notifications.date_notify, notifications.not_id, notifications.click_notification');
		$this->db->from('notifications');
		$this->db->join('documents', 'documents.doc_id = notifications.doc_id');
		$this->db->join('faculty', 'faculty.fac_Id = notifications.fac_ID');
		$this->db->where('documents.fac_ID', $this->session->userdata('fac_Id'));
		$results = $this->db->get();
		return $results->result();
	}

	public function change_pic()
	 {
		$config = array(
			'upload_path'   => 'image',
			'allowed_types' => 'jpg|png|gif', 
			);
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('file')) 
		{
				$data1 = array('upload_data' => $this->upload->data());
				$data  = array(
				'img' => $data1['upload_data']['file_name']
				);
			$this->db->where('fac_ID', $this->session->userdata('fac_Id'));
			$this->db->update('faculty', $data);
			return $this->db->affected_rows()>0?true:false;
		}
	}

	// save faculty
	public function save_faculty() 
	{
		$data = array(
						'fac_ID'	=> $this->input->post('factID'),
						'fac_fname'	=> ucfirst($this->input->post('fname')),
						'fac_mname' => ucfirst($this->input->post('mname')),
						'fac_lname' => ucfirst($this->input->post('lname')),
						'gender' 	=> $this->input->post('gender'),
						'phone_num' => $this->input->post('phoneNo'),
						'date_added'=> mdate( '%Y/%m/%d - %h:%i:%s %a')
					);
		$this->db->insert('faculty', $data);
		$query = $this->db->get('faculty');
		$this->db->insert('users', array(
										'fac_Id'	=> $this->input->post('factID'), 
										'user_name' => $this->input->post('factID'), 
										'user_pass' => md5($this->input->post('factID')),
										'type' => 2,
										'f_id' => $query->last_row()->f_id
										));
		return $this->db->affected_rows() > 0?true:false;
	}

	// save uploaded file
	public function send_sms($number = []) 
	{
		require_once APPPATH."third_party/ChikkaSMS.php";
		$clientId = '43cf76200cbe0477c911f73d58090942a5a2cf58b44984a9d33824c9718956a2';
		$secretKey = '0f723c9a96f4e5c072719d7ec6b870df12cbb3af396304d9dcaecc1f3fb67ae4';
		$shortCode = '29290333444';
		$chikkaAPI = new ChikkaSMS($clientId,$secretKey,$shortCode);
		foreach ($number as $phone_num) {
			$response = $chikkaAPI->sendText('1234561', $phone_num, 'Testing chikka');
		}
		if($_POST) 
		{
		    if ($chikkaAPI->receiveNotifications() === null) 
		    {
		        // header("HTTP/1.1 400 Error");
		        return "Message has not been processed.";
		    }
		    else
		    {
		        return "Message has been successfully processed.";
		    }
		    var_dump($chikkaAPI->receiveNotifications());
		}

		return 'sent';
	}

	public function save_upload() 
	{
		if (!empty($_FILES)) 
		{
			$files 			 = $_FILES;
			$number_of_files = count($_FILES['file']['name']);
			for ($i=0; $i < $number_of_files; $i++) 
			{ 
				$_FILES['file']['name'] 	= $files['file']['name'][$i];
				$_FILES['file']['type'] 	= $files['file']['type'][$i];
				$_FILES['file']['tmp_name'] = $files['file']['tmp_name'][$i];
				$_FILES['file']['error'] 	= $files['file']['error'][$i];
				$_FILES['file']['size'] 	= $files['file']['size'][$i];
				$config = array(
				'upload_path'   => 'documents',
				'allowed_types' => 'pdf', 
				);
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('file')) 
				{
					$fileData   					 = $this->upload->data();
					$uploadData[$i]['file'] 		 = $fileData['file_name'];
					$uploadData[$i]['title_id'] 	 = $this->input->post('doc-title'); // $this->input->post('dateToday');
					$uploadData[$i]['title'] 		 = $this->input->post('title');
					$uploadData[$i]['date_upload']   = mdate( '%Y/%m/%d - %h:%i:%s %a');
					$uploadData[$i]['fac_ID'] 		 = $this->session->userdata('fac_Id');
				}
			}

			if (!empty($uploadData)) 
			{
				$this->db->insert_batch('documents', $uploadData);
				$query = $this->db->query('SELECT doc_id FROM documents');
				if ($query->row()) 
				{
					$f_ID  = $this->input->post('check'); // get all selected checkboxes faculty id
					foreach ($f_ID as $id => $value) 
					{
						$data = array(
							'fac_ID' => $value,
							'doc_id' => $query->last_row()->doc_id // query last document id
						);
						$this->db->insert('views',$data); // insert to views table
					}
				} 
				$this->db->insert('logs', array('fac_ID' 		=> $this->session->userdata('fac_Id'), // insert to logs table
												'task' 	 		=> 'Uploaded',
												'file_title'	=> $this->input->post('title'),
												'log_date'		=> mdate( '%Y/%m/%d - %h:%i:%s %a')
				));
				return $this->db->affected_rows() > 0?true:false;
			}
		}
	}

	// edit faculty
	public function edit_faculty() 
	{
		$data = array(
			'fac_ID'	=> $this->input->post('factID'),
			'fac_fname'	=> ucfirst($this->input->post('fname')),
			'fac_mname' => ucfirst($this->input->post('mname')),
			'fac_lname' => ucfirst($this->input->post('lname')),
			'phone_num' => $this->input->post('phoneNo'),
		);

		$this->db->update('faculty', $data, "f_id = ".$this->input->post('fac-id')." ");
		// also update users id
		$userlog = array(
			'fac_Id' 	=> $this->input->post('factID'),
			'user_name' => $this->input->post('factID'),
		);
		if ($this->db->affected_rows() > 0) 
		{
			$this->db->update('users', $userlog, "f_id = ".$this->input->post('fac-id')."");
			return true;
		} 
		else 
		{
			return false;
		}
	}

	public function openfile() 
	{
		$doc_id = $this->input->post('doc_id');
		$this->db->where('doc_id', $doc_id);
		$this->db->where('fac_ID', $this->session->userdata('fac_Id'));
		$this->db->update('views', array('open' =>1));
		// insert to notification table
		$data = array(
			'fac_ID' 		=> $this->session->userdata('fac_Id'),
			'doc_id' 		=> $doc_id,
			'upload_id'		=> $this->input->post('fac_ID'),
			'date_notify'	=> mdate( '%Y/%m/%d - %h:%i:%s %a')
		);
		$this->db->select('fac_ID');
		$this->db->from('notifications');
		$this->db->where('fac_ID', $this->session->userdata('fac_Id'));
		$this->db->where('doc_id', $doc_id);
		$query = $this->db->get();
		if (!$query->num_rows()) 
		{
			$this->db->insert('notifications', $data);
		}
		return $this->db->affected_rows() > 0?true:false;
	}

	// get list of documents being uploaded by the faculty or administrator
	public function list_uploaded() 
	{
		$this->db->order_by('date_upload DESC');
		$this->db->select('file, title_name, date_upload, documents.doc_id, documents.title');
		$this->db->from('documents');
		$this->db->join('title', 'title.title_id = documents.title_id');
		$this->db->where('documents.fac_ID = "'.$this->session->userdata('fac_Id').'"' );
		$this->db->or_where('documents.fac_ID = "'.$this->session->userdata('fac_Id').'"' );
		$query = $this->db->get();
		return $query->result();
	}

	// 
	public function faculty_seen() 
	{
		$this->db->select('faculty.fac_fname, faculty.fac_mname, faculty.fac_lname, views.open');
		$this->db->from('views');
		$this->db->join('documents', 'documents.doc_id = views.doc_id');
		$this->db->join('faculty', 'faculty.fac_ID = views.fac_ID');
		$this->db->where('documents.fac_ID = "'.$this->session->userdata('fac_Id').'"');
		$query = $this->db->get();
		return $query->result();
	}

	// get list doucments being uploaded by the sender faculty or administrator 
	public function list_upload() 
	{
		$doc_id = $this->input->post('doc_id');
		$this->db->select('faculty.fac_fname, faculty.fac_mname, faculty.fac_lname, views.open');
		$this->db->from('views');
		$this->db->join('documents', 'documents.doc_id = views.doc_id');
		$this->db->join('faculty', 'faculty.fac_ID = views.fac_ID');
		$this->db->where('documents.fac_ID = "'.$this->session->userdata('fac_Id').'"');
		$this->db->where('views.doc_id = "'.$doc_id.'"');
		$query = $this->db->get();
		return $query->result();
	}
}