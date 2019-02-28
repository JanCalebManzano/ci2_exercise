<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Welcome extends CI_Controller {
	
	public function index()
	{
		$data["title"] = "Welcome";
		$data["signup"] = false;
		$this->load->view( "pages/welcome", $data );		
	}

}