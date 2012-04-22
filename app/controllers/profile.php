<?php

class Profile extends CI_Controller
{			
	function index()
	{		
		$data['main_content'] = 'ProfilePageView';
		$this -> load -> view('includes/template', $data);
	}
	
	function view_profile()
	{
		$this -> load -> helper('url');
		$username = $this -> uri -> segment(3);
		
		$this -> load -> model('User_model');
		$query = $this -> User_model -> fetch_user($username);
		
		if ($query)
		{
			extract($query);
				
			$data['last_name'] = $last_name;
			$data['id'] = $id;
			$data['username'] = $username;
			$data['password'] = $password;
			$data['email_address'] = $email_address;
			$data['first_name'] = $first_name;
		}
		
		$data['main_content'] = 'ProfilePageView';	
		$this -> load -> view('includes/template', $data);
	}
	
	function edit_profile()
	{
		$username = $this -> uri -> segment(3);	
			
		if ($username == $this -> session -> userdata('username') && $this -> input -> post('ajax') == '1')
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
		
			if ($this -> form_validation -> run() == FALSE) 
			{
				echo validation_errors();
			} 
			
			else 
			{
				$this -> load -> model('User_model');
				$first_name = $this -> input -> post('first_name');
				$last_name = $this -> input -> post('last_name');			
				$username = $this -> input -> post('username');
				$password = $this -> input -> post('password');	
					
				if ($this -> User_model -> update_user($first_name, $last_name, $username, $password)) 
				{
					echo 'true';
					redirect('profile/view_profile'.$username);
				} 
				
				else 
				{
					echo "<div class=\"alert alert-error\">Unknown Error occured.</div>";
				}
			}
		}
	}
}
