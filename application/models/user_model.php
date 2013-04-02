<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{

	public function create($inputData = array())
	{
		$data = array(
			'title' => $inputData['title'],
			'description' => $inputData['description'],
		);

		$this->db->insert('users', $data);
		return $this->db->insert_id();
	}

	public function update($id, $inputData = array())
	{
		$data = array(
			'title' => $inputData['title'],
			'description' => $inputData['description'],
		);

		$this->db->where('id', $id);
		return $this->db->update('users', $data);
	}

	public function get($id='')
	{
		$this->db->select('id,username,first_name,last_name,email,phone');
		$this->db->from('users');
		if($id) $this->db->where('id', $id);
		$this->db->order_by('first_name');
		$users = $this->db->get()->result();		

		return $users;
	}

}