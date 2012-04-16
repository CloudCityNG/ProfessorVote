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

    function getCollegeByState($state) {
        $q = $this -> db -> query("SELECT * FROM College WHERE State='$state'");
        if ($q -> num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        } else {
            return NULL;
        }
    }
    
    public function collegeByStateAndName($state,$college)
    {
        $decodedCollege = urldecode($college);
        $decodeState = urldecode($state);
        $q = $this->db -> query("SELECT * FROM COLLEGE WHERE State='$decodeState' AND Name='$decodedCollege'");
        if ($q -> num_rows() == 0 || $q -> num_rows() > 1) {
            return NULL;
            // That college doesn't exist OR there is more than one school with the same name in a State. THIS SHOULD NOT BE POSSIBLE.
        } else {
            $CollegeIDRow = $q -> row();
            return $CollegeIDRow;
        }
        
    }
    function loadProfessorByCollege($state,$college) {

        // First part hits the ProfessorList lookup table. We need to find the College ID so we can find all professors ID's that belong to that college
        $q1 = $this -> db -> query("SELECT ID FROM College WHERE Name='$college' AND State='$state'");
        if ($q1 -> num_rows() == 0 || $q1 -> num_rows() > 1) {
            show_404();
            // That college doesn't exist OR there is more than one school with the same name in a State. THIS SHOULD NOT BE POSSIBLE.
        } else {
            $CollegeIDRow = $q1 -> row();
            $collegeID = $CollegeIDRow -> ID;
        }
        // end of First part

        // Second part. we will need to $collegeID from the first part
        $q2 = $this -> db -> query("SELECT * FROM Professorlist WHERE CollegeID='$collegeID'");
        // Now we all the ProfessorID's that go to that college
        if ($q2 -> num_rows() == 0) {
            return NULL;
            // NO Professors In that school exist
        } else {
            foreach ($q2->result() as $row) {
                $ProfessorIDs[] = $row -> ProfessorID;
                // now we have the list of all the professor ID's. We have to to do one final query to get all the professors.
            }
        }
        foreach ($ProfessorIDs as $ID) {
            $q3 = $this -> db -> query("SELECT * FROM Professor WHERE ProfessorID='$ID'");
            $professorRows[] = $q3->row();
            // Adds the Professor object to an array of professors
        }
        return $professorRows;
        // All the professors that were found
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
