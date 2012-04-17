<?php

class Professor extends CI_Controller {

	function index() {
		$data['main_content'] = 'ProfessorPage';
		$this -> load -> view('includes/template', $data);
	}

	function view($state = null, $college = null, $firstName = null, $lastName = null, $department = null) {
		$this -> load -> model('Professor_model');
		$this -> load -> model('Course_model');
		$this -> load -> model('College_model');
		$this -> load -> model('State_model');
		$this->load->helper('url');
		$data = array();
		if ($college != null && $firstName != null && $lastName != null && $department != null && $state != null) {
			$college = str_replace("%20"," ",$college);	
		
			if ($this->State_model->stateExists($state)==FALSE) {
				$data['main_content'] = 'HomePage';
				$this -> load -> view('includes/template', $data);
			} else if ($this->College_model->collegeExists($college, $state)==FALSE) {
				$data['main_content'] = 'HomePage';
				$this -> load -> view('includes/template', $data);
				//select state 
			} else if ($this->Professor_model->professorExists($firstName, $lastName, $department)==FALSE) {
			
			redirect(base_url("CollegePage/".$state."/".$college));
			} else {
				$data['firstName'] = $firstName;
				$data['lastName'] = $lastName;
				$data['department'] = $department;
				//TODO:get college name from previous page!!!! THIS codfe should be in else block
				$data2 = array();
				$data['collegeName'] = $college;
				$data2['collegeName'] = $college;
				$data2['professorFirstName'] = $firstName;
				$data2['professorLastName'] = $lastName;
				$data2['professorDepartment'] = $department;
				$collegeID = $this -> College_model -> getID($college);
				$courseNames = $this -> Course_model -> getCourseNameArray($collegeID);
				$catalogNumbers = $this -> Course_model -> getCatalogNumbersArray($collegeID);
				$data2['courseNames'] = $courseNames;
				$data2['catalogNumbers'] = $catalogNumbers;
				$data['addCourse'] = $this -> load -> view("add_course_form", $data2, TRUE);
				$data['main_content'] = 'ProfessorPage';
				$this -> load -> view('includes/template', $data);

			}

		} else {

		}
	}

}
