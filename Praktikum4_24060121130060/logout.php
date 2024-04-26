<!-- 
    Nama File   : logout.php
    Deskripsi   : untuk logout (menghapus session yang dibuat saat login)
 -->

<?php 
    session_start();
    // Menghapus username session
    if (isset($_SESSION['username'])) {
        unset($_SESSION['username']);
        session_destroy();
    }
    header('Location: login.php');
?>