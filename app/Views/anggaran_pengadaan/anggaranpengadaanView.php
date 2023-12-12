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
    <!-- <div class="row ">
        <div class="col-lg-7 col-sm-4 col-md-5 ms-2">
            <button onclick="window.print()" class="btn btn-primary mb-2"><i class="ri-printer-line"></i></button>
            <a href="<?= base_url('AnggaranPengadaan'); ?>" class="btn btn-secondary mb-2"><i class="bi bi-arrow-clockwise"></i></a>
        </div>
        <div class="col me-2 pb-3">

            <form class="d-flex" role="search" action="AnggaranPengadaan" method="POST">
                <input class="form-control me-2" type="search" placeholder="Search..." aria-label="Search" name="cari">
                <button class="btn btn-outline-success cari" type="submit">Search</button>
            </form>
        </div>
    </div> -->

    <div class="card pt-4">
        <div class="card-body">
            <!-- <h5 class="card-title">Table with stripped rows</h5> -->
            <!-- Table with stripped rows -->

            <div class="table-responsive-md">
                <table class="table table-striped align-item-center datatable">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Nama Supplier</th>
                            <th scope="col">Tanggal Pengadaan</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Harga Satuan</th>
                            <th scope="col">Total Harga</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="aksi">Proses</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        <?php $no = 1 ?>
                        <?php foreach ($getPengadaan as $isi) : ?>
                            <tr>
                                <td class="text-center align-middle"><?= $no; ?></td>
                                <td class="text-right align-middle"><?= $isi['nama_barang']; ?></td>
                                <td class="text-right align-middle"><?= $isi['nama_supplier']; ?></td>

                                <td class="text-center align-middle">
                                    <?= format_tanggal($isi['tanggal_pengadaan']); ?>
                                </td>
                                <td class="text-center align-middle"><?= $isi['jumlah']; ?></td>
                                <td class="text-center align-middle"><?= format_rupiah($isi['harga_satuan']); ?></td>
                                <td class="text-center align-middle"><?= format_rupiah($isi['harga_satuan'] * $isi['jumlah']); ?></td>
                                <td class="text-center align-middle" <?= ($isi['status_pengadaan'] == 'Disetujui') ? 'style="color: green;"' : (($isi['status_pengadaan'] == 'Ditolak') ? 'style="color: red;"' : '') ?>><?= $isi['status_pengadaan']; ?></td>


                                <?php if ($isi['status_pengadaan'] == 'Diajukan') { ?>

                                    <td class="text-center align-middle">
                                        <form action="<?= base_url('AnggaranPengadaan/update/' . $isi['id_pengadaan']); ?>" method="POST">
                                            <input type="hidden" name="id" value="<?= $isi['id_pengadaan']; ?>">
                                            <input type="hidden" name="supplier" value="<?= $isi['id_supplier']; ?>">
                                            <input type="hidden" name="tanggal" value="<?= $isi['tanggal_pengadaan']; ?>">
                                            <input type="hidden" name="jumlah" value="<?= $isi['jumlah']; ?>">
                                            <input type="hidden" name="status" value="Disetujui">

                                            <button class="btn btn-success btn-sm m-2"><i class="bi bi-check-lg"></i></button>
                                        </form>
                                        <form action="<?= base_url('AnggaranPengadaan/update/' . $isi['id_pengadaan']); ?>" method="POST">
                                            <input type="hidden" name="id" value="<?= $isi['id_pengadaan']; ?>">
                                            <input type="hidden" name="supplier" value="<?= $isi['id_supplier']; ?>">
                                            <input type="hidden" name="tanggal" value="<?= $isi['tanggal_pengadaan']; ?>">
                                            <input type="hidden" name="jumlah" value="<?= $isi['jumlah']; ?>">
                                            <input type="hidden" name="status" value="Ditolak">
                                            <button class="btn btn-danger btn-sm"><i class="bi bi-x"></i></button>
                                        </form>
                                    </td>
                                <?php } ?>

                                <?php if ($isi['status_pengadaan'] == 'Disetujui' or $isi['status_pengadaan'] == 'Ditolak') { ?>
                                    <td class="text-center align-middle">
                                        <form action="<?= base_url('AnggaranPengadaan/update/' . $isi['id_pengadaan']); ?>">
                                            <button class="btn btn-success btn-sm m-2" disabled><i class="bi bi-check-lg"></i></button>
                                        </form>
                                        <form action="<?= base_url('AnggaranPengadaan/update/' . $isi['id_pengadaan']); ?>">
                                            <button class="btn btn-danger btn-sm" disabled><i class="bi bi-x"></i></button>
                                        </form>
                                    </td>
                                <?php } ?>

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