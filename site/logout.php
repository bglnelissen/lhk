<?php
session_start();
// this script is called when a user is forced to log out.
// all the garbage collection and logout shizzle happens here.

// includes
include_once('inc/inc_functions.php');
debugmsg(__FILE__."(".__LINE__.")"."Unset session");

// Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
// if (ini_get("session.use_cookies")) {
//     $params = session_get_cookie_params();
//     setcookie(session_name(), '', time() - 42000,
//         $params["path"], $params["domain"],
//         $params["secure"], $params["httponly"]
//     );
// }

// Finally, destroy the session.
session_destroy();
header('Location: login.php');
?>