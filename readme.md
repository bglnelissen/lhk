## LHK

This app will retrieve data from a JSON server (https://guu.st/lhk/json.php) and use it in an iPhone app build in Swift. The main goal is to get familiar with Swift and JSON and data management.

The mysql/php server is already up and running

#### Sources

List of sources:

- https://developer.apple.com/swift/blog/?id=37

#### json.php

```
<?php
$servername = "localhost";
$username = "lhk";
$password = "n3liss3n";
$dbname = "lhk";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql_q = "SELECT * FROM questions"; # ORDER BY RAND()";
$result_q = mysqli_query($conn, $sql_q);

if (mysqli_num_rows($result_q) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result_q)) {
	$q=$row['question_id'];
	$json_result[$q]=$row;

	# find answers
	$sql_a = "SELECT * FROM answers WHERE question_id=".$row['question_id']." ORDER BY RAND()";
	$result_a = mysqli_query($conn, $sql_a);
	if (mysqli_num_rows($result_a) > 0) {
	    // output answers
	    while($row = mysqli_fetch_assoc($result_a)) {
		$a="answer_".$row['answer_id'];
	        $json_result[$q][$a]=$row;
	    }
	}

    }
}

# output
header('Content-Type: application/json; charset=utf-8');
print json_encode($json_result);
mysqli_close($conn);
?>
```

#### Swift playground based Apple's code

