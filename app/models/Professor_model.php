<?php
class Professor_model extends CI_Model {

    function create_professor($firstName, $lastName, $department,$collegeID) {
        $new_professor_insert_data = array('FirstName' => $firstName, 'LastName' => $LastName, 'Department' => $department);
        $insertProfessor = $this -> db -> insert('professor', $new_professor_insert_data);
        $id = $this->db->insert_id();
        $professorLookUP = array('CollegeID' => $collegeID, 'ProfessorID' => $id);
        $insertLookup = $this -> db -> insert('professorlist', $professorLookUP);
        return $insert;
    }

    function professorExists($firstName, $lastName, $department) {
        $this -> db -> select('*');
        $this -> db -> where('FirstName', $firstName);
        $this -> db -> where('LastName', $lastName);
        $this -> db -> where('Department', $department);
        $q = $this -> db -> get('professor');

        if ($q -> num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function getID($firstName, $lastName, $department) {

        $this -> db -> select('*');
        $this -> db -> where('FirstName', $firstName);
        $this -> db -> where('LastName', $lastName);
        $this -> db -> where('Department', $department);
        $q = $this -> db -> get('professor');
        //log_message("debug", "***********");
        //log_message("debug", "firstname " . $firstName . " lastname " . $lastName . " department " . $department . " num rows " . $q -> num_rows());
        //log_message("debug", "***********");

        if ($q -> num_rows() == 0) {
            return NULL;
        } else if ($q -> num_rows() == 1) {
            return $q -> row() -> ProfessorID;
        } else {
            return 'error';
        }
    }
    
    function getProfessorIDs($firstName, $lastName, $department) {

        $this -> db -> select('*');
        $this -> db -> where('FirstName', $firstName);
        $this -> db -> where('LastName', $lastName);
        $this -> db -> where('Department', $department);
        $q = $this -> db -> get('professor');
        if ($q -> num_rows() == 0) {
            return NULL;
        } else{
            foreach ($q->result() as $row) {
                $ProfessorIDs[] = $row -> ProfessorID;
                // now we have the list of all the professor ID's.
            }
            return $ProfessorIDS;
        }
        
    }
    
    function getAllDepartments(){
        $q = $this -> db -> query("SELECT * FROM departments");
        if ($q -> num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    function professorExistAtCollege($ProfessorIDS,$CollegeID){
        foreach ($ProfessorIDS as $profID) {
            if($q = $this -> db -> query("SELECT * FROM professorlist WHERE CollegeID='$CollegeID' AND ProfessorID='$profID'")){
                return TRUE;
            }
        }
        return FALSE; // That professor doesn't already exist at the college
    }

}
