<!-- 
    Nama File   : login.php 
    Deskripsi   : menampilkan form login dan melakukan login ke halaman admin.php
-->

<?php
// Inisialisasi session
session_start(); 

// Koneksi dengan database
require_once('lib/db_login.php');

// Cek apakah user sudah submit form
if (isset($_POST['submit'])) {
    $valid = TRUE;

    // Cek validasi email
    $email = test_input($_POST['email']);
    if ($email == '') {
        $error_email = "*Email is required!";
        $valid = FALSE;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_email = "*Invalid email format!";
        $valid = FALSE;
    }

    // Cek validasi password
    $password = test_input($_POST['password']);
    if ($password == '') {
        $error_password = "*Password is required!";
        $valid = FALSE;
    }

    // Cek validasi
    if ($valid) {
        // Query
        $query = " SELECT * FROM admin WHERE email='$email' AND password='$password' ";
        $result = $db->query($query);
        if (!$result) {
            die ("Could not query the database: <br />". $db->error);
        } else {
            if ($result->num_rows > 0) { // login  berhasil
                $_SESSION['username'] = $email;
                header('Location: view_customer.php');
                exit;
            } else { // login gagal
                echo '<span class="text-danger">Combination of username and password are not correct.</span>';
            }
        }
        // Close koneksi dengan database
        $db->close();
    }
}
?>

<?php include('./header.php') ?>
<br>
<div class="card mt-3">
    <div class="card-header">Login Form</div>
    <div class="card-body">
        <form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
            <!-- Email -->
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" size="30" value="<?php if(isset($email)) echo $email; ?>">
                <div class="text-danger"><?php if (isset($error_email)) echo $error_email ?></div>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" size="30" value="">
                <div class="text-danger"><?php if (isset($error_password)) echo $error_password; ?></div>
            </div>
            <br>

            <!-- Button -->
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Login</button>
        </form>
    </div>
</div>
<?php include('./footer.php') ?>