<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sensor_model extends CI_Model
{

	public function get($id='')
	{
		$this->db->select('sensors.id,sensors.title,sensors.status,sensors.serial,sensor_types.title AS sensor_type,rooms.title AS room_title,rooms.id AS room_id');
		$this->db->from('sensors');
		$this->db->join('sensor_types', 'sensors.type = sensor_types.id');
		$this->db->join('rooms', 'sensors.room = rooms.id');
		if($id) $this->db->where('sensors.id', $id);
		$this->db->order_by('sensors.title');
		$sensors = $this->db->get()->result();		

		return $sensors;
	}

	public function update($id, $inputData = array())
	{
		$data = array(
			'title' => $inputData['title'],
			'type' => $inputData['type'],
			'room' => $inputData['room'],
			'serial' => $inputData['serial'],
		);

		$this->db->where('id', $id);
		return $this->db->update('sensors', $data);
	}

	public function create($inputData = array())
	{
		$data = array(
			'title' => $inputData['title'],
			'type' => $inputData['type'],
			'room' => $inputData['room'],
			'serial' => $inputData['serial'],
		);

		$this->db->insert('sensors', $data);
		return $this->db->insert_id();
	}

}