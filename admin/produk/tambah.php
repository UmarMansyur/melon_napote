<?php if ($_GET['edit_produk']) : ?>
    <?php
    if (isset($_GET['edit_produk'])) {
        $id  = $_GET['edit_produk'];
        $result = mysqli_fetch_assoc($connection->query("SELECT * FROM tb_produk WHERE id_produk = '$id'"));
    }
    ?>
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Tambah Produk</h4>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Upload Produk</h4>
                        <p class="card-title-desc"> Hindari berjualan produk palsu dan memanipulasi harga !</p>
                        <?php if (isset($_POST['add'])) {
                            $nama_produk = mysqli_escape_string($connection, $_POST["nama_produk"]);
                            $stok = $_POST["stok"];
                            $satuan = mysqli_escape_string($connection, $_POST["satuan"]);
                            $kategori = mysqli_escape_string($connection, $_POST["kategori"]);
                            $harga = $_POST["harga"];
                            $query = $connection->query("UPDATE tb_produk SET nama_produk = '$nama_produk', stok = '$stok', satuan = '$satuan', kategori = '$kategori', harga = '$harga' WHERE id_produk = '$id'");
                            if ($query) {
                                echo "<script>
                                alert('berhasil');
                                window.location.href='./index.php?page=data_produk';
                            </script>";
                            }
                        } ?>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="nama_produk" class="form-label">Nama Produk <sup class="text-danger">* Wajib</sup></label>
                                <input type="text" class="form-control" name="nama_produk" id="nama_produk" placeholder="Nama Produk" value="<?= $result['nama_produk'] ?>">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="stok" class="form-label">Stok</label>
                                        <input type="number" class="form-control" id="stok" name="stok" placeholder="Stok" value="<?= $result['stok'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="satuan" class="form-label">Satuan</label>
                                        <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Contoh: Kg" value="<?= $result['satuan'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="harga" class="form-label">Kategori</label>
                                        <select class="form-select" id="kategori" name="kategori" required>
                                            <option value="0" selected="">Pilih Kategori</option>
                                            <option value="1">Telur Ayam Ras/Horn</option>
                                            <option value="2">Telur Ayam Arab</option>
                                            <option value="3">Telur Burung Puyuh</option>
                                            <option value="4">Lainnya ...</option>
                                        </select>
                                        <p class="text-muted">Harap isi ulang pilihan kategori</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="harga" class="form-label">Harga</label>
                                        <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga" value="<?= $result['harga'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary w-md" name="add">SIMPAN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body row">
                        <h4 class="card-title">Upload Foto Produk</h4>
                        <p class="card-title-desc">Pastikan foto produk sesuai dengan produk yang diinputkan !</p>
                        <div class="col-lg-4">
                            <?php
                            if (isset($_POST['upload1'])) {
                                $directory = 'assets/uploads/produk/';
                                $foto = rand(1,9999) . $_FILES["foto_utama"]['name'];
                                $file = $_FILES["foto_utama"]['tmp_name'];
                                $getfoto = move_uploaded_file($file, $directory.$foto);
                                if($getfoto) {
                                    echo "<script>
                                alert('berhasil');
                                window.location.href='./index.php?page=data_produk';
                            </script>";
                                }
                                $date = date('Y-m-d');
                                $connection->query("UPDATE tb_produk SET foto_utama = '$foto' WHERE id_produk = '$id'");
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
                        <div class="col-lg-4">
                            <?php
                            if (isset($_POST['upload2'])) {
                                $directory = 'assets/uploads/produk/';
                                $file = $_FILES["foto2"]['tmp_name'];
                                $foto = rand(1,9999) . $_FILES["foto2"]['name'];
                                $getfoto = move_uploaded_file($file, $directory.$foto);
                                $date = date('Y-m-d');
                                $connection->query("UPDATE tb_produk SET foto_dua = '$foto' WHERE id_produk = '$id'");
                            }
                            ?>
                            <form action="" class="dropzone" method="POST" enctype="multipart/form-data">
                                <div class="fallback">
                                    <input name="foto2" type="file" multiple="multiple">
                                </div>
                                <div class="dz-message needsclick">
                                    <div class="mb-3">
                                        <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                    </div>

                                    <h4>Foto 2</h4>
                                </div>
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" name="upload2">upload</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-4">
                            <?php
                            if (isset($_POST['upload3'])) {
                                $directory = 'assets/uploads/produk/';
                                $foto = rand(1,9999). $_FILES["foto3"]['name'];
                                $file = $_FILES["foto3"]['tmp_name'];
                                $getfoto = move_uploaded_file($file, $directory.$foto);
                                $date = date('Y-m-d');
                                $connection->query("UPDATE tb_produk SET foto_tiga = '$foto' WHERE id_produk = '$id'");
                            }
                            ?>
                            <form action="#" class="dropzone" method="POST" enctype="multipart/form-data">
                                <div class="fallback">
                                    <input name="foto3" type="file" multiple="multiple">
                                </div>
                                <div class="dz-message needsclick">
                                    <div class="mb-3">
                                        <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                    </div>

                                    <h4>Foto 3</h4>
                                </div>
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" name="upload3">upload</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>

<?php else : ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Tambah Jenis Melon</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Upload Jenis Melon</h4>
                        <p class="card-title-desc"> Hindari berjualan produk palsu dan memanipulasi harga !</p>
                        <?php if (isset($_POST['add'])) {
                            $nama_produk = mysqli_escape_string($connection, $_POST["nama_produk"]);
                            $stok = $_POST["stok"];
                            $satuan = mysqli_escape_string($connection, $_POST["satuan"]);
                            $kategori = mysqli_escape_string($connection, $_POST["kategori"]);
                            $harga = $_POST["harga"];
                            $query = $connection->query("INSERT INTO tb_produk VALUES (NULL, '$_SESSION[id]', '$nama_produk', '$stok', '$satuan', '$kategori', '$harga', NULL, NULL, NULL, now(), now(), 1)");
                        } ?>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="nama_produk" class="form-label">Nama Jenis <sup class="text-danger">* Wajib</sup></label>
                                <input type="text" class="form-control" name="nama_produk" id="nama_produk" placeholder="Nama Jenis Melon" value="<?= $result['nama_produk'] ?>">
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary w-md" name="add">Tambahkan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
<?php endif ?>