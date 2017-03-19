<?php
	//Define the LIVE and CONTACT_EMAIL constants
	if(!defined('LIVE')){
		DEFINE('LIVE', false);
	}
	DEFINE('CONTACT_EMAIL', 'crodenberg01@bellarmine.edu');//Update this when site goes live

	define('BASE_URI', '/xampp/htdocs/');//Change this to our path
	define('BASE_URL', 'localhost/');//Change this to our base URL
	define('MYSQL', BASE_URI . 'mysql.inc.php');

	//Launch session to track logged-in users
	session_start();

	//Error-handling function
	function my_error_handler($e_number, $e_message, $e_file, $e_line, $e_vars){
		$message = "An error occurred in script '$e_file' on line $e_line:\n$e_message\n";
		$message .= "<pre>" . print_r(debug_backtrace(), 1) . "</pre>\n";

		if(!LIVE){
			echo '<div class = "alert alert-danger">' . nl2br($message) . '</div>';
		}
		else{
			error_log($message, 1, CONTACT_EMAIL, 'From:admin@throwbackhub.com');//Update this to the actual email account
			if($e_number != E_NOTICE){
				echo '<div class = "alert alert-danger">A system error occurred. We apologize for the inconvenience.</div>';
			}
		}//End of $live IF-ELSE
		return true;
	}//End of my_error_handler()

	//Apply the error handler
	set_error_handler('my_error_handler');