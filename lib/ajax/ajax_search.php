<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 11/03/2018
 * Time: 20:32
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/load.php';

if(!empty($_POST['query'])){

	$return = $wiki->search($_POST['query']);

	echo $return;

	//send data to function
} else {
	echo 'leeg';
}


