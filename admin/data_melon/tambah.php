    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18"><?= @($_GET['edit_produk']) ? 'Edit' : 'Upload' ?> Melon</h4>
                </div>
            </div>
        </div>
        <?php
        if (isset($_GET['edit_produk'])) {
            $getResource = mysqli_fetch_assoc($connection->query("SELECT * FROM tb_melon LEFT JOIN tb_jenis_melon ON tb_melon.id_jenis_melon = tb_jenis_melon.id_jenis_melon LEFT JOIN tb_stok ON tb_melon.id_stok = tb_stok.id_stok WHERE id_melon = '$_GET[edit_produk]'"));
        }
        ?>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?= @($_GET['edit_produk']) ? 'Edit' : 'Upload' ?> Melon</h4>
                        <p class="card-title-desc"> Hindari berjualan produk palsu dan memanipulasi harga !</p>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="nama_produk" class="form-label">Nama Melon: <sup class="text-danger">* Wajib</sup></label>
                                <input type="text" class="form-control" name="nama_produk" id="nama_produk" placeholder="Nama Jenis Melon" value="<?= @($_GET['edit_produk']) ? $getResource['nama_melon'] : '' ?>" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="stok" class="form-label">Stok: <sup class="text-danger">* Wajib</sup></label>
                                        <input type="number" class="form-control" id="stok" name="stok" placeholder="Stok" value="<?= @($_GET['edit_produk']) ? $getResource['stok'] : '' ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="satuan" class="form-label">Berat: <sup class="text-danger">* Wajib</sup></label>
                                        <input type="number" class="form-control" id="satuan" name="satuan" placeholder="Contoh: Kg" value="<?= @($_GET['edit_produk']) ? $getResource['berat'] : '' ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="harga" class="form-label">Jenis Melon: <sup class="text-danger">* Wajib</sup></label>
                                        <select class="form-select" id="kategori" name="kategori">
                                            <option selected="">Pilih Jenis Melon</option>
                                            <?php
                                            $getData = $connection->query("SELECT * FROM tb_jenis_melon");
                                            while ($data = mysqli_fetch_assoc($getData)) : ?>
                                                <option value="<?= $data['id_jenis_melon'] ?>"><?= $data['jenis_melon'] ?></option>
                                            <?php endwhile ?>
                                        </select>
                                        <?php
                                        if (isset($_GET['edit_produk'])) {
                                            // $query = mysqli_fetch_assoc($connection->query("SELECT * FROM tb_melon WHERE id_melon = '$_GET[edit_produk]'"));
                                            echo "<script>
                                             document.getElementById('kategori').value = '$getResource[id_jenis_melon]' ;
                                                
                                                </script>";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="harga" class="form-label">Harga <sup class="text-danger">* Wajib</sup></label>
                                        <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga" value="<?= @($_GET['edit_produk']) ? $getResource['harga'] : ''?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary w-md" name="<?= @($_GET['edit_produk']) ? 'save' : 'add' ?>"><?= @($_GET['edit_produk']) ? 'Simpan' : 'Tambahkan' ?></button>
                            </div>
                        </form>
                        <?php if (isset($_POST['add'])) {
                            $nama_produk = mysqli_real_escape_string($connection, $_POST["nama_produk"]);
                            $stok = mysqli_real_escape_string($connection, $_POST["stok"]);
                            $kategori = $_POST["kategori"];
                            $harga = $_POST["harga"];
                            $berat = $_POST["satuan"];
                            try {
                                $connection->query("INSERT INTO tb_stok VALUES (NULL, $stok, now(), now())");
                                $query = $connection->query("INSERT INTO tb_melon VALUES (NULL, $kategori, $connection->insert_id, '$nama_produk', $berat, $harga, NULL, now(), now())");
                                echo " <script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        showConfirmButton: true,
                                    }).then(function(){
                                        window.location.href = 'index.php?page=tambah_melon';
                                    });
                                    </script>";
                            } catch (\Throwable $th) {
                                echo " <script>
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal!',
                                        text: 'Server tidak merespon!',
                                        showConfirmButton: true,
                                    }).then(function(){
                                        window.location.href = 'index.php?page=tambah_melon';
                                    });
                                    </script>";
                            }
                        } ?>
                        <?php if(isset($_POST['save'])) {
                             $nama_produk = mysqli_real_escape_string($connection, $_POST["nama_produk"]);
                             $stok = mysqli_real_escape_string($connection, $_POST["stok"]);
                             $kategori = $_POST["kategori"];
                             $harga = $_POST["harga"];
                             $berat = $_POST["satuan"];
                             try {
                                $postResource = $connection->query("INSERT INTO tb_stok VALUES (NULL, $stok, now(), now())");
                                $putResource = $connection->query("UPDATE tb_melon SET nama_melon = '$nama_produk', id_jenis_melon = $kategori, id_stok=$connection->insert_id, harga = $harga, berat = $berat, updated_at = now() WHERE id_melon = '$_GET[edit_produk]'");
                                echo " <script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        showConfirmButton: true,
                                    }).then(function(){
                                        window.location.href = 'index.php?page=tambah_melon';
                                    });
                                    </script>";
                             } catch (\Throwable $th) {
                                echo " <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: 'Server tidak merespon!',
                                    showConfirmButton: true,
                                }).then(function(){
                                    window.location.href = 'index.php?page=tambah_melon';
                                });
                                </script>";
                             }
                        } ?>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body row">
                        <h4 class="card-title">Upload Foto Produk</h4>
                        <p class="card-title-desc">Foto diupload setelah menginputkan data pada form diatas, Pastikan foto produk sesuai dengan produk yang diinputkan !</p>
                        <div class="col-lg-12">
                            <?php
                            if (isset($_POST['upload1'])) {
                                $directory = 'assets/uploads/produk/';
                                $foto = rand(1, 9999) . $_FILES["foto_utama"]['name'];
                                $file = $_FILES["foto_utama"]['tmp_name'];
                                $getfoto = move_uploaded_file($file, $directory . $foto);
                                $date = date('Y-m-d');
                                $connection->query("UPDATE tb_melon SET foto = '$foto' WHERE created_at LIKE '%$date%' AND foto IS NULL");
                            }
                            ?>
                            <form action="" class="dropzone" method="POST" enctype="multipart/form-data">
                                <div class="fallback">
                                    <input name="foto_utama" type="file" multiple="multiple">
                                </div>
                                <div class="dz-message needsclick">
                                    <div class="mb-3">
                                        <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                    </div>

                                    <h4>Foto Utama</h4>
                                </div>
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" name="upload1">upload</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>