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
                            <img src="./assets/images/transaksi.svg" alt="logo" class="img-fluid d-block">
                        </div>
                        <div class="col-lg-8">
                            <div class="text-end my-3">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addToCart">Tambah Transaksi</button>
                            </div>
                            <?php
                            $data = mysqli_fetch_assoc($connection->query("SELECT count(*) as banyak FROM tb_detail_transaksi WHERE id_pengguna = '$_SESSION[id]' AND status = 0"));
                            ?>
                            <?php
                            if($data['banyak'] > 0):
                            ?>
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
                                        $data = $connection->query("SELECT *, tb_detail_transaksi.harga as cost FROM tb_detail_transaksi LEFT JOIN tb_melon ON tb_detail_transaksi.id_melon = tb_melon.id_melon LEFT JOIN tb_jenis_melon ON tb_melon.id_jenis_melon = tb_jenis_melon.id_jenis_melon WHERE id_pengguna = '$_SESSION[id]' AND status = 0");
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
                                            $data = mysqli_fetch_assoc($connection->query("SELECT SUM(harga) as total FROM tb_detail_transaksi WHERE id_pengguna = '$_SESSION[id]' AND status = 0"));
                                            ?>
                                            <td colspan="3" class="text-center fw-bold">Total</td>
                                            <td class="text-center">Rp <?= number_format($data['total'], 2, ',', '.') ?></td>
                                            <td class="text-center">
                                                <a href="" data-bs-target="#bayar" data-bs-toggle="modal" class="btn btn-success d-block">Bayar</a>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <?php else: ?>
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
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada transaksi</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <?php endif?>
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
                                                    <select name="nama_melon" id="nama_melon" class="form-select">
                                                        <option value="">Pilih Melon</option>
                                                        <?php
                                                        $getResource = $connection->query("SELECT nama_melon, id_melon FROM tb_melon");
                                                        while ($data = mysqli_fetch_assoc($getResource)) :
                                                        ?>
                                                            <option value="<?= $data['id_melon'] ?>"><?= $data['nama_melon'] ?></option>
                                                        <?php endwhile ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="jumlah">Jumlah: </label>
                                                    <input type="number" name="jumlah" id="jumlah" class="form-control" placeholder="Contoh: 1">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="berat">Berat: </label>
                                                    <input type="number" name="berat" id="berat" class="form-control" placeholder="Contoh: 1kg">
                                                </div>
                                                <div class="text-end">
                                                    <button class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                                    <button class="btn btn-success" name="simpan">Simpan</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade bs-example-modal-center" id="bayar" tabindex="-1" aria-modal="true" role="dialog">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Pembayaran</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="POST" class="px-1">
                                                <div class="mb-3">
                                                    <label for="nama_pembeli">Nama Pembeli: </label>
                                                    <input type="text" name="nama_pembeli" id="nama_pembeli" class="form-control" placeholder="Nama Pembeli">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="byr">Bayar: </label>
                                                    <input type="number" name="byr" id="byr" class="form-control" placeholder="Rp. 0">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="kembali">Kembali: </label>
                                                    <input type="text" name="kembali" id="kembali" class="form-control" placeholder="Rp. 0">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="total">Total: </label>
                                                    <?php
                                                    $data = mysqli_fetch_assoc($connection->query("SELECT SUM(harga) as total FROM tb_detail_transaksi WHERE id_pengguna = '$_SESSION[id]' AND status = 0"));
                                                    ?>
                                                    <input type="text" name="total" id="total" class="form-control" value="Rp <?= number_format($data['total'], 2, ',', '.') ?>">
                                                </div>
                                                <script>
                                                    document.getElementById('byr').onchange = () => {
                                                        document.getElementById('kembali').value = document.getElementById('byr').value - <?= $data['total'] ?>
                                                    }
                                                </script>
                                                <div class="text-end">
                                                    <button class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                                    <button class="btn btn-success" name="bayar">Simpan</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if (isset($_POST['simpan'])) {
                                $nama = mysqli_real_escape_string($connection, $_POST['nama_melon']);
                                $jumlah = mysqli_real_escape_string($connection, $_POST['jumlah']);
                                $berat = mysqli_real_escape_string($connection, $_POST['berat']);
                                $id = mysqli_fetch_assoc($connection->query("SELECT harga FROM tb_melon WHERE tb_melon.id_melon = $nama"));
                                $harga = doubleval($jumlah) * $id['harga'];
                                try {
                                    $connection->query("INSERT INTO tb_detail_transaksi VALUES (NULL, NULL, '$_SESSION[id]',$nama, $jumlah, $berat, $harga, 0)");
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
                                        window.location.href='';
                                    });
                                    </script>";
                                }
                            }
                            ?>
                            <?php
                            if (isset($_GET['hapus'])) {
                                try {
                                    $connection->query("DELETE FROM tb_detail_transaksi WHERE id_detail_transaksi = '$_GET[hapus]'");
                                    echo " <script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        showConfirmButton: true,
                                    }).then(function(){
                                        window.location.href='index.php?page=transaksi';
                                    });
                                    </script>";
                                } catch (\Throwable $th) {
                                    echo " <script>
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal!',
                                        showConfirmButton: true,
                                    }).then(function(){
                                        window.location.href='index.php?page=transaksi';
                                    });
                                    </script>";
                                }
                            }
                            ?>
                            <?php
                            if (isset($_POST['bayar'])) {
                                $nama_pembeli = mysqli_real_escape_string($connection, $_POST['nama_pembeli']);
                                $bayar = mysqli_real_escape_string($connection, $_POST['byr']);
                                $kembali = mysqli_real_escape_string($connection, $_POST['kembali']);
                                $data = mysqli_fetch_assoc($connection->query("SELECT SUM(harga) as total FROM tb_detail_transaksi WHERE id_pengguna = '$_SESSION[id]' AND status = 0"));
                                try {
                                    $connection->query("INSERT INTO tb_transaksi VALUES (NULL, '$nama_pembeli', '$data[total]', $bayar, $kembali, now(), now())");
                                    $connection->query("UPDATE tb_detail_transaksi SET id_transaksi = $connection->insert_id, status = 1");
                                    echo " <script>
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Berhasil!',
                                            showConfirmButton: true,
                                        }).then(function(){
                                            window.location.href='index.php?page=transaksi';
                                        });
                                        </script>";
                                } catch (\Throwable $th) {
                                    echo " <script>
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Gagal!',
                                            showConfirmButton: true,
                                        }).then(function(){
                                            window.location.href='index.php?page=transaksi';
                                        });
                                        </script>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>