<?php

class course extends CI_Controller {

	function index() {
		$data['main_content'] = 'add_course_form';

		$this -> load -> view('includes/template', $data);
	}

	public function add() {
		$this -> load -> model('Course_model');
		$this -> load -> model('College_model');
		$this -> load -> model('Professor_model');
		$catalogNumber = $this -> input -> post('catalog_number');
		$response = "";

		if ($catalogNumber === "" or $catalogNumber == null) {
			if ($response === "" or $response == null) {
				$response = "catalog_number_err#Please provide a course catalog number.";
			} else {
				$response .= ('|' . "catalog_number_err#Please provide a course catalog number.");
			}

		} elseif (strlen($catalogNumber) < 6) {
			if ($response === "" or $response == null) {
				$response = "catalog_number_err#The course catalog number must be atleast 6 characters.";
			} else {
				$response .= ('|' . "catalog_number_err#The course catalog number must be atleast 6 characters.");
			}
		} elseif (strlen($catalogNumber) > 12) {
			if ($response === "" or $response == null) {
				$response = "catalog_number_err#The course catalog number must not exceed 12 characters.";
			} else {
				$response .= ('|' . "catalog_number_err#The course catalog number must not exceed 12 characters.");
			}
		}

		//log_message('debug',"catalog_number: " . $catalogNumber);
		$collegeName = $this -> input -> post('college_name');
		$courseName = $this -> input -> post('course_name');
		$firstName=$this -> input -> post('professor_first_name');
		$lastName=$this -> input -> post('professor_last_name');
		$department=$this -> input -> post('professor_department');
		$professorID = $this -> Professor_model-> getID($firstName,$lastName,$department);
		
		if ($courseName === "" or $courseName == null) {
			if ($response === "" or $response == null) {
				$response = $response . "course_name_err#Please provide a course name.";
			} else {
				$response .= ('|' . "course_name_err#Please provide a course name.");
			}

		} elseif (strlen($courseName) < 4) {
			if ($response === "" or $response == null) {
				$response = $response . "course_name_err#The course name must be atleast 4 characters.";
			} else {
				$response .= ('|' . "course_name_err#The course name must be atleast 4 characters.");
			}
		} elseif (strlen($courseName) > 64) {
			if ($response === "" or $response == null) {
				$response = $response . "course_name_err#The course name must not exceed 64 characters.";
			} else {
				$response .= ('|' . "course_name_err#The course name must not exceed 64 characters.");
			}
		}
		if ($response != "") {
			echo $response;
			return;
		}

		$collegeID = $this -> College_model -> getID($collegeName);

		if ($collegeID == null || $collegeID == 'error' || $collegeID == '') {
			echo "error_msg#Error pulling Professor's College data";
			return;
		}
		if ($professorID == null || $professorID == 'error' || $professorID == '') {
			echo "error_msg#Error pulling Professor's data";
			return;
		}
		//need to check if course exists. if it does, see if course/professor exists
		$result = $this -> Course_model -> courseExists($catalogNumber, $collegeID);
		if ($result == TRUE) {
			//$this -> form_validation -> set_message('course_check', 'The course and college combination you entered already exists.');
			//handle error where there already exists that combo
			
			$courseID=$this -> Course_model ->getID($catalogNumber,$collegeID);
			$result2 = $this -> Course_model -> courseProfessorExists($courseID, $professorID);
			if($result2 == TRUE){
			echo "error_msg#This professor already teaches this class.";
			return;	
			}

		}// else {
		//echo "true";
		//	return;
		//}

		//no error, add course
		//insert into DB
		$course_name = $this -> input -> post('course_name');
		$catalog_number = $this -> input -> post('catalog_number');
		$college_name = $this -> input -> post('college_name');
		$college_id = $this -> College_model -> getID($college_name);

		if ($college_id == 'error' || $college_id == '' || $college_id == null) {
			echo 'college_error';
			return;

		}

		if ($this -> Course_model -> add_course($catalog_number, $course_name, $college_id,$professorID)) {
			//success
			echo 'success';
			return;
		} else {
			echo 'error';
			log_message("debug", "Error creating course for catalog number: '" . $catalog_number . "' course name: '" . $course_name . "' college name: '" . $college_name);
			return;
		}

	}

}
