<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangKeluarModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'barang_keluar';
    protected $primaryKey       = 'id_barang_keluar';
    protected $allowedFields    = ['id_barang_keluar', 'id_supplier', 'tgl_keluar', 'jumlah'];


    public function getBarangKeluar($id = false)
    {
        if ($id === false) {
            return $this->join('supplier', 'supplier.id_supplier = barang_keluar.id_supplier')->groupBy('barang_keluar.id_barang_keluar')->orderBy('barang_keluar.tgl_keluar', 'ASC')->get()->getResultArray();
        } else {
            return $this->getWhere(['id_barang_keluar' => $id]);
        }
    }



    public function search($keyword)
    {

        return $this->like('nama_supplier', $keyword)->orLike('nama_barang', $keyword);
    }

    public function laporan($tgl_awal, $tgl_akhir)
    {
        return $this->join('supplier', 'supplier.id_supplier = barang_keluar.id_supplier')
            ->where('tgl_keluar >=', $tgl_awal)->where('tgl_keluar <=', $tgl_akhir)
            ->groupBy('barang_keluar.id_barang_keluar')
            ->orderBy('barang_keluar.id_barang_keluar', 'ASC')
            ->get()->getResultArray();
    }

    public function sumPenjualan()
    {
        return $this->table('barang_keluar')
            ->join('supplier', 'supplier.id_supplier = barang_keluar.id_supplier')
            ->join('stok_gudang', 'stok_gudang.id_supplier = barang_keluar.id_supplier')
            ->select('SUM(barang_keluar.jumlah * stok_gudang.harga_jual) AS total')
            ->get()->getRow();
    }

    public function sumBK()
    {
        return $this->table('barang_keluar')
            ->selectSUM('jumlah')
            ->get()->getRow();
    }

    public function dateMin()
    {
        return $this->table('barang_keluar')
            ->selectMIN('tgl_keluar')
            ->get()->getRow();
    }
    public function dateMax()
    {
        return $this->table('barang_keluar')
            ->selectMAX('tgl_keluar')
            ->get()->getRow();
    }
}
