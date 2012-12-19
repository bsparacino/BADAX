<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Sensors extends REST_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->auth();
		$this->load->model('sensor_model');
	}

	private function auth()
	{
		if(!$this->ion_auth->logged_in())
		{
			$this->response('Unauthorized', 401);
		}
	}

	function item_get($id)
    {
        if(!$id)
        {
            $this->response(NULL, 400);
        }

        $sensors = $this->sensor_model->getSensors($id);
        
        if($sensors)
        {
            $this->response($sensors, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Sensor could not be found'), 404);
        }
    }

    function items_get()
    {            
        $sensors = $this->sensor_model->getSensors();
        
        if($sensors)
        {
            $this->response($sensors, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'No sensors found'), 404);
        }
    }

}