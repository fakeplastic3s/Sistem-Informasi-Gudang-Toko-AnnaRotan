<?php

namespace App\Controllers;

use App\Models\BarangMasukModel;
use App\Models\SupplierModel;


use App\Controllers\BaseController;
use App\Models\PengadaanModel;
use Config\Validation;

class BarangMasuk extends BaseController
{
    public function index()
    {
        $model = new BarangMasukModel;
        $keyword = $this->request->getVar('cari');
        if ($keyword) {
            $model->search($keyword);
        } else {
            $model->getBarangMasukJoin();
        }
        $barangmasuk['getBarangMasuk'] = $model->getBarangMasukJoin();
        $barangmasuk['title'] = 'Data Barang Masuk';
        echo view('/barang_masuk/barangmasukView', $barangmasuk);
    }

    public function tambah()
    {
        session();
        $model = new BarangMasukModel;
        $barangmasuk['pengadaan'] = $model->getPengadaanJoinDisetujui();
        $barangmasuk['supplier'] = $model->getSupplierPengadaan();
        $barangmasuk['validation'] = \Config\Services::validation();
        $barangmasuk['title'] = 'Tambah Data Barang Masuk';

        // dd($model->getPengadaanJoinDisetujui());
        return  view('/barang_masuk/tambahView', $barangmasuk);
    }

    public function add()
    {
        if (!$this->validate([
            'pengadaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Id pengadaan  harus diisi'

                ]
            ],
            'supplier' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Id Supplier harus diisi'
                ]
            ],
            'jumlah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Masuk barang harus diisi'
                ]
            ],
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Masuk barang harus diisi'
                ]
            ]
        ])) {
            # code...
            $validation = \Config\Services::validation();
            return redirect()->to('/BarangMasuk/tambah')->withInput()->with('validation', $validation);
        }

        $BarangMasukModel = new BarangMasukModel();
        $barangmasuk = [
            'title' => 'Tambah BarangMasuk Barang',
            // 'id' => $this->request->getVar('id'),
            'id_pengadaan' => $this->request->getVar('pengadaan'),
            'id_supplier' => $this->request->getVar('supplier'),
            'tgl_masuk' => $this->request->getVar('tanggal'),
            'jumlah_masuk' => $this->request->getVar('jumlah')
        ];
        // dd($barangmasuk);
        $BarangMasukModel->save($barangmasuk);
        session()->setFlashData('pesan_tambah', "Data BarangMasuk Barang Berhasil Ditambah");
        return redirect()->to('BarangMasuk');
    }
    // edit
    public function edit($id)
    {
        session();
        $PengadaanModel = new PengadaanModel;
        $SupplierModel = new SupplierModel;
        $model = new BarangMasukModel();
        $getBarangMasuk = $model->getBarangMasuk($id)->getRow();
        // dd($getBarangMasuk);

        if (isset($getBarangMasuk)) {
            $barangmasuk = [
                'validation' => \Config\Services::validation(),
                'title' => 'Edit Data Barang Masuk ' . $getBarangMasuk->id_barang_masuk,
            ];
            $barangmasuk['pengadaan'] = $PengadaanModel->getPengadaan();
            $barangmasuk['supplier'] = $SupplierModel->getSupplier();
            $barangmasuk['barangmasuk'] = $getBarangMasuk;
            return view('/barang_masuk/editView', $barangmasuk);
        } else {
            session()->setFlashData('pesan_edit', 'Id Barang Masuk tidak ditemukan');
            return redirect()->to('/BarangMasuk');
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
                    'required' => 'Tanggal Masuk barang harus diisi'
                ]
            ]
        ])) {
            # code...
            $validation = \Config\Services::validation();
            return redirect()->to('/BarangMasuk/edit/' . $this->request->getVar('id'))->withInput()->with('validation', $validation);
        }


        $BarangMasukModel = new BarangMasukModel();
        $barangmasuk = [
            'id_barang_masuk' => $id,
            'id_pengadaan' => $this->request->getVar('pengadaan'),
            'id_supplier' => $this->request->getVar('supplier'),
            'tgl_masuk' => $this->request->getVar('tanggal'),
        ];
        // dd($barangmasuk);
        $BarangMasukModel->update($id, $barangmasuk);
        session()->setFlashData('pesan_edit', "Data Barang Masuk Barang Berhasil Diedit");
        return redirect()->to('BarangMasuk');
    }

    // Hapus
    public function hapus($id)
    {
        $model = new BarangMasukModel();
        $getBarangMasuk = $model->getBarangMasuk($id)->getRow();
        if (isset($getBarangMasuk)) {
            $model->hapusBarangMasuk($id);
            session()->setFlashData('pesan_hapus', "Data berhasil dihapus");
            return redirect()->to('/BarangMasuk');
        } else {
            session()->setFlashData('pesan_hapus', "Data gagal dihapus");
            return redirect()->to('/BarangMasuk');
        }
    }

    // laporan barang masuk
    public function laporan()
    {
        $model = new BarangMasukModel;
        $tanggal_awal = $this->request->getVar('tanggal1');
        $tanggal_akhir = $this->request->getVar('tanggal2');

        if ($tanggal_awal && $tanggal_akhir) {
            $barangmasuk['laporan'] = $model->laporan($tanggal_awal, $tanggal_akhir);
            $barangmasuk['title'] = 'Laporan Barang Masuk';
            echo view('/barang_masuk/LaporanBarangMasuk', $barangmasuk);
        } else {
            $barangmasuk['laporan'] = $model->laporan(0, 0);
            $barangmasuk['title'] = 'Laporan Barang Masuk';
            echo view('/barang_masuk/LaporanBarangMasuk', $barangmasuk);
        }
    }
}
