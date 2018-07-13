<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 23/03/2018
 * Time: 08:05
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/load.php';

//save_new_notification

if(isset($_POST)){
	if(!empty($_POST['title']) AND !empty($_POST['message']) AND $_POST['type']){
		$result = $wiki->save_new_notification($_POST['title'], $_POST['message'], $_POST['type']);
		echo json_encode( $result );
	} else {
		$error = array(
			'error' => 'leeg'
		);

		echo json_encode( $error );
	}
} else {
	$error = array(
		'error' => 'leeg'
	);

	echo json_encode( $error );
}