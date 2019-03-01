<?php

    class Model_schedule extends CI_Model {
    
        
        function getScheduleWithID( $schedID ) {
            $this->db->where( "ID", $schedID );
            $this->db->where( "isActive", true );
            $query = $this->db->get( "tbl_schedule" );

            return $query->result_array();
        }

        function getSchedulesByUser( $userID ) {
            $this->db->where( "createdBy", $userID );
            $this->db->where( "substr(scheduledAt,1,10)", date("Y-m-d") );
            $this->db->where( "isActive", true );
            $this->db->order_by("scheduledAt", "asc");
            $query = $this->db->get( "tbl_schedule" );

            return $query->result_array();
        }

        function insertSchedule( $schedule ) {
            if( $this->db->insert( "tbl_schedule", $schedule ) ){
                return true;
            }else{
                return false;
            }
        }

        function updateSchedule( $schedule ) {
            $query = $this->db->update( "tbl_schedule", array( "description" => $schedule["description"] ), array( "ID" => $schedule["schedID"] ) );
            
            if ( $this->db->affected_rows() > 0 )
                return true;
            else
                return false;
        }

        function deleteSchedule( $schedID ) {
            $this->db->where( "ID", $schedID );
            $query = $this->db->update( "tbl_schedule", array( "isActive" => false ), array( "ID" => $schedID ) );

            if( $query ){
                return true;
            } else {
                return false;
            }
        }
    
    }

?>