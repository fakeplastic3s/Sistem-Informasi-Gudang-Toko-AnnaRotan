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
            <a href="<?= base_url('Pengadaan/tambah'); ?>" class="btn btn-success mb-2"><i class="bi bi-clipboard-plus"></i></a>
            <button onclick="window.print()" class="btn btn-primary mb-2"><i class="ri-printer-line"></i></button>
            <a href="<?= base_url('Pengadaan'); ?>" class="btn btn-secondary mb-2"><i class="bi bi-arrow-clockwise"></i></a>
        </div>
        <div class="col me-2 pb-3">

            <form class="d-flex" role="search" action="Pengadaan" method="POST">
                <input class="form-control me-2" type="search" placeholder="Search..." aria-label="Search" name="cari">
                <button class="btn btn-outline-success cari" type="submit">Search</button>
            </form>
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
                            <th scope="col">#</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Nama Supplier</th>
                            <th scope="col">Tanggal Pengadaan</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Harga Satuan</th>
                            <th scope="col">Total Harga</th>
                            <th scope="col">Status Pengadaan</th>
                            <th scope="col">Status Pemesanan</th>
                            <th scope="col" class="aksi">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        <?php foreach ($getPengadaan as $isi) : ?>
                            <tr>
                                <td class="text-center align-middle"><?= $no; ?></td>
                                <td class="text-right align-middle" align-middle><?= $isi['nama_barang']; ?></td>
                                <td class="text-right align-middle"><?= $isi['nama_supplier']; ?></td>
                                <td class="text-center align-middle">
                                    <?php
                                    $tanggal = date('d M Y', strtotime($isi['tanggal_pengadaan']));
                                    echo $tanggal
                                    ?>
                                </td>
                                <td class="text-center align-middle"><?= $isi['jumlah']; ?></td>
                                <td class="text-center align-middle"><?= format_rupiah($isi['harga_satuan']); ?></td>
                                <td class="text-center align-middle"><?= format_rupiah($isi['harga_satuan'] * $isi['jumlah']); ?></td>
                                <td class="text-center align-middle" <?= ($isi['status_pengadaan'] == 'Disetujui') ? 'style="color: green;"' : (($isi['status_pengadaan'] == 'Ditolak') ? 'style="color: red;"' : '') ?>><?= $isi['status_pengadaan']; ?></td>
                                <td class="text-center align-middle" <?= ($isi['status_pemesanan'] == 'Terkirim') ? 'style="color: green;"' : (($isi['status_pemesanan'] == 'Dibatalkan') ? 'style="color: red;"' : '') ?>><?= $isi['status_pemesanan']; ?></td>
                                <td class="text-center align-middle">
                                    <?php if ($isi['status_pengadaan'] == 'Diajukan') { ?>

                                        <a href="<?= base_url('Pengadaan/edit/' . $isi['id_pengadaan']); ?>" class="btn btn-success btn-sm"><i class="ri-clipboard-line"></i></a>
                                    <?php } ?>
                                    <?php if ($isi['status_pengadaan'] == 'Disetujui' or $isi['status_pengadaan'] == 'Ditolak') { ?>

                                        <a class="btn btn-secondary btn-sm"><i class="ri-clipboard-line"></i></a>
                                    <?php } ?>

                                </td>
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