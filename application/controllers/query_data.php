<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Query_data extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('query_dataM', 'q');
	}

	public function fetchfile_uploaded() {
		$feth_data 	= $this->q->make_datatables_uploaded();
		$data 		= array();
		foreach ($feth_data as $row) {
			$sub_array 		= array();
			$sub_array[] 	= $row->title;
			$sub_array[]	= $row->file;
			$sub_array[]	= $row->title_name;
			$sub_array[]	= $row->date_upload;
			$sub_array[]	= $row->open;
			$sub_array[]	= $row->doc_id;
			$sub_array[]	= $row->fac_ID;
			$sub_array[]	= $row->fac_fname;
			$sub_array[]	= $row->fac_mname;
			$sub_array[]	= $row->fac_lname;
			$sub_array[]	= $row->date_upload;
			$data[] 		= $sub_array;
		}
		$output = array(
			"draw" 				=> intval($_POST['draw']),
			"recordsTotal" 		=> $this->q->get_all_uploaded(),
			"recordsFiltered" 	=> $this->q->get_filtered_uploaded(),
			"data" 				=> $data
		);
		echo json_encode($output);
	}

	public function fetchfile_file() {
		$feth_data 	= $this->q->make_datatables_file();
		$data 		= array();
		foreach ($feth_data as $row) {
			$sub_array 		= array();
			$sub_array[] 	= $row->title;
			$sub_array[]	= $row->file;
			$sub_array[]	= $row->title_name;
			$sub_array[]	= $row->date_upload;
			// $sub_array[]	= $row->open;
			$sub_array[]	= $row->doc_id;
			// $sub_array[]	= $row->fac_ID;
			// $sub_array[]	= $row->fac_fname;
			// $sub_array[]	= $row->fac_mname;
			// $sub_array[]	= $row->fac_lname;
			// $sub_array[]	= $row->date_upload;
			$data[] 		= $sub_array;
		}
		$output = array(
			"draw" 				=> intval($_POST['draw']),
			"recordsTotal" 		=> $this->q->get_all_file(),
			"recordsFiltered" 	=> $this->q->get_filtered_file(),
			"data" 				=> $data
		);
		echo json_encode($output);
	}
}