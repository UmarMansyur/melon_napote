<?php
if (isset($_GET['edit_produk'])) {
    $data = mysqli_fetch_assoc($connection->query("SELECT * FROM tb_jenis_melon WHERE id_jenis_melon = '$_GET[edit_produk]'"));
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Grafik Penjualan</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Grafik Penjualan</h4>
                    <p class="card-title-desc">Data berikut terekap perbulan</p>
                    <div class="row">
                        <div class="col-lg-4">
                            <img src="./assets/images/chart.svg" alt="logo" class="img-fluid d-block">
                        </div>
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Statistik Penjualan Perbulan</h4>
                                    <div id="line_chart_datalabel" class="apex-charts"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
</div>