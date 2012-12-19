<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Rooms extends REST_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->auth();
		$this->load->model('room_model');
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

        $rooms = $this->room_model->getRooms($id);
        
        if($rooms)
        {
            $this->response($rooms, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Room could not be found'), 404);
        }
    }

    function items_get()
    {            
        $rooms = $this->room_model->getRooms();

        if($rooms)
        {
            $this->response($rooms, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'No rooms found'), 404);
        }
    }

}