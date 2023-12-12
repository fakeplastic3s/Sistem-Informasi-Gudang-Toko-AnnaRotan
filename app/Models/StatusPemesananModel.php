<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusPemesananModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'status_pemesanan';
    protected $primaryKey       = 'id_pengadaan';
    protected $allowedFields    = ['id_status_pemesanan', 'id_supplier', 'id_pengadaan', 'jumlah', 'status_pengadaan'];


    public function getPengadaan($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_pengadaan' => $id]);
        }
    }


    public function getPengadaanJoin($id = false)
    {
        return $this->table('pengadaan')
            ->join('supplier', 'supplier.id_supplier = pengadaan.id_supplier')
            ->groupBy('pengadaan.id_pengadaan')
            ->orderBy('pengadaan.id_pengadaan', 'ASC')
            ->get()->getResultArray();
    }
    public function getPengadaanJoin2($id = false)
    {
        return $this->table('pengadaan')
            ->join('supplier', 'supplier.id_supplier = pengadaan.id_supplier')
            ->groupBy('pengadaan.id_pengadaan')
            ->orderBy('pengadaan.id_pengadaan', 'ASC')
            ->get();
    }

    public function getPengadaanJoinDiajukan($id = false)
    {
        return $this->table('pengadaan_bahan')
            ->join('supplier', 'supplier.id_supplier = pengadaan_bahan.id_supplier')
            ->groupBy('pengadaan_bahan.id_pengadaan')
            ->orderBy('pengadaan_bahan.id_pengadaan', 'ASC')
            ->where('pengadaan_bahan.status_pengadaan', 'Diajukan')
            ->get()->getResultArray();
    }
    public function getPengadaanJoinDisetujui($id = false)
    {
        return $this->table('pengadaan_bahan')
            ->join('supplier', 'supplier.id_supplier = pengadaan_bahan.id_supplier')
            ->groupBy('pengadaan_bahan.id_pengadaan')
            ->orderBy('pengadaan_bahan.id_pengadaan', 'ASC')
            ->where('pengadaan_bahan.status_pengadaan', 'Disetujui')
            ->get()->getResultArray();
    }
    public function getPengadaanJoinDitolak($id = false)
    {
        return $this->table('pengadaan_bahan')
            ->join('supplier', 'supplier.id_supplier = pengadaan_bahan.id_supplier')
            ->groupBy('pengadaan_bahan.id_pengadaan')
            ->orderBy('pengadaan_bahan.id_pengadaan', 'ASC')
            ->where('pengadaan_bahan.status_pengadaan', 'Ditolak')
            ->get()->getResultArray();
    }


    public function hapusPengadaan($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_pengadaan' => $id]);
    }

    public function search($keyword)
    {
        // $builder = $this->table('tiket');
        // $builder->like('nama', $keyword);
        // return $builder;

        return $this->table('Pengadaan')->like('nama_supplier', $keyword)->orLike('nama_barang', $keyword)->orLike('status_pengadaan', $keyword);
    }
}
