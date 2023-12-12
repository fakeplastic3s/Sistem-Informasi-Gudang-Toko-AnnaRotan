<?php

namespace App\Controllers;

use App\Models\UserModel;

use App\Controllers\BaseController;
use App\Models\BarangKeluarModel;
use App\Models\BarangMasukModel;
use App\Models\StokBarangModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $session = session();
        $barangmasuk = new BarangMasukModel();
        $barangkeluar = new BarangKeluarModel();
        $stokbarang = new StokBarangModel();
        $data = [
            'title' => 'Dashboard',
            'date' => date('l, j F Y'),
            'barangmasuk' => $barangmasuk->sumBM(),
            'barangkeluar' => $barangkeluar->sumBK(),
            'stokbarang' => $stokbarang->sumStok(),
            'tanggal_min' => $barangmasuk->dateMin(),
            'tanggal_max' => $barangmasuk->dateMax(),
            'tanggal_bk_min' => $barangkeluar->dateMin(),
            'tanggal_bk_max' => $barangkeluar->dateMax(),
            'penjualan' => $barangkeluar->sumPenjualan(),
        ];
        // dd($barangkeluar->sumPenjualan());
        echo view('/dashboard/index', $data);
    }
    public function gudang()
    {
        $session = session();
        $barangmasuk = new BarangMasukModel();
        $barangkeluar = new BarangKeluarModel();
        $stokbarang = new StokBarangModel();
        $data = [
            'title' => 'Dashboard',
            'date' => date('l, j F Y'),
            'barangmasuk' => $barangmasuk->sumBM(),
            'barangkeluar' => $barangkeluar->sumBK(),
            'stokbarang' => $stokbarang->sumStok(),
            'getStokBarang' => $stokbarang->getStokBarang(),
            'tanggal_min' => $barangmasuk->dateMin(),
            'tanggal_max' => $barangmasuk->dateMax(),
            'tanggal_bk_min' => $barangkeluar->dateMin(),
            'tanggal_bk_max' => $barangkeluar->dateMax(),
            'penjualan' => $barangkeluar->sumPenjualan(),
        ];
        // dd($barangkeluar->sumPenjualan());

        $getStokBarang = $stokbarang->getStokBarang();
        // Notifikasi jika stok bahan mentah kurang dari 5
        // dd($getStokBarang);
        foreach ($getStokBarang as $isi) {
            // dd($isi['nama_barang']);
            if ($isi['jumlah'] <= 5) {
                if ($isi['jumlah'] == 0) {
                    session()->setFlashData('pesan_habis' . $isi['nama_barang'], $isi['nama_barang']);
                } else {
                    session()->setFlashData('pesan_hampir_habis' . $isi['nama_barang'], $isi['nama_barang']);
                }
            }
        }
        echo view('dashboard/dashboardGudang', $data);
    }

    public function profil($user_id)
    {
        $model = new UserModel();
        $data = [
            'title' => 'Profil',
            'profil' => $model->getdata($user_id)->getRow()

        ];
        // dd($data);
        return view('pages/detailProfilView', $data);
    }
}
