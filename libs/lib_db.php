<?php
require_once 'lib_main0.php';

// Return NULL or an array indexed by fields in query
function Get_Row( $query )
{
	
	global $mysqli;
	$ret = NULL;
	if ($result = $mysqli->query($query)) 
	{
		if($row = $result->fetch_assoc())
		{	
			$result->free();
			$ret = $row;
		}
    }
    else
    {
		$query_err_str = $mysqli->error;
		echo( 'Error when executing query '.NL.$query.NL.$query_err_str );
	}
	// var_dump($ret);
    return $ret;
} 

// return NULL or single result
function Get_Single_Result( $query )
{
	global $mysqli;
	
	$ret = NULL;
	if ($result = $mysqli->query($query)) 
	{
		if($row = $result->fetch_array(MYSQLI_NUM))
		{	
			$result->free();
			$ret = $row[0];
		}
    }
    else
    {
		$query_err_str = $mysqli->error;
		echo( 'Error when executing query '.NL.$query.NL.$query_err_str );
	}
    return $ret;
} 

// returns array
function Get_All_Rows( $query )
{
	global $mysqli;
	$rows=array();

	if ($result = $mysqli->query(my_real_escape_string($query)))
	{
		while ($row = $result->fetch_assoc())
		{
			$rows[] = $row;
		}
		$result->free();
    }
    else
    {
		$query_err_str = $mysqli->error;
		echo( 'Get_All_Rows: Error when executing query '.NL.$query.NL.$query_err_str );
		return NULL;
	}
	// var_dump( $rows);
    return $rows;
}

function Get_All_Rows_by_Key( $query, $key='id' )
{
	global $mysqli;
	$rows=array();

	if ($result = $mysqli->query(my_real_escape_string($query)))
	{
		while ($row = $result->fetch_assoc())
		{
			$rows[ $row[$key] ] = $row;
		}
		$result->free();
    }
    else
    {
		$query_err_str = $mysqli->error;
		echo( 'Get_All_Rows_by_Key: Error when executing query '.NL.$query.NL.$query_err_str );
		return NULL;
	}
	//echo "<pre>"; var_dump( $rows); echo "</pre>";
    return $rows;
}

function my_real_escape_string( $x )
{
	return str_replace( '\\', '\\\\', $x );
}

