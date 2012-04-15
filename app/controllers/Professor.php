<?php

class Professor extends CI_Controller {

	function index() {
		$data['main_content'] = 'ProfessorPage';
		$this -> load -> view('includes/template', $data);
	}

	function view($firstName = null, $lastName = null, $department = null) {
		$data = array();

		$this -> load -> model('Professor_model');
		if ($this -> Professor_model -> professorExists($firstName, $lastName, $department) == FALSE) {
			//load professor not found data
			if ($firstName != null && $firstName != "") {
				$data['firstName'] = $firstName;
			}
			if ($lastName != null && $lastName != "") {
				$data['lastName'] = $lastName;
			}
			if ($department != null && $department != "") {
				$data['department'] = $department;
			}
			//get college name from previous page!!!!
			$data2=array();
			$data2['collegeName'] = "Kennesaw State University";
			
			$data['addCourse']=$this->load->view("add_course_form",$data2,TRUE);
			$data['main_content'] = 'ProfessorPage';
			$this -> load -> view('includes/template', $data);
		} else {
			if ($firstName != null && $firstName != "") {
				$data['firstName'] = $firstName;
			}
			if ($lastName != null && $lastName != "") {
				$data['lastName'] = $lastName;
			}
			if ($department != null && $department != "") {
				$data['department'] = $department;
			}
			$data['addCourse']=$this->load->view("add_course_form");
			$data['main_content'] = 'ProfessorPage';
			$this -> load -> view('includes/template', $data);

		}
	}

}
