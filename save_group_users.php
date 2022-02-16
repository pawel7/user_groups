<?php
require_once 'header.php';
require_once 'connect.php';
require_once 'libs/lib_main0.php';
require_once 'groups_view.php';

if(count($_POST)>0)
{
	$group_id = $_POST['group_id'] ?? 0;
	if( $group_id == 0 )
	{
		Error( '$_POST["group_id"] is not set');
		require_once "footer.php";
		die();
	}

	$query = "DELETE FROM `user_groups` WHERE group_id = $group_id";
	
	if($mysqli->query($query)) {
		Info( "Group of id = $group_id has been deprived of users" );
	} 
	else {
		Error( "Error executing query <br> $query <br>" . $mysqli->error);
	}

		// prepare vals as pairs (group_id, user_id), where
		// group_id always = $group_id and user_id = numeric array_keys($_POST)
	$vals = array();
	$user_found = false;
	foreach( array_keys( $_POST ) as $key )
	{
		if( is_numeric($key) )
		{
			$user_found = true;
			$vals[] = "($group_id, $key)";
		}
	}
	//my_dump( $_POST, '$_POST');
	//my_dump( $vals, 'vals');

	if( $user_found )	// at least one checkbox was checked 
						// group $group_id has at least one member
	{
		$query = "INSERT INTO `user_groups`( `group_id`, `user_id` )  
		VALUES ".implode(', ', $vals).";";
	
		if($mysqli->query($query)) {
			Info( "Users belonging to group <b>$group_id</b> were updated" );
			Info( "Query: <code>$query</code>");
		}
		else {
			Error( "Error executing query <br> $query <br>" . $mysqli->error);
		}
	}
	else
	{
		Info( "No users belong to group with id <b>$group_id</b>");
	}
	Groups_View::Show_Links('left');
	$mysqli->close(); 
}
else 
{
	Error("<code>save_group_users.php</code> can be used only with <code>POST</code> method to update group users");
}


require_once "footer.php";
