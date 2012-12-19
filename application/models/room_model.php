<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Room_model extends CI_Model
{

	public function getRooms($id='')
	{
		$this->db->select('id,title,description');
		$this->db->from('rooms');
		if($id) $this->db->where('id', $id);
		$this->db->order_by('title');
		$rooms = $this->db->get()->result();		

		return $rooms;
	}

	public function updateRoom($id, $inputData = array())
	{
		$campaign = $this->getCampaigns($id);
		if(empty($campaign)) return 0;
	
		$this->db->where('id', $id);
		return $this->db->update('campaigns', $inputData);
	}

}