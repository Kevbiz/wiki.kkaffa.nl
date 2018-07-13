<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 04/03/2018
 * Time: 15:06
 */
session_start();



if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

if ( file_exists( ABSPATH . 'config.php' ) ) {

	require_once( ABSPATH . 'config.php' );

}

if ( file_exists( ABSPATH . '/lib/database.php' ) ) {

	require_once( ABSPATH . '/lib/database.php' );

	$db = $conn;

}

if ( isset( $_SESSION['user_session'] ) ) {
	$stmt = $conn->prepare("SELECT * FROM users WHERE user_id=:id");
	$stmt->bindValue(':id', $_SESSION['user_session']);
	$stmt->execute();

	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$count = $stmt->rowCount();

	if($count = 1){
		$user_details = $row;
		$user_details['error'] = 'none';
	} else {
		$user_details['error'] = 'true';
	}

	$user_details = json_decode( json_encode($user_details), false);
} else {
	$user_details['error'] = 'Niet ingelogd';
}

if ( file_exists( ABSPATH . '/lib/class.wiki.php' ) ) {

	require_once( ABSPATH . '/lib/class.wiki.php' );

	$wiki = new Wiki( $db );

}

if(isset($_SESSION['user_session'])){
	$user_id = $_SESSION['user_session'];
} else {
	$user_id = 0;
}