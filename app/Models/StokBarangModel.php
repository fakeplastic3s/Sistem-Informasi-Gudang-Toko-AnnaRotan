<?php

namespace App\Models;

use CodeIgniter\Model;

class StokBarangModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'stok_gudang';
    protected $primaryKey       = 'id_stok';
    protected $allowedFields    = ['id_stok', 'id_supplier', 'jumlah', 'harga_jual'];


    public function getStokBarang($id = false)
    {
        if ($id === false) {
            return $this->join('supplier', 'supplier.id_supplier = stok_gudang.id_supplier')->groupBy('stok_gudang.id_stok')->orderBy('stok_gudang.id_stok', 'ASC')->get()->getResultArray();
        } else {
            return $this->getWhere(['id_stok' => $id]);
        }
    }

    public function search($keyword)
    {

        return $this->like('nama_supplier', $keyword)->orLike('nama_barang', $keyword);
    }

    public function laporan($tgl_awal, $tgl_akhir)
    {
        return $this->join('supplier', 'supplier.id_supplier = stok_gudang.id_supplier')->where('tgl_keluar >=', $tgl_awal)->where('tgl_keluar <=', $tgl_akhir)->groupBy('stok_gudang.id_stok')->orderBy('stok_gudang.id_stok', 'ASC')->get()->getResultArray();
    }

    public function sumStok()
    {
        return $this->table('stok_barang')
            ->selectSUM('jumlah')
            ->get()->getRow();
    }

    public function getStokByIdSupplier($id_supplier)
    {
        return $this->db->table('stok_gudang')
            ->join('supplier', 'supplier.id_supplier = stok_gudang.id_supplier')
            ->where('stok_gudang.id_supplier', $id_supplier)
            ->get()->getRow();
    }
}
