<?php

/* register new user */
/* accept get post session username variables */


/* ask for a new password that is conform the password rules */
/* never store the password in the session, encrypt asap */
/* store the password as encrypted blob */
/* send the user back to the login page, fill the username/email field */
?>
<?php
session_start();
$debugmsg = "true";

// set variables
unset($user_warnings_array);

// includes
include_once('inc/inc_functions.php');
include_once('inc/inc_mysqli_connect.php');

// session debug
debugmsg(__FILE__."(".__LINE__.")".": Session ID: ". session_id());

// set email variable
if(isset($_GET['email'])){
  $email = $_GET['email'];
  debugmsg(__FILE__."(".__LINE__.")".": Email via GET: ".$email);
}elseif(isset($_POST['email'])){
  $email = $_POST['email'];
  debugmsg(__FILE__."(".__LINE__.")".": Email via POST: ".$email);
}elseif(isset($_SESSION['email'])){
  $email = $_SESSION['email'];
  debugmsg(__FILE__."(".__LINE__.")".": Email via SESSION: ".$email);
}else{
  unset($email);
  debugmsg(__FILE__."(".__LINE__.")".": Email not set via GET, POST or SESSION");
}

// Test username
if (empty($email)){
	// fresh page load
	debugmsg(__FILE__."(".__LINE__.")".": Fresh page.");
}else{
	// email is filled in
	debugmsg(__FILE__."(".__LINE__.")".": Email is posted: ".$email);
	// Remove all illegal characters from email
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);
	debugmsg(__FILE__."(".__LINE__.")".": Email is sanitized: ".$email);
	
	/* check if email is valid */
	if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		
		// Correct email
		$email = $connection->real_escape_string($email); // create mysql save string
		
		// Give email back to user
		debugmsg(__FILE__."(".__LINE__.")".": Email is valid: ".$email);
		$user_warnings_array[] = "Email is valid.";
    
    // Check if email already exists
		$u = "SELECT * FROM users WHERE email='".$email."'"; // this should be 1 unique result
		if (!$users_result = $connection->query($u)) {
			debugmsg(__FILE__."(".__LINE__.")".": Could not retrieve user: ".mysqli_error($connection));
		}
		if ($users_result->num_rows === 0) {
		  /* email does not exist */
			debugmsg(__FILE__."(".__LINE__.")".": Email is new, ".$users_result->num_rows." users found");
		}else{
		  /* email exists, do not tell user, just continue */
			debugmsg(__FILE__."(".__LINE__.")".": Email exists, ".$users_result->num_rows." users found");
			
		  // send email to user with registration link
		  // 1. create random blob
		  // 2. store the registration db paired with the email and timestamp.
		  // 3. Send the user the blob
		  // 4. The user can now use the blob to verify his email
		  
		  $registration_key = bin2hex(random_bytes(128));
			debugmsg(__FILE__."(".__LINE__.")".": Random registration key: ". $registration_key);
		}
		
		
		
		
    
    /* send an email with a link that works for 2 hours */
      /* the links contains a hash and is stored in the database */
      /* within that hour use the same hash when password is asked for twice */
      /* password hash can only be used once */
      /* check the hash with the email address, if so, the email is validated */
	} else {
		debugmsg(__FILE__."(".__LINE__.")".": Email is not valid: ".$email);
		$user_warnings_array[] = "Email is not valid.";
	}
}

// test
$registration_key = bin2hex(random_bytes(16));
debugmsg(__FILE__."(".__LINE__.")".": TEST Random registration key: ". $registration_key);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/swiss.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<h6 class="right"><?php echo strftime("%A"); ?></h6>
<h2>Register</h2>

Insert your email address to register or reset your password.

<div class="register">
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" name="register" method="POST" enctype="multipart/form-data">
		<input type="text" name="email" value="<?php echo $email ;?>" placeholder="Email..." >
		<input type="submit" name="register" value="Register">
	</form>
</div>

<?php
// show warning when needed
if (!empty($user_warnings_array)){
  echo "<div class=\"warning\">";
  foreach ($user_warnings_array as $key => $user_warning) {
      echo "  ".$user_warning;
  }
  echo "</div>";
};
?>
</body>
</html>
<?php include_once('inc/inc_mysqli_close.php');