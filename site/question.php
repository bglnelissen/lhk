<?php
// debug
function debugmsg($input){ if (false){ $m = "$input <br>"; echo $m; } }; // true false
// includes
include_once('inc/functions.php');
include_once('inc/mysqli_connect.php');
include_once('inc/session_start.php');

// Question is FRESH
$question_id = 9;

// get questions data
$q = "SELECT * FROM questions WHERE question_id = ".$question_id;
if (!$questions_result = $connection->query($q)) {
  debugmsg("Fail. Could not retrieve question.");
}
if ($questions_result->num_rows === 0) {
  debugmsg("0 questions found: ".$q);
}
$questions = $questions_result->fetch_assoc();
// set variabels
$question = $questions['question'];
$question_id = $questions['question_id'];
$image_id = $questions['image_id'];
$origin = $questions['origin'];
$subject_id = $questions['subject_id'];

// get answers data
$a = "SELECT * FROM answers WHERE question_id = ".$question_id;
if (!$answers_result = $connection->query($a)) {
  debugmsg("Fail. Could not retrieve answers.");
}
if ($answers_result->num_rows === 0) {
  debugmsg("0 answers found: ".$a);
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Question</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="css/swiss.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php if (!empty($origin) && !empty($origin)){
  echo "<code>$origin ~ $question_id</code>";
} ?>
<h2>Question</h2>

<div class="case">
  <?php if($image_id >= 1 ){ ?>
    <img class="image" src="<?php echo "image.php?image_id=$image_id";?>">
  <?php } ?>
  <?php if ($questions_result->num_rows === 0) {
    echo "<p class=\"question\"><i>No question found.</i></p>";
  }else{ ?>
    <p class="question"><?php echo $question ;?></p>
    <div class="answers">
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" name="question" method="POST" enctype="multipart/form-data">
      <?php
      while ($answer = $answers_result->fetch_assoc()) { ?>
        <div class="answer">
          <text readonly><?php echo " ".$answer['answer'] ;?></text>
          <input id="<?php echo "answer".$answer['answer_id'] ;?>" type="radio" name="answer" value="<?php echo $answer['answer_id'] ;?>" >
          <label for="<?php echo "answer".$answer['answer_id'] ;?>">Correct</label>
        </div>
        <?php } ?>
      <input type="submit" name="submit" value="Submit">
    </form>
  </div>
  <?php } ?>

</div>

</body>
</html>

<?php 
include_once('inc/mysqli_close.php');
?>