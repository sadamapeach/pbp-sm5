<?php
// Nama : Laily Novita Sari
// NIM  : 24060121130056
// Lab  : A1 PBP

// TODO 1 : setup & connect database
$db_host = 'localhost';
$db_database = 'responsi';
$db_username = 'root';
$db_password = '';
$db_port = 3307;

$db = new mysqli($db_host, $db_username, $db_password, $db_database, $db_port);

if ($db->connect_errno) {
    die("Could not connect to the database: <br/>" . $db->connect_error);
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
