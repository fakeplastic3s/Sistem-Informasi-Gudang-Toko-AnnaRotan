<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="row">

    <!-- Left side columns -->
    <div class="col-lg-12">
        <div class="row">
            <div class="col-xxl-4 col-md-4">
                <div class="row">
                    <div class="col">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h4 class="card-title">Jumlah Barang Masuk</h4>
                                <div class="d-flex align-items-center m-2">
                                    <div class="card-icon icon-primary rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-box2"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?= $barangmasuk->jumlah; ?></h6>
                                        <span class="text-muted small pt-2 ps-1"> <?= format_tanggal($tanggal_min->tgl_masuk); ?> - <?= format_tanggal($tanggal_max->tgl_masuk); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xxl-4 col-md-4">
                <div class="row">
                    <div class="col">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h4 class="card-title">Jumlah Barang Keluar</h4>
                                <div class="d-flex align-items-center m-2">
                                    <div class="card-icon icon-success icon-primary rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-inbox"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?= $barangkeluar->jumlah; ?></h6>
                                        <span class="text-muted small pt-2 ps-1"> <?= format_tanggal($tanggal_min->tgl_masuk); ?> - <?= format_tanggal($tanggal_max->tgl_masuk); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xxl-4 col-md-4">
                <div class="row">
                    <div class="col">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h4 class="card-title">Jumlah Stok Barang</h4>
                                <div class="d-flex align-items-center m-2">
                                    <div class="card-icon icon-danger rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-box-seam"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?= $stokbarang->jumlah; ?></h6>
                                        <!-- <span class="text-muted small pt-2 ps-1"> <?= format_tanggal($tanggal_min->tgl_masuk); ?> - <?= format_tanggal($tanggal_max->tgl_masuk); ?></span> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xxl-5 col-md-5">
                <div class="row">
                    <div class="col">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h4 class="card-title">Penjualan</h4>
                                <div class="d-flex align-items-center m-2">
                                    <div class="card-icon icon-cash rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cash"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?= format_rupiah($penjualan->total); ?></h6>
                                        <span class="text-muted small pt-2 ps-1"> <?= format_tanggal($tanggal_bk_min->tgl_keluar); ?> - <?= format_tanggal($tanggal_bk_max->tgl_keluar); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-4 col-md-4">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="d-flex align-item-center">
                                <div class="card-body m-0 p-2 g-0">
                                    <div class="card-title text-center m-0"><?= $date; ?> <br> <span><i class="bi bi-clock"></i></span> <span id="clock"></span>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>





        </div>
    </div><!-- End Left side columns -->


</div>

<?= $this->endSection(); ?>