<?php

class Profile extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this -> is_logged_in();

    }

	/**
	 * Is logged in function.
	 * 
	 * Determines whether the current user and the profile being visited are equal.
	 */
    function is_logged_in() {
    	// Assign the user's current status to the is_logged_in variable.
        $is_logged_in = $this -> session -> userdata('is_logged_in');
		// Assign the third segment in the URL to the username variable.
        $username = $this -> uri -> segment(3);
        
		// If the is_logged_in variable is not set or is false
        if ((!isset($is_logged_in) || $is_logged_in != true)) {
        	// Redirect to the home page
            redirect('');
        }
    }

	/**
	 * Index function.
	 * 
	 * If this function is visited, then the ProfilePageView view is loaded.
	 */
    function index() {
    	// The main content to be loaded is the ProfilePageView view.
        $data['main_content'] = 'ProfilePageView';
		// The main content is also going to be loaded within a template.
        $this -> load -> view('includes/template', $data);
    }

	/**
	 * View profile function.
	 * 
	 * If this function is visited, then the ProfilePageView is loaded with all the user information.
	 */
    function view_profile() {
    	// Load the URL helper.
        $this -> load -> helper('url');
		// Assign the third segment in the URL to the username variable.
        $username = $this -> uri -> segment(3);
		// Load the user_model model so that we can use the functions in it.
        $this -> load -> model('User_model');

		// Calling the fetch_user function in the user_model model.
		// The results should be for the user's profile.
        $query = $this -> User_model -> fetch_user($username);

		// If the query doesn't come back empty, null, or false
        if ($query) {
        	// Extract the data from the query variable 
        	// and assign each piece of data its own variable 
        	// so we can access the variables in the ProfilePageView view.
            extract($query);
            $data['last_name'] = $last_name;
            $data['id'] = $id;
            $data['username'] = $username;
            $data['password'] = $password;
            $data['email_address'] = $email_address;
            $data['first_name'] = $first_name;
        }

		// The main content to be loaded is the ProfilePageView view.
        $data['main_content'] = 'ProfilePageView';
		// The main content is also going to be loaded within a template.
		// The data array, with the main content and all our data variables, are going to be loaded in the view.
        $this -> load -> view('includes/template', $data);
    }

	/**
	 * Edit profile function.
	 * 
	 * This function is called in the ProfilePageEdit view. 
	 * It allows the current logged in user to edit their own profile.
	 */
    function edit_profile() {
    	// Assign the session's username to the username variable.
        $username = $this -> session -> userdata('username');
		// If AJAX is being used
        if ($this -> input -> post('ajax') == '1') {
        	// Load the form validation library, to make sure users don't enter bad things into the form.
            $this -> load -> library('form_validation');
			// Set the error delimiters for the form validator.
            $this -> form_validation -> set_error_delimiters('<div class="alert alert-error">', '</div>');
            // field name, error message, validation rules
            $this -> form_validation -> set_rules('first_name', 'First Name', 'trim|required');
            $this -> form_validation -> set_rules('last_name', 'Last Name', 'trim|required');
            //$this -> form_validation -> set_rules('email_address', 'Email Address', 'trim|required|valid_email|is_unique[user.email_address]');
            //$this -> form_validation -> set_rules('username', 'Username', 'trim|required|min_length[4]');
            $this -> form_validation -> set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
            $this -> form_validation -> set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');

			// If the form validator finds errors
            if ($this -> form_validation -> run() == FALSE) {
            	// Echo the form errors.
                echo validation_errors();
            } else {
            	// Load the user_model model so we can use its functions.
                $this -> load -> model('User_model');
				// Assign the first_name data that the user input in the form to the first_name variable.
                $first_name = $this -> input -> post('first_name');
				// Assign the last_name data that the user input in the form to the last_name variable.
                $last_name = $this -> input -> post('last_name');
				// Assign the password data that the user input in the form to the password variable.
                $password = $this -> input -> post('password');

				// If the function was able to update the user
                if ($this -> User_model -> update_user($first_name, $last_name, $username, $password)) {
                	// Tell AJAX that everything is okay, and to continue with its jQuery
                    echo 'true';  
                } else {
                    echo "<div class=\"alert alert-error\">Unknown Error occured.</div>";
                }
            }
        }
    }
}