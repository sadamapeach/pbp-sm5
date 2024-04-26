<!-- 
    Nama File   : edit_customer.php
    Deskripsi   : menampilkan form edit data customer dan mengupdate data ke database
-->

<?php
// Koneksi dengan database
require_once('lib/db_login.php');

// Membuat variabel '$id' yang diambil dari query string parameter
$id = isset($_GET['id']) ? $id = $_GET['id'] : '';

// Inisialisasi variabel '$name' dan '$address'
$name = ''; 
$address = '';

// Memeriksa apakah user belum menekan tombol submit
if (!isset($_POST["submit"])) {
    // Query untuk mengambil informasi customer berdasarkan id
    $query = " SELECT * FROM customers WHERE customerid = '$id' ";
    $result = $db->query($query);
    if (!$result) {
        die ("Could not query the database: <br />". $db->error);
    } else {
        while ($row = $result->fetch_object()) {
            $name = $row->name;
            $address = $row->address;
            $city = $row->city;
        }
    }

} else {
    $valid = TRUE;

    // Validasi terhadap field name
    $name = test_input($_POST['name']);
    if ($name == '') {
        $error_name = "*Name is required!";
        $valid = FALSE;
    } else if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $error_name = "*Only letters and white space allowed!";
        $valid = FALSE;
    }

    // Validasi terhadap field address
    $address = test_input($_POST['address']);
    if ($address == '') {
        $error_address = "*Address is required!";
        $valid = FALSE;
    }

    // Validasi terhadap field city
    $city = $_POST['city'];
    if ($city == '' || $city == 'none') {
        $error_city = "*City is required!";
        $valid = FALSE;
    }

    // Update data ke database
    // Jika valid, update data pada database dengan mengeksekusi query yang sesuai
    if ($valid) {
        // Menghapus tanda petik
        $address = $db->real_escape_string($address);
        $query = " UPDATE customers SET name='$name', address='$address', city='$city' 
                   WHERE customerid='$id' ";
        $result = $db->query($query);
        if (!$result) {
            die ("Could not query the database: <br />". $db->error. '<br>Query:' .$query);
        } else {
            $db->close();
            header('Location: view_customer.php');
        }   
    }
}
?>

<?php include('./header.php') ?>
<br>
<div class="card mt-4">
    <div class="card-header">Edit Customers Data</div>
    <div class="card-body">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?id=' . $id; ?>" method="POST" autocomplete="on">
            <!-- Name -->
            <div class="form-group">
                <label for="name">Nama:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
                <div class="text-danger"><?php if (isset($error_name)) echo $error_name ?></div>
            </div>

            <!-- Address -->
            <div class="form-group">
                <label for="name">Address:</label>
                <textarea class="form-control" name="address" id="address" rows="5"><?php echo $address; ?></textarea>
                <div class="text-danger"><?php if (isset($error_address)) echo $error_address; ?></div>
            </div>

            <!-- City -->
            <div class="form-group">
                <label for="city">City:</label>
                <select name="city" id="city" class="form-control" required>
                    <option value="none" <?php if (!isset($city)) echo 'selected="true"'; ?>>--Select a city--</option>
                    <option value="Airport West" <?php if (isset($city) && $city == "Airport West") echo 'selected="true"'; ?>>Airport West</option>
                    <option value="Box Hill" <?php if (isset($city) && $city == "Box Hill") echo 'selected="true"'; ?>>Box Hill</option>
                    <option value="Yarraville" <?php if (isset($city) && $city == "Yarraville") echo 'selected="true"'; ?>>Yarraville</option>
                </select>
                <div class="text-danger"><?php if (isset($error_city)) echo $error_city;?></div>
            </div>
            <br>

            <!-- Button -->
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
            <a href="view_customer.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
<?php include('./footer.php') ?>
<?php
$db->close();
?>