<?php
include('CoursePulse/Pulse.vote.class.php');
class Professor extends CI_Controller {

    function index() {
        $data['main_content'] = 'ProfessorPage';
        $this -> load -> view('includes/template', $data);
    }

    public function getCourseListHTML() {
        $this -> load -> model("Course_model");
        $professorID = urldecode($this -> input -> post('professorID'));
        $state =urldecode( $this -> input -> post('state'));
        $collegeName = urldecode($this -> input -> post('collegeName'));
        $firstName = urldecode($this -> input -> post('firstName'));
        $lastName = urldecode($this -> input -> post('lastName'));
        $department = urldecode($this -> input -> post('department'));
        $courses = $this -> Course_model -> getCoursesByProfessor($professorID);

        if (isset($courses) == FALSE || $courses == NULL || count($courses) < 1) {

            echo '<div class="well">
	No courses were found for this professor.  Have you taken a course with this professor? Add It!
	</div>';
        } else {

            foreach ($courses as $course) :

                echo '<div class="well" id="' . $course['CatalogNumber'] . '">
		<div class="catalogNumber">' . anchor(site_url('course/view/' . $state . '/' . $collegeName . '/' . $firstName . '/' . $lastName . '/' . $department . '/' . $course['CatalogNumber']), $course['CatalogNumber']) . '</div>
		<div class="courseName">' . anchor(site_url('course/view/' . $state . '/' . $collegeName . '/' . $firstName . '/' . $lastName . '/' . $department . '/' . $course['CatalogNumber']), $course['CourseName']) . '</div>

	</div>';
            endforeach;
        }
    }

    function view($state = null, $college = null, $firstName = null, $lastName = null, $department = null) {
        $this -> load -> model('Professor_model');
        $this -> load -> model('Course_model');
        $this -> load -> model('College_model');
        $this -> load -> model('State_model');
        $this -> load -> helper('url');
        $data = array();
        if ($college != null && $firstName != null && $lastName != null && $department != null && $state != null) {
        	$college = urldecode($college);
			$firstName = urldecode($firstName);
			$lastName = urldecode($lastName);
			$department = urldecode($department);
			$state = urldecode($state);
            //$college = str_replace("%20", " ", $college);

            if ($this -> State_model -> stateExists($state) == FALSE) {
                $data['main_content'] = 'HomePage';
                $this -> load -> view('includes/template', $data);
            } else if ($this -> College_model -> collegeExists($college, $state) == FALSE) {
                $data['main_content'] = 'HomePage';
				$this->session->set_flashdata('state', urldecode($state));
                $this -> load -> view('includes/template', $data);

            } else if ($this -> Professor_model -> professorExists($firstName, $lastName, urldecode($department)) == FALSE) {

                redirect(site_url("CollegePage/" . $state . "/" . $college));
            } else {
                $data['firstName'] = $firstName;
                $data['lastName'] = $lastName;
                $data['department'] = urldecode($department);
                $data2 = array();
                $data['collegeName'] = $college;
                $data2['collegeName'] = $college;
                $data2['professorFirstName'] = $firstName;
                $data2['professorLastName'] = $lastName;
                $data2['professorDepartment'] = $department;

                $data2['state'] = $state;
                $collegeID = $this -> College_model -> getID($college, $state);
                $courseNames = $this -> Course_model -> getCourseNameArray($collegeID);
                $catalogNumbers = $this -> Course_model -> getCatalogNumbersArray($collegeID);

                $data2['courseNames'] = $courseNames;
                $data2['catalogNumbers'] = $catalogNumbers;

                $professorID = $this -> Professor_model -> getID($firstName, $lastName, $department);
                $data2['professorID'] = $professorID;
                $data['professorID'] = $professorID;
                $data['addCourse'] = $this -> load -> view("add_course_form", $data2, TRUE);

                $data['courses'] = $this -> Course_model -> getCoursesByProfessor($professorID);
                $data['main_content'] = 'ProfessorPage';
                $this -> load -> view('includes/template', $data);

            }

        } else {
            $data['main_content'] = 'HomePage';
            $this -> load -> view('includes/template', $data);
        }
    }

    function addProfessor_Ajax() {
        if ($this -> input -> post('ajax') == '1') {
            $this -> load -> library('form_validation');
            $this -> form_validation -> set_error_delimiters('<div class="alert alert-error">', '</div>');
            $this -> form_validation -> set_rules('professor_first_name', 'Professor First Name', 'trim|required|max_length[32]');
            $this -> form_validation -> set_rules('professor_last_name', 'Professor Last Name', 'trim|required|max_length[32]');
            $this -> form_validation -> set_rules('professor_department', 'Selected Department', 'trim|required|max_length[32]');
            if ($this -> form_validation -> run() == FALSE) {
                echo validation_errors();
            } else {
                //insert into DB
                $this -> load -> model('College_model');
                $this -> load -> model('Professor_model');
                $firstName = $this -> input -> post('professor_first_name');
                $lastName = $this -> input -> post('professor_last_name');
                $departmentName = $this -> input -> post('professor_department');
                $state = $this -> input -> post('state_name');
                $college = $this -> input -> post('college_name');

                $collegeINFO = $this -> College_model -> collegeByStateAndName($state,$college);
                $professorIDS = $this -> Professor_model -> getProfessorIDs($firstName, $lastName, $departmentName);
                if ($this -> Professor_model -> professorExistAtCollege($professorIDS, $collegeINFO -> id)) {
                    echo "<div class=\"alert alert-error\">Professor Already Exist.</div>";
                } else {
                    if ($this -> Professor_model -> create_professor($firstName, $lastName, $departmentName, $collegeINFO -> id)) {
                        echo 'true';
                    } else {
                        echo "<div class=\"alert alert-error\">Unkown Error occured.</div>";
                    }
                }
            }
        }
    }

}
