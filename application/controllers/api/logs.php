<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Logs extends REST_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->auth();
		$this->load->model('log_model');
	}

	private function auth()
	{
		if(!$this->ion_auth->logged_in())
		{
			$this->response('Unauthorized', 401);
		}
	}

    function items_get()
    {            
        $logs = $this->log_model->get();
        
        if($logs)
        {
            $this->response($logs, 200); // 200 being the HTTP response code
        }
        else
        {
            $this->response(array('error' => 'No logs found'), 404);
        }
    }

}