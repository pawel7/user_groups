<?php

require_once __DIR__.'/../libs/lib_db.php';

class Group{
	
    // Return array of rows: group id, name, list of identifiers of users belonging to a group
	public static function Get_All_Groups()
    {
        $query = 
        "SELECT   g.id, name, 
                  GROUP_CONCAT( user_id ) AS user_ids,
                  GROUP_CONCAT( username ) AS user_names
         FROM     `groups` g
         LEFT JOIN user_groups ug  ON ( g.id = ug.group_id )
         LEFT JOIN users u ON ( u.id = ug.user_id )
		 GROUP BY g.id";
              
        return Get_All_Rows( $query );
    }

    // Return group name
	public static function Get_Group_Name( $id )
    {
        $query = 
        "SELECT  name
		 FROM    `groups` 
		 WHERE   id = $id";
		 
        return Get_Single_Result( $query );
    }
	
    // Return info about a user with list of identifiers and names of groups to which he belongs 
	// Returns NULL if no user with such $id
	public static function Get_Group( $id )
    {
        $query = 
        "SELECT g.id, name, 
        GROUP_CONCAT( user_id ) AS user_ids,
        GROUP_CONCAT( username ) AS user_names
        FROM     `groups` g
        LEFT JOIN user_groups ug  ON ( g.id = ug.group_id )
        LEFT JOIN users u ON ( u.id = ug.user_id )
        WHERE  g.id = $id
        GROUP BY g.id";
    
        return Get_Row( $query );
    }

    // Return array of group id => name
    public static function Get_Group_Names()
	{
		$query = "SELECT id, name FROM `groups` ORDER BY id";
		$rows = Get_All_Rows_by_Key( $query );
        $ret = array();
        foreach( $rows as $id => $row )
            $ret[ $id ] = $row['name'];
        return $ret;
	}

   	// Return an array of identifiers of users belonging to a group
	public static function Get_User_Ids( $group_id )
	{
		$query = "SELECT user_id FROM user_groups WHERE group_id = $group_id";
		return array_keys( Get_All_Rows_by_Key( $query, 'user_id' ));
	}
 	
    // Return an array of identifiers of groups to which a user belongs
     public static function Get_User_Group_Ids( $user_id )
     {
         $query = "SELECT group_id FROM user_groups WHERE user_id  = $user_id";
         return array_keys( Get_All_Rows_by_Key( $query, 'group_id' ));
     }
 }