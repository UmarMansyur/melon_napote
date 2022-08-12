<?php
if (isset($_GET['id'])) {
    $result = mysqli_fetch_assoc($connection->query("SELECT * FROM tb_pengguna WHERE id_pengguna = '$_GET[id]'"));
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
                    <h4 class="card-title">Manajemen Pengguna</h4>
                    <p class="card-title-desc"> Berikut adalah daftar pengguna</p>
                    <div class="row">
                        <div class="col-lg-8">
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr class="text-center">
                                        <th>Nama Pengguna</th>
                                        <th>Email</th>
                                        <th>Type</th>
                                        <th>Edit</th>
                                        <th>Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $getResource = $connection->query("SELECT * FROM tb_pengguna");
                                    while ($data = mysqli_fetch_assoc($getResource)) :
                                    ?>
                                        <tr>
                                            <td><?= $data['username'] ?></td>
                                            <td><?= $data['email'] ?></td>
                                            <td><?= $data['type'] ?></td>
                                            <td class="text-center">
                                                <a href="index.php?page=setting&id=<?= $data['id_pengguna'] ?>" class="btn btn-outline-secondary btn-sm"><i class="fas fa-pen"></i></a>
                                            </td>
                                            <td class="text-center">
                                                <a href="index.php?page=setting&hapus=<?= $data['id_pengguna'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class="btn btn-outline-secondary btn-sm"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php endwhile ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-4">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="mb-3 mt-2">
                                    <label for="nama_pengguna" class="form-label">Nama Pengguna: </sup></label>
                                    <input type="text" class="form-control" name="nama_pengguna" placeholder="Nama Pengguna" value="<?= @($_GET['id']) ? $result['username'] : '' ?>" required>
                                </div>
                                <div class="mb-3 mt-2">
                                    <label for="email" class="form-label">Email: </sup></label>
                                    <input type="email" class="form-control" name="email" placeholder="Email" value="<?= @($_GET['id']) ? $result['email'] : '' ?>" required>
                                </div>
                                <div class="mb-3 mt-2">
                                    <label for="passwordBaru" class="form-label">Password <?= @($_GET['id']) ? 'Baru' : '' ?>: </sup></label>
                                    <input type="password" class="form-control" name="passwordBaru" placeholder="Password <?= @($_GET['id']) ? 'Baru' : '' ?>">
                                </div>
                                <div class="mb-3 mt-2">
                                    <label for="konfirmasi" class="form-label">Konfirmasi Password <?= @($_GET['id']) ? 'Baru' : '' ?>: </sup></label>
                                    <input type="password" class="form-control" name="konfirmasi" placeholder="Konfirmasi Password <?= @($_GET['id']) ? 'Baru' : '' ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="type" class="form-label">Hak Akses Pengguna: </label>
                                    <select class="form-select" id="type" name="type">
                                        <option selected="">Pilih Hak Akses</option>
                                        <option value="admin">Admin</option>
                                        <option value="owner">Owner</option>
                                        <option value="kasir">Kasir</option>
                                        <option value="user">User</option>
                                    </select>
                                    <?php
                                    if (isset($_GET['id'])) {
                                        echo "<script>
                                            document.getElementById('type').value = '$result[type]'
                                        </script>";
                                    }
                                    ?>
                                </div>
                                <div class="mb-3 mt-2">
                                    <label for="foto" class="form-label">Foto Profil: </sup></label>
                                    <input type="file" class="form-control" name="foto" placeholder="Konfirmasi Password Baru">
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-success w-md" name="<?= @($_GET['id']) ? 'edit' : 'add' ?>"><?= @($_GET['id']) ? 'Update' : 'Simpan' ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php if (isset($_POST['add'])) {
                        $nama_pengguna = mysqli_real_escape_string($connection, $_POST['nama_pengguna']);
                        $email = mysqli_real_escape_string($connection, $_POST['email']);
                        $passwordBaru = mysqli_real_escape_string($connection, $_POST['passwordBaru']);
                        $konfirmasi = mysqli_real_escape_string($connection, $_POST['konfirmasi']);
                        $type = mysqli_real_escape_string($connection, $_POST['type']);
                        $today = date("Y-m-d H:i:s");

                        try {
                            if (empty($_FILES['foto']['name'])) {
                                if ($passwordBaru == $konfirmasi) {
                                    $konfirmasi = password_hash($konfirmasi, PASSWORD_DEFAULT);
                                    $connection->query("INSERT INTO tb_pengguna VALUES (NULL, '$nama_pengguna', '$email', '$konfirmasi', '$type', NULL, '$today', '$today');");
                                }
                            } else {
                                $allowed = array("jpg", "JPG", "jpeg", "JPEG", "png", "PNG");
                                $foto = explode(".", $_FILES['foto']['name']);
                                $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
                                $nama_gambar = rand(1, 9999) . round(microtime(true)) . '.' . end($foto);
                                $file = "../upload/pengguna/$nama_gambar";
                                move_uploaded_file($_FILES['foto']['tmp_name'], $file);
                                if (in_array($ext, $allowed)) {

                                    if ($passwordBaru == $konfirmasi) {
                                        $konfirmasi = password_hash($konfirmasi, PASSWORD_DEFAULT);
                                        $connection->query("INSERT INTO tb_pengguna VALUES (NULL, '$nama_pengguna', '$email', '$konfirmasi', '$type', '$nama_gambar', '$today', '$today');");
                                    }
                                }
                            }
                            echo "<script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Data Berhasil dirubah',
                                        showConfirmButton: false,
                                        }).then(function(){
                                        window.location.href = '?page=setting';
                                    });
                                </script>";
                        } catch (\Throwable $th) {
                            echo "<script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Server tidak merespon',
                                    showConfirmButton: false,
                                    }).then(function(){
                                    window.location.href = '?page=setting';
                                });
                            </script>";
                        }
                    }
                    ?>
                    <?php if (isset($_POST['edit'])) {
                        $nama_pengguna = mysqli_real_escape_string($connection, $_POST['nama_pengguna']);
                        $email = mysqli_real_escape_string($connection, $_POST['email']);
                        $passwordBaru = mysqli_real_escape_string($connection, $_POST['passwordBaru']);
                        $konfirmasi = mysqli_real_escape_string($connection, $_POST['konfirmasi']);
                        $type = mysqli_real_escape_string($connection, $_POST['type']);
                        $today = date("Y-m-d H:i:s");
                        try {
                            if (empty($_FILES['foto']['name'])) {
                                if (empty($passwordBaru)) {
                                    $query = $connection->query("UPDATE tb_pengguna SET username = '$nama_pengguna', email = '$email', type='$type', updated_at = '$today' WHERE id_pengguna = '$_GET[id]'");
                                } else {
                                    if ($passwordBaru == $konfirmasi) {
                                        $konfirmasi = password_hash($konfirmasi, PASSWORD_DEFAULT);
                                        $query = $connection->query("UPDATE tb_pengguna SET username = '$nama_pengguna', password = '$konfirmasi', email = '$email', type='$type', updated_at = '$today' WHERE id_pengguna = '$_GET[id]'");
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
                                        $query = $connection->query("UPDATE tb_pengguna SET username = '$nama_pengguna', password = '$konfirmasi', email = '$email', type='$type', updated_at = '$today', thumbnail = '$nama_gambar' WHERE id_pengguna = '$_GET[id]'");
                                    } else {
                                        if ($passwordBaru == $konfirmasi) {
                                            $konfirmasi = password_hash($konfirmasi, PASSWORD_DEFAULT);
                                            $query = $connection->query("UPDATE tb_pengguna SET username = '$nama_pengguna', password = '$konfirmasi', email = '$email', type='$type', updated_at = '$today', thumbnail = '$nama_gambar' WHERE id_pengguna = '$_GET[id]'");
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
                                        window.location.href = '?page=setting';
                                    });
                                </script>";
                        } catch (\Throwable $th) {
                            echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Data gagal dirubah',
                                showConfirmButton: false,
                                }).then(function(){
                                window.location.href = '?page=setting';
                            });
                        </script>";
                        }
                        // try {
                        //     $nama_pengguna = mysqli_real_escape_string($connection, $_POST['nama_pengguna']);
                        //     $email = mysqli_real_escape_string($connection, $_POST['email']);
                        //     $passwordBaru = mysqli_real_escape_string($connection, $_POST['passwordBaru']);
                        //     $konfirmasi = mysqli_real_escape_string($connection, $_POST['konfirmasi']);
                        //     $type = mysqli_real_escape_string($connection, $_POST['type']);
                        //     $today = date("Y-m-d H:i:s");
                        //     if (empty($_FILES['foto']['name'])) {
                        //         if (empty($passwordBaru)) {
                        //             $query = $connection->query("UPDATE tb_pengguna SET username = '$nama_pengguna', email = '$email', type='$type', update_at = '$today' WHERE id_pengguna = '$_GET[id]'");
                        //         } else {
                        //             if ($passwordBaru == $konfirmasi) {
                        //                 $konfirmasi = password_hash($konfirmasi, PASSWORD_DEFAULT);
                        //                 $query = $connection->query("UPDATE tb_pengguna SET username = '$nama_pengguna', password = '$konfirmasi', email = '$email', type='$type', update_at = '$today' WHERE id_pengguna = '$_GET[id]'");
                        //             }
                        //         }
                        //     } else {
                        //         $allowed = array("jpg", "JPG", "jpeg", "JPEG", "png", "PNG");
                        //         $foto = explode(".", $_FILES['foto']['name']);
                        //         $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
                        //         $nama_gambar = rand(1, 9999) . round(microtime(true)) . '.' . end($foto);
                        //         $file = "../upload/pengguna/$nama_gambar";
                        //         move_uploaded_file($_FILES['foto']['tmp_name'], $file);
                        //         if (in_array($ext, $allowed)) {
                        //             if (empty($passwordBaru)) {
                        //                 $query = $connection->query("UPDATE tb_pengguna SET username = '$nama_pengguna', email = '$email', type='$type', thumbnail = '$nama_gambar' , update_at = '$today' WHERE id_pengguna = '$_GET[id]'");
                        //             } else {
                        //                 if ($passwordBaru == $konfirmasi) {
                        //                     $konfirmasi = password_hash($konfirmasi, PASSWORD_DEFAULT);
                        //                     $query = $connection->query("UPDATE tb_pengguna SET username = '$nama_pengguna', password = '$konfirmasi', email = '$email', type='$type', thumbnail = '$nama_gambar' , update_at = '$today' WHERE id_pengguna = '$_GET[id]'");
                        //                 }
                        //             }
                        //         }
                        //     }
                        //     echo "<script>
                        //             Swal.fire({
                        //                 icon: 'success',
                        //                 title: 'Data Berhasil dirubah',
                        //                 showConfirmButton: false,
                        //                 }).then(function(){
                        //                 window.location.href = '?page=profile';
                        //             });
                        //         </script>";
                        // } catch (\Throwable $th) {
                        // }
                    }
                    ?>
                    <?php if (isset($_GET['hapus'])) {
                        try {
                            $connection->query("DELETE FROM tb_pengguna WHERE id_pengguna = '$_GET[hapus]'");
                            echo "<script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Data Berhasil dihapus',
                                showConfirmButton: false,
                                }).then(function(){
                                window.location.href = '?page=setting';
                            });
                        </script>";
                        } catch (\Throwable $th) {
                            echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Data gagal dihapus',
                                showConfirmButton: false,
                                }).then(function(){
                                window.location.href = '?page=setting';
                            });
                        </script>";
                        }
                    } ?>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
</div>