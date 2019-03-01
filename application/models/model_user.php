<?php

    class Model_user extends CI_Model {
    
        function getUserWithID( $userID ) {
            $this->db->where( "ID", $userID );
            $this->db->where( "isActive", true );
            $query = $this->db->get( "tbl_user" );

            return $query->result_array();
        }

        function getUserWithEmailAndPassword( $user ) {
            $this->db->where( "email", $user["email"] );
            $this->db->where( "password", $user["password"] );
            $query = $this->db->get( "tbl_user" );

            return $query;
        }

        function insertUser( $newUser ) {
            $isInserted = $this->db->insert( "tbl_user", $newUser );
            $affectedRows = $this->db->affected_rows();

            if( $isInserted && $affectedRows > 0 )  // if inserted
                    return true;
            else
                return false;
        }

            function isEmailUnique( $email ) {
                $this->db->where( "email", $email );
                $query = $this->db->get( "tbl_user" );

                if( $query->num_rows > 0 )  // if email exists
                    return false;
                else
                    return true;
            }

            function isEmailExisting( $email ) {
                $this->db->where( "email", $email );
                $query = $this->db->get( "tbl_user" );

                if( $query->num_rows > 0 )  // if email exists
                    return true;
                else
                    return false;
            }
    
    }

?>