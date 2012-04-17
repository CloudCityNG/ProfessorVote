<?php
class Course_model extends CI_Model {

	function create_course($catalog_number, $course_name, $collegeID) {

		$new_course_insert_data = array('CourseName' => $course_name, 'CatalogNumber' => $catalog_number, 'CollegeID' => $collegeID);

		$insert = $this -> db -> insert('course', $new_course_insert_data);
		return $insert;
	}

	function add_course($catalog_number, $course_name, $collegeID, $professorID) {
		$continue = TRUE;
		if ($this -> courseExists($catalog_number, $collegeID) != TRUE) {
			if (!$this -> create_course($catalog_number, $course_name, $collegeID)) {
				$continue = FALSE;
			}
		}
		if (!$continue) {
			return FALSE;
		}

		$courseID = $this -> getID($catalog_number, $collegeID);
		if ($courseID == 'error' || $courseID == null) {

			return false;
		}
		$new_course_insert_data = array('CourseID' => $courseID, 'ProfessorID' => $professorID);

		$insert = $this -> db -> insert('courselist', $new_course_insert_data);

		return $insert;

	}

	function courseExists($catalog_number, $college_ID) {
		log_message("debug", "***********");
		log_message("debug", "ENTERING COURSEXISTS");
		log_message("debug", "***********");
		$this -> db -> select('*');
		$this -> db -> where('CollegeID', $college_ID);
		$this -> db -> where('CatalogNumber', $catalog_number);

		$q = $this -> db -> get('course');

		if ($q -> num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function courseProfessorExists($courseID, $professorID) {
		log_message("debug", "***********");
		log_message("debug", "ENTERING COURSEPROFESSORXISTS");
		log_message("debug", "***********");
		$this -> db -> select('*');
		$this -> db -> where('CourseID', $courseID);
		$this -> db -> where('ProfessorID', $professorID);

		$q = $this -> db -> get('courselist');

		if ($q -> num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function getID($catalog_number, $college_ID) {
		$this -> db -> where('CatalogNumber', $catalog_number);
		$this -> db -> where('CollegeID', $college_ID);
		$q = $this -> db -> get('course');
		//where college is the same
		if ($q -> num_rows() == 0) {
			return NULL;
		} else if ($q -> num_rows() == 1) {
			return $q -> row() -> CourseID;
		} else {
			return 'error';
		}
	}

	function getCoursesByProfessor($professorID) {
		$this -> db -> where('ProfessorID', $professorID);
		$this -> db -> join('courselist', 'courselist.CourseID=course.courseID');
		$q = $this -> db -> get('course');
		if ($q -> num_rows() < 1) {
			return NULL;
		} else {
			return $q;
		}

	}
	function getCatalogNumbersArray($collegeID = null) {
		if ($collegeID != null) {
			$this -> db -> where('CollegeID', $collegeID);
			$q = $this -> db -> get('course');
			if ($q -> num_rows() < 1) {
				return NULL;
			} else {
				foreach ($q->result() as $row) {
					$data[] = $row -> CatalogNumber;
				}
				return $data;

			}
		} else {
			$q = $this -> db -> get('course');
			if ($q -> num_rows() < 1) {
				return NULL;
			} else {
				foreach ($q->result() as $row) {
					$data[] = $row -> CatalogNumber;
				}
				return $data;

			}
		}
	}

	function getCourseNameArray($collegeID = null) {
		if ($collegeID != null) {
			$this -> db -> where('CollegeID', $collegeID);
			$q = $this -> db -> get('course');
			if ($q -> num_rows() < 1) {
				return NULL;
			} else {
				foreach ($q->result() as $row) {
					$data[] = $row -> CourseName;
				}
				return $data;

			}
		} else {
			$q = $this -> db -> get('course');
			if ($q -> num_rows() < 1) {
				return NULL;
			} else {
				foreach ($q->result() as $row) {
					$data[] = $row -> CourseName;
				}
				return $data;

			}
		}
	}

}
