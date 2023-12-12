<?php

namespace App\Controllers;

use App\Models\StokBarangModel;

use App\Controllers\BaseController;
use App\Models\SupplierModel;
use Config\Validation;

class StokBarang extends BaseController
{
    public function index()
    {
        $model = new StokBarangModel;
        $keyword = $this->request->getVar('cari');
        if ($keyword) {
            $model->search($keyword);
        } else {
            $model->getStokBarang();
        }
        $StokBarang['getStokBarang'] = $model->getStokBarang();
        $StokBarang['title'] = 'Data Stok Gudang';
        echo view('/stokBarang/StokBarangView', $StokBarang);
    }

    public function tambah()
    {
        session();
        $supplierModel = new SupplierModel();
        $pengadaan['supplier'] = $supplierModel->getSupplier();
        $pengadaan['validation'] = \Config\Services::validation();
        $pengadaan['title'] = 'Tambah Data Stok Gudang';
        return  view('/stokBarang/tambahView', $pengadaan);
    }

    public function add()
    {
        if (!$this->validate([
            'supplier' => [
                'rules' => 'required|is_unique[stok_gudang.id_supplier]',
                'errors' => [
                    'required' => 'Id Supplier harus diisi',
                    'is_unique' => 'Id Supplier sudah ada'
                ]
            ],
            'jumlah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal harus diisi'
                ]
            ],
            'harga_jual' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jumlah barang harus diisi'
                ]
            ]
        ])) {
            # code...
            $validation = \Config\Services::validation();
            return redirect()->to('/stokBarang/tambah')->withInput()->with('validation', $validation);
        }
        $StokBarangModel = new StokBarangModel();
        $stokBarang = [
            'id_supplier' => $this->request->getPost('supplier'),
            'jumlah' => $this->request->getPost('jumlah'),
            'harga_jual' => $this->request->getPost('harga_jual'),
        ];
        $StokBarangModel->save($stokBarang);
        session()->setFlashData('pesan_tambah', "Data Barang Berhasil Ditambah");
        return redirect()->to('StokBarang');
    }
    // edit
    public function edit($id)
    {
        session();
        $SupplierModel = new SupplierModel;
        $model = new StokBarangModel();
        $getStokBarang = $model->getStokBarang($id)->getRow();

        if (isset($getStokBarang)) {
            $StokBarang = [
                'validation' => \Config\Services::validation(),
                'title' => 'Edit Data Stok Barang ' . $getStokBarang->id_stok,
            ];
            $StokBarang['supplier'] = $SupplierModel->getSupplier();
            $StokBarang['StokBarang'] = $getStokBarang;
            return view('/stokBarang/editView', $StokBarang);
        } else {
            session()->setFlashData('pesan_edit', 'Id Barang tidak ditemukan');
            return redirect()->to('/stokBarang');
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
            'jumlah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal harus diisi'
                ]
            ],
            'harga_jual' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jumlah barang harus diisi'
                ]
            ]
        ])) {
            # code...
            $validation = \Config\Services::validation();
            return redirect()->to('/stokBarang/edit/' . $this->request->getVar('id_stok'))->withInput()->with('validation', $validation);
        }
        $StokBarangModel = new StokBarangModel();
        $StokBarang = [
            // 'id_supplier' => $id,
            'id_supplier' => $this->request->getPost('supplier'),
            'jumlah' => $this->request->getPost('jumlah'),
            'harga_jual' => $this->request->getPost('harga_jual'),

        ];
        $StokBarangModel->update($id, $StokBarang);
        session()->setFlashData('pesan_edit', "Data  Barang Berhasil Diedit");
        return redirect()->to('StokBarang');
    }

    public function hapus($id)
    {
        $model = new StokBarangModel();
        $getStokBarang = $model->getStokBarang($id)->getRow();
        if (isset($getStokBarang)) {
            $model->delete($id);
            session()->setFlashData('pesan_hapus', "Data berhasil dihapus");
            return redirect()->to('/StokBarang');
        } else {
            session()->setFlashData('pesan_hapus', "Data gagal dihapus");
            return redirect()->to('/StokBarang');
        }
    }

    // laporan barang keluar
    public function laporan()
    {
        $model = new StokBarangModel;
        $model = new StokBarangModel;
        $keyword = $this->request->getVar('cari');
        if ($keyword) {
            $model->search($keyword);
        } else {
            $model->getStokBarang();
        }
        $StokBarang['laporan'] = $model->getStokBarang();
        $StokBarang['title'] = 'Laporan Barang Gudang';
        echo view('/stokBarang/LaporanStokBarang', $StokBarang);
    }
}
