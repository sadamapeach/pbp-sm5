<!-- Nama   : Oktaviana Sadama Nur Azizah -->
<!-- NIM    : 24060121130060 -->
<!-- Lab    : A1 -->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Praktikum 3 PBP Lab A1</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <script>
            function validateForm() {
                var x = document.getElementById("ekstra");
                var y = document.getElementById("kelas");
                if(y.value == "XII") {
                    x.style.display = "none";
                } else {
                    x.style.display = "block";
                }
            }
        </script>
    </head>

    <body>
        <?php
        if (isset($_POST['submit'])) {
            //validasi nis: tidak boleh kosong, hanya terdiri 10 karakter (0...9)
            $nis = test_input($_POST['nis']);
            if (empty($nis)) {
                $error_nis = "*NIS harus diisi";
            } elseif (strlen($nis) != 10) {
                $error_nis = "*NIS harus terdiri dari 10 karakter";
            } elseif (!preg_match("/^[0-9]*$/", $nis)) {
                $error_nis = "*NIS hanya dapat berisi angka 0-9";
            }

            //validasi nama: tidak boleh kosong, hanya dapat berisi huruf dan spasi
            $nama = test_input($_POST['nama']);
            if (empty($nama)) {
                $error_nama = "*Nama harus diisi";
            } elseif (!preg_match("/^[a-zA-Z ]*$/", $nama)) {
                $error_nama = "*Nama hanya dapat berisi huruf dan spasi";
            }

            //validasi jenis_kelamin: tidak boleh kosong
            if(!isset($_POST['jenis_kelamin'])) {
                $error_jenis_kelamin = "*Jenis kelamin harus diisi";
            }

            //validasi kelas: tidak boleh kosong
            $kelas = test_input($_POST['kelas']);
            if (empty($kelas)) {
                $error_kelas = "*Kelas harus diisi";
            }

            //validasi ekstra: mengikuti ketentuan kelas
            if ($_POST['kelas'] == 'XII') {
                echo '<style>#ekstra {display:none;}</style>';
            } else {
                if (!isset($_POST['ekstra'])) {
                    $error_ekstra = "*Ekstrakurikuler harus diisi min.1 max.3";
                } elseif (count($_POST['ekstra']) > 3) {
                    $error_ekstra = "*Ekstrakurikuler harus diisi min.1 max.3";
                }
            }
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>

        <div class="container"><br/>
        <div class="card">
            <div class="card-header">Form Input Mahasiswa</div>
            <div class="card-body">
                <form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <!-- NIS -->
                    <div class="form-group">
                        <label for="nis">NIS:</label>
                        <input type="text" class="form-control" id="nis" name="nis" maxlength="10" 
                            value="<?php if (isset($_POST['nis'])) echo $_POST['nis']?>">
                        <div class="error text-danger"><?php if (isset($error_nis)) echo $error_nis;?></div>
                    </div>

                    <!-- Nama -->
                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama" maxlength="50" 
                            value="<?php if (isset($_POST['nama'])) echo $_POST['nama']?>">
                        <div class="error text-danger"><?php if (isset($error_nama)) echo $error_nama;?></div>
                    </div>

                    <!-- Jenis Kelamin -->
                    <label>Jenis Kelamin:</label>
                    <!-- Pria -->
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input"
                                <?php if (isset($_POST['jenis_kelamin']) && $_POST['jenis_kelamin'] == 'Pria')
                                echo 'checked'?> name="jenis_kelamin" value="Pria">Pria
                        </label>
                        <div class="error text-danger"><?php if (isset($error_jenis_kelamin)) echo $error_jenis_kelamin;?></div>
                    </div>
                    <!-- Wanita -->
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input"
                                <?php if (isset($_POST['jenis_kelamin']) && $_POST['jenis_kelamin'] == 'Wanita')
                                echo 'checked'?> name="jenis_kelamin" value="Wanita">Wanita
                        </label>
                        <div class="error text-danger"><?php if (isset($error_jenis_kelamin)) echo $error_jenis_kelamin;?></div>
                    </div><br>

                    <!-- Kelas -->
                    <div class="form-group">
                        <label for="kelas">Kelas:</label>
                        <select name="kelas" id="kelas" class="form-control" onchange="validateForm()">
                            <option value="X" <?php if (isset($kelas) && $kelas=="X")
                            echo 'selected="true"';?>>X</option>
                            <option value="XI" <?php if (isset($kelas) && $kelas=="XI")
                            echo 'selected="true"';?>>XI</option>
                            <option value="XII" <?php if (isset($kelas) && $kelas=="XII")
                            echo 'selected="true"';?>>XII</option>
                        </select>
                        <div class="error text-danger"><?php if (isset($error_kelas)) echo $error_kelas;?></div>
                    </div>

                    <!-- Ekstrakurikuler -->
                    <div id="ekstra">
                        <label>Ekstrakurikuler:</label>
                        <!-- Pramuka -->
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="ekstra[]" value="Pramuka"
                                <?php if (isset($_POST['ekstra']) && in_array('Pramuka', $_POST['ekstra']))
                                echo 'checked';?>>Pramuka
                            </label>
                        </div>
                        <!-- Seni Tari -->
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="ekstra[]" value="Seni Tari"
                                <?php if (isset($_POST['ekstra']) && in_array('Seni Tari', $_POST['ekstra']))
                                echo 'checked';?>>Seni Tari
                            </label>
                        </div>       
                        <!-- Sinematografi -->
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="ekstra[]" value="Sinematografi"
                                <?php if (isset($_POST['ekstra']) && in_array('Sinematografi', $_POST['ekstra']))
                                echo 'checked';?>>Sinematografi
                            </label>
                        </div>      
                        <!-- Basket -->
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="ekstra[]" value="Basket"
                                <?php if (isset($_POST['ekstra']) && in_array('Basket', $_POST['ekstra']))
                                echo 'checked';?>>Basket
                            </label>
                        </div>  
                        <div class="error text-danger"><?php if (isset($error_ekstra)) echo $error_ekstra;?></div>             
                    </div><br>

                    <!-- Button -->
                    <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
                </form>                
    </body><br>

    <?php 
    if (isset($_POST["submit"]) && isset($_POST["nis"]) && isset($_POST["nama"]) && isset($_POST["jenis_kelamin"]) && isset($_POST["kelas"])) {
        echo "<h3>Your Input:</h3>";
        echo 'NIS = ' . $_POST['nis'] . '<br />';
        echo 'Nama = ' . $_POST['nama'] . '<br />';
        echo 'Jenis Kelamin = ' . $_POST['jenis_kelamin'] . '<br />';
        echo 'Kelas = ' . $_POST['kelas'] . '<br />';

        if ($_POST['kelas'] != 'XXI') {
            if (isset($_POST['ekstra'])) {
                $ekstra = $_POST['ekstra'];
                if (!empty($ekstra) && (count($ekstra)<=3)) {
                    echo 'Ekstrakurikuler = ';
                    foreach ($ekstra as $ekstra_item) {
                        echo '<br />' . htmlspecialchars($ekstra_item);
                    }
                }
            }
        }
    }
    ?>

</html>