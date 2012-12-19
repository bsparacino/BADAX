<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sensor_model extends CI_Model
{

	public function getSensors($id='')
	{
		$this->db->select('sensors.id,sensors.title,sensors.status,sensor_types.title AS sensor_type,rooms.title AS room');
		$this->db->from('sensors');
		$this->db->join('sensor_types', 'sensors.type = sensor_types.id');
		$this->db->join('rooms', 'sensors.room = rooms.id');
		if($id) $this->db->where('sensors.id', $id);
		$this->db->order_by('sensors.title');
		$sensors = $this->db->get()->result();		

		return $sensors;
	}

	public function updateSensor($id, $inputData = array())
	{
		$campaign = $this->getCampaigns($id);
		if(empty($campaign)) return 0;
	
		$this->db->where('id', $id);
		return $this->db->update('campaigns', $inputData);
	}

}