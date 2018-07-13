<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 25/03/2018
 * Time: 20:56
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/load.php';


$result = $wiki->get_new_notifications();

if($result == 'error'){
	echo 'no notifications';
} else {
	$result = json_encode($result);

	echo $result;

	$new = json_decode($result);
	foreach($new as $key){
		$wiki->disable_notifcication($key->id);
	}
}