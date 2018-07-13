<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/load.php';

if ( isset( $_POST['save-new-article'] ) ) {
	if ( ! empty( $_POST['categorie'] ) && ! empty( $_POST['subcategorie'] ) && ! empty( $_POST['title'] ) && ! empty( $_POST['bericht'] ) ) {
		$result = $wiki->new_article( $_POST['categorie'], $_POST['subcategorie'], $_POST['title'], $_POST['bericht'] );
		if ( is_array( $result ) ) {
			$wiki->add_log( $user_id, "Heeft artikel: #{$result['last_id']} {$_POST['title']} toegevoegd." );
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
