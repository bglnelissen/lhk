<?php
include_once('inc/inc_session_check.php'); // including session_start() and in_functions.php
include_once('inc/inc_mysqli_connect.php');
include_once('inc/inc_stylesheets.php');

// handle POST data
$question = savehtml($_POST['question']);
$subject_id = savehtml($_POST['subject']);

$answer1 = savehtml($_POST['answer1']);
$answer2 = savehtml($_POST['answer2']);
$answer3 = savehtml($_POST['answer3']);
$answer4 = savehtml($_POST['answer4']);

$corr = savehtml($_POST['correct']);
$origin = savehtml($_POST['origin']);
$image = $_FILES["image"];

// remember in session
$_SESSION['origin'] = $origin;

// only collect ansers that are non-empty
$answersraw = array("a1" => $answer1, "a2" => $answer2, "a3" => $answer3, "a4" => $answer4);
unset($answers);
foreach ($answersraw as $key => $value){
	if(! empty($value) ){
		$answers[$key]=$value;
	}
}

// Form submitted?
if (empty($_POST)){
	// fresh page load
	debugmsg(__FILE__."(".__LINE__.")".": Fresh page load.");
}else{
	// Upload image if one is present and store Image_ID for later use
	if(! empty($image)){
			$image_name = pathinfo($image["name"])['filename'];
			$image_tmp = $image["tmp_name"];
			$target_file = $image_tmp.".target_file";
			$check_valid_image = getimagesize($image_tmp);
			if($check_valid_image !== false) {
					debugmsg(__FILE__."(".__LINE__.")".": File is a valid image: " . $check_valid_image["mime"] . ".");
					if(imagepng(imagecreatefromstring(file_get_contents($image_tmp)), $target_file)){
						debugmsg(__FILE__."(".__LINE__.")".": Image to png conversion succes: \"" . $target_file . "\".");
						$image_data = addslashes(file_get_contents($target_file));
						$image_mime = getimagesize($target_file)["mime"];
						if ($image_data !== false){
							$i = "INSERT INTO images (image_name, image_mime, image, user_id, session_id) VALUES ('$image_name', '$image_mime', '$image_data','$user_id', '$session_id');";
							if ($connection->query($i) === TRUE) {
								$image_id=$connection->insert_id;
								debugmsg(__FILE__."(".__LINE__.")".": Succes. Image ID: $image_id, Name: $image_name");
								if (unlink($target_file)){
									debugmsg(__FILE__."(".__LINE__.")".": Deleted: ".$target_file);
								}else{
									debugmsg(__FILE__."(".__LINE__.")".": Could not delete:".$target_file);
								}
								if (unlink($image_tmp)){
									debugmsg(__FILE__."(".__LINE__.")".": Deleted: ".$image_tmp);
								}else{
									debugmsg(__FILE__."(".__LINE__.")".": Could not delete:".$image_tmp);
								}
							}else{
								debugmsg(__FILE__."(".__LINE__.")".": Fail: ".$connection->error);
							}
						}
					}else{
						debugmsg(__FILE__."(".__LINE__.")".": Image to png conversion fail.");
					}
			} else {
					debugmsg(__FILE__."(".__LINE__.")".": File is not a valid image.");
			}
	}else{
			debugmsg(__FILE__."(".__LINE__.")".": No image found.");
	}
	// check if the question is non empty
	// check if at least two answers are given
	// check if the correct answer is non-emtpy
	// check if the questions has an origin ID
	if(!empty($question) && is_numeric($subject_id) && 2 <= count($answers) && ! empty($answersraw[$corr]) && !empty($origin)){
		$q = "INSERT INTO questions (question, image_id, origin, subject_id, user_id, session_id) VALUES ('$question', '$image_id', '$origin', '$subject_id','$user_id', '$session_id');";
		if ($connection->query($q) === TRUE) {
			$question_id=$connection->insert_id;
			debugmsg(__FILE__."(".__LINE__.")".": Succes. Question ID: $question_id, Origin: $origin, Subject_id: $subject_id");
			debugmsg(__FILE__."(".__LINE__.")".": Correct: $corr");
			foreach ($answers as $key => $answer) {
				$correct = ($key == $corr ? 1 : 0 ); // if key is correct key -> 1 else 0
				$a = "INSERT INTO answers (answer, correct, question_id, user_id, session_id) VALUES ('$answer', '$correct', '$question_id', '$user_id', '$session_id');";
				if ($connection->query($a) === TRUE) {
					$answer_id=$connection->insert_id;
					debugmsg(__FILE__."(".__LINE__.")".": Succes. Answer ID: $answer_id, Correct: $correct, Answer: $answer");
				}else{
					debugmsg(__FILE__."(".__LINE__.")".": Fail: ".$connection->error);
				}
			}
		}else{
			debugmsg(__FILE__."(".__LINE__.")".": Fail: ".$connection->error);
		}
		// all should be saved now, unset values
		unset($_POST);
	}else{
		debugmsg(__FILE__."(".__LINE__.")".": Not all values are set");
		$req = "required";
		$questionvalue=$question;
		$a1=$answer1;
		$a2=$answer2;
		$a3=$answer3;
		$a4=$answer4;
	}
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Insert</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="<?php echo $_SESSION['stylesheet']; ?>">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<div class="menu">
	<?php include_once("inc/inc_menu.php");?>
</div>

<h2>Insert question</h2>

<p>Add your question, add at least 2 answers and select which answer is the correct answer. Also choose a subject and an 'Origin ID' (e.g. LHK2013FEB).</p>

<div class="insert">
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" name="insert" method="POST" enctype="multipart/form-data">
		<textarea class="<?php echo $req ;?>" name="question" placeholder="   Question..."><?php echo $questionvalue ;?></textarea>
		<select name="subject">
			<option value="" >Choose subject:</option>
			<?php
			$s = "SELECT * FROM subjects ORDER BY icpc ASC;";
			if ( $subjects = $connection->query($s)) {
				debugmsg(__FILE__."(".__LINE__.")".": Succes subjects.");
				while ( $row = $subjects->fetch_assoc() ){
					$sel = ($row['subject_id'] == $_POST['subject'] ? "selected" : ""); // selected if id is known
					echo "<option value=\"".$row['subject_id']."\" ".$sel.">".$row['icpc']." ".$row['subject']."</option>";
				}
			}else{
				debugmsg(__FILE__."(".__LINE__.")".": Fail: ".$connection->error);
			}
			?>
		</select>

		<div class="answer">
		<input type="text" class="<?php echo $req ;?> answer" name="answer1" value="<?php echo $a1 ;?>" placeholder="   answer A..."/>
		<input type="radio" name="correct" value="a1" id="answer1" <?php if ("a1" == $_POST['correct'] ){ echo "checked"; } ?> >
		<label for="answer1" class="<?php echo $req ;?>">Correct</label> 
		</div>

		<div class="answer">
		<input type="text" class="<?php echo $req ;?> answer" name="answer2" value="<?php echo $a2 ;?>"  placeholder="   answer B..."/>
		<input type="radio" name="correct" value="a2" id="answer2" <?php if ("a2" == $_POST['correct'] ){ echo "checked"; } ?> >
		<label for="answer2" class="<?php echo $req ;?>" >Correct</label> 
		</div>

		<div class="answer">
		<input type="text" class="answer" name="answer3" value="<?php echo $a3 ;?>"  placeholder="   answer C..."/>
		<input type="radio" name="correct" value="a3" id="answer3" <?php if ("a3" == $_POST['correct'] ){ echo "checked"; } ?> >
		<label for="answer3" class="<?php echo $req ;?>">Correct</label> 
		</div>

		<div class="answer">
			<input class="answer" type="text" name="answer4" value="<?php echo $a4 ;?>"  placeholder="   answer D..."/>
			<input type="radio" name="correct" value="a4" id="answer4" <?php if ("a4" == $_POST['correct'] ){ echo "checked"; } ?> >
			<label for="answer4" class="<?php echo $req ;?>">Correct</label> 
		</div>

		Image: <input type="file" name="image" id="imageupload">
	
		<input type="submit" name="submit" value="Insert">
		<input type="text" name="origin" class="<?php echo $req ;?> origin" value="<?php echo $_SESSION['origin'];?>" placeholder="   Origin ID..."/>
	</form>
</div>

</body>
</html>

<?php 
include_once('inc/inc_mysqli_close.php');
?>