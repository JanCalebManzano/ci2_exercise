<?php

    require(APPPATH.'/libraries/REST_Controller.php');
    
    class Api extends REST_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->model('model_schedule');
        }

        //REST -  Fetch all schedules
        function schedules_get(){
            $result = $this->model_schedule->getAllSchedules();
            if($result){
                $this->response($result, 200); 
            } 
            else{
                $this->response("No record found", 404);
            }
        }

    }

?>