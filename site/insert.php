<?php
/* create an include_once for this part */
$servername = "localhost";
$username = "lhk";
$password = "n3liss3n";
$dbname = "lhk";

// Create connection
$connection = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<?php
setlocale(LC_ALL, 'nl_NL');
date_default_timezone_set('Europe/Amsterdam');
session_start();
?>
<?php
/* FUNCTIONS */
function savehtml($input){
  $savehtml = trim(htmlspecialchars($input, ENT_QUOTES));
  return $savehtml;
}
function msg($input){
  $message = "$input <br>";
  // echo $message;
}
?>
<?php
$user = "test";
$session_id = session_id();
$useragent = $_SERVER['HTTP_USER_AGENT'];
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$l = "INSERT INTO log (user, session_id, useragent, url) VALUES ('$user', '$session_id', '$useragent', '$actual_link');";
if ($connection->query($l) === TRUE) {
  $log_id=$connection->insert_id;
  msg("Succes. Log ID: $log_id, Session ID: $session_id");
}else{
  msg("Fail: ".$connection->error);
}
?>
<?php
/* handle POST data */

  $question = savehtml($_POST['question']);
  $subject_id = savehtml($_POST['subject']);

  $answer1 = savehtml($_POST['answer1']);
  $answer2 = savehtml($_POST['answer2']);
  $answer3 = savehtml($_POST['answer3']);
  $answer4 = savehtml($_POST['answer4']);

  $corr = savehtml($_POST['correct']);
  $image = savehtml($_POST['image']);
  $origin = savehtml($_POST['origin']);

  $_SESSION['origin'] = $origin;

  // check answers, only collect the ones that are non-empty
  $answersraw = array("a1" => $answer1, "a2" => $answer2, "a3" => $answer3, "a4" => $answer4);
  unset($answers);
  foreach ($answersraw as $key => $value){
    if(! empty($value) ){
      $answers[$key]=$value;
    }
  }

  // check if the question is non empty
  // check if at least two answers are given
  // check if the correct answer is non-emtpy
  // check if the questions has an origin ID
if(!empty($question) && 2 <= count($answers) && ! empty($answersraw[$corr]) && !empty($origin)){
  $q = "INSERT INTO questions (question, origin, subject_id, session_id) VALUES ('$question', '$origin', '$subject_id', '$session_id');";
  if ($connection->query($q) === TRUE) {
    $question_id=$connection->insert_id;
    msg("Succes. Question ID: $question_id, Origin: $origin, Subject_id: $subject_id");
    msg("Correct: $corr");
    foreach ($answers as $key => $answer) {
      $correct = ($key == $corr ? 1 : 0 ); // if key is correct key -> 1 else 0
      $a = "INSERT INTO answers (answer, correct, question_id, session_id) VALUES ('$answer', '$correct', '$question_id', '$session_id');";
      if ($connection->query($a) === TRUE) {
        $answer_id=$connection->insert_id;
        msg("Succes. Answer ID: $answer_id, Correct: $correct, Answer: $answer");
      }else{
        msg("Fail: ".$connection->error);
      }
    }
  }else{
    msg("Fail: ".$connection->error);
  }
  // all should be saved now, unset values
  unset($_POST);
}else{
  msg("Not all values are set");
  $req = "required";
  $questionvalue=$question;
  $a1=$answer1;
  $a2=$answer2;
  $a3=$answer3;
  $a4=$answer4;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Insert question</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="css/swiss.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<h2>Insert question</h2>

<p>Add your question, add at least 2 answers and select which answer is the correct answer. Also choose a subject and an origin id (identification for this test: e.g. 2013janLHK) for this question.</p>

<div class="insert">
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" name="insert" method="POST">
    <textarea class="<?php echo $req ;?>" name="question" placeholder="   Question..."><?php echo $questionvalue ;?></textarea>
    <select name="subject">
      <option value="0" >Choose subject:</option>
      <?php
      $s = "SELECT subject_id, subject FROM subjects;";
      if ( $subjects = $connection->query($s)) {
        msg("Succes subjects.");
        while ( $row = $subjects->fetch_assoc() ){
          $sel = ($row['subject_id'] == $_POST['subject'] ? "selected" : ""); // selected if id is known
          echo "<option value=\"".$row['subject_id']."\" ".$sel."> - ".$row['subject']."</option>";
        }
      }else{
        msg("Fail: ".$connection->error);
      }
      ?>
    </select>
    <input type="text" class="<?php echo $req ;?> answer" name="answer1" value="<?php echo $a1 ;?>" placeholder="   answer A..."/>
      <input type="radio" name="correct" value="a1" id="answer1" <?php if ("a1" == $_POST['correct'] ){ echo "checked"; } ?> >
      <label for="answer1" class="<?php echo $req ;?>">Correct</label> 
    <input type="text" class="<?php echo $req ;?> answer" name="answer2" value="<?php echo $a2 ;?>"  placeholder="   answer B..."/>
      <input type="radio" name="correct" value="a2" id="answer2" <?php if ("a2" == $_POST['correct'] ){ echo "checked"; } ?> >
      <label for="answer2" class="<?php echo $req ;?>" >Correct</label> 
    <input type="text" class="answer" name="answer3" value="<?php echo $a3 ;?>"  placeholder="   answer C..."/>
      <input type="radio" name="correct" value="a3" id="answer3" <?php if ("a3" == $_POST['correct'] ){ echo "checked"; } ?> >
      <label for="answer3" class="<?php echo $req ;?>">Correct</label> 
    <input class="answer" type="text" name="answer4" value="<?php echo $a4 ;?>"  placeholder="   answer D..."/>
      <input type="radio" name="correct" value="a4" id="answer4" <?php if ("a4" == $_POST['correct'] ){ echo "checked"; } ?> >
      <label for="answer4" class="<?php echo $req ;?>">Correct</label> 
    <input type="text" name="origin" class="<?php echo $req ;?> origin" value="<?php echo $_SESSION['origin'];?>" placeholder="   Origin ID..."/>
    Add an image: <input type="file" name="image">
    <input type="submit" name="submit" value="Insert">
  </form>
</div>

</body>
</html>

<?php mysqli_close($connection); ?>