<?php
session_start();

// set variables
unset($user_warnings_array);

// includes
include_once('inc/inc_functions.php');
include_once('inc/inc_mysqli_connect.php');

// session debug
debugmsg(__FILE__."(".__LINE__.")".": Session ID: ". session_id());

// Test login credentials
if (empty($_POST)){
	// fresh page load
	debugmsg(__FILE__."(".__LINE__.")".": Fresh page.");
	unset($_SESSION);
}else{
	debugmsg(__FILE__."(".__LINE__.")".": Login form is posted.");

	// make variables secure
	$email = trim($_POST['email']); // in future, this can be a name or an email address
	$pw = trim($_POST['password']);

	// debug empty name en password
	if(empty($email)){ debugmsg(__FILE__."(".__LINE__.")".": Email is empty"); }else{ debugmsg(__FILE__."(".__LINE__.")".": Name is: ".$email); }
	if(empty($pw)){ debugmsg(__FILE__."(".__LINE__.")".": Password is empty"); }else{ debugmsg(__FILE__."(".__LINE__.")".": Password is: ".$pw); }

	if ( !empty($email) && !empty($pw) ){
		debugmsg(__FILE__."(".__LINE__.")".": Both name and pw are set");

		// get the hashed pw for this user
		$email = $connection->real_escape_string($email); // create mysql save string
		$u = "SELECT * FROM users WHERE email='".$email."'"; // this should be 1 unique result
		if (!$users_result = $connection->query($u)) {
			debugmsg(__FILE__."(".__LINE__.")".": Could not retrieve user: ".mysqli_error($connection));
		}
		if ($users_result->num_rows === 0) {
			debugmsg(__FILE__."(".__LINE__.")".": 0 users found");
		}
	
		// User variabels
		$user = $users_result->fetch_assoc();
		$user_id = $user['user_id'];
		$name = $user['name'];
		$email = $user['email'];
		$password_hash = $user['password_hash'];

		// Compare hashed pw with password (password is not empty, we checked for that)
		// password_hash('password', PASSWORD_DEFAULT);
		// password test
		// debugmsg(__FILE__."(".__LINE__.")".": Password 'Escalatie': ". password_hash('Escalatie', PASSWORD_DEFAULT));

		if( password_verify($pw, $password_hash) ){
			debugmsg(__FILE__."(".__LINE__.")".": Password is valid");
			debugmsg(__FILE__."(".__LINE__.")".": name: ".$name);
			debugmsg(__FILE__."(".__LINE__.")".": user_id: ".$user_id);
			debugmsg(__FILE__."(".__LINE__.")".": email: ".$email);
			debugmsg(__FILE__."(".__LINE__.")".": email sha1: ".sha1($email));
		
			// Valid user and valid password, start session
			// unset($_SESSION); // clear ALL
			$_SESSION['name'] = $name;
			$_SESSION['user_id'] = $user_id;
			$_SESSION['email'] = $email;
			$_SESSION['email_sha1'] = sha1($email);

			// browser stuff to log
			$session_id = session_id();
			$useragent = $_SERVER['HTTP_USER_AGENT'];
			$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

			// Log succesful login
			$l = "INSERT INTO log (name, user_id, session_id, useragent, url) VALUES ('$name', '$user_id', '$session_id', '$useragent', '$actual_link');";
			if ($connection->query($l) === TRUE) {
				$log_id=$connection->insert_id;
				debugmsg(__FILE__."(".__LINE__.")".": Succes. Log ID: $log_id, Session ID: $session_id");
			}else{
				debugmsg(__FILE__."(".__LINE__.")".": Fail: ".$connection->error);
			}
		
			// Now all is set and we move to the question.php page
			// ---> actual redirect
			// print_r($_SESSION);
			header('Location: question.php');
			die;
		
		}else{
		unset($_SESSION);
			debugmsg(__FILE__."(".__LINE__.")".": Email or password is not valid");
			$user_warnings_array[] = "Email or password incorrect";
		}  
	}else{
		$user_warnings_array[] = "Email or password empty.";
	unset($_SESSION);
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/swiss.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<h6 class="right"><?php echo strftime("%A"); ?></h6>
<h2>Login</h2>

<div class="login">
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" name="login" method="POST" enctype="multipart/form-data">
		<input type="text" name="email" value="<?php echo $email ;?>" placeholder="Email..." >
		<input type="password" name="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" >
		<input type="submit" name="login" value="Login">
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

<div class="debug">
	<?php
	foreach ($msg as $debug_message){
		echo $debug_message;
	} ?>
</div>
</body>
</html>
<?php include_once('inc/inc_mysqli_close.php');