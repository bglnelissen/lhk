<?php
include_once('inc_functions.php');

// get a collection of question_id's
// save the collection of questions in an array for this session
// no need for mysql/database work

if(count($_SESSION['collection']) >= 1){
	debugmsg(__FILE__."(".__LINE__.")".": Looks like there is a collection. No need for a new one.");
}else{
	debugmsg(__FILE__."(".__LINE__.")".": Create a new collection.");
	$c = "SELECT question_id FROM questions ORDER BY question_id ASC";
	if (!$collection_result = $connection->query($c)) {
		debugmsg(__FILE__."(".__LINE__.")".":  Fail. Could not retrieve collection.");
		die();
	}elseif ($collection_result->num_rows === 0) {
		debugmsg(__FILE__."(".__LINE__.")".": Query for collection gets 0 results: ".$a);
	}else{
		debugmsg(__FILE__."(".__LINE__.")".": Number of questions found for this collection: ". $collection_result->num_rows);

		// store results in an array
		$_SESSION['collection'] = array();
		while ($question = $collection_result->fetch_assoc()) {
			$_SESSION['collection'][] = $question['question_id'];
		}
		shuffle($_SESSION['collection']); // reorder the collection
	}
}
?>