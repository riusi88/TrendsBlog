<?php

include( 'config.php' );

// validate for a name and comment value
if ( !$_GET['title'] || !$_GET['comment']) {
	echo '{ "result": "false" }';
	die();
}

// escaping
$title = mysqli_real_escape_string($connect, $_GET['title']);
$title = strip_tags($title);

$comment = mysqli_real_escape_string($connect, $_GET['comment']);
$comment = strip_tags($comment);

$referer = mysqli_real_escape_string($connect, $_SERVER['HTTP_REFERER']);
$referer = htmlentities($referer);

// if name and comment are both present
$query = 'INSERT INTO comment (title, comment, page) VALUES ("' . $title . '","' . $comment . '","' . $referer . '")';

mysqli_query( $connect, $query ) or die( mysql_error() );

echo '{ "result": "true", "id": "' . mysqli_insert_id($connect) . '"}';  
