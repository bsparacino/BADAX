<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log_model extends CI_Model
{

	public function get()
	{
		$this->db->select('timestamp, message');
		$this->db->from('logs');
		$this->db->order_by('timestamp', 'DESC');
		$logs = $this->db->get()->result();		

		return $logs;
	}

	public function create($message)
	{
		$this->db->insert('logs', array('message'=>$message));
		return $this->db->insert_id();
	}

}