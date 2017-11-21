<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class LoginM extends CI_Model
{
	
	public function login() 
	{
		$this->db->where('user_name', $this->input->post('usrn'));
		$this->db->where('user_pass', md5($this->input->post('pass')));
		$query 	= $this->db->get('users');

		if ($query->num_rows() == 1) 
		{
			foreach ($query->result() as $row) 
			{
				$data = array(
					'id' 		=> $row->user_id,
					'usern' 	=> $row->user_name,
					'type'		=> $row->type,
					'fac_Id'	=> $row->fac_Id,
					'is_true' 	=> true 
					);
			}
			$this->session->set_userdata($data);
			return true;
		} 
		else 
		{
			return false;
		}
	}
	public function is_loggin() 
	{
		$log = $this->session->userdata('is_true');
		if (!isset($log) && isset($log) != true) 
		{
			redirect(base_url().'/ict_archive');
		}
	}

	public function logout() 
	{
		$this->session->unset_userdata('is_true');
		redirect(base_url().'/ict_archive');
	}

	public function changeP_U() 
	{
		$oldPass = $this->input->post('oldPass');
		$this->db->select('user_pass');
		$this->db->from('users');
		$this->db->where('user_pass', md5($oldPass));
		$query = $this->db->get();
		if ($query->num_rows() > 0) 
		{
			$data = array(
				'user_name' => $this->session->userdata('fac_Id'), 
				'user_pass' => md5($this->input->post('password')));
			$logid = $this->session->userdata('fac_Id');
			$this->db->where('fac_ID', $logid);
			$this->db->update('users', $data);
			return $this->db->affected_rows() > 0?true:false;
		}
		return false;
	}
}