<?php

class CollegePage extends CI_Controller {

    // function index($College = NULL) {
        // echo $College;
        // if($College != NULL){
//         
        // $data['main_content'] = 'CollegePage';
        // $this -> load -> view('includes/template', $data);
        // }
        // else{
            // show_404();
        // }
    // }

    public function _remap($method,$params = array()) {
        $this -> load -> model('College_model');
        $exist = $this -> College_model -> collegeByStateAndName($method,$params[0]);
        if ($exist == NULL) {
            show_404();
        } else {
            $data['collegeINFO'] = $this -> College_model -> collegeByStateAndName($method,$params[0]);
            $data['main_content'] = 'CollegePage';
            $this -> load -> view('includes/template', $data);
        }
    }

}
