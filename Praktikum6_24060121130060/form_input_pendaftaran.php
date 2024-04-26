<?php
// Nama : Laily Novita Sari
// NIM  : 24060121130056
// Lab  : A1 PBP

include('header.html');

require_once 'lib/db_login.php';

/*TODO 2 : Buatlah
1. server side validation
2. insert new user
3. tampilkan hasilnya error/berhasil */

$error_nama = $error_email = $error_gender = $error_alamat = $error_provinsi = $error_kabupaten = "";
$valid = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Server-side validation
    $nama = $_POST["nama"];
    $email = $_POST["email"];
    $gender = isset($_POST["gender"]) ? $_POST["gender"] : "";
    $alamat = $_POST["alamat"];
    $provinsi = $_POST["provinsi"];
    $kabupaten = $_POST["kabupaten"];

    if (empty($nama)) {
        $error_nama = "Nama tidak boleh kosong";
        $valid = false;
    }

    if (empty($email)) {
        $error_email = "Email tidak boleh kosong";
        $valid = false;
    }

    if (empty($gender)) {
        $error_gender = "Gender tidak boleh kosong";
        $valid = false;
    }

    if (empty($alamat)) {
        $error_alamat = "Alamat tidak boleh kosong";
        $valid = false;
    }

    if (empty($provinsi)) {
        $error_provinsi = "Provinsi tidak boleh kosong";
        $valid = false;
    }

    if (empty($kabupaten)) {
        $error_kabupaten = "Kabupaten tidak boleh kosong";
        $valid = false;
    }

    // insert new user
    if ($valid){
        $query = "INSERT INTO tb_user (`id`, `nama`, `email`, `jenis_kelamin`, `alamat`, `kode_prov`, `kode_kab`) VALUES (NULL, '$nama', '$email', '$gender', '$alamat', '$provinsi', '$kabupaten')";
        $result = $db->query( $query );
        // tampilkan jika hasil error
        if (!$result) {
            die("Could not query the database: <br>" . $db->error . '<br>Query: ' . $query);
        }
        // tampilkan jika hasil berhasil
        else{
            echo '<div class="alert alert-success">Data berhasil disimpan</div>';
        }
        $db->close();
    }
}

?>

<div class="card">
    <div class="card-header">Form Input Pendaftaran</div>
    <div class="card-body">
        <!-- TODO 3 : definisikan method dan actions pada tags <form> -->
        <form name="daftar" method="POST" actions="">
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="<?php if(isset($nama)) {echo $nama;}?>">
                <div id="error_name" style="color: red;">
                    <?php if (isset($error_nama))  echo $error_nama ?>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <!-- TODO 4 : buatlah cek email menggunakan ajax -->
                <input type="email" name="email" id="email" class="form-control" oninput="getUser()" value="<?php if(isset($email)) {echo $email;}?>">
                <div id="error_email" style="color: red;">
                    <?php if (isset($error_email))  echo $error_email ?>
                </div>
            </div>
            <label>Jenis Kelamin</label>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="gender" value="Laki-laki" <?php if(isset($gender) && $gender=="Laki-laki") echo "checked"?>>Laki-laki
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="gender" value="Perempuan" <?php if(isset($gender) && $gender=="Perempuan") echo "checked"?>>Perempuan
                </label>
            </div>
            <div id="error_gender" style="color: red; margin-bottom: 12px;">
                <?php if (isset($error_gender))  echo $error_gender ?>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="alamat" rows="3" class="form-control"><?php if(isset($alamat)) {echo $alamat;}?></textarea>
                <div id="error_alamat" style="color: red;">
                    <?php if (isset($error_alamat))  echo $error_alamat ?>
                </div>
            </div>
            <div class="form-group">
                <label for="provinsi">Provinsi</label>
                <select onchange="getKabupaten(this.value)" name="provinsi" id="provinsi" class="form-control" value="<?php if(isset($provinsi)) {echo $provinsi;}?>">
                    <option value="">Pilih Provinsi</option>
                    <?php require_once('get_provinsi.php'); ?>
                </select>
                <div id="error_provinsi" style="color: red;">
                    <?php if (isset($error_provinsi))  echo $error_provinsi ?>
                </div>
            </div>
            <div class="form-group">
                <label for="kabupaten">Kabupaten</label>
                <select name="kabupaten" id="kabupaten" class="form-control" value="<?php if(isset($kabupaten)) {echo $kabupaten;}?>">
                    <option value="">Pilih kabupaten</option>
                    <!-- TODO 5 : tampilkan daftar kabupaten berdasarkan pilihan provinsi yang dipilih, menggunakan ajax -->
                </select>
                <div id="error_kabupaten" style="color: red;">
                    <?php if (isset($error_kabupaten))  echo $error_kabupaten ?>
                </div>
            </div>
            <br>
            <button type="submit" name="submit" value="submit" class="btn btn-primary container-fluid">Daftar</button>
        </form>
    </div>
</div>

<?php include('footer.html') ?>