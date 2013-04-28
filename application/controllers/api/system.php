
<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class System extends REST_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->auth();
		$this->load->model('system_model');
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
        $system = $this->system_model->get();
        echo json_encode($system);
        die();

        if($system)
        {
            $this->response($system, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'No system found'), 404);
        }
    }

    function items_post()
    {
        $inputData = $this->post(null, TRUE);
        $system = $this->system_model->update($inputData);

        $system = $this->system_model->get();
        echo json_encode($system);
        die();


        if($system)
        {
            $this->response($system, 200); // 200 being the HTTP response code
        }
        else
        {
            $this->response(array('error' => 'System not updated'), 404);
        }
    }

}