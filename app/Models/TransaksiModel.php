<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table            = 'tb_transaksi';
    protected $primaryKey       = 'id_tr';
    protected $useTimestamps    = true;
    protected $createdField     = 'create_at';
    protected $updatedField     = 'update_at';
    protected $allowedFields    = ['kode_tr', 'pelanggan', 'kontak_plg', 'alamat_plg', 'layanan', 'jasa', 'qty', 'hrg_jsa', 'hrg_lyn', 'estimasi', 'tgl_masuk', 'tgl_selesai', 'jam_masuk', 'jam_selesai', 'total', 'pembayaran', 'status', 'create_by', 'update_by'];

    public function getTransaksi($slug = false)
    {
        if ($slug == false) {
            // return $this->findAll();
            $builder = $this->db->table('tb_transaksi');
            $builder->orderBy('id_tr', 'DESC');
            $query = $builder->get();
            return $query->getResultArray();
        }
        return $this->where(['kode_tr' => $slug])->first();
    }

    public function genKodeTr($tglMulai)
    {
        $builder = $this->db->table('tb_transaksi');
        $builder->like('create_at', $tglMulai);
        $builder->orderBy('kode_tr', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        return $query->getResult();
    }

    public function cariTransaksi($no_tr)
    {
        // $builder = $this->db->table('tb_transaksi');
        // $builder->where(['kode_tr' => $no_tr]);
        // $query = $builder->get();
        // return $query->getResultArray();
        return $this->where(['kode_tr' => $no_tr])->first();
    }

    public function getTransaksiById($id_tr)
    {
        return $this->where(['id_tr' => $id_tr])->first();
    }

    public function transaksiSukses()
    {
        $db = db_connect();
        $query = $db->query('SELECT * FROM tb_transaksi WHERE status = "4"');
        return $query->getNumRows();
    }

    public function transaksiHariIni()
    {
        $today = date("Y-m-d");
        $db = db_connect();
        // $query = $db->query('SELECT * FROM tb_transaksi LIKE create_at = %."$today".%');
        $query = $db->query('SELECT * FROM tb_transaksi WHERE create_at LIKE "' . $today . ' %"');
        return $query->getNumRows();
    }

    public function pendapatanHariIni()
    {
        $today = date("Y-m-d");
        // // dd($today);
        // $today = "2022-08-18";
        $db = db_connect();
        // $query = $db->query('SELECT * FROM tb_transaksi LIKE create_at = %."$today".%');
        $query = $db->query('SELECT SUM(total) AS total_pdp FROM tb_transaksi WHERE create_at LIKE "' . $today . ' %"');
        return $query->getRowArray();
    }

    public function getTransaksiSukses()
    {
        $builder = $this->db->table('tb_transaksi');
        $builder->where('status', '4');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function jmlSemuaTransaksi()
    {
        $db = db_connect();
        $query = $db->query('SELECT * FROM tb_transaksi');
        return $query->getNumRows();
    }

    public function jmlTransaksiOpen()
    {
        $db = db_connect();
        $query = $db->query('SELECT * FROM tb_transaksi WHERE status = "1"');
        return $query->getNumRows();
    }

    public function jmlTransaksiProcess()
    {
        $db = db_connect();
        $query = $db->query('SELECT * FROM tb_transaksi WHERE status = "2"');
        return $query->getNumRows();
    }

    public function jmlTransaksiWaiting()
    {
        $db = db_connect();
        $query = $db->query('SELECT * FROM tb_transaksi WHERE status = "3"');
        return $query->getNumRows();
    }

    public function jmlTransaksiSukses()
    {
        $db = db_connect();
        $query = $db->query('SELECT * FROM tb_transaksi WHERE status = "4"');
        return $query->getNumRows();
    }
}
