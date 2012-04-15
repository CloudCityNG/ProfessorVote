<?php

class College_model extends CI_Model {

    function getAll() {
        $q = $this -> db -> get('College');
        if ($q -> num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    function getCollegeByState($state){
        $q = $this -> db -> query("SELECT * FROM College WHERE State='$state'");
        if($q ->num_rows() > 0){
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        else{
            return NULL;
        }
    }

    function collegeExists($college) {
        $q = $this -> db -> get('College');
        if ($q -> num_rows() > 0) {
            foreach ($q->result() as $row) {
                if ($row -> Name == $college) {
                    return TRUE;
                }
            }
            return FALSE;
        }
    }

    function loadCollegeList($letter) {
        //make sure $letter is a letter
        $this -> load -> library('Util');
        $fields = array(0 => 'Name', 1 => 'State', 2 => 'City');

        $q = $this -> db -> like('Name', $letter, 'after');
        $q = $this -> db -> get('College');
        $html = $this -> util -> make_table($fields, $q);
        return $html;

    }

}
