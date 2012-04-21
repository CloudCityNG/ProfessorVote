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

    function addCollege_Ajax() {
        if ($this -> input -> post('ajax') == '1') {
            $this -> load -> library('form_validation');
            $this -> form_validation -> set_error_delimiters('<div class="alert alert-error">', '</div>');
            $this -> form_validation -> set_rules('college_name', 'College Name', 'trim|required|min_length[4]|max_length[32]');

            if ($this -> form_validation -> run() == FALSE) {
                echo validation_errors();
            } else {
                //insert into DB
                $this -> load -> model('College_model');
                $college_name = $this -> input -> post('college_name');
                $state = $this -> input -> post('state_name');
                if ($this -> College_model -> collegeExists($college_name, $state)) {
                    echo "<div class=\"alert alert-error\">College Already Exist.</div>";
                } else {

                    if ($this -> College_model -> create_college($college_name, $state)) {
                        echo 'true';
                    } else {
                        echo "<div class=\"alert alert-error\">Unkown Error occured.</div>";
                    }
                }
            }
        }
    }

    function college_state_check($str) {
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
