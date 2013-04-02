<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Room_model extends CI_Model
{

	public function create($inputData = array())
	{
		$data = array(
			'title' => $inputData['title'],
			'description' => $inputData['description'],
		);

		$this->db->insert('rooms', $data);
		return $this->db->insert_id();
	}

	public function update($id, $inputData = array())
	{
		$data = array(
			'title' => $inputData['title'],
			'description' => $inputData['description'],
		);

		$this->db->where('id', $id);
		return $this->db->update('rooms', $data);
	}

	public function getRooms($id='')
	{
		$this->db->select('id,title,description');
		$this->db->from('rooms');
		if($id) $this->db->where('id', $id);
		$this->db->order_by('title');
		$rooms = $this->db->get()->result();		

		return $rooms;
	}

}