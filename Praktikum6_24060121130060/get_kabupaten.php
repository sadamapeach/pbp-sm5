<?php
// Nama : Laily Novita Sari
// NIM  : 24060121130056
// Lab  : A1 PBP

require_once 'lib/db_login.php';

/* TODO 6 : mengambil data kabupaten dari tabel 'tb_kabs' dengan parameter kode_prov*/
if (isset($_GET['kode_prov'])) {
    $kode_prov = $_GET['kode_prov'];
    $query = "SELECT * FROM tb_kabs WHERE kode_prov = '$kode_prov'";
    $result = $db->query($query);
    if(!$result){
        die("Could not query the database: <br/>" . $db->error);
    } else {
        while ($row = $result->fetch_object()) {
            echo "<option value='" . $row->kode_kab . "'>" . $row->nama_kab . "</option>";
        }
    }
}