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


    <div class="card pt-4">
        <div class="card-body">

            <div class="row ">
                <div class="col-lg-7 col-sm-4 col-md-5 ms-2">
                    <a href="<?= base_url('supplier/tambahsupplier'); ?>" class="btn btn-success mb-2"><i class="bi bi-clipboard-plus"></i> Tambah Data</a>
                    <!-- <button onclick="window.print()" class="btn btn-primary mb-2"><i class="ri-printer-line"></i></button>
            <a href="<?= base_url('supplier'); ?>" class="btn btn-secondary mb-2"><i class="bi bi-arrow-clockwise"></i></a> -->
                </div>
                <!-- <div class="col me-2 pb-3">

            <form class="d-flex" role="search" action="supplier" method="POST">
                <input class="form-control me-2" type="search" placeholder="Search..." aria-label="Search" name="cari">
                <button class="btn btn-outline-success cari" type="submit">Search</button>
            </form>
        </div> -->
            </div>
            <!-- <h5 class="card-title">Table with stripped rows</h5> -->
            <!-- Table with stripped rows -->

            <div class="table-responsive-md">
                <table class="table table-striped datatable">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">Nama Supplier</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Harga Satuan</th>
                            <th scope="col" class="aksi">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        <?php foreach ($getSupplier as $isi) : ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td class="text-right"><?= $isi['nama_supplier']; ?></td>
                                <td class="text-center"><?= $isi['alamat']; ?></td>
                                <td class="text-center"><?= $isi['nama_barang']; ?></td>
                                <td class="text-center"><?= format_rupiah($isi['harga_satuan']); ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('supplier/edit/' . $isi['id_supplier']); ?>" class="btn btn-success btn-sm"><i class="ri-clipboard-line"></i></a>
                                    <form action="/supplier/hapus/<?= $isi['id_supplier']; ?>" class="d-inline">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" onclick="javascript:return confirm('Apakah anda ingin menghapus data supplier?')" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                    </form>
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