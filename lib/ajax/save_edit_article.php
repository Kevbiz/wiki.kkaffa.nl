<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 14/03/2018
 * Time: 22:36
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/load.php';

if ( isset( $_POST['save-article'] ) ) {
	if ( ! empty( $_POST['id'] ) && ! empty( $_POST['title'] ) && ! empty( $_POST['bericht'] ) ) {
		$result = $wiki->edit_article( $_POST['id'], $_POST['title'], $_POST['bericht'] );
		if ( is_array( $result ) ) {
			$wiki->add_log( $user_id, "Heeft artikel: #{$result['edit_id']} {$_POST['title']} aangepast." );
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