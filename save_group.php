<?php
if(isset($_POST['cancel']))
{
	header('location: show_groups.php');
	die();
}
require_once 'header.php';
require_once 'connect.php';
require_once 'libs/lib_main0.php';

require_once 'groups_view.php';
require_once 'connect.php';
		
if(count($_POST)>0)
{
	if( isset($_POST['delete'] ))
	{
		//require_once 'groups_view.php';
		//require_once 'connect.php';
		
		$id=$_POST['id'];
		$query = "SELECT id FROM `groups` WHERE id=$id ";
		$result = $mysqli->query($query);
		if( $result->num_rows == 0 )
		{
			Error( "Group with id = $id does not exist");
		}
		else
		{
			$query = "DELETE FROM `groups` WHERE id=$id ";
			
			if($mysqli->query($query)) {
				Info( "Group with id = $id was deleted");
			} 
			else {
				Error( "Error executing query <br> $query <br>" . $mysqli->error);
			}
		}
		//$mysqli->close(); 
		
		Groups_View::Show_Groups();
	}
	else

	// my_dump( $_POST, '_POST');
	if($_POST['action']=='add'){
		$name = $_POST['name'];
       
		$query = "INSERT INTO `groups`( `name` )  
		VALUES ('$name')";
		//$result = $mysqli->query($query);
		if($mysqli->query($query)) {
			Info( "New group <b>$name</b> was added" );
		} 
		else {
			Error( "Error executing query <br> $query <br>" . $mysqli->error);
		}
		Groups_View::Show_Groups();
		$mysqli->close(); 
	}
	else
	if($_POST['action']=='edit'){
		$id=$_POST['id'];
		$name = $_POST['name'];
        $query = "UPDATE  `groups` SET `name` = '$name'
			WHERE id=$id";
		
		if($mysqli->query($query)) {
			Info("Group <b>$name</b> was updated");
		} 
		else {
			Error( "Error executing query <br> $query <br>" . $mysqli->error);
		}
		Groups_View::Show_Groups();
		$mysqli->close(); 
	}
}
else 
{
	Error("<code>save_group.php</code> can be used only with <code>POST</code> method to update or insert a group");
}

require_once "footer.php";