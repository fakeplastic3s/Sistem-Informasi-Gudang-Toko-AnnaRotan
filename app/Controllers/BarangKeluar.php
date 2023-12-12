<?php

namespace App\Controllers;

use App\Models\PengadaanModel;


use App\Controllers\BaseController;
use App\Models\BarangKeluarModel;
use App\Models\StokBarangModel;
use App\Models\SupplierModel;
use Config\Validation;

class BarangKeluar extends BaseController
{
    public function index()
    {
        $model = new BarangKeluarModel;
        $keyword = $this->request->getVar('cari');
        if ($keyword) {
            $model->search($keyword);
        } else {
            $model->getBarangKeluar();
        }
        $BarangKeluar['getBarangKeluar'] = $model->getBarangKeluar();
        $BarangKeluar['title'] = 'Data Barang Keluar';
        echo view('/barangKeluar/BarangKeluarView', $BarangKeluar);
    }

    public function tambah()
    {
        session();
        $supplierModel = new SupplierModel();
        $pengadaan['supplier'] = $supplierModel->getSupplier();
        $pengadaan['validation'] = \Config\Services::validation();
        $pengadaan['title'] = 'Tambah Data Barang keluar';
        return  view('/barangKeluar/tambahView', $pengadaan);
    }

    public function add()
    {
        if (!$this->validate([
            'supplier' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Id supplier  harus diisi'
                ]
            ],
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal harus diisi'
                ]
            ],
            'jumlah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jumlah barang harus diisi'
                ]
            ]
        ])) {
            # code...
            $validation = \Config\Services::validation();
            return redirect()->to('BarangKeluar/tambah')->withInput()->with('validation', $validation);
        }
        $stok = new StokBarangModel();
        $id_supplier = $this->request->getVar('supplier');
        $jumlahInput = $this->request->getVar('jumlah');
        $getDataStok = $stok->getStokByIdSupplier($id_supplier);
        // dd($getDataStok);


        if ($jumlahInput > $getDataStok->jumlah) {
            session()->setFlashData('warning', "Jumlah Stok Tidak Mencukupi ! Jumlah stok " . $getDataStok->nama_barang . " saat ini adalah " . $getDataStok->jumlah);
            return redirect()->to('BarangKeluar/tambah')->withInput();
        } else {
            $BarangKeluarModel = new BarangKeluarModel();
            $barangKeluar = [
                'id_supplier' => $this->request->getPost('supplier'),
                'tgl_keluar' => $this->request->getPost('tanggal'),
                'jumlah' => $this->request->getPost('jumlah'),
            ];
            $BarangKeluarModel->save($barangKeluar);
            session()->setFlashData('pesan_tambah', "Data Barang Keluar Berhasil Ditambah");
        }

        return redirect()->to('BarangKeluar');
    }
    // edit
    public function edit($id)
    {
        session();
        $SupplierModel = new SupplierModel;
        $model = new BarangKeluarModel();
        $getBarangKeluar = $model->getBarangKeluar($id)->getRow();

        if (isset($getBarangKeluar)) {
            $BarangKeluar = [
                'validation' => \Config\Services::validation(),
                'title' => 'Edit Data Barang Keluar ' . $getBarangKeluar->id_barang_keluar,
            ];
            $BarangKeluar['supplier'] = $SupplierModel->getSupplier();
            $BarangKeluar['BarangKeluar'] = $getBarangKeluar;
            return view('/barangKeluar/editView', $BarangKeluar);
        } else {
            session()->setFlashData('pesan_edit', 'Id Pengadaaan Barang tidak ditemukan');
            return redirect()->to('/barangKeluar');
        }
    }

    public function update($id)
    {
        if (!$this->validate([
            'supplier' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Id supplier  harus diisi'
                ]
            ],
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal harus diisi'
                ]
            ],
            'jumlah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jumlah Barang harus diisi'
                ]
            ]
        ])) {
            # code...
            $validation = \Config\Services::validation();
            return redirect()->to('/barangKeluar/edit/' . $this->request->getVar('id_barang_keluar'))->withInput()->with('validation', $validation);
        }
        $BarangKeluarModel = new BarangKeluarModel();
        $BarangKeluar = [
            // 'id_supplier' => $id,
            'id_supplier' => $this->request->getPost('supplier'),
            'tgl_keluar' => $this->request->getPost('tanggal'),
            'jumlah' => $this->request->getPost('jumlah'),

        ];
        $BarangKeluarModel->update($id, $BarangKeluar);
        session()->setFlashData('pesan_edit', "Data  Barang Keluar Berhasil Diedit");
        return redirect()->to('BarangKeluar');
    }

    public function hapus($id)
    {
        $model = new BarangKeluarModel();
        $getBarangKeluar = $model->getBarangKeluar($id)->getRow();
        if (isset($getBarangKeluar)) {
            $model->delete($id);
            session()->setFlashData('pesan_hapus', "Data berhasil dihapus");
            return redirect()->to('/BarangKeluar');
        } else {
            session()->setFlashData('pesan_hapus', "Data gagal dihapus");
            return redirect()->to('/BarangKeluar');
        }
    }

    // laporan barang keluar
    public function laporan()
    {
        $model = new BarangKeluarModel;
        $tanggal_awal = $this->request->getVar('tanggal1');
        $tanggal_akhir = $this->request->getVar('tanggal2');

        if ($tanggal_awal && $tanggal_akhir) {
            $BarangKeluar['laporan'] = $model->laporan($tanggal_awal, $tanggal_akhir);
            $BarangKeluar['title'] = 'Laporan Barang Keluar';
            echo view('/barangKeluar/LaporanBarangKeluar', $BarangKeluar);
        } else {
            $BarangKeluar['laporan'] = $model->laporan(0, 0);
            $BarangKeluar['title'] = 'Laporan Barang Keluar';
            echo view('/barangKeluar/LaporanBarangKeluar', $BarangKeluar);
        }
    }
}
