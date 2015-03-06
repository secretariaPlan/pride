<?php

class Recovery_pass extends CI_Controller {
	function index() {
		$this->load->helper('url');
		$this->load->view("header");
		$this->load->view("recovery_pass");
		$this->load->view("footer");
	}



	

	
	
}

?>