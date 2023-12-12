<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<section class="section dashboard">
    <?php if (session()->getFlashdata('pesan_tambah')) : ?>
        <div class="alert alert-success my-2 text-center" role="alert">
            <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('pesan_tambah'); ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('pesan_hapus')) : ?>
        <div class="alert alert-danger my-2 text-center" role="alert">
            <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('pesan_hapus'); ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('pesan_edit')) : ?>
        <div class="alert alert-primary my-2 text-center" role="alert">
            <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('pesan_edit'); ?>
        </div>
    <?php endif; ?>
    <div class="row ">
        <div class="col-lg-7 col-sm-4 col-md-5 ms-2">

            <button onclick="window.print()" class="btn btn-primary mb-2"><i class="ri-printer-line"></i></button>
            <a href="<?= base_url('StokBarang/laporan'); ?>" class="btn btn-secondary mb-2"><i class="bi bi-arrow-clockwise"></i></a>
        </div>
    </div>

    <div class="card pt-4">
        <div class="card-body">
            <!-- <h5 class="card-title">Table with stripped rows</h5> -->
            <!-- Table with stripped rows -->

            <div class="table-responsive-md">
                <table class="table table-striped">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Nama Supplier</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Harga Jual</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (empty($laporan)) : ?>
                            <tr>
                                <td colspan="6" class="text-center">
                                    Data tidak ditemukan!
                                </td>
                            </tr>
                        <?php endif;
                        ?>
                        <?php $no = 1 ?>
                        <?php foreach ($laporan as $isi) : ?>
                            <tr class="text-center">
                                <td class="text-center"><?= $no; ?></td>
                                <td class="text-right"><?= $isi['nama_barang']; ?></td>
                                <td class="text-right"><?= $isi['nama_supplier']; ?></td>
                                <td class="text-right"><?= $isi['jumlah']; ?></td>
                                <td class="text-center">Rp <?= number_format($isi['harga_jual'], 0, ",", "."); ?></td>

                            </tr>
                            <?php $no++ ?>
                        <?php endforeach ?>


                    </tbody>
                </table>
            </div>
            <!-- End Table with stripped rows -->

        </div>
    </div>
</section>
<?= $this->endSection(); ?>