<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Users extends REST_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->auth();
		$this->load->model('user_model');
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

        $sensors = $this->user_model->get($id);
        
        if($sensors)
        {
            $this->response($sensors, 200); // 200 being the HTTP response code
        }
        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    }

    function items_get()
    {            
        $sensors = $this->user_model->get();
        
        if($sensors)
        {
            $this->response($sensors, 200); // 200 being the HTTP response code
        }
        else
        {
            $this->response(array('error' => 'No users found'), 404);
        }
    }

    function items_post()
    {
        $inputData = $this->post(null, TRUE);
        $sensor = $this->user_model->create($inputData);

        if($sensor)
        {
            $this->response($sensor, 200); // 200 being the HTTP response code
        }
        else
        {
            $this->response(array('error' => 'User not created'), 404);
        }
    }

    function item_put($id)
    {
        $inputData = $this->put(null, TRUE);
        $sensor = $this->user_model->update($id, $inputData);

        if($sensor)
        {
            $this->response($sensor, 200); // 200 being the HTTP response code
        }
        else
        {
            $this->response(array('error' => 'User not updated'), 404);
        }
    }

}