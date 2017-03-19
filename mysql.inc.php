<?php
	//Define the constants for accessing the database
	DEFINE('DB_USER', 'root');
	DEFINE('DB_PASSWORD', 'password');
	DEFINE('DB_HOST', 'localhost');
	DEFINE('DB_NAME', 'testdb');

	//Make the connection to the database with the values from above
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	//Establish the character set:
	mysqli_set_charset($dbc, 'utf8');

	//Make data safer to use in queries by 1) removing slashes when Magic Quotes is enabled 2) Trimming extra spaces from data
	//3) Running the data through the mysqli_real_escape_string() function
	function escape_data($data, $dbc){
		if(get_magic_quotes_gpc()){
			$data = stripslashes($data);
		}
		return mysqli_real_escape_string($dbc, trim($data));
	}//End escape_data


