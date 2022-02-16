<?php

require_once 'config_db.php';   // $db_host, $db_user, $db_pass, $db_name
	
//mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$mysqli = new mysqli( $db_host, $db_user, $db_pass, $db_name );

if ($mysqli->connect_errno) 
	{
		echo("Error connecting with MySQL database: %s<br>\n". $mysqli->connect_error);
		exit();
	};

	/* Set the desired charset after establishing a connection */
//$mysqli->set_charset('utf8mb4');
