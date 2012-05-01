<?php
class Course_model extends CI_Model {
/*
 * method to add a a coure to the database.
 */
	function create_course($catalog_number, $course_name, $collegeID) {

		$new_course_insert_data = array('CourseName' => $course_name, 'CatalogNumber' => $catalog_number, 'CollegeID' => $collegeID);

		$insert = $this -> db -> insert('course', $new_course_insert_data);
		return $insert;
	}
/*
 * method to add a course to the database
 */
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
/*
 * returns true if course exists, false if not
 */
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
	/*
	 * returns the courseName from an ID if it exists.
	 * else returns null
	 */
	function getCourseName($courseID){
		$this -> db -> select('*');
		$this -> db -> where('CourseID', $courseID);	
		$q = $this -> db -> get('course');
		log_message("debug","****COURseID:".$courseID);
	log_message("debug","****COURENAME:".$q->row()->CourseName);
		if ($q -> num_rows() < 1) {
			return NULL;
		} else if ($q->num_rows()>1){
			return "error";
		}else
		{
			return $q->row()->CourseName;
		}
	}
	/*
	 * returns the course ID from a college and catalog number.
	 * error returns "error" string
	 * no results returns null;
	 */
	function getCourseID($collegeID,$catalogNumber){
		log_message("debug","****COllegeID:".$collegeID);
		$this->db->where('CollegeID',$collegeID);
		$this->db->where('CatalogNumber',$catalogNumber);
		log_message("debug","****Catnum:".$catalogNumber);
		$q = $this->db->get('Course');
		if ($q -> num_rows() == 1) {
			return $q->row()->CourseID;
		} else if ($q->num_rows()>1){
			return "error";
		}else
		{
			return NULL;
		}
	}
	/*
	 * function to add a comment to DB.
	 * Success returns "success"
	 * else returns  "error"
	 */
	function addComment($comment,$professorID,$courseID){
		$mysqldate = date( 'Y-m-d H:i:s');
		log_message("debug",'::::::::::::::::::::::::::::::');
		log_message("debug",'userid : '.$this->session->userdata('userid'));
		$userID =$this->session->userdata('userid'); 

		$commentData=array('Comment'=>$comment,'ProfessorID'=>$professorID,'CourseID'=>$courseID,'`Date`'=>$mysqldate,'UserID'=>$userID
		);	
		if($this->db->insert('comments',$commentData)){
			return "success";
		}else{
			return "error";
		}
		
	}
	/*
	 * returns all the comments given a coure ID and professor ID
	 */
	function getComments($courseID,$professorID){

		$q=$this->db->query("SELECT *,DATE_FORMAT(c.`Date`,'%W, %M %D, %Y') as DateString FROM comments c where c.CourseID = '".$courseID."' and c.ProfessorID= '".$professorID."'order by DateString asc;");

		if ($q -> num_rows() < 1) {
			return NULL;
		} else {
			foreach ($q->result()as $row) {
				$comments[]=$row;
			};
			return $comments;
		}
	}
/*
 * checks whether or not a course exists for a given courseID and professorID
 * return true or false
 */
	function courseProfessorExists($courseID, $professorID) {
		
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
/*
 * given a catalog number and college id, this method
 * returns the ID of a course if it exists.
 *
 */
	function getID($catalog_number, $college_ID) {
		$this -> db -> where('CatalogNumber', $catalog_number);
		$this -> db -> where('CollegeID', $college_ID);
		$q = $this -> db -> get('course');
				log_message("debug", "***********");
		log_message("debug", "cat num ".$catalog_number."collegeID ".$college_ID." num rows ".$q->num_rows());
		log_message("debug", "***********");
		
		//where college is the same
		if ($q -> num_rows() == 0) {
			return NULL;
		} else if ($q -> num_rows() == 1) {
			return $q -> row() -> CourseID;
		} else {
			return 'error';
		}
	}
/*
 * returns all courses tought be a professor
 */
	function getCoursesByProfessor($professorID) {
		$this -> db -> where('ProfessorID', $professorID);
		$this -> db -> join('courselist', 'courselist.CourseID=course.courseID');
		$this -> db -> order_by('CatalogNumber','asc');
		$q = $this -> db -> get('course');
		if ($q -> num_rows() < 1) {
			return NULL;
		} else {
			foreach ($q->result() as $row) {
				$info =array('CourseName'=>$row -> CourseName, 'CatalogNumber'=>$row->CatalogNumber, 'CourseID' => $row->CourseID);
				$courses[] = $info;
				// now we have the list of all the professor ID's. We have to to do one final query to get all the professors.
			}
		}
		return $courses;

	}
	/*
	 * returns all catalog numbers for a certain collegeID.
	 * this is used for autopopulating text boxes
	 */
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
/*
 * returns all course names for a given college ID
 * this is for auto populating text boxes
 */
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
