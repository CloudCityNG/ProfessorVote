<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class home extends CI_Controller {

    public function index() {
        $this -> load -> model('State_model');
        $this -> load -> model('College_model');
        $data['states'] = $this -> State_model -> getAllStates();
        $data['main_content'] = 'HomePage';
        $this -> load -> view('includes/template', $data);
    }

    function showCollegesFromState() {
        $state = $this -> uri -> segment(3);
        
        if ($state != NULL) {
            $this->session->set_flashdata('state', urldecode($state));
            redirect('home');
            
        } else {
            echo "TODO ERROR page redirect";
        }
    }

    function learnMore() {
        $this -> load -> view('LearnMore');
    }

}
