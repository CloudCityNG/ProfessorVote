<?php

class CollegePage extends CI_Controller {

    function index($College) {
        echo $College;
        $data['main_content'] = 'CollegePage';
        $this -> load -> view('includes/template', $data);
    }

    public function _remap($method) {
        if ($method == NULL) {
            echo 'woos';
        } else {
            $data['main_content'] = 'CollegePage';
            $this -> load -> view('includes/template', $data);
        }
    }

}
