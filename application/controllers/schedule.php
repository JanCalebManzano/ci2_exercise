<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

    class Schedule extends CI_Controller {

        /**
         * POST
         * Body:
         *      userID
         */
        function getSchedulesByUser() {            
            $response = array();
            $userID = $this->input->post("userID");

            // VALIDATION
            $this->form_validation->set_rules( "userID", "User ID", "trim|required|numeric|xss_clean" );

            if( $this->form_validation->run() == false ) {
                // 400 - userID
                $response = array(
                    "status" => 400,
                    "error" => true,
                    "message" => form_error("userID")
                );
            } else {

                // Query user
                $this->load->model( "model_user" );
                $result = $this->model_user->getUserWithID( $userID );
                if( $result ) {    
    
                    // Query schedule
                    $this->load->model( "model_schedule" );
                    $result = $this->model_schedule->getSchedulesByUser( $userID );
                    
                    if( $result ) {
                        $count = count( $result );
                        $response = array(
                            "status" => 200,
                            "error" => false,
                            "data" => $result,
                            "count" => count( $result ),
                            "message" => ( "Here's your schedule for today, <i class='text-info'>" . date("d-M-Y") . "</i>" )
                        );            
                    } else {
                        // 404 - schedule
                        $response = array(
                            "status" => 404,
                            "error" => true,
                            "data" => null,
                            "message" => ( "Hmmm, looks like you have nothing scheduled for today, <i class='text-info'>" . date("d-M-Y") . "</i>" )
                        );
                    }
    
                } else {
                    // 400 - user
                    $response = array(
                        "status" => 400,
                        "error" => true,
                        "data" => null,
                        "message" => "User with ID of '$userID' does not exist"
                    );
                }

            }
            

            
            
            $this->output
                ->set_status_header( $response["status"] )
                ->set_content_type("application/json", "utf-8")
                ->set_output( json_encode( $response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) )
                ->_display();
            exit;
        }

        /**
         * POST
         * Body:
         *      scheduledAt (datetime)
         *      description
         *      createdBy (userID)
         */
        function insertSchedule() {
            $response = array();
            $schedule = array(
                "scheduledAt" => $this->input->post("scheduledAt"),
                "description" => $this->input->post("description"),
                "createdBy" => $this->input->post("createdBy")
            );

            // VALIDATION
            $this->form_validation->set_rules( "scheduledAt", "Scheduled Date/Time", "trim|required|callback_regex_check_datetime|xss_clean" );
            $this->form_validation->set_rules( "description", "Description", "trim|required|xss_clean" );
            $this->form_validation->set_rules( "createdBy", "User ID", "trim|required|numeric|xss_clean" );

            if( $this->form_validation->run() == false ) {
                // 400 - scheduledAt, description, createdBy
                $response = array(
                    "status" => 400,
                    "error" => true,
                    "message" => validation_errors()
                );
            } else {

                // Query user
                $this->load->model( "model_user" );
                $result = $this->model_user->getUserWithID( $schedule["createdBy"] );
                if( $result ) {  
    
                    // Insert schedule
                    $this->load->model( "model_schedule" );
                    $result = $this->model_schedule->insertSchedule( $schedule );
                    
                    if( $result ) {
                        $response = array(
                            "status" => 200,
                            "error" => false,
                            "data" => $schedule,
                            "insertID" => $this->db->insert_id()
                        );
                    } else {
                        // 500 - schedule
                        $response = array(
                            "status" => 500,
                            "error" => true,
                            "data" => null,
                            "message" => "Schedule can not be inserted"
                        );
                    }
    
                } else {
                    // 400 - user
                    $response = array(
                        "status" => 400,
                        "error" => true,
                        "data" => null,
                        "message" => "User with ID of '" . $schedule["createdBy"] . "' does not exist"
                    );
                }

            }

            


            $this->output
                ->set_status_header( $response["status"] )
                ->set_content_type("application/json", "utf-8")
                ->set_output( json_encode( $response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) )
                ->_display();
            exit;
        }

        /**
         * POST
         * Body:
         *      schedID
         *      description
         */
        function updateSchedule() {
            $response = array();
            $schedule = array(
                "schedID" => $this->input->post("schedID"),
                "description" => $this->input->post("description")
            );

            // VALIDATION
            $this->form_validation->set_rules( "schedID", "Schedule ID", "trim|required|numeric|xss_clean" );
            $this->form_validation->set_rules( "description", "Description", "trim|required|xss_clean" );

            if( $this->form_validation->run() == false ) {
                // 400 - schedID, description
                $response = array(
                    "status" => 400,
                    "error" => true,
                    "message" => validation_errors()
                );
            } else {

                // Query schedule
                $this->load->model( "model_schedule" );
                $result = $this->model_schedule->getScheduleWithID( $schedule["schedID"] );
    
                if( $result ) {
    
                    // Update schedule
                    $this->load->model( "model_schedule" );
                    $result = $this->model_schedule->updateSchedule( $schedule );
    
                    $response = array();
                    if( $result ) { 
                        $response = array(
                            "status" => 200,
                            "error" => false,
                            "data" => $schedule,
                            "affectedRows" => $this->db->affected_rows()
                        );
                    } else {
                        // 400 - schedule
                        $response = array(
                            "status" => 400,
                            "error" => true,
                            "data" => $schedule,
                            "message" => "Hmmm, looks like no updates have been made to the previous data"
                        );
                    }
    
                } else {
                    // 400 - schedule
                    $response = array(
                        "status" => 400,
                        "error" => true,
                        "data" => null,
                        "message" => "Schedule with ID of '" . $schedule["schedID"] . "' does not exist"
                    );
                }

            }


            
            
            $this->output
                ->set_status_header( $response["status"] )
                ->set_content_type("application/json", "utf-8")
                ->set_output( json_encode( $response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) )
                ->_display();
            exit;
        }

        /**
         * POST
         * Body:
         *      schedID
         */
        function deleteSchedule() {
            $response = array();
            $schedID = $this->input->post( "schedID" );

            // VALIDATION
            $this->form_validation->set_rules( "schedID", "Schedule ID", "trim|required|numeric|xss_clean" );

            if( $this->form_validation->run() == false ) {
                // 400 - schedID
                $response = array(
                    "status" => 400,
                    "error" => true,
                    "message" => form_error("schedID")
                );
            } else {

                // Query schedule
                $this->load->model( "model_schedule" );
                $result = $this->model_schedule->getScheduleWithID( $schedID );
    
                if( $result ) {
    
                    // Delete schedule
                    $this->load->model( "model_schedule" );
                    $result = $this->model_schedule->deleteSchedule( $schedID );
    
                    $response = array();
                    if( $result ) { 
                        $response = array(
                            "status" => 200,
                            "error" => false,
                            "data" => $schedID,
                            "affectedRows" => $this->db->affected_rows()
                        );
                    } else {
                        // 400 - schedule
                        $response = array(
                            "status" => 400,
                            "error" => true,
                            "data" => $schedID,
                            "message" => "Hmmm, looks like no updates have been made to the previous data"
                        );
                    }
    
                } else {
                    // 400 - schedule
                    $response = array(
                        "status" => 400,
                        "error" => true,
                        "data" => null,
                        "message" => "Schedule with ID of '" . $schedID . "' does not exist"
                    );
                }

            }


            
            
            $this->output
                ->set_status_header( $response["status"] )
                ->set_content_type("application/json", "utf-8")
                ->set_output( json_encode( $response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) )
                ->_display();
            exit;
        }



        // CALLBACK - form_validation
        public function regex_check_datetime($str)
        {
            if ( ! preg_match('/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/', $str ) )
            {
                return false;
            }
            else
            {
                return true;
            }
        }


    }

?>