<?php
require_once 'header.php';
require_once 'connect.php';
require_once 'libs/lib_main0.php';

if(count($_POST)>0)
{
	$id = $_POST['id'] ?? 0;
	if( $id > 0 )
	{
		//my_dump($_POST,'_POST');
		//my_dump( md5('abc'), 'md5(abc)');
		//my_dump( md5('1234'), 'md5(1234)');
		
		$password = $_POST['password'];
		$h_password = $_POST['h_password'];
        $old_password = $_POST['old_password'];
        if( md5($old_password ) != $h_password )
		{
			//Info( 'md5(old_password )= '. md5($old_password ) );
			//Info( 'h_password= '.$h_password);
			Error('You provided wrong old password');
		}
		elseif( $old_password == $password )
		{
			Error( 'Old and new passwords are the same');
		}
		else
		{
			$password = md5( $password );
			
			$query = "UPDATE  `users` SET password = '$password' WHERE id=$id";
			
			if($mysqli->query($query)) {
				Info("Password was changed for user with id <b>$id</b>");
				Info("Query: ".$query);
			} 
			else {
				Error( "Error executing query <br> $query <br>" . $mysqli->error);
			}
			$mysqli->close(); 
		}
	}
	else
	{
		Error('User id not provided');
	}
}
else 
{
	Error("<code>save_password.php</code> can be used only with <b><code>POST</code></b> method");
}

require_once "footer.php";