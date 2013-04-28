<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class System_model extends CI_Model
{

	public function update($inputData = array())
	{

		if(isset($inputData['status']))
		{
			$this->db->where('field', 'status');
			$this->db->update('system', array('value'=>$inputData['status']));

			$user = $this->ion_auth->user()->row();   

			$CI =& get_instance();
			$CI->load->model('log_model');
			$CI->log_model->create($user->first_name.' '.$user->last_name.' set system status to '.$inputData['status']);
		}

		return true;
	}

	public function get()
	{
		$this->db->select('field,value');
		$this->db->from('system');
		$fields = $this->db->get()->result();	

		$system = array();
		foreach($fields as $row)
		{
			$system[$row->field] = $row->value;
		}

		return $system;
	}

}