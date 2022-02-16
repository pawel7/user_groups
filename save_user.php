<?php
if(isset($_POST['cancel']))
{
	header('location: show_users.php');
	die();
}
require_once 'header.php';
require_once 'connect.php';
require_once 'libs/lib_main0.php';
require_once 'users_view.php';
require_once 'connect.php';

if(count($_POST)>0)
{
	if( isset($_POST['delete'] ))
	{
		//require_once 'users_view.php';
		//require_once 'connect.php';
		
		$id=$_POST['id'];
		$query = "SELECT id FROM `users` WHERE id=$id ";
		$result = $mysqli->query($query);
		if( $result->num_rows == 0 )
		{
			Error( "User with id = $id does not exist");
		}
		else
		{
			$query = "DELETE FROM `users` WHERE id=$id ";
			
			if($mysqli->query($query)) {
				Info( "User with id = $id was deleted");
			} 
			else {
				Error( "Error executing query <br> $query <br>" . $mysqli->error);
			}
		}
		//$mysqli->close(); 
		
		Users_View::Show_Users();
	}
	else

	// my_dump( $_POST, '_POST');
	if($_POST['action']=='add'){
		$username = $_POST['username'];
        $password = md5( $_POST['password'] );
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $born_at = $_POST['born_at'];
		
		$query = "INSERT INTO `users`( username, `password`, firstname, lastname, born_at )  
		VALUES ('$username','$password','$firstname','$lastname', '$born_at')";
		//$result = $mysqli->query($query);
		if($mysqli->query($query)) {
			Info( "New user <b>$username ( $firstname $lastname )</b> was added" );
			//echo json_encode(array("statusCode"=>200));
		} 
		else {
			Error( "Error executing query <br> $query <br>" . $mysqli->error);
		}
		
		Users_View::Show_Users();
		$mysqli->close(); 
	}
	else
	if($_POST['action']=='edit'){
		$id=$_POST['id'];
		$username = $_POST['username'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $born_at = $_POST['born_at'];
		$query = "UPDATE  `users` SET username = '$username', 
			firstname = '$firstname', lastname = '$lastname', born_at = '$born_at'  
			WHERE id=$id";
		
		if($mysqli->query($query)) {
			Info("User <b>$username ( $firstname $lastname )</b> was updated");
		} 
		else {
			Error( "Error executing query <br> $query <br>" . $mysqli->error);
		}
		Users_View::Show_Users();
		$mysqli->close(); 
	}
}
else 
{
	Error("<code>save_user.php</code> can be used only with <code>POST</code> method to update or insert a user");
}

require_once "footer.php";