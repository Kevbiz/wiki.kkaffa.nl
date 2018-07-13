<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 04/03/2018
 * Time: 15:11
 */
try {

	$host   = SQL_HOST;
	$user   = SQL_NAME;
	$pass   = SQL_PASS;
	$dbname = SQL_DB;


	$conn = new PDO( "mysql:host=$host;dbname=$dbname", $user, $pass );
	$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
} catch ( PDOException $e ) {
	if ( DEBUG ) { echo "Connection failed: " . $e->getMessage(); }
	http_response_code( 404 );
	include( $_SERVER['DOCUMENT_ROOT'] . '/lib/custom_404/404_dbnotfound.php' );
	die();

}
