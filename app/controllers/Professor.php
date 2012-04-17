<?php

class Professor extends CI_Controller {

	function index() {
		$data['main_content'] = 'ProfessorPage';
		$this -> load -> view('includes/template', $data);
	}

	function view($firstName = null, $lastName = null, $department = null) {
		$data = array();

		$this -> load -> model('Professor_model');
		$this -> load -> model('Course_model');
		$this -> load -> model('College_model');
		if ($this -> Professor_model -> professorExists($firstName, $lastName, $department) == FALSE) {
			//TODO:load professor not found data
			
			//TODO:get college name from previous page!!!! THIS codfe should be in else block
		
			
			$data['main_content'] = 'CollegePage';
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
			//TODO:get college name from previous page!!!! THIS codfe should be in else block
			$data2=array();
			$collegeName="Kennesaw State University";
			$data['collegeName'] = $collegeName;
			$data2['collegeName'] = $collegeName;
			$data2['professorFirstName'] = $firstName;
			$data2['professorLastName'] = $lastName;
			$data2['professorDepartment'] = $department;
			//TODO:get data arrays to pass to bootsrap typehead
			
			$collegeID = $this->College_model->getID($collegeName);
			$courseNames= $this->Course_model->getCourseNameArray($collegeID);
			$catalogNumbers=$this->Course_model->getCatalogNumbersArray($collegeID);
			$data2['courseNames']=$courseNames;
			log_message("debug",$courseNames);
			$data2['catalogNumbers']=$catalogNumbers;
			$data['addCourse']=$this->load->view("add_course_form",$data2,TRUE);
			$data['main_content'] = 'ProfessorPage';
			$this -> load -> view('includes/template', $data);

		}
	}

}
