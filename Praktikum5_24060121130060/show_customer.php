<!-- 
    File        : show_customer.php
    Deskripsi   : menampilkan data customers
 -->

<?php include('./header.php') ?>
<div class="row w-50 mx-auto mt-5">
    <div class="col">
        <div class="card">
            <div class="card-header">Show Customer Data</div>
            <div class="card-body">
                <select name="customer" id="customer" class="form-control" onchange="showCustomer(this.value)">
                    <option value="">-- Select a Customer --</option>
                    <?php
                    require_once('./lib/db_login.php');

                    // Asign A Query
                    $query = "SELECT * FROM customers ORDER BY customerid";
                    $result = $db->query($query);

                    if (!$result) {
                        die("Could not query the database: <br>" . $db->error);
                    }

                    // Fetch and display the results
                    while ($row = $result->fetch_object()) {
                        echo '<option value="' . $row->customerid . '">' . $row->name . '</option>';
                    }

                    $result->free();
                    $db->close();
                    ?>
                </select>
                <br>
                <div id="detail_customer"></div>
            </div>
        </div>
    </div>
</div>
<?php include('./footer.php') ?>