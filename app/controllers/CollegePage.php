<?php
/*
 * handles loading and reloading of the view college page
 */
class CollegePage extends CI_Controller {

    public function _remap($method,$params = array()) {
        $this -> load -> model('College_model');
        $exist = $this -> College_model -> collegeByStateAndName(urldecode($method),urldecode($params[0]));
        if ($exist == NULL) {
            show_404(); // for testing purposes
        } else {
            $this -> load -> model('Professor_model');
            $data['collegeINFO'] = $this -> College_model -> collegeByStateAndName(urldecode($method),urldecode($params[0]));
            $data['professors'] = $this -> College_model -> loadProfessorByCollege(urldecode($method),urldecode($params[0]));
            $data['main_content'] = 'CollegePage';
            $this -> load -> view('includes/template', $data);
        }
    }

}
