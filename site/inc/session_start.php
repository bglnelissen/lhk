<?php
// locale
setlocale(LC_ALL, 'nl_NL');
date_default_timezone_set('Europe/Amsterdam');

// session
session_start();

// log
$_SESSION['user'] = "Bas";
$_SESSION['user_id'] = "1";
$_SESSION['email'] = "b.g.l.nelissen@gmail.com";

$user = $_SESSION['user'];
$user_id = $_SESSION['user_id'];
$session_id = session_id();
$useragent = $_SERVER['HTTP_USER_AGENT'];
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$l = "INSERT INTO log (user, user_id, session_id, useragent, url) VALUES ('$user', '$user_id', '$session_id', '$useragent', '$actual_link');";
if ($connection->query($l) === TRUE) {
  $log_id=$connection->insert_id;
  debugmsg("Succes. Log ID: $log_id, Session ID: $session_id");
}else{
  debugmsg("Fail: ".$connection->error);
}
?>