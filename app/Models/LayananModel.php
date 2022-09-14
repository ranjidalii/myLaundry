<?php

namespace App\Models;

use CodeIgniter\Model;

class LayananModel extends Model
{
    protected $table            = 'tb_layanan';
    protected $primaryKey       = 'id_lyn';
    protected $useTimestamps    = true;
    protected $createdField     = 'create_at';
    protected $updatedField     = 'update_at';
    protected $allowedFields    = ['layanan', 'slug', 'harga', 'estimasi', 'st_esti'];

    public function getLayanan($slug = false)
    {
        if ($slug == false)
        {
            return $this->findAll();
        }
        return $this->where(['slug' => $slug])->first();
    }

}