<?php

namespace App\Controllers;




use App\Controllers\BaseController;
use App\Models\SupplierModel;
use App\Models\PengadaanModel;
use App\Models\StatusPemesananModel;
use Config\Validation;

class Pengadaan extends BaseController
{
    public function index()
    {
        $model = new StatusPemesananModel;
        $keyword = $this->request->getVar('cari');
        if ($keyword) {
            $model->search($keyword);
        } else {
            $model->getPengadaanJoin();
        }
        $pengadaan['getPengadaan'] = $model->getPengadaanJoin();
        $pengadaan['title'] = 'Data Pengadaan';
        echo view('/pengadaan/pengadaanView', $pengadaan);
    }

    public function tambah()
    {
        session();
        $supplierModel = new SupplierModel();
        $pengadaan['supplier'] = $supplierModel->getSupplier();
        $pengadaan['validation'] = \Config\Services::validation();
        $pengadaan['title'] = 'Tambah Data Pengadaan';
        return  view('/pengadaan/tambahView', $pengadaan);
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
            return redirect()->to('/Pengadaan/tambah')->withInput()->with('validation', $validation);
        }
        $PengadaanModel = new PengadaanModel();
        $pengadaan = [
            'title' => 'Tambah Pengadaan Barang',
            // 'id' => $this->request->getVar('id'),
            'id_supplier' => $this->request->getVar('supplier'),
            'tanggal_pengadaan' => $this->request->getVar('tanggal'),
            'jumlah' => $this->request->getVar('jumlah'),
            'status_pengadaan' => $this->request->getVar('status')
        ];
        $PengadaanModel->save($pengadaan);
        session()->setFlashData('pesan_tambah', "Data Pengadaan Barang Berhasil Ditambah");
        return redirect()->to('Pengadaan');
    }
    // edit
    public function edit($id)
    {
        session();
        $SupplierModel = new SupplierModel;
        $model = new PengadaanModel();
        $getPengadaan = $model->getPengadaan($id)->getRow();

        if (isset($getPengadaan)) {
            $pengadaan = [
                'validation' => \Config\Services::validation(),
                'title' => 'Edit Data Pengadaan Barang ' . $getPengadaan->id_pengadaan,
            ];
            $pengadaan['supplier'] = $SupplierModel->getSupplier();
            $pengadaan['pengadaan'] = $getPengadaan;
            return view('/pengadaan/editView', $pengadaan);
        } else {
            session()->setFlashData('pesan_edit', 'Id Pengadaaan Barang tidak ditemukan');
            return redirect()->to('/Pengadaan');
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
            return redirect()->to('/Pengadaan/edit/' . $this->request->getVar('id'))->withInput()->with('validation', $validation);
        }
        $PengadaanModel = new PengadaanModel();
        $pengadaan = [
            'id_supplier' => $id,
            'id_supplier' => $this->request->getPost('supplier'),
            'tanggal_pengadaan' => $this->request->getPost('tanggal'),
            'jumlah' => $this->request->getPost('jumlah'),
        ];
        // dd($pengadaan);
        $PengadaanModel->update($id, $pengadaan);
        session()->setFlashData('pesan_edit', "Data Pengadaan Barang Berhasil Diedit");
        return redirect()->to('Pengadaan');
    }

    // Hapus
    public function hapus($id)
    {
        $model = new PengadaanModel();
        $getPengadaan = $model->getPengadaan($id)->getRow();
        if (isset($getPengadaan)) {
            $model->hapusPengadaan($id);
            session()->setFlashData('pesan_hapus', "Data berhasil dihapus");
            return redirect()->to('/Pengadaan');
        } else {
            session()->setFlashData('pesan_hapus', "Data gagal dihapus");
            return redirect()->to('/Pengadaan');
        }
    }
}
