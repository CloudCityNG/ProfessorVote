<?php

class course extends CI_Controller {

	function index() {
		$data['main_content'] = 'add_course_form';

		$this -> load -> view('includes/template', $data);
	}

	function add() {
		$this -> load -> library('form_validation');
		$this -> form_validation -> set_error_delimiters('<div class="alert alert-error">', '</div>');
		// field name, error message, validation rules
		//look into creating global variables for max and min length, and use those instead of constants
		$this -> form_validation -> set_rules('catalog_number', 'Catalog Number', 'trim|required|min_length[6]|max_length[12');
		$this -> form_validation -> set_rules('course_name', 'Course Name', 'trim|required|min_length[4]|max_length[64]|callback_course_check');
		$this -> form_validation -> set_rules('college_name', 'College Name', 'trim|required|min_length[4]|max_length[64]|callback_college_check');
		//look into createing customer validator Valid_coolge_name in the set_rules method
		//$this -> form_validation -> set_rules('college_name', 'College', 'trim|required|valid_college_name');

		if ($this -> form_validation -> run() == FALSE) {
			//reload page with error msg and populate fields.
			$data['main_content'] = 'add_course_form';
			$college_name = $this -> input -> post('college_name');
			if ($college_name != "" && $college_name != NULL) {
				$data['college_name'] = $this -> input -> post('college_name');
			}
			$course_name = $this -> input -> post('course_name');
			if ($course_name != "" && $course_name != NULL) {
				$data['course_name'] = $this -> input -> post('course_name');
			}
			$catalog_number = $this -> input -> post('catalog_number');
			if ($catalog_number != "" && $catalog_number != NULL) {
				$data['catalog_number'] = $this -> input -> post('catalog_number');
			}
			$this -> load -> view('includes/template', $data);
		} else {
			//insert into DB
			$this -> load -> model('Course_model');
			$course_name = $this -> input -> post('course_name');
			$catalog_number = $this -> input -> post('catalog_number');
			$college_name = $this -> input -> post('college_name');

			if ($this -> Course_model -> create_course($catalog_number, $course_name, $college_name)) {
				$courseID = $this -> Course_model -> getID($ctalog_number, $college_id);
				$data['main_content'] = 'CourseView';
				$data['courseID'] = $courseID;
				$data['isConfirm'] = TRUE;
				$this -> load -> view('includes/template', $data);
			} else {
				//reload page and show error message
				$data['college_name'] = $this -> input -> post('college_name');
				$data['course_name'] = $this -> input -> post('course_name');
				$data['catalog_number'] = $this -> input -> post('catalog_number');
				$data['error_msg'] = 'Unknown Error.  Course could not be added.' . 'Course: ' . $course_name . ' Catalog Number: ' . $catalog_number . ' College: ' . $college_name;
				$this -> load -> view('includes/template', $data);
			}
		}
	}

	public function course_check() {
		//needs to take into account catalognumber and college. but they cant both be called in the same string.
		$this -> load -> model('Course_model');
		$this -> load -> model('College_model');
		$catalogNumber = $this -> input -> post('catalog_number');
		$data=array();
		if($catalogNumber==''||$catalogNumber==null){
			echo "Please provide a course catalog number.";
			return;
		}
		if($catalogNumber==''||$catalogNumber==null){
			echo "Please provide a course catalog number.";
			return;
		}
		
		log_message('debug',"catalog_number: " . $catalogNumber);
		$collegeName = $this -> input -> post('college_name');
		log_message('debug',"college_name: " . $collegeName);
		$collegeID = $this->College_model->getID($collegeName);
		log_message('debug',"college_ID: " . $collegeID);
		$result = $this -> Course_model -> courseExists($catalogNumber, $collegeID);
		log_message('debug',"courseExists: " . $result);
		if ($result == TRUE) {
			//$this -> form_validation -> set_message('course_check', 'The course and college combination you entered already exists.');
			echo "false";
		} else {
			echo "true";
		}

	}

	public function college_check($str) {
		$this -> load -> model('College_model');
		$result = $this -> College_model -> collegeExists($str);
		if ($result == TRUE) {
			$this -> form_validation -> set_message('college_check', 'The college you entered was not found.  If the college does not yet exist, the college must be created first.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

}
