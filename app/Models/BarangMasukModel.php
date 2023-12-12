<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangMasukModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'barang_masuk';
    protected $primaryKey       = 'id_barang_masuk';
    protected $allowedFields    = ['id_barang_masuk', 'id_supplier', 'id_pengadaan', 'tgl_masuk', 'jumlah_masuk'];

    public function getBarangMasuk($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_barang_masuk' => $id]);
        }
    }

    public function getBarangMasukJoin($id = false)
    {
        return $this->table('barang_masuk')
            ->join('pengadaan', 'pengadaan.id_pengadaan = barang_masuk.id_pengadaan')
            ->join('supplier', 'supplier.id_supplier = barang_masuk.id_supplier')
            ->groupBy('barang_masuk.id_barang_masuk')
            ->orderBy('barang_masuk.tgl_masuk', 'ASC')
            ->get()->getResultArray();
    }

    public function sumBM()
    {
        return $this->table('barang_masuk')
            ->join('pengadaan', 'pengadaan.id_pengadaan = barang_masuk.id_pengadaan')
            ->join('supplier', 'supplier.id_supplier = barang_masuk.id_supplier')
            ->selectSUM('pengadaan.jumlah')
            ->where('pengadaan.status_pengadaan', 'Disetujui')
            ->where('pengadaan.status_pemesanan', 'Terkirim')
            ->get()->getRow();
    }

    public function getPengadaanJoinDisetujui()
    {
        return $this->db->table('pengadaan')
            ->join('supplier', 'supplier.id_supplier = pengadaan.id_supplier')
            ->where('pengadaan.status_pengadaan', 'Disetujui')
            ->where('pengadaan.status_pemesanan', 'Diproses')
            ->get()->getResultArray();
    }

    public function getSupplierPengadaan()
    {
        return $this->db->table('pengadaan')
            ->join('supplier', 'supplier.id_supplier = pengadaan.id_supplier')
            ->where('pengadaan.status_pengadaan', 'Disetujui')
            ->where('pengadaan.status_pemesanan', 'Diproses')
            ->get()->getResultArray();
    }
    public function dateMin()
    {
        return $this->table('barang_masuk')
            ->selectMIN('tgl_masuk')
            ->get()->getRow();
    }
    public function dateMax()
    {
        return $this->table('barang_masuk')
            ->selectMAX('tgl_masuk')
            ->get()->getRow();
    }

    public function hapusBarangMasuk($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_barang_masuk' => $id]);
    }

    public function search($keyword)
    {
        // $builder = $this->table('tiket');
        // $builder->like('nama', $keyword);
        // return $builder;

        return $this->table('BarangMasuk')->like('nama_barang', $keyword)->orLike('tanggal_masuk', $keyword);
    }
    public function laporan($tgl_awal, $tgl_akhir)
    {
        return $this->join('pengadaan', 'pengadaan.id_pengadaan = barang_masuk.id_pengadaan')
            ->join('supplier', 'supplier.id_supplier = barang_masuk.id_supplier')
            ->where('tgl_masuk >=', $tgl_awal)->where('tgl_masuk <=', $tgl_akhir)
            ->groupBy('barang_masuk.id_barang_masuk')
            ->orderBy('barang_masuk.tgl_masuk', 'ASC')
            ->get()->getResultArray();
    }
}
