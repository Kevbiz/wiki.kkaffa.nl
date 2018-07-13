<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 21/03/2018
 * Time: 08:23
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/load.php';

if ( isset( $_POST['btn-save-edit-cat'] ) ) {
	if ( ! empty( $_POST['id'] ) && ! empty( $_POST['cat_name'] ) ) {
		$result = $wiki->edit_categorie( $_POST['id'], $_POST['cat_name'] );
		if ( is_array( $result ) ) {
			$wiki->add_log( $user_id, "Heeft categorie: #{$result['edit_id']} {$_POST['cat_name']} aangepast." );
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

}