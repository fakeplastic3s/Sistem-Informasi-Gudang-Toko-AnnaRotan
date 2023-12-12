<?php

namespace App\Controllers;

use App\Models\PengadaanModel;


use App\Controllers\BaseController;
use App\Models\SupplierModel;
use Config\Validation;

class AnggaranPengadaan extends BaseController
{
    public function index()
    {
        $model = new PengadaanModel;
        $keyword = $this->request->getVar('cari');
        if ($keyword) {
            $model->search($keyword);
        } else {
            $model->getPengadaanJoin();
        }
        $pengadaan['getPengadaan'] = $model->getPengadaanJoin();
        $pengadaan['title'] = 'Data Anggaran Pengadaan Barang';
        echo view('/anggaran_pengadaan/anggaranpengadaanView', $pengadaan);
    }


    public function proses($id)
    {
        session();
        $SupplierModel = new SupplierModel;
        $model = new PengadaanModel();
        $getPengadaan = $model->getPengadaan($id)->getRow();

        if (isset($getPengadaan)) {
            $pengadaan = [
                'validation' => \Config\Services::validation(),
                'title' => 'Proses Data Anggaran Pengadaan Barang ' . $getPengadaan->id_pengadaan,
            ];
            $pengadaan['supplier'] = $SupplierModel->getSupplier();
            $pengadaan['pengadaan'] = $getPengadaan;
            $pengadaan['status_pengadaan'] = $model->getPengadaan();
            return view('/anggaran_pengadaan/prosesView', $pengadaan);
        } else {
            session()->setFlashData('pesan_edit', 'Id Pengadaaan Barang tidak ditemukan');
            return redirect()->to('/AnggaranPengadaan');
        }
    }

    public function update($id)
    {
        $PengadaanModel = new PengadaanModel();
        $statuspengadaan = $this->request->getPost('status');
        if ($statuspengadaan == 'Disetujui') {
            $statuspemesanan = 'Diproses';
        } elseif ($statuspengadaan == 'Ditolak') {
            $statuspemesanan = 'Dibatalkan';
        } else {
            $statuspemesanan = 'Diproses';
        }
        $pengadaan = [
            'id_supplier' => $id,
            'id_supplier' => $this->request->getPost('supplier'),
            'tanggal_pengadaan' => $this->request->getPost('tanggal'),
            'jumlah' => $this->request->getPost('jumlah'),
            'status_pengadaan' => $this->request->getPost('status'),
            'status_pemesanan' => $statuspemesanan
        ];
        // dd($pengadaan);
        $PengadaanModel->update($id, $pengadaan);
        session()->setFlashData('pesan_edit', "Data Pengadaan Barang Berhasil Diproses");
        return redirect()->to('AnggaranPengadaan');
    }
}
