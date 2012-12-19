<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sensor_types_model extends CI_Model
{

	public function getSensorTypes($id='')
	{
		$this->db->select('id, title, description');
		$this->db->from('sensor_types');
		if($id) $this->db->where('id', $id);
		$this->db->order_by('title');
		$sensors = $this->db->get()->result();		

		return $sensors;
	}

	public function updateSensorType($id, $inputData = array())
	{
		$campaign = $this->getCampaigns($id);
		if(empty($campaign)) return 0;
	
		$this->db->where('id', $id);
		return $this->db->update('campaigns', $inputData);
	}

}