<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function index()
	{
		if( $this->session->userdata("isLoggedIn") == false )
			redirect( "" );

		$emailShort = explode( "@", $this->session->userdata("email") )[0];

		$data["title"] = "Dashboard";
		$data["page_header"] = "Hello, <span class=\"text-warning\">" . $emailShort . "</span>!";
		$this->load->view( "pages/dashboard", $data );
	}
}