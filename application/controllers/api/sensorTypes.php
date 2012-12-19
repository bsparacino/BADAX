<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class SensorTypes extends REST_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->auth();
		$this->load->model('sensor_types_model');
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

        $sensor_types = $this->sensor_types_model->getSensorTypes($id);
        
        if($sensor_types)
        {
            $this->response($sensor_types, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Sensor type could not be found'), 404);
        }
    }

    function items_get()
    {            
        $sensor_types = $this->sensor_types_model->getSensorTypes();
        
        if($sensor_types)
        {
            $this->response($sensor_types, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'No sensor types found'), 404);
        }
    }

}