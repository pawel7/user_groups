<?php
require_once 'header.php';
require_once 'connect.php';
require_once 'libs/lib_main0.php';
require_once 'groups_view.php';

if(count($_POST)>0)
{
	$id = $_POST['id'] ?? 0;
	if( $id == 0 )
	{
		Error( '$_POST["id"] is not set');
		Groups_View::Show_Links('left');
		require_once "footer.php";
		die();
	}

	$query = "DELETE FROM `user_groups` WHERE user_id = $id";
	
	if($mysqli->query($query)) {
		Info( "Groups for user with id <b>$id</b> were deleted" );
	} 
	else {
		Error( "Error executing query <br> $query <br>" . $mysqli->error);
	}

		// prepare vals as pairs (group_id, user_id), where
		// group_ids = numeric array_keys($_POST) and user_id always = $id
	$vals = array();
	$group_found = false;
	foreach( array_keys( $_POST ) as $key )
	{
		if( is_numeric($key) )
		{
			$group_found = true;
			$vals[] = "($key, $id)";
		}
	}
	//my_dump( $_POST, '$_POST');
	//my_dump( $vals, 'vals');

	if( $group_found )	// at least one checkbox was checked - user $id belongs to a group
	{
		$query = "INSERT INTO `user_groups`( `group_id`, `user_id` )  
		VALUES ".implode(', ', $vals).";";
	
		if($mysqli->query($query)) {
			Info( "Groups for user with id <b>$id</b> were updated" );
			Info( "Query: <code>$query</code>");
		}
		else {
			Error( "Error executing query <br> $query <br>" . $mysqli->error);
		}
	}
	else
	{
		Info( "No groups were selected for user with id <b>$id</b>");
	}
	Groups_View::Show_Links('left');
	$mysqli->close(); 
}
else 
{
	Error("<code>save_user_groups.php</code> can be used only with <code>POST</code> method to update user groups");
}

require_once "footer.php";
