<?php
include('CoursePulse/Pulse.vote.class.php');
class TestPulse extends CI_Controller {

	function index() {
		$this -> load -> model('College_model');
		$data['records'] = $this -> College_model -> getAll();
		$data['main_content'] = 'TestPulsePage';
		$this -> load -> view('includes/template', $data);
	}

}
