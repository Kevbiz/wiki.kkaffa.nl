<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 26/03/2018
 * Time: 20:46
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/load.php';


if(isset($_POST['id'])){
	$result = $wiki->delete_cat($_POST['id']);
	echo json_encode( $result );
} else {
	$error = array(
		'error' => 'leeg'
	);

	echo json_encode( $error );
}