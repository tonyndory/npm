<?php

$DB_SERVER = "127.0.0.1";
$DB_USER = "root";
$DB_PASS = "password";
$DB_DATABASE = "npm";

/*
	Function Name:		db_connect
	Arguments:			None.
	Returns:			Int, MySql Link Identifier
*/
function db_connect() {
	global $DB_SERVER, $DB_USER, $DB_PASS, $DB_DATABASE;
	$link_id = @mysql_connect($DB_SERVER, $DB_USER, $DB_PASS) or die ("I'm sorry... I couldn't find the database server.  Please try back a little later. Thanks!");
	if (!$link_id) {
		return 0;
	}
	mysql_select_db($DB_DATABASE) or die ("I'm sorry, I couldn't find the database.  Please try back a little later. Thanks!");
	return $link_id;
}

/**
 * @return resource
 * @param string $query
 * @desc Fetch a data from the database
*/
function getdata($query) {
	global $link_id;
	if (!$link_id) $link_id = db_connect();
	if ($link_id <> 0) {
		$results = mysql_query($query);
		$numrows = mysql_affected_rows($link_id);
		if ($numrows < 1) return;
	}
	return $results;
}

/*
	Function Name:		setdata
	Arguments:			String $query
	Returns:			Int, MySql Result Resource
*/
function setdata($query) {
	global $link_id;
	if (!$link_id) $link_id = db_connect();
	if ($link_id <> 0) {
		$results = mysql_query($query);
		$numrows = mysql_affected_rows($link_id);
		return $numrows;
	}
}
?>