<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/load.php';


if ( is_numeric( $_POST['cat'] ) ) {
	$cat_id   = $_POST['cat'];
	$articles = $wiki->get_subcategories( $cat_id );

	$articles = json_encode( $articles );
	echo $articles;

}

