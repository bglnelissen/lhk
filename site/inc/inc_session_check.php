<?php
// session
session_start();

// essentials
include_once('inc_functions.php');
include_once('inc_mysqli_connect.php');

// locale
setlocale(LC_ALL, 'nl_NL');
date_default_timezone_set('Europe/Amsterdam');


// Set variables
$name = $_SESSION['name'];
$user_id = $_SESSION['user_id'];
$email = $_SESSION['email'];
// $_SESSION['email_sha1'] already set at login...
$session_id = session_id();
$useragent = $_SERVER['HTTP_USER_AGENT'];
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


// If email is emtpy or user !== sha1(user) exit to login page.
debugmsg(__FILE__."(".__LINE__.")".": email sha1: ". sha1($_SESSION['email']) );
debugmsg(__FILE__."(".__LINE__.")".": stored sha1: ". $_SESSION['email_sha1']);
if (sha1($_SESSION['email'])===$_SESSION['email_sha1']){
  debugmsg(__FILE__."(".__LINE__.")".": Session email hash comparinson is correct.");
}else{
  $_SESSION = array();
  debugmsg(__FILE__."(".__LINE__.")".": Session incorrect.");
  
  debugmsg(__FILE__."(".__LINE__.")".": SHA1(".$_SESSION['email']."): ".sha1($_SESSION['email']));
  debugmsg(__FILE__."(".__LINE__.")".": SHA1 from db: ".$_SESSION['email_sha1']);
  header('Location: logout.php');
  exit;
}

// Log session
$l = "INSERT INTO log (name, user_id, session_id, useragent, url) VALUES ('$name', '$user_id', '$session_id', '$useragent', '$actual_link');";
if ($connection->query($l) === TRUE) {
  $log_id=$connection->insert_id;
  debugmsg(__FILE__."(".__LINE__.")".": Succes. Log ID: $log_id, Session ID: $session_id");
}else{
  debugmsg(__FILE__."(".__LINE__.")".": Fail: ".$connection->error);
}

?>