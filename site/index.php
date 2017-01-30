<html>
<head>
	<title>LHK vragen</title>
</head>
<body>

LHK toetsvragen

<p>

<?php
# debug 
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php

/*
http://www.w3schools.com/php/php_mysql_connect.asp
*/

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
	echo "<p>";
	echo "<b>Vraag:</b><br>";
    	echo $row['question'];
	echo "<p>";
	# find answers
	$sql_a = "SELECT * FROM answers WHERE question_id=".$row['question_id']." ORDER BY RAND()";
	$result_a = mysqli_query($conn, $sql_a);
	if (mysqli_num_rows($result_a) > 0) {
	    echo "Antwoorden:<br>";
	    // output answers
	    while($row = mysqli_fetch_assoc($result_a)) {
	        if ($row['correct'] == 1){
			echo "+ ".$row['answer'];
		} else {
                        echo "0 ".$row['answer'];
		}
		echo "<br>";
		$a="answer_".$row['answer_id'];
	        $json_result[$q][$a]=$row;
	    }
	} else {
	    echo "0 answers";
	}
    }
} else {
    echo "0 questions";
}


/*
JSON output
*/
echo "<p>\n\n\n";
print json_encode($json_result);


mysqli_close($conn);

?>

</body>
</html>
