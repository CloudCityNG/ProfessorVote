<?php
class State_model extends CI_Model {
	function getAllStates() {
		$q = $this -> db -> query("SELECT * FROM state");
		if ($q -> num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}

	function stateExists($state) { 
		$this -> db -> where('state', $state);
		$q = $this -> db -> get('State');
		if ($q -> num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

}
