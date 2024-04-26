<!-- 
    Nama File   : delete_customer.php
    Deskripsi   : menghapus data customer baru
-->

<?php
    // Koneksi dengan database
    require_once('lib/db_login.php');

    // Membuat variabel '$id' yang diambil dari query string parameter
    $id = $_GET['id'];

    // Query
    $query = " DELETE FROM customers WHERE customerid='$id' ";
    $result = $db->query($query);
    if (!$result) {
        die ("Could not query the database: <br />". $db->error);
    } else {
        $db->close();
        header('Location: view_customer.php');
        echo ("Could not query the database: <br />");
    } 

    // Close koneksi dengan database
    $db->close();
?>