<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth extends CI_Controller {

    function logout() {
        $this->session->sess_destroy();
        redirect( "" );
    }

    function login() {
        // VALIDATION
        $this->form_validation->set_rules( 'email', 'Email Address', 'trim|required|callback_isEmailExisting|xss_clean' );
        $this->form_validation->set_rules( 'password', 'Password', 'trim|required|xss_clean' );

        if( $this->form_validation->run() == false ) {
            // INVALID INPUT
            $data["title"] = "Welcome";
            $data["signup"] = false;
            $this->load->view( "pages/welcome", $data );
        } else {
            $user = array(
                "email" => $this->input->post("email"),
                "password" => md5( $this->input->post("password") )
            );
            
            // Query user
            $this->load->model( "model_user" );
            $query = $this->model_user->getUserWithEmailAndPassword( $user );

            if( $query->num_rows === 1 ) {
                $userData = $query->_fetch_assoc();
                    $userData["isLoggedIn"] = true;
                    unset( $userData["password"] );

                $this->session->set_userdata( $userData );
                redirect( "dashboard" );
            } else {
                // WRONG PASSWORD
                $data["title"] = "Welcome";
                $data["signup"] = false;
                $data["error_extra"] = "Password is incorrect.";
                $this->load->view( "pages/welcome", $data );
            }
        }
    }

    function signup() {
        // VALIDATION
        $this->form_validation->set_rules( 'email', 'Email Address', 'trim|required|valid_email|callback_isEmailUnique|xss_clean' );
        $this->form_validation->set_rules( 'password', 'Password', 'trim|required|min_length[8]|max_length[32]|xss_clean' );
        $this->form_validation->set_rules( 'password_confirm', 'Password Confirmation', 'trim|required|matches[password]|xss_clean' );

        if( $this->form_validation->run() == false ) {
            // INVALID INPUT
            $data["title"] = "Welcome";
            $data["signup"] = true;
            $this->load->view( "pages/welcome", $data );
        } else {
            $newUser = array(
                "email" => $this->input->post("email"),
                "password" => md5( $this->input->post("password") )
            );
            
            $this->load->model( "model_user" );
            $isInserted = $this->model_user->insertUser( $newUser );

            if( $isInserted ) {
                $userData = array(
                    "email" => $newUser["email"],
                    "isLoggedIn" => true
                );

                $this->session->set_userdata( $userData );
                redirect( "dashboard" );
            } else {
                // NOT INSERTED
                $data["title"] = "Welcome";
                $data["signup"] = true;
                $this->load->view( "pages/welcome", $data );
            }
        }
    }

        // CALLBACK FUNCTIONS
        function isEmailUnique( $email ) {
            $this->load->model( "model_user" );
            $isEmailUnique = $this->model_user->isEmailUnique( $email );
            
            return $isEmailUnique;
        }
        
        function isEmailExisting( $email ) {
            $this->load->model( "model_user" );
            $isEmailExisting = $this->model_user->isEmailExisting( $email );
            
            return $isEmailExisting;
        }

}