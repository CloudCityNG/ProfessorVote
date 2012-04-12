<?php

class Profile extends CI_Controller
{	
	function index()
	{
		$data['main_content'] = 'ProfilePageView';
		$this -> load -> view('includes/template', $data);
	}
	
	function view_profile($username)
	{
		$username = $this -> uri -> segment(3);
		$query = $this -> User_model -> fetch_user($username);
		
		if ($query -> num_rows() == 1)
		{
			$row = $query -> row();
			$data['user']['id'] = $row -> id;
			$data['user']['username'] = $row -> username;
			$data['user']['email_address'] = $row -> email;
			$data['user']['first_name'] = $row -> first;
			$data['user']['last_name'] = $row -> last;
		}
		
		$query -> free_result();
		
		$this -> load -> view('ProfilePageView', $data);
	}
	
	function edit_profile($username)
	{
		$username = $this -> uri -> segment(3);
		
		if ($username == $this -> db_session -> userdata('username'))
		{
			$rules['password'] = 'trim|xss_clean|callback__password_check';
			$rules['password_confirm'] = 'trim|xss_clean|matches[password]';
			$rules['email_address'] = 'trim|required|valid_email|xss_clean|callback__email_duplicate_check';
			$rules['first_name'] = 'trim';
			$rules['last_name'] = 'trim';
		}
		
		else
		{
			$msg = 'You must login to access this restricted area.';
			$this -> db_session -> set_flashdata('flashMessage', $msg, 1);
			redirect('', 'location');
		}
	}
}
