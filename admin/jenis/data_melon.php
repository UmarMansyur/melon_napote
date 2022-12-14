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
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Melon</h4>
                    <p class="card-title-desc">Pastikan keterbaharuan produk baik dari stok maupun harga
                    </p>
                    <div class="text-end my-3">
                        <a href="index.php?page=tambah_jenis" class="btn btn-success">Tambah Jenis</a>
                    </div>
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr class="text-center">
                                <th class="text-center">Jenis Melon</th>
                                <?php if ($getData['type'] == 'admin') : ?>
                                    <th>Edit</th>
                                    <th>Hapus</th>
                                <?php elseif ($getData['type'] == 'owner') : ?>
                                    <th>Tanggal Ditambahkan</th>
                                <?php endif ?>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $data = $connection->query("SELECT * FROM tb_jenis_melon");
                            while ($p = mysqli_fetch_assoc($data)) :
                            ?>
                                <tr class="text-center">
                                    <td class="text-start"><?= $p['jenis_melon'] ?></td>
                                    <?php if ($getData['type'] == 'admin') : ?>
                                        <td>
                                            <a href="index.php?page=tambah_jenis&edit_produk=<?= $p['id_jenis_melon'] ?>" class="btn btn-outline-secondary btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                        </td>
                                        <td>
                                            <a href="index.php?page=data_jenis&hapus=<?= $p['id_jenis_melon'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class="btn btn-outline-secondary btn-sm"><i class="fas fa-trash"></i></a>
                                        </td>
                                    <?php endif ?>
                                </tr>
                            <?php endwhile ?>
                        </tbody>
                    </table>
                    <?php if (isset($_GET['hapus'])) {
                        try {
                            $connection->query("DELETE FROM tb_jenis_melon WHERE id_jenis_melon = '$_GET[hapus]'");
                            echo " <script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    showConfirmButton: true,
                                }).then(function(){
                                    window.location.href='index.php?page=data_jenis';
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
                                    window.location.href='index.php?page=data_jenis';
                                });
                                </script>";
                        }
                    } ?>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
</div>