<?php
include_once('inc_session_check.php'); // including session_start() and in_functions.php
include_once('inc_mysqli_connect.php');

$image_id = $_GET['image_id'];
if (!empty($image_id)) {
	$i = "SELECT * FROM images WHERE image_id = ".$image_id;
	if (!$images_result = $connection->query($i)) {
		debugmsg(__FILE__."(".__LINE__.")".": Fail. Could not retrieve images.");
	}
	if ($images_result->num_rows === 0) {
		debugmsg(__FILE__."(".__LINE__.")".": 0 images found: ".$q);
	}
	$image = $images_result->fetch_assoc();

	 header("Content-Type: ".$image['image_mime']);
	 echo $image['image'];
}

?>