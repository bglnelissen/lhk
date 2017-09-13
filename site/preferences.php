<?php
include_once('inc/inc_session_check.php'); // including session_start() and in_functions.php
include_once('inc/inc_mysqli_connect.php');
include_once('inc/inc_session_collection.php');
include_once('inc/inc_stylesheets.php');

/* Setup style */
debugmsg(__FILE__."(".__LINE__.")".": Current stylesheet: ".$_SESSION['stylesheet']);
$styles = array(
	"Swiss" => './css/swiss.css',
	"Markdown" => './css/markdown.css',
	"GitHub" => './css/GitHub.css',
	"Solarized Light" => './css/Solarized (Light).css',
	"Solarized Dark" => './css/Solarized (Dark).css'
);

/* Setup the selection of questions */


/* Process form data */
// Form submitted?
if (empty($_POST)){
	// fresh page load
	debugmsg(__FILE__."(".__LINE__.")".": Fresh page load.");
}else{
	if(!empty($_POST['style'])){
		if(! in_array($_POST['style'], $styles)){
			debugmsg(__FILE__."(".__LINE__.")".": Style NOT fount in array: ".$_POST['style']);
		}else{
			debugmsg(__FILE__."(".__LINE__.")".": Style found in array: ".$_POST['style']);
			debugmsg(__FILE__."(".__LINE__.")".": Change SESSION['stylesheet'] to: ".$_POST['style']);
			$_SESSION['stylesheet'] = $_POST['style'];
		}
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Preferences</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="<?php echo $_SESSION['stylesheet']; ?>">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<div class="menu">
	<?php include_once("inc/inc_menu.php");?>
</div>

<h2>Preferences</h2>

<h3>Style</h3>


<div class="style">
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" name="style" method="POST" enctype="multipart/form-data">
		<select name="style">
			<?php
				foreach ($styles as $name => $path){
					$selected = ($_SESSION['stylesheet']==$path ? "selected" : ""); // if/else oneliner
					echo "  <option value=\"".$path."\" ".$selected.">".$name."</option>\n";
				}
			?>
		</select>
		<input type="submit" name="submit" value="Change">
	</form>
</div>



</body>
</html>
<?php 
include_once('inc/inc_mysqli_close.php');
?>