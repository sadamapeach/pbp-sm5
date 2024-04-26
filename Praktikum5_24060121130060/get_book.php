<?php

require_once('./lib/db_login.php');
$booktitle = $_GET['title'];

// Asign a query
$query = ' SELECT * FROM books WHERE title = "' . $booktitle . '" ';
$result = $db->query( $query );

if (!$result) {
    die("Could not query the database: <br />" . $db->error);
}

// Fetch and display the results
$found = false;
while ($row = $result->fetch_object()) {
    if($row->title == $booktitle) {
        echo '<br>';
        echo 'ISBN      : '.$row->isbn.'<br />';
        echo 'Author    : '.$row->author.'<br />';
        echo 'Title     : '.$row->title.'<br />';
        echo 'Price     : '.$row->price.'<br />';
        $found = true;
    }
}
if ($found == false) {
    echo '<br>';
    echo 'Not found :(';
}

$result->free();
$db->close();
?>