<?php
// debug
function debugmsg($input){ if (false){ $m = "$input <br>"; echo $m; } }; // true false
// includes
include_once('inc/functions.php');
include_once('inc/mysqli_connect.php');
include_once('inc/session_start.php');
include_once('inc/session_collection.php');

// get the correct question from GET data
$collection = $_SESSION['collection'];

// fetch the question ID
if(is_numeric($_GET['q'])){
  $question_key = $_GET['q'];
  debugmsg("Question key via GET: ".$question_key);
}elseif(is_numeric($_POST['q'])){
  $question_key = $_POST['q'];
  debugmsg("Question key via POST: ".$question_key);
}else{
  unset($question_key);
}

if(! array_key_exists($question_key, $collection)){
  // key does not exist, get the first key
  reset($collection);
  $question_key = key($collection);
}
$question_id = $collection[$question_key];
$question_name = $question_key+1;
debugmsg("Question id: ".$question_id);

// Question
$q = "SELECT * FROM questions WHERE question_id = ".$question_id ;
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

// Answer is given:
if(is_numeric($_POST['answer'])){
  $answer_id = $_POST['answer'];

  // check if this is the correct answer
  $s = "SELECT * FROM answers WHERE answer_id = ".$answer_id;
  if (!$answers_id_Check_result = $connection->query($s)) {
    debugmsg("Fail. Could not retrieve submitted answer.");
  }
  if ($answers_id_Check_result->num_rows === 0) {
    debugmsg("0 answers found: ".$q);
  }
  debugmsg("Answer ID: ".$answer_id);
  $submittedAnswer = $answers_id_Check_result->fetch_assoc();

  if($submittedAnswer['correct'] == 1){
    // answer is correct
    debugmsg("Answer: correct");
  }else{
    // answer is not correct
    debugmsg("Answer: not correct");
  }

  // save answer in scores table
  $a = "INSERT INTO scores (user_id, question_id, answer_id, session_id) VALUES ('$user_id', '$question_id', '$answer_id', '$session_id')";
  if ($connection->query($a) === TRUE) {
    $score_id=$connection->insert_id;
    debugmsg("Succes. Question ID: $question_id, Score ID: $score_id");
  }else{
    debugmsg("Fail: ".$connection->error);
  }
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
<h2>Question <?php echo $question_name ?></h2>
<div class="case">
  <?php if($image_id >= 1 ){ ?>
    <img class="image" src="<?php echo "image.php?image_id=$image_id";?>">
  <?php }
  if ($questions_result->num_rows === 0) {
    echo "<p class=\"question\"><i>No question found.</i></p>";
  }else{ ?>

    <p class="question"><?php echo $question ;?></p>
    <div class="answers">
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" name="question" method="POST" enctype="multipart/form-data">
      <?php
      // get answers data
      $a = "SELECT * FROM answers WHERE question_id = ".$question_id;
      if (!$answers_result = $connection->query($a)) {
        debugmsg("Fail. Could not retrieve answers.");
      }
      if ($answers_result->num_rows === 0) {
        debugmsg("0 answers found: ".$a);
      }

      while ($answer = $answers_result->fetch_assoc()) {
      $answerLabel="True";
      if (isset($_POST['answer'])){
        $css_a = ($answer['answer_id'] == $_POST['answer']) ? "answered" : "";
        $css_c = ($answer['correct'] == 1 ) ? "correct" : "incorrect";
        $answerLabel = ($answer['correct'] == 1 ) ? "True" : "False";
      }
      ?>

        <div class="answer">
          <text readonly><?php echo " ".$answer['answer'] ;?></text>
          <input id="<?php echo "answer".$answer['answer_id'] ;?>" type="radio" name="answer" value="<?php echo $answer['answer_id'] ;?>" >
          <label for="<?php echo "answer".$answer['answer_id'] ;?>" class="<?php echo $css_a ." " . $css_c;?>"><?php echo $answerLabel ;?></label>
        </div>
      <?php }
      if(!is_numeric($_POST['answer'])){ // remove Submit button when pressed
      ?>

        <input type="hidden" name="q" value="<?php echo $question_key; ?>">
        <input type="submit" name="submit" value="Submit">
      <?php }else{ ?>
        <?php $next_key = $question_key +1; ?>
        <input type="hidden" name="q" value="<?php echo $next_key; ?>">
        <input type="submit" name="submit" value="Next">
      <?php };?>

    </form>
  </div><?php } ?>

</div>

<div class="question_navigation">
  <div class="question_list">
    <?php
      foreach ($collection as $key => $value) {
        // $value is the anser_id in the database
        $name = $key+1;
        echo "<a href=\"".$_SERVER['PHP_SELF']."?q=".$key."\">" . $name . "</a> - ";
      }
    if (!empty($origin) && !empty($origin)){
      echo "<span class=\"tip\"><i>ref.</i>";
      echo "  <span class=\"tiptext\">".$origin."#".$question_id."</span>";
      echo "</span>";
    };
    ?>

  </div>
</div>
</body>
</html>
<?php 
include_once('inc/mysqli_close.php');
?>