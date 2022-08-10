<?php
if (isset($_GET['edit_produk'])) {
    $data = mysqli_fetch_assoc($connection->query("SELECT * FROM tb_jenis_melon WHERE id_jenis_melon = '$_GET[edit_produk]'"));
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18"><?= @($_GET['edit_produk']) ? 'Edit' : 'Tambah' ?> Jenis Melon</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Upload Jenis Melon</h4>
                    <p class="card-title-desc"> Hindari berjualan produk palsu dan memanipulasi harga !</p>
                    <div class="row">
                        <div class="col-lg-4">
                            <img src="./assets/images/add.svg" alt="logo" class="img-fluid d-block">
                        </div>
                        <div class="col-lg-8">
                            <form action="" method="POST">
                                <div class="mb-3 mt-2">
                                    <label for="nama_jenis" class="form-label">Nama Jenis <sup class="text-danger">* Wajib</sup></label>
                                    <input type="text" class="form-control" name="nama_jenis" id="nama_jenis" placeholder="Nama Jenis Melon" value="<?= isset($_GET['edit_produk']) ? $data['jenis_melon'] : '' ?>" required>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary w-md" name="<?= @($_GET['edit_produk']) ? 'edit' : 'add' ?>"><?= @($_GET['edit_produk']) ? 'Simpan' : 'Tambahkan' ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php if (isset($_POST['add'])) {
                        try {
                            $today = date("Y-m-d H:i:s");
                            $nama_jenis = mysqli_escape_string($connection, $_POST["nama_jenis"]);
                            $query = $connection->query("INSERT INTO tb_jenis_melon VALUES (NULL, '$nama_jenis', '$today', '$today')");
                            echo " <script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    showConfirmButton: true,
                                }).then(function(){
                                    window.location.href='';
                                });
                                </script>";
                        } catch (\Throwable $th) {
                            echo " <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    showConfirmButton: true,
                                }).then(function(){
                                    window.location.reload();
                                });
                                </script>";
                        }
                    } ?>
                    <?php if (isset($_POST['edit'])) {
                        try {
                            $today = date("Y-m-d H:i:s");
                            $nama_jenis = mysqli_escape_string($connection, $_POST["nama_jenis"]);
                            $query = $connection->query("UPDATE tb_jenis_melon SET jenis_melon = '$nama_jenis', updated_at = '$today' WHERE id_jenis_melon = '$_GET[edit_produk]'");
                            echo " <script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    showConfirmButton: true,
                                }).then(function(){
                                    window.location.href='index.php?page=tambah_produk';
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
                                    window.location.href='index.php?page=tambah_produk&edit_produk=$_GET[edit_produk]';
                                });
                                </script>";
                        }
                    } ?>

                </div>
            </div>
        </div> <!-- end col -->
    </div>
</div>