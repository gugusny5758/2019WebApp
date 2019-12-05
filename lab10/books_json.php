<?php
$BOOKS_FILE = "books.txt";

function filter_chars($str) {
	return preg_replace("/[^A-Za-z0-9_]*/", "", $str);
}

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "GET") {
	header("HTTP/1.1 400 Invalid Request");
	die("ERROR 400: Invalid request - This service accepts only GET requests.");
}

$category = "";
$delay = 0;

if (isset($_REQUEST["category"])) {
	$category = filter_chars($_REQUEST["category"]);
}
if (isset($_REQUEST["delay"])) {
	$delay = max(0, min(60, (int) filter_chars($_REQUEST["delay"])));
}

if ($delay > 0) {
	sleep($delay);
}

if (!file_exists($BOOKS_FILE)) {
	header("HTTP/1.1 500 Server Error");
	die("ERROR 500: Server error - Unable to read input file: $BOOKS_FILE");
}

header("Content-type: application/json");

print "{\n  \"books\": [\n";

$output = array();
foreach(file($BOOKS_FILE) as $book){
	$book_data = explode("|", $book);
	if($book_data[2] == $category){
		array_push($output, '{"category": "'.$book_data[2].'", "title": "'.$book_data[0].'", "author": "'.$book_data[1].'", "year": '.$book_data[3].', "price": '.$book_data[4].'}');			
	}
}
print implode(", ", $output);

print "  ]\n}\n";
?>
