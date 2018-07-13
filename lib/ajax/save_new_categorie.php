<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 09/03/2018
 * Time: 07:41
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/load.php';

if ( isset( $_POST['btn-save-new-cat'] ) ) {
	if ( ! empty( $_POST['cat_name'] ) ) {
		$result = $wiki->new_categorie( $_POST['cat_name'] );
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