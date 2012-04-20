<?php
include ('CoursePulse/Pulse.vote.class.php');
class College extends CI_Controller {

	function index() {
		$this -> browse();
	}

	function view($name = null) {
		if ($name == null) {
			$this -> browse();
		} else {
			$data['college_name'] = $name;
			$data['main_content'] = 'CollegeView';
			$this -> load -> view('includes/template', $data);

		}
	}

	function browse($letter = NULL) {
		$this -> load -> model('College_model');
		$data['main_content'] = 'BrowseCollegesPage';
		$params = array('table_name' => 'college', 'column_name' => 'Name');
		$this -> load -> library('AbcBar', $params);

		$data['abcBar'] = $this -> abcbar -> CreateAlphabetNavigationBar();
		if (isset($letter) && strlen($letter) == 1 && ctype_alpha($letter)) {
			$letter = strval($letter);
			$letter = $letter[0];
			$data['letter'] = $letter;
			$list = $this -> College_model -> loadCollegeList($letter);
			if ($list == FALSE) {
				$list = 'No colleges found.';
			}
			$data['list'] = $list;
		}

		$this -> load -> view('includes/template', $data);

	}

	function search() {
		$this -> load -> model('College_model');
		$data['records'] = $this -> College_model -> getAll();
		$data['main_content'] = 'CollegeSearchPage';
		$this -> load -> view('includes/template', $data);
	}

	function addCollege() {
		$this -> load -> library('form_validation');
		$this -> form_validation -> set_error_delimiters('<div class="alert alert-error">', '</div>');

		$this -> form_validation -> set_rules('college_name', 'College Name', 'trim|required|min_length[4]|max_length[32]|callback_college_state_check');
		$this -> form_validation -> set_rules('state', 'State', 'trim|required|min_length[2]|max_length[2]');
		$this -> form_validation -> set_rules('city', 'City', 'trim|required|min_length[4]|max_length[32]');

		if ($this -> form_validation -> run() == FALSE) {
			//reload page with error msg and populate fields.
			$data['main_content'] = 'College_Form';
			$data['college_name'] = $this -> input -> post('college_name');
			$data['state'] = $this -> input -> post('state');
			$data['city'] = $this -> input -> post('city');
			$this -> load -> view('includes/template', $data);
		} else {
			//insert into DB
			$this -> load -> model('College_model');
			$college_name = $this -> input -> post('college_name');
			$state = $this -> input -> post('state');
			$city = $this -> input -> post('city');

			if ($this -> College_model -> create_college($college_name, $state, $city)) {
				//$courseID = $this -> Course_model ->getID($course_name, $college_name);
				$data['main_content'] = 'CollegeConfirm';
				$data['collegeName'] = $college_name;
				$data['isConfirm'] = TRUE;
				$this -> load -> view('includes/template', $data);
			} else {
				//reload page and show error message
				$data['college_name'] = $this -> input -> post('college_name');
				$data['state'] = $this -> input -> post('state');
				$data['city'] = $this -> input -> post('city');
				$data['error_msg'] = 'Unknown Error.  Course could not be added.' . 'College: ' . $college_name . ' State: ' . $state . ' City: ' . $city;
				$this -> load -> view('includes/template', $data);
			}
		}
	}

	public function college_state_check($str) {
		$this -> load -> model('College_model');
		$result = $this -> College_model -> collegeStateExists($str, $this -> input -> post('state'));
		if ($result == TRUE) {
			$this -> form_validation -> set_message('college_state_check', 'The state and college combination you entered already exists.');
			return FALSE;
		} else {
			return TRUE;
		}

	}

}
