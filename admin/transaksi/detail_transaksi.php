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
                            <img src="./assets/images/undraw_shopping_app_flsj.svg" alt="logo" class="img-fluid d-block">
                        </div>
                        <div class="col-lg-8">
                            <div class="text-end my-3">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addToCart">Kembali</button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="align-middle">
                                        <tr class="text-center">
                                            <th>Nama Melon</th>
                                            <th>Berat</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $data = $connection->query("SELECT *, tb_detail_transaksi.harga as cost FROM tb_detail_transaksi LEFT JOIN tb_melon ON tb_detail_transaksi.id_melon = tb_melon.id_melon LEFT JOIN tb_jenis_melon ON tb_melon.id_jenis_melon = tb_jenis_melon.id_jenis_melon WHERE status = 1 AND id_transaksi = '$_GET[id]'");
                                        while ($p = mysqli_fetch_assoc($data)) :
                                        ?>
                                            <tr class="text-center">
                                                <td class="text-start"><?= $p['nama_melon'] ?></td>
                                                <td><?= $p['berat'] ?> kg</td>
                                                <td><?= $p['jumlah'] ?></td>
                                                <td>Rp <?= number_format($p['cost'], 2, ',', '.') ?></td>
                                                </td>
                                                <td>
                                                    <a href="index.php?page=transaksi&hapus=<?= $p['id_detail_transaksi'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class="btn btn-outline-secondary btn-sm"><i class="fas fa-trash"></i></a>

                                                </td>
                                            </tr>
                                        <?php endwhile ?>
                                        <tr class="align-middle">
                                            <?php
                                            $data = mysqli_fetch_assoc($connection->query("SELECT SUM(harga) as total FROM tb_detail_transaksi WHERE id_pengguna = '$_SESSION[id]' AND status = 1 AND id_transaksi = '$_GET[id]'"));
                                            ?>
                                            <td colspan="3" class="text-center fw-bold">Total</td>
                                            <td class="text-center">Rp <?= number_format($data['total'], 2, ',', '.') ?></td>
                                            <td class="text-center">
                                                <a href="" class="btn btn-danger d-block">Cetak</a>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>