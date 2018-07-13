<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/load.php';

if ( isset( $_POST['btn-login'] ) ) {
	$user_email    = trim( $_POST['user_email'] );
	$user_password = trim( $_POST['password'] );

	$password = md5( $user_password );

	try {
		$stmt = $db->prepare( "SELECT * FROM users WHERE user_email=:email" );
		$stmt->bindValue( ':email', $user_email );
		$stmt->execute();

		$row   = $stmt->fetch( PDO::FETCH_ASSOC );
		$count = $stmt->rowCount();

		if ( $row['user_password'] == $password ) {
			echo "ok";
			$_SESSION['user_session'] = $row['user_id'];
		} else {
			echo "email or password does not exist.";
		}
	} catch ( PDOException $e ) {
		echo $e->getMessage();
	}
}