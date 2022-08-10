<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Dashboard</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-secondary" role="alert">
                Selamat datang <?= $getData['username'] ?>, semoga harimu menyenangkan
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xl-4">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">Jenis Melon</p>
                            <?php $data = mysqli_fetch_assoc($connection->query("SELECT COUNT(id_jenis_melon) as produk FROM tb_jenis_melon")); ?>
                            <h4 class="mb-0"><?= $data['produk']?></h4>
                        </div>
                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                <span class="avatar-title">
                                    <i class="bx bx-git-merge font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xl-4">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">Data Melon</p>
                            <?php $data = mysqli_fetch_assoc($connection->query("SELECT COUNT(id_melon) as produk FROM tb_melon")); ?>
                            <h4 class="mb-0"><?= $data['produk']?></h4>
                        </div>
                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                <span class="avatar-title">
                                    <i class="bx bx-bowling-ball font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xl-4">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">                   
                            <p class="text-muted fw-medium">Penjualan</p>
                            <?php $data = mysqli_fetch_assoc($connection->query("SELECT COUNT(id_transaksi) AS penjualan FROM tb_transaksi")); ?>
                            <h4 class="mb-0"><?= $data['penjualan'] ?></h4>
                        </div>
                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                <span class="avatar-title">
                                    <i class="bx bx-cart-alt font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-nd-12 col-sm-12 col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">5 Melon yang baru ditambahkan</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama Melon</th>
                                    <th>Jenis Melon</th>
                                    <th class="text-center">Berat</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $data = $connection->query("SELECT * FROM tb_melon LEFT JOIN tb_jenis_melon ON tb_melon.id_jenis_melon = tb_jenis_melon.id_jenis_melon ORDER BY tb_melon.created_at DESC");
                                $key = 1;
                                while($d = mysqli_fetch_assoc($data)):
                                ?>
                               <tr>
                                    <td class="text-center"><?= $key ?></td>
                                    <td><?= $d['nama_melon'] ?></td>
                                    <td><?= $d['jenis_melon'] ?></td>
                                    <td class="text-center"><?= $d['berat'] ?></td>
                                    <td><?= $d['harga'] ?></td>
                                </tr>
                                <?php $key++; endwhile ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col-lg-6 col-nd-6 col-sm-12 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Statistik Penjualan Perbulan</h4>
                    <div id="line_chart_datalabel" class="apex-charts"></div>
                </div>
            </div>
        </div> -->
    </div>
    <!-- end page title -->
</div>