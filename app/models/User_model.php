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
	
	function update_user($username)
	{
		if (!$this -> validate($username))
		{
			return FALSE;
		}
		
		if (isset($password))
		{
			$this -> db -> set('password', $password);
		}
		
		if (isset($first))
		{
			$this -> db -> set('first_name', $first);
		}
		
		if (isset($last))
		{
			$this -> db -> set('last_name', $last);
		}
		
		$this -> db -> update('Users');
		
		return $this -> db -> affected_rows();
	}
	
	function fetch_user($username)
	{
		if (!$this -> validate($username))
		{
			return FALSE;
		}
		
		if (isset($id))
		{
			$this -> db -> where('id', $id);
		}
		
		if (isset($username))
		{
			$this -> db -> where('username', $username);
		}
		
		if (isset($email))
		{
			$this -> db -> where('email_address', $email);
		}
		
		if (isset($password))
		{
			$this -> db -> where('password', $password);
		}
		
		if (isset($limit) && isset($offset))
		{
			$this -> db -> limit($limit, $offset);
		}
		
		else if (isset($limit))
		{
			$this -> db -> limit($limit);
		}
		
		if (isset($sort_by) && isset($sort_direction))
		{
			$this -> db -> order_by($sort_by, $sort_direction);
		}
		
		$query = $this -> db -> get('User');
		
		if (isset($id) || isset($username) || isset($email))
		{
			return $query -> row(0);
		}
		
		return $query -> result();
	}
}
