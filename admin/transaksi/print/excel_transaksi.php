<?php
include '../../../config/connection.php';

?>
<!DOCTYPE html>
<html>

<head>
    <!-- <title>Export Data Ke Excel Dengan PHP - www.malasngoding.com</title> -->
</head>

<body>
    <style type="text/css">
        body {
            font-family: sans-serif;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #3c3c3c;
            padding: 3px 8px;

        }

        a {
            background: blue;
            color: #fff;
            padding: 8px 10px;
            text-decoration: none;
            border-radius: 2px;
        }
    </style>

    <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=RekapTransaksi.xls");
    ?>

    <table border="1">
        <thead>
            <tr class="text-center">
                <th>Nama Pemesan</th>
                <th>Tanggal Transaksi</th>
                <th>Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $getResource = $connection->query("SELECT * FROM tb_transaksi");
            while ($data = mysqli_fetch_assoc($getResource)) :
            ?>
                <tr>
                    <td><?= $data['nama_pembeli'] ?></td>
                    <td class="text-center"><?= $data['created_at'] ?></td>
                    <td><?= $data['harga_total'] ?></td>
                </tr>
            <?php endwhile ?>
        </tbody>
    </table>
</body>

</html>