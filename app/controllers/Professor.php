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
		if ($this -> Professor_model -> professorExists($firstName, $lastName, $department) == FALSE) {
			//TODO:load professor not found data
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
			$data2['collegeName'] = "Kennesaw State University";
			//TODO:get data arrays to pass to bootsrap typehead
			$professorID = $this->Professor_model->getID('Philip','Krogel','Math');
			$courses= $this->Course_model->getCoursesByProfessor($professorID);
			//$data2['courseNames']='';
			//$data2['catalogNumbers']='';
			$data['addCourse']=$this->load->view("add_course_form",$data2,TRUE);
			$data['main_content'] = 'ProfessorPage';
			$this -> load -> view('includes/template', $data);
		} else {//TODO:load professor not found data
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
			$data['collegeName'] = "Kennesaw State University";
			$data2['collegeName'] = "Kennesaw State University";
			$data2['professorFirstName'] = $firstName;
			$data2['professorLastName'] = $lastName;
			$data2['professorDepartment'] = $department;
			//TODO:get data arrays to pass to bootsrap typehead
			$professorID = $this->Professor_model->getID('Philip','Krogel','Math');
			$courses= $this->Course_model->getCoursesByProfessor($professorID);
			//$data2['courseNames']='';
			//$data2['catalogNumbers']='';
			$data['addCourse']=$this->load->view("add_course_form",$data2,TRUE);
			$data['main_content'] = 'ProfessorPage';
			$this -> load -> view('includes/template', $data);

		}
	}

}
