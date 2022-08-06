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
                    <p class="card-title-desc">Pastikan data yang diinputkan telah valid!</p>
                    <div class="row">
                        <div class="col-lg-4">
                            <img src="./assets/images/undraw_shopping_app_flsj.svg" alt="logo" class="img-fluid d-block">
                        </div>
                        <div class="col-lg-8">
                            <div class="text-end my-2">
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addToCart">Tambah</button>
                            </div>
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr class="text-center">
                                        <th>Nama Pemesan</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Cetak</th>
                                        <th>Status</th>
                                        <th>Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $data = $connection->query("SELECT * FROM tb_transaksi");
                                    while ($p = mysqli_fetch_assoc($data)) :
                                    ?>
                                        <tr class="text-center">
                                            <td class="text-start"><?= $p['nama_melon'] ?></td>
                                            <td><?= $p['jenis_melon'] ?></td>
                                            <td><?= $p['stok'] ?></td>
                                            <td><?= $p['harga'] ?>/<?= $p['berat'] ?> kg</td>
                                            <td><a href="./qrCode/qr.php?qr=<?= $p['id_melon'] ?>" target="__blank" class="btn btn-outline-info btn-sm"><i class="bx bx-printer"></i></a></td>
                                            </td>
                                            <td>
                                                <a href="index.php?page=tambah_melon&edit_produk=<?= $p['id_melon'] ?>" class="btn btn-outline-secondary btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                                <a href="index.php?page=data_melon&hapus=<?= $p['id_melon'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class="btn btn-outline-secondary btn-sm"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php endwhile ?>
                                </tbody>
                            </table>
                            <div class="modal fade bs-example-modal-center" id="addToCart" tabindex="-1" aria-modal="true" role="dialog">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Tambah Transaksi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="POST" class="px-1">
                                                <div class="mb-3">
                                                    <label for="nama_melon">Nama Melon: </label>
                                                    <select name="nama_melon" id="nama_melon" class="form-control">
                                                        <option value="">Pilih Nama Melon</option>
                                                        <?php
                                                        $getResource = $connection->query("SELECT nama_melon, id_melon FROM tb_melon");
                                                        while($data = mysqli_fetch_assoc($getResource)):
                                                        ?>
                                                        <option value="<?= $data['id_melon'] ?>"><?= $data['nama_melon'] ?></option>
                                                        <?php endwhile ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nama_melon">Jumlah: </label>
                                                    <input type="number" name="jumlah" id="jumlah" class="form-control" placeholder="Contoh: 1">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="berat">Berat: </label>
                                                    <input type="number" name="berat" id="berat" class="form-control" placeholder="Contoh: 1kg">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>