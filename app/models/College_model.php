<?php

class College_model extends CI_Model {

    function getAll() {
        $q = $this -> db -> get('college');
        if ($q -> num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
	function getAllFromState($state){
		
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
        $fields = array(0 => 'Name', 1 => 'State',2=>'id');

        $q = $this -> db -> like('Name', $letter, 'after');
        $q = $this -> db -> get('college');
        $html = $this -> util -> make_table($fields, $q);
        return $html;

    }
	function getID($collegeName){
		$this->db->where('Name',$collegeName);
		$q = $this -> db -> get('college');
		//where college is the same
		if ($q -> num_rows() == 0) {
			return NULL;
		} else if ($q -> num_rows() == 1){
			return $q->row()->id;
		}else{
			return 'error';
		}
	}

}
