<?php
include ('CoursePulse/Pulse.vote.class.php');
class College extends CI_Controller {

	function index() {
		$this -> browse();
	}
	function view($name=null){
		if($name==null){
			$this->browse();
		}
		else{
		$data['college_name'] = $name;
		$data['main_content'] = 'CollegeView';
		$this -> load -> view('includes/template', $data);
			
			
		}
	}

	function browse($letter=NULL) {
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
			if($list==FALSE){
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

}
