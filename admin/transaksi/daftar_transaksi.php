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
                            <?php if($getData['type'] != 'kasir'): ?>
                            <div class="text-end my-3">
                                </div>
                                <div class="text-end my-3">
                                    <a href="../admin/transaksi/print/excel_transaksi.php" target="__blank" class="btn btn-success">Export Excel</a>
                                    <a href="index.php?page=transaksi" class="btn btn-primary">Tambah</a>
                            </div>
                            <?php endif ?>
                            <table id="dataTable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr class="text-center">
                                        <th>Nama Pemesan</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Pendapatan</th>
                                        <th>Detail</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if($getData['type'] == 'user') {
                                        $getResource = $connection->query("SELECT * FROM tb_transaksi LEFT JOIN tb_detail_transaksi ON tb_transaksi.id_transaksi = tb_detail_transaksi.id_transaksi WHERE id_pengguna = '$_SESSION[id]'");
                                    } else {
                                        $getResource = $connection->query("SELECT * FROM tb_transaksi");
                                    }
                                    while ($data = mysqli_fetch_assoc($getResource)) :
                                    ?>
                                        <tr>
                                            <td><?= $data['nama_pembeli'] ?></td>
                                            <td class="text-center"><?= $data['created_at'] ?></td>
                                            <td><?= $data['harga_total']?></td>
                                            <td class="text-center">
                                                <a href="index.php?page=detail_transaksi&id=<?= $data['id_transaksi']?>" class="btn btn-outline-info btn-sm">Lihat</a>
                                            </td>
                                            <td class="text-center">
                                                <a href="./transaksi/print/struk_belanja.php?id_transaksi=<?= $data['id_transaksi']?>" class="btn btn-danger btn-sm">Cetak</a>
                                            </td>
                                        </tr>
                                    <?php endwhile ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>