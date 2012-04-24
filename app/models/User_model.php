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
	
	function update_user($first_name, $last_name, $username, $password)
	{
        $oldUserData = $this -> User_model -> fetch_user($username);
        $data = array('last_name' => $last_name,'password' => md5($password),'first_name' => $first_name);
		$this->db->where('id',$oldUserData['id']);
		$update = $this -> db -> update('user',$data);
		//echo $this -> db -> affected_rows();
		return $update;
	}
	
	function fetch_user($username)
	{
		if (isset($username))
		{
			$this -> db -> where('username', $username);
		}	
		
		$query = $this -> db -> get('user');
		
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
		}
// 		
		// else if ($query -> num_rows() > 1)
		// {
			// return $query -> result();
		// }
	}
}
