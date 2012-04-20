<?php

class Professor extends CI_Controller {

	function index() {
		$data['main_content'] = 'ProfessorPage';
		$this -> load -> view('includes/template', $data);
	}

	public function getCourseListHTML() {
		$this->load->model("Course_model");
		$professorID=$this -> input -> post('professorID');
		$state=$this -> input -> post('state');
		$collegeName=$this -> input -> post('collegeName');
		$firstName=$this -> input -> post('firstName');
		$lastName=$this -> input -> post('lastName');
		$department=$this -> input -> post('department');
		$courses = $this -> Course_model -> getCoursesByProfessor($professorID);
		
		if (isset($courses) == FALSE || $courses == NULL || count($courses) < 1) {

			echo '<div class="well">
	No courses were found for this professor.  Have you taken a course with this professor? Add that shit!
	</div>';
		} else {

			foreach ($courses as $course) :

				echo '<div class="well" id="' . $course['CatalogNumber'] . '">
		<div class="catalogNumber">' . anchor(base_url('course/view/' . $state . '/' . $collegeName . '/' . $firstName . '/' . $lastName . '/' . $department . '/' . $course['CatalogNumber']), $course['CatalogNumber']) . '</div>
		<div class="courseName">' . anchor(base_url('course/view/' . $state . '/' . $collegeName . '/' . $firstName . '/' . $lastName . '/' . $department . '/' . $course['CatalogNumber']), $course['CourseName']) . '</div>

	</div>';
			endforeach;
		}
	}

	function view($state = null, $college = null, $firstName = null, $lastName = null, $department = null) {
		$this -> load -> model('Professor_model');
		$this -> load -> model('Course_model');
		$this -> load -> model('College_model');
		$this -> load -> model('State_model');
		$this -> load -> helper('url');
		$data = array();
		if ($college != null && $firstName != null && $lastName != null && $department != null && $state != null) {
			$college = str_replace("%20", " ", $college);

			if ($this -> State_model -> stateExists($state) == FALSE) {
				$data['main_content'] = 'HomePage';
				$this -> load -> view('includes/template', $data);
			} else if ($this -> College_model -> collegeExists($college, $state) == FALSE) {
				$data['main_content'] = 'HomePage';
				$this -> load -> view('includes/template', $data);
				//TODO:select state
			} else if ($this -> Professor_model -> professorExists($firstName, $lastName, $department) == FALSE) {

				redirect(base_url("CollegePage/" . $state . "/" . $college));
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
				
				$data2['state'] = $state;
				$collegeID = $this -> College_model -> getID($college, $state);
				$courseNames = $this -> Course_model -> getCourseNameArray($collegeID);
				$catalogNumbers = $this -> Course_model -> getCatalogNumbersArray($collegeID);

				$data2['courseNames'] = $courseNames;
				$data2['catalogNumbers'] = $catalogNumbers;
				
				$professorID = $this -> Professor_model -> getID($firstName, $lastName, $department);
				$data2['professorID'] = $professorID;
				$data['professorID'] = $professorID;
				$data['addCourse'] = $this -> load -> view("add_course_form", $data2, TRUE);

				$data['courses'] = $this -> Course_model -> getCoursesByProfessor($professorID);
				$data['main_content'] = 'ProfessorPage';
				$this -> load -> view('includes/template', $data);

			}

		} else {
			$data['main_content'] = 'HomePage';
			$this -> load -> view('includes/template', $data);
		}
	}

}
