<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Data Melon</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <!-- col -->
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Melon</h4>
                    <p class="card-title-desc">Pastikan keterbaharuan produk baik dari stok maupun harga
                    </p>
                    <div class="text-end my-3">
                        <a href="index.php?page=tambah_melon" class="btn btn-success">Tambah Melon</a>
                    </div>
                    <table id="dataTable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr class="text-center">
                                <th>Nama Produk</th>
                                <th>Jenis Melon</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th>Satus</th>
                                <?php if ($getData['type'] == 'admin') : ?>
                                    <th>Hapus</th>
                                <?php endif ?>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $data = $connection->query("SELECT * FROM tb_melon LEFT JOIN tb_jenis_melon ON tb_melon.id_jenis_melon = tb_jenis_melon.id_jenis_melon LEFT JOIN tb_stok ON tb_melon.id_stok = tb_stok.id_stok");
                            while ($p = mysqli_fetch_assoc($data)) :
                            ?>
                                <tr class="text-center">
                                    <td class="text-start"><?= $p['nama_melon'] ?></td>
                                    <td><?= $p['jenis_melon'] ?></td>
                                    <td><?= $p['stok'] ?></td>
                                    <td><?= $p['harga'] ?>/<?= $p['berat'] ?> kg</td>
                                    <td><a href="./qrCode/qr.php?qr=<?= $p['id_melon'] ?>" target="__blank" class="btn btn-outline-info btn-sm"><i class="bx bx-printer"></i></a></td>
                                    </td>

                                    <?php if ($getData['type'] == 'admin') : ?>

                                        <td>
                                            <a href="index.php?page=tambah_melon&edit_produk=<?= $p['id_melon'] ?>" class="btn btn-outline-secondary btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="index.php?page=data_melon&hapus=<?= $p['id_melon'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class="btn btn-outline-secondary btn-sm"><i class="fas fa-trash"></i></a>
                                        </td>
                                </tr>
                            <?php endif; ?>
                        <?php endwhile ?>

                        </tbody>
                    </table>
                    <?php if (isset($_GET['hapus'])) {
                        try {
                            $connection->query("DELETE FROM tb_melon WHERE id_melon = '$_GET[hapus]'");
                            echo " <script>
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Berhasil!',
                                            showConfirmButton: true,
                                        }).then(function(){
                                            window.location.href='index.php?page=data_melon';
                                        });
                                        </script>";
                        } catch (\Throwable $th) {
                            echo " <script>
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Gagal!',
                                            text: 'Server tidak merespon',
                                            showConfirmButton: true,
                                        }).then(function(){
                                            window.location.href='index.php?page=data_melon';
                                        });
                                        </script>";
                        }
                    } ?>
                </div>
            </div>
        </div> 
        <!-- end col -->
    </div>
</div>