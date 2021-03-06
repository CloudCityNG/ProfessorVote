<?php
class User_model extends CI_Model {
	/*
	 * checks if the password is correct for a given username
	 */
	function validate($username, $password) {

		$this -> db -> where('username', $username);
		$this -> db -> where('password', md5($password));
		$query = $this -> db -> get('User');
		if ($query -> num_rows() == 1) {
			return TRUE;
		}

	}
	/*
	 * gets the user ID given the user name
	 */
	function getID($username){
		$this -> db -> where('username', $username);
		$query = $this -> db -> get('User');
		return $query->row()->id;
	}
	/*
	 * method to create a user and add it to the DB
	 */
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
	/*
	 * checks if an email is already assosiated with a user
	 */
	function checkUniqueEmail($email){
		$this -> db -> where('email_address',$email);
		$query = $this->db->get('User');
		if($query -> num_rows() == 1){
			return TRUE;
		}
	}
	/*
	 * checks if a username is already used
	 */
	function checkUniqueUser($user){
		$this -> db -> where('username',$user);
		$query = $this->db->get('User');
		if($query -> num_rows() == 1){
			return TRUE;
		}
	}
	/*
	 * method to update a user information
	 */
	function update_user($first_name, $last_name, $username, $password)
	{
		//var_dump($username);
		//var_dump($first_name);
		//var_dump($last_name);
        $oldUserData = $this -> User_model -> fetch_user($username);
		//var_dump($oldUserData);
        $data = array('last_name' => $last_name,'password' => md5($password),'first_name' => $first_name);
		$this->db->where('id',$oldUserData['id']);
		$update = $this -> db -> update('user',$data);
		return $update;
	}
	/*
	 * gets user information from a username
	 */
	function fetch_user($username)
	{
	    $query = $this -> db -> query("SELECT * FROM user WHERE Username='$username'");
		
		if ($query -> num_rows() == 0 || $query -> num_rows() >1)
		{
			return NULL;
		}
		
		else
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
		// else if ($query -> num_rows() > 1)
		// {
			// return $query -> result();
		// }
	}
}
