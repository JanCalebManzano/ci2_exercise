<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Schedule extends CI_Controller {

    function getSchedulesByUser() {            
        $userID = $this->input->post("userID");

        $this->load->model( "model_schedule" );
        $query = $this->model_schedule->getSchedulesByUser( $userID );

        $response = array(
            "error" => false,
            "data" => $query->result(),
            "count" => $query->num_rows
        );

        echo json_encode( $response );
    }

    function updateSchedule() {
        $schedule = array(
            "schedID" => $this->input->post("schedID"),
            "description" => $this->input->post("description")
        );

        $this->load->model( "model_schedule" );
        $lastQuery = $this->model_schedule->updateSchedule( $schedule );

        $response = array(
            "error" => false,
            "lastQuery" => $lastQuery
        );

        echo json_encode( $response );
    }

    function createSchedule() {
        $schedule = array(
            "scheduledAt" => $this->input->post("scheduledAt"),
            "description" => $this->input->post("description"),
            "createdBy" => $this->input->post("createdBy")
        );

        $this->load->model( "model_schedule" );
        $query = $this->model_schedule->createSchedule( $schedule );

        $response = array(
            "error" => false,
            "query" => $query
        );

        echo json_encode( $response );
    }

}