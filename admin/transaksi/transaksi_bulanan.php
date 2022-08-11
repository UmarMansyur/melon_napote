<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Transaksi</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Transaksi</h4>
                    <p class="card-title-desc">Pastikan data yang diinputkan telah valid!, data di menu transaksi akan hilang ketika status sudah dibayar!</p>
                    <div class="row">
                        <div class="col-lg-4 d-none d-xl-inline-block">
                            <img src="./assets/images/transaksi.svg" alt="logo" class="img-fluid d-block">
                        </div>
                        <div class="col-lg-8">
                            <?php if($getData['type'] == 'kasir'): ?>
                            <div class="text-end my-3">
                                <a href="index.php?page=transaksi" class="btn btn-primary">Tambah Transaksi</a>
                            </div>
                            <?php endif ?>
                            <table id="dataTable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr class="text-center">
                                        <th>Pendapatan</th>
                                        <th>Bulan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $getResource = $connection->query("SELECT SUM(harga_total) as pendapatan, MONTH(created_at) as bulan FROM tb_transaksi GROUP BY bulan ORDER BY bulan ASC");
                                    while ($data = mysqli_fetch_assoc($getResource)) :
                                    ?>
                                        <tr>
                                            <td>Rp <?= number_format($data['pendapatan'], 2, ',', '.') ?></td>
                                            <td id="bulan"><?= $data['bulan'] ?></td>
                                        </tr>
                                        <script>
                                            const bulan = ['Januari', 'Pebruari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember']
                                            document.getElementById('bulan').innerHTML = bulan[<?= $data['bulan']-1 ?>];
                                        </script>
                                    <?php endwhile ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>