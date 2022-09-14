<?php

namespace App\Models;

use CodeIgniter\Model;

class JasaModel extends Model
{
    protected $table            = 'tb_jasa';
    protected $primaryKey       = 'id_jsa';
    protected $useTimestamps    = true;
    protected $createdField     = 'create_at';
    protected $updatedField     = 'update_at';
    protected $allowedFields    = ['jasa', 'slug', 'harga', 'satuan'];

    public function getJasa($slug = false)
    {
        if ($slug == false)
        {
            return $this->findAll();
        }
        return $this->where(['slug' => $slug])->first();
    }
}