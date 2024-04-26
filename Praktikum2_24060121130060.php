<!-- Nama   : Oktaviana Sadama Nur Azizah -->
<!-- NIM    : 24060121130060 -->
<!-- Lab    : A1 -->

<html>
    <head>
        <title>Praktikum 2 PBP Lab A1</title>
    </head>

    <body>
        <?php
        $array_mhs = array (
            'Abdul' => array(89,90,54),
            'Budi' => array(78,60,64),
            'Nina' => array(67,56,84),
            'Budi' => array(87,69,50),
            'Budi' => array(98,65,74)
        );

        function hitung_rata($array) {
            $total = 0;
            $sum_elemen = count($array);

            foreach($array as $nilai) {
                $total += $nilai;
            }

            $rata2 = $total / $sum_elemen;
            return $rata2;
        }

        function print_mhs($array_mhs) {
            echo '<table border = "1">';
            echo '<tr>
                <td>Nama</td>
                <td>Nilai 1</td>
                <td>Nilai 2</td>
                <td>Nilai 3</td>
                <td>Rata2</td>
            </tr>';

            foreach($array_mhs as $nama_mhs => $nilai_mhs) {
                echo '<tr>';
                    echo '<td>'.$nama_mhs.'</td>';
                    echo '<td>'.$array_mhs[$nama_mhs][0].'</td>';
                    echo '<td>'.$array_mhs[$nama_mhs][1].'</td>';
                    echo '<td>'.$array_mhs[$nama_mhs][2].'</td>';

                    $rata_mhs = hitung_rata($array_mhs[$nama_mhs]);

                    echo '<td>'.$rata_mhs.'</td>';
                echo '</tr>';
            }
            echo '</table>';
        }
        
        print_mhs($array_mhs);
        ?>
    </body>
</html>