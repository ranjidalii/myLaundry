<?php

namespace App\Models;

use CodeIgniter\Model;
use LDAP\Result;

class PelangganModel extends Model
{
    protected $table            = 'tb_pelanggan';
    protected $primaryKey       = 'id_plg';
    protected $useTimestamps    = true;
    protected $createdField     = 'create_at';
    protected $updatedField     = 'update_at';
    protected $allowedFields    = ['nama', 'slug', 'alamat', 'no_telp', 'jenkel', 'tgl_lahir'];

    public function getPelanggan($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }
        return $this->where(['slug' => $slug])->first();
    }

    public function getData()
    {
        // $builder = $this->db->table('tb_pelanggan');
        // $builder = $this->builder();
        // $builder->orderBy('nama', 'ASC');
        // $query = $builder->get();
        // return $query->getResultArray();
        return $this->orderBy('nama', 'ASC')->findAll();
    }

    public function cariNama($nama)
    {
        $builder = $this->db->table('tb_pelanggan');
        $builder->like('nama', $nama);
        $builder->orderBy('nama', 'ASC');
        $builder->limit(5);
        $query = $builder->get();
        return $query->getResult();
    }

    public function countPelanggan(){
        $db = db_connect();
        $query = $db->query('SELECT * FROM tb_pelanggan');
        return $query->getNumRows();
    }
}
