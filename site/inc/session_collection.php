<?php
// get a collection of question_id's
// save the collection of questions in an array for this session
// no need for mysql/database work

$c = "SELECT question_id FROM questions ORDER BY question_id ASC";

if (!$collection_result = $connection->query($c)) {
  debugmsg("Fail. Could not retrieve collection.");
}
if ($collection_result->num_rows === 0) {
  debugmsg("Collection seems empty (0 results): ".$a);
}

// store results in an array
unset($collection);
while ($question = $collection_result->fetch_assoc()) {
  $collection[] = $question['question_id']; // keys are sequencial
}
$_SESSION['collection'] = array_merge($collection, $collection, $collection, $collection, $collection, $collection,$collection, $collection, $collection,$collection, $collection, $collection, $collection);

unset($collection);
?>