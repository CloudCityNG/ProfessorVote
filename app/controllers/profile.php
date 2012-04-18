<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);	

class Profile extends CI_Controller
{			
	function index()
	{
		//$username = $this -> session -> userdata('username');
		//$username = $this -> uri -> segment(3);
		//$this -> view_profile($username);
		//$data['username'] = $username;
		//$data['main_content'] = 'ProfilePageView';
		//$this -> load -> view('includes/template', $data);
	}
	
	function view_profile()
	{
		$username = $this -> uri -> segment(3);
		
		if ($username == $this -> session -> userdata('username'))
		{
			$this -> load -> model('User_model');
			$username = $this -> input -> post('username');
			$query = $this -> User_model -> fetch_user($username);
		
			echo "<pre>";
			print_r($query);
			echo "</pre>";
			
			var_dump($query);
			
			//$row = $query -> row();
			$data['last_name'] = $query -> last_name;
			$data['id'] = $query -> id;
			$data['username'] = $query -> username;
			$data['password'] = $query -> password;
			$data['email_address'] = $query -> email_address;
			$data['first_name'] = $query -> first_name;
			
			//$query -> free_result();
		}
		
		$data['main_content'] = 'ProfilePageView';
		//$data['data'] = $query;
		$this -> load -> view('includes/template', $data);
	}
	
	function edit_profile($username)
	{
		$username = $this -> uri -> segment(3);
			
		if ($username == $this -> session -> userdata('username'))
		{
			$this -> load -> library('form_validation');
			$this -> form_validation -> set_error_delimiters('<div class="alert alert-error">', '</div>');
			// field name, error message, validation rules
			$this -> form_validation -> set_rules('first_name', 'Name', 'trim|required');
			$this -> form_validation -> set_rules('last_name', 'Last Name', 'trim|required');
			//$this -> form_validation -> set_rules('email_address', 'Email Address', 'trim|required|valid_email|is_unique[user.email_address]');
			//$this -> form_validation -> set_rules('username', 'Username', 'trim|required|min_length[4]|is_unique[user.username]');
			$this -> form_validation -> set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
			$this -> form_validation -> set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
		}

		if ($this -> form_validation -> run() == FALSE) 
		{
			$data['main_content'] = 'ProfilePageEdit';
			$this -> load -> view('includes/template', $data);
		} 
		
		else 
		{
			$this -> load -> model('User_model');
			$first_name = $this->input->post('first_name');
			$last_name = $this->input->post('last_name');
			$email_address = $this->input->post('email_address');			
			$username = $this->input->post('username');
			$password = $this->input->post('password');	
				
			if ($this -> User_model -> update_user($first_name, $last_name, $email_address, $username, $password)) 
			{
				//$data = array('username' => $this -> input -> post('username'), 'is_logged_in' => true);
				$this -> session -> set_userdata($data);
				redirect('profile/view_profile/'.$username);
			} 
			
			else 
			{
				$data['main_content'] = 'ProfilePageEdit';
				$this -> load -> view('includes/template', $data);
			}
		}

	}
}
