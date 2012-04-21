<?php
class User_model extends CI_Model {
	function validate($username, $password) {

		$this -> db -> where('username', $username);
		$this -> db -> where('password', md5($password));
		$query = $this -> db -> get('User');
		if ($query -> num_rows() == 1) {
			return TRUE;
		}

	}
	
	function create_user($first, $last, $email, $username, $password)
	{
		
		$new_user_insert_data = array(
			'first_name' => $first,
			'last_name' => $last,
			'email_address' => $email,		
			'username' => $username,
			'password' => md5($password)						
		);
		
		$insert = $this->db->insert('User', $new_user_insert_data);
		return $insert;
	}
	
	function checkUniqueEmail($email){
		$this -> db -> where('email_address',$email);
		$query = $this->db->get('User');
		if($query -> num_rows() == 1){
			return TRUE;
		}
	}
	
	function checkUniqueUser($user){
		$this -> db -> where('username',$user);
		$query = $this->db->get('User');
		if($query -> num_rows() == 1){
			return TRUE;
		}
	}
	
	function update_user($username)
	{
		if (isset($username))
		{
			$this -> db -> where('username', $username);
			
			if (isset($password))
			{
				$this -> db -> set('password', md5($password));
			}
			
			if (isset($first))
			{
				$this -> db -> set('first_name', $first);
			}
			
			if (isset($last))
			{
				$this -> db -> set('last_name', $last);
			}
		}
			
		$this -> db -> update('User');
		
		return $this -> db -> affected_rows();
	}
	
	function fetch_user($username)
	{	
		if (isset($username))
		{
			$this -> db -> where('username', $username);
		}
		
		$query = $this -> db -> get('User');
		
		if ($query -> num_rows() == 0)
		{
			return NULL;
		}
		
		else if ($query -> num_rows() == 1)
		{
			$row = $query -> row();
			
			$data['last_name'] = $row -> last_name;
			$data['id'] = $row -> id;
			$data['username'] = $row -> username;
			$data['password'] = $row -> password;
			$data['email_address'] = $row -> email_address;
			$data['first_name'] = $row -> first_name;
			
			return $data;
			
			//return $query -> row(0);
		}
	}
}
