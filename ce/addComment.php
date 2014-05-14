<?php

include( 'config.php' );

// validate for a name and comment value
if ( !$_GET['title'] || !$_GET['comment']) {
	echo '{ "result": "false" }';
	die();
}

// if name and comment are both present
$query = 'INSERT INTO comment (title, comment, page) VALUES ("' .  
			$_GET["title"] . '","' . 
			$_GET["comment"] . '","' . 
			$_SERVER["HTTP_REFERER"] . '")';

mysqli_query( $connect, $query ) or die( mysql_error() );

echo '{ "result": "true", "id": "' . mysqli_insert_id($connect) . '"}';  