<?php
defined('BASEPATH')OR exit('No direct script access allowed');
/**
* 
*/
class Query_DataM extends CI_Model
{
	// query data for uploaded documents by the sender
	public function make_query_uploaded() {
		$order_column = array("title", "file", "title_name", null);
		$f_id = $this->session->userdata('fac_Id');
		$this->db->select('faculty.fac_ID, fac_fname, fac_mname, fac_lname, date_upload, file, open, title_name, documents.doc_id, documents.title');
		$this->db->from('documents');
		$this->db->join('faculty', 'faculty.fac_ID = documents.fac_ID');
		$this->db->join('views', 'views.doc_id = documents.doc_id');
		$this->db->join('title', 'title.title_id = documents.title_id');
		$this->db->where('views.fac_ID', $f_id);

		if (isset($_POST['search']['value'])) {
			$this->db->like('file', 	  $_POST['search']['value']);
			$this->db->like('title_name', $_POST['search']['value']);
		}
		if (isset($_POST['order'])) {
			$this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else {
			$this->db->order_by('date_upload DESC');
		}
	}

	public function make_datatables_uploaded() {
		$this->make_query_uploaded();
		if ($_POST['length'] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function get_filtered_uploaded() {
		$this->make_query_uploaded();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_all_uploaded() {
		$this->make_query_uploaded();
		return $this->db->count_all_results();
	}

	// make query uploaded by the user
	public function make_query_file() {
		$order_column = array("title", "file", "title_name", null);
		$this->db->select('file, title_name, date_upload, documents.doc_id, documents.title');
		$this->db->from('documents');
		$this->db->join('title', 'title.title_id = documents.title_id');
		$this->db->where('documents.fac_ID = "'.$this->session->userdata('fac_Id').'"' );

		if (isset($_POST['search']['value'])) {
			$this->db->like('file', 	  $_POST['search']['value']);
			$this->db->like('title_name', $_POST['search']['value']);
		}
		if (isset($_POST['order'])) {
			$this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else {
			$this->db->order_by('date_upload DESC');
		}
	}

	public function make_datatables_file() {
		$this->make_query_file();
		if ($_POST['length'] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function get_filtered_file() {
		$this->make_query_file();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_all_file() {
		$this->make_query_file();
		return $this->db->count_all_results();
	}
}