<?php

class Evaluador extends CI_Controller {
	function index() {
		$this->load->helper('url');
		$this->load->view("header");
		$this->load->view("evaluador");
	}
}

?>