<?php

include( 'config.php' );

$query = 'SELECT id, title, comment, date FROM comment WHERE page = "' . $_SERVER['HTTP_REFERER'] . '" ORDER BY date ASC';
$result = mysqli_query( $connect, $query ) or die ( mysql_error() );
$data = array();

if ( mysqli_num_rows( $result ) ) {
	while ( $record = mysqli_fetch_assoc( $result ) ) {

		$time = date_create($record['date']);   
		$record['pubdate'] = date_format($time, 'F d, Y -- H:i');

		$data[] = $record;
	}
} 

echo json_encode( $data );