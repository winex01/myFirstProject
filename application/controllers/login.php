<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Login extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('loginM', 'm');
	}

	function index() 
	{
		$this->load->view('index');
	}

	public function login() 
	{
		$result 		= $this->m->login();
		$msg['success'] = false;
		$arr = array('admin', 'faculty');
		$type = $this->session->userdata('type');
		if ($result) 
		{
			$msg['success'] = true;
			$msg['url'] 	= $arr[$type-1];
		} 
		else 
		{
			$msg['invalid'] = 'Invalid username or password';
		}
		echo json_encode($msg);
	}

	public function profile() 
	{
		$logID = $this->session->userdata('fac_Id');
		$query = $this->db->query("SELECT f.fac_fname, f.fac_mname, f.fac_lname, u.user_name, u.user_pass, u.type, f.img, f.gender,f.fac_ID
									FROM faculty f 
									INNER JOIN users u 
									ON u.fac_Id = f.fac_ID  
									WHERE f.fac_ID = '$logID' ");
		echo json_encode($query->row());
	}

	public function changeP_U() 
	{
		$result 		= $this->m->changeP_U();
		$msg['success'] = false;
		if ($result) 
		{
			$msg['success'] = true;
			$msg['msg']		= 'Password or username changed successfully';
		}
		echo json_encode($msg);
	}
	

}