<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Faculty extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('loginM', 'm');
		$this->m->is_loggin();
	}

	function index() {
		$this->load->view('faculty');
	}

	public function logout() {
		$this->m->logout();
	}
}