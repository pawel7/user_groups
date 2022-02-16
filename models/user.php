<?php

require_once __DIR__.'/../libs/lib_db.php';

class User{
	
	// Return array of info about each user with list of identifiers and names of groups to which he belongs 
	public static function Get_All_Users()
    {
        $query = 
        "SELECT  u.id, username, password, firstname, lastname, born_at, 
		         GROUP_CONCAT( group_id ORDER BY g.id) AS group_ids,
				 GROUP_CONCAT( g.name  ORDER BY g.id ) AS group_names 
		 FROM    users u 
		 LEFT JOIN user_groups ug ON u.id = ug.user_id 
		 LEFT JOIN `groups`     g ON g.id = ug.group_id
		 GROUP BY u.id";
       
        return Get_All_Rows( $query );
    }
		
	// Return info about a user with list of identifiers and names of groups to which he belongs 
	// Returns NULL if no user with such $id
	public static function Get_User( $id )
    {
        $query = 
        "SELECT  u.id, username, password, firstname, lastname, born_at, 
		         GROUP_CONCAT( group_id ORDER BY g.id) AS group_ids,
				 GROUP_CONCAT( g.name  ORDER BY g.id ) AS group_names 
		 FROM    users u 
		 LEFT JOIN user_groups ug ON u.id = ug.user_id 
		 LEFT JOIN `groups`     g ON g.id = ug.group_id
		 WHERE   u.id = $id
		 GROUP BY u.id";
       
        return Get_Row( $query );
    }

	// Return info about a user with list of identifiers and names of groups to which he belongs 
	public static function Get_Username( $id )
    {
        $query = 
        "SELECT  username
		 FROM    users
		 WHERE   id = $id";
		 
        return Get_Single_Result( $query );
    }
		
  // Return array of user id => username
  public static function Get_Usernames()
  {
	  $query = "SELECT id, username FROM `users`";
	  $rows = Get_All_Rows_by_Key( $query );
	  $ret = array();
	  foreach( $rows as $id => $row )
		  $ret[ $id ] = $row['username'];
	  return $ret;
  }

  // Return array of user id => array( username, concat(  firstname, lastname ) AS realname )
  public static function Get_User_Infos()
  {
	  $query = 
	  "SELECT id,
	    username, CONCAT( firstname, ' ', lastname ) AS realname
	   FROM `users`";
	  $rows = Get_All_Rows_by_Key( $query );
	  $ret = array();
	  foreach( $rows as $id => $row )
		  $ret[ $id ] = array( 'username' => $row['username'],
		  					   'realname' => $row['realname'] );
	  return $ret;
  }

  // Return an array of rows: user_id, list of identifiers of groups to which he belongs
  public static function Get_All_Users_Group_Ids()
  {
    $query = 
    "SELECT   user_id, 
     GROUP_CONCAT( group_id ) AS user_group_ids
     FROM     user_groups  
     GROUP BY user_id"; 
       
    return Get_All_Rows( $query );
  }
	
    // Return an array of identifiers of groups the user belongs to
    public static function Get_Group_Ids( $user_id )
    {
        $query = "SELECT group_id FROM user_groups WHERE user_id = $user_id";
        return Get_All_Rows( $query );
    }

}
