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
                            <img src="./assets/images/profile.svg" alt="logo" class="img-fluid d-block">
                        </div>
                        <div class="col-lg-8">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="mb-3 mt-2">
                                    <label for="nama_pengguna" class="form-label">Nama Pengguna: </sup></label>
                                    <input type="text" class="form-control" name="nama_pengguna" placeholder="Nama Pengguna" value="<?= $getData['username'] ?>" required>
                                </div>
                                <div class="mb-3 mt-2">
                                    <label for="email" class="form-label">Email: </sup></label>
                                    <input type="email" class="form-control" name="email" placeholder="Email" value="<?= $getData['email'] ?>" required>
                                </div>
                                <div class="mb-3 mt-2">
                                    <label for="passwordBaru" class="form-label">Password Baru: </sup></label>
                                    <input type="password" class="form-control" name="passwordBaru" placeholder="Password Baru">
                                </div>
                                <div class="mb-3 mt-2">
                                    <label for="konfirmasi" class="form-label">Konfirmasi Password Baru: </sup></label>
                                    <input type="password" class="form-control" name="konfirmasi" placeholder="Konfirmasi Password Baru">
                                </div>
                                <div class="mb-3 mt-2">
                                    <label for="foto" class="form-label">Foto Profil: </sup></label>
                                    <input type="file" class="form-control" name="foto" placeholder="Konfirmasi Password Baru">
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-success w-md" name="edit">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php if (isset($_POST['edit'])) {
                        try {
                            $nama_pengguna = mysqli_escape_string($connection, $_POST["nama_pengguna"]);
                            $email = mysqli_escape_string($connection, $_POST["email"]);
                            $passwordBaru = mysqli_escape_string($connection, $_POST["passwordBaru"]);
                            $konfirmasi = mysqli_escape_string($connection, $_POST["konfirmasi"]);
                            // var_dump($_FILES['foto']['name']);
                            if (empty($_FILES['foto']['name'])) {
                                if (empty($passwordBaru)) {
                                    $query = $connection->query("UPDATE tb_pengguna SET username = '$nama_pengguna', email = '$email' WHERE id_pengguna = '$_SESSION[id]' ");
                                } else {
                                    if ($passwordBaru == $konfirmasi) {
                                        $konfirmasi = password_hash($konfirmasi, PASSWORD_DEFAULT);
                                        $query = $connection->query("UPDATE tb_pengguna SET username = '$nama_pengguna', email = '$email', password = '$konfirmasi' WHERE id_pengguna = '$_SESSION[id]'");
                                    }
                                }
                            } else {
                                $allowed = array("jpg", "JPG", "jpeg", "JPEG", "png", "PNG");
                                $foto = explode(".", $_FILES['foto']['name']);
                                $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
                                $nama_gambar = rand(1, 9999) . round(microtime(true)) . '.' . end($foto);
                                $file = "../upload/pengguna/$nama_gambar";
                                move_uploaded_file($_FILES['foto']['tmp_name'], $file);
                                if (in_array($ext, $allowed)) {
                                    if (empty($passwordBaru)) {
                                        echo "$nama_gambar";
                                        $query = $connection->query("UPDATE tb_pengguna SET username = '$nama_pengguna', email = '$email', thumbnail = '$nama_gambar' WHERE id_pengguna = '$_SESSION[id]' ");
                                    } else {
                                        if ($passwordBaru == $konfirmasi) {
                                            $konfirmasi = password_hash($konfirmasi, PASSWORD_DEFAULT);
                                            $query = $connection->query("UPDATE tb_pengguna SET username = '$nama_pengguna', email = '$email', password = '$konfirmasi', thumbnail = '$nama_gambar' WHERE id_pengguna = '$_SESSION[id]'");

                                        }
                                    }
                                }
                            }
                            echo "<script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Data Berhasil dirubah',
                                        showConfirmButton: false,
                                        }).then(function(){
                                        window.location.href = '?page=profile';
                                    });
                                </script>";
                        } catch (\Throwable $th) {
                        }
                    }
                    ?>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
</div>