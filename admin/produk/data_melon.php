<?php
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $hapus = mysqli_fetch_assoc($connection->query("SELECT * FROM tb_produk WHERE id_produk = '$id'"));
    $data = $connection->query("DELETE FROM tb_produk WHERE id_produk = '$id'");
}
?>
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Produk</h4>
                <h1><?= $_GET['delete']; ?></h1>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Produk</h4>
                    <p class="card-title-desc">Pastikan keterbaharuan produk baik dari stok maupun harga
                    </p>

                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr class="text-center">
                                <th class="text-start">Nama Produk</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Satuan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $data = $connection->query("SELECT * FROM tb_produk WHERE id_pengguna = '$_SESSION[id]'");
                            while ($p = mysqli_fetch_assoc($data)) :
                            ?>
                                <tr class="text-center">
                                    <td class="text-start"><?= $p['nama_produk'] ?></td>
                                    <td><?= $p['harga'] ?></td>
                                    <td><?= $p['stok'] ?></td>
                                    <td><?= $p['satuan'] ?></td>
                                    <td><span class="badge <?= $p['status'] == 0 ? 'bg-warning' : 'bg-success' ?>"><?= $p['status'] == 0 ? 'Habis' : 'Tersedia' ?></span></td>
                                    <td>
                                        <a href="index.php?page=tambah_produk&edit_produk=<?= $p['id_produk'] ?>" class="btn btn-outline-secondary btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="index.php?page=data_produk&hapus=<?= $p['id_produk'] ?>" class="btn btn-outline-secondary btn-sm"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endwhile ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div>
</div>