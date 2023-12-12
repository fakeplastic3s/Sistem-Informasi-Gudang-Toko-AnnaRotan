<?php

namespace App\Models;

use CodeIgniter\Model;

class PengadaanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pengadaan';
    protected $primaryKey       = 'id_pengadaan';
    protected $allowedFields    = ['id_pengadaan', 'id_supplier', 'tanggal_pengadaan', 'jumlah', 'status_pengadaan', 'status_pemesanan'];


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

    public function laporan($tgl_awal, $tgl_akhir)
    {
        return $this->join('supplier', 'supplier.id_supplier = pengadaan.id_supplier')
            ->where('tanggal_pengadaan >=', $tgl_awal)
            ->where('tanggal_pengadaan <=', $tgl_akhir)
            ->groupBy('pengadaan.id_pengadaan')
            ->orderBy('pengadaan.id_pengadaan', 'ASC')
            ->get()->getResultArray();
    }
}
