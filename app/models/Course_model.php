<?php
class Course_model extends CI_Model {
	

	function create_course($catalog_number,$course_name, $collegeID) {

		$new_course_insert_data = array('CourseName' => $course_name,'CatalogNumber'=>$catalog_number, 'CollegeID' => $collegeID);

		$insert = $this -> db -> insert('course', $new_course_insert_data);
		return $insert;
	}

	function courseExists($catalog_number,$college_ID) 
	{
		$this ->db ->select('*');
		$this->db->where('CollegeID',$college_ID);
		$this->db->where('CatalogNumber',$catalog_number);
		
		$q = $this -> db -> get('Course');

		if ($q -> num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function getID($catalog_numner, $college_ID){
		$this->db->where('CatalogNumber',$catalog_number);
		$this->db->where('CollegeID',$college_ID);
		$q = $this -> db -> get('course');
		//where college is the same
		if ($q -> num_rows() == 0) {
			return NULL;
		} else if ($q -> num_rows() == 1){
			return $q->row()->id;
		}else{
			return 'error';
		}
	}
	function getCoursesByProfessor($professorID){
		$this->db->where('ProfessorID',$professorID);
		$this->db-> join('courselist','courselist.CourseID=course.courseID');
		$q = $this -> db -> get('course');
		if($q->num_rows()<1){
			return NULL;
		}
		else{
			return $q;
		}
		
		
	}

}


