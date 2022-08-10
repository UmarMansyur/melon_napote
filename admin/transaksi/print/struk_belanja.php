<?php
session_start();
include '../../../config/connection.php';
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Print Nota</title>
</head>

<body>
    <div class="print">
        <div class="card" style="width: 12rem;">
            <div class="card-body">
                <h5 class="card-title text-center"><strong>MELON NAPOTE</strong></h5>
                <p class="card-text text-center" style="font-size: 12px">Marenget Barat, Bira Tim. Kec. Sokobenah. Kabupaten Sampang</p>
                <div class="row" style="margin-bottom: -10%">
                    <div class="col-sm">
                        <span style="font-size: 12px; margin-bottom: -25px">
                            <strong>Kasir: <?= $_SESSION['nama'] ?></strong>
                        </span>
                    </div>
                    <div class="col-sm">
                        <span style="font-size: 70%; margin-bottom: -25px">
                            <strong><?= date("d-m-Y H:i") ?></strong>
                        </span>
                    </div>
                </div>
            </div>
            <span class="text-center">---------------------------</span>
            <table class="table table-borderless">
                <thead>
                    <tr style="font-size: 12px; margin-bottom: -25px">
                        <th>Nama Melon</th>
                        <th>Berat</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data = $connection->query("SELECT SUM(tb_detail_transaksi.berat) as brt, SUM(tb_detail_transaksi.harga) as cost, nama_melon, harga_total, bayar, kembalian, tb_melon.harga  FROM tb_detail_transaksi LEFT JOIN tb_transaksi ON tb_detail_transaksi.id_transaksi = tb_transaksi.id_transaksi LEFT JOIN tb_melon ON tb_detail_transaksi.id_melon = tb_melon.id_melon LEFT JOIN tb_jenis_melon ON tb_melon.id_jenis_melon = tb_jenis_melon.id_jenis_melon WHERE tb_transaksi.id_transaksi = '$_GET[id_transaksi]' GROUP BY tb_detail_transaksi.id_melon");
                    $key = 1;
                    while ($d = mysqli_fetch_assoc($data)) :
                    ?>
                        <tr style="font-size: 10px;">
                            <td><?= $d['nama_melon'] ?></td>
                            <td><?= $d['brt'] ?> Kg</td>
                            <td><?= number_format($d['cost']) ?></td>
                        </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
            <span class="text-center">---------------------------</span>
            <div class="text-end" style="margin-right: 5%; font-size: 80%">
            <?php $data = mysqli_fetch_assoc($connection->query("SELECT * FROM tb_transaksi WHERE id_transaksi = '$_GET[id_transaksi]'")) ?>
                <span>Diskon: <strong>0</strong></span><br>
                <span>Total: <strong><?= $data['harga_total'] ?></strong></span><br>
                <span>Tunai: <strong><?= $data['bayar'] ?></strong></span><br>
                <span>Kembalian: <strong><?= $data['kembalian'] ?></span>
            </div>

            <h5 class="text-center my-3">Terima Kasih</h5>
        </div>
    </div>
    </div>
    <script>
        window.onload = () => {
            window.print();
        }
    </script>

</body>

</html>