<?php
class Professor_model extends CI_Model {
	

	function create_professor($firstName,$lastName, $department) {

		$new_professor_insert_data = array('FirstName' => $firstName,'LastName'=>$LastName, 'Department' => $department);

		$insert = $this -> db -> insert('professor', $new_professor_insert_data);
		return $insert;
	}

	function professorExists($firstName,$lastName,$department) 
	{
		$this ->db ->select('*');
		$this->db->where('FirstName',$firstName);
		$this->db->where('LastName',$lastName);
		$this->db->where('Department',$department);
		$q = $this -> db -> get('professor');

		if ($q -> num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function getID($firstName,$lastName,$department){

		$this ->db ->select('*');
		$this->db->where('FirstName',$firstName);
		$this->db->where('LastName',$lastName);
		$this->db->where('Department',$department);
		$q = $this -> db -> get('professor');
				log_message("debug", "***********");
		log_message("debug", "firstname ".$firstName." lastname ".$lastName." department ".$department." num rows ".$q->num_rows());
		log_message("debug", "***********");
		

		if ($q -> num_rows() == 0) {
			return NULL;
		} else if ($q -> num_rows() == 1){
			return $q->row()->ProfessorID;
		}else{
			return 'error';
		}
	}

}


