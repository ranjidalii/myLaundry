<?php

namespace App\Models;

use CodeIgniter\Model;
use LDAP\Result;

class SettingModel extends Model
{
    protected $table            = 'tb_setting';
    protected $primaryKey       = 'id_sett';
    protected $useTimestamps    = true;
    protected $createdField     = 'create_at';
    protected $updatedField     = 'update_at';
    protected $allowedFields    = ['nama', 'slogan', 'alamat', 'no_telp'];

    public function adaData()
    {
        $db = db_connect();
        $query = $db->query('SELECT * FROM tb_setting');
        return $query->getNumRows();
    }

    public function getProfil()
    {
        // $builder = $this->db->table('tb_setting');
        // $builder->orderBy('id_Sett', 'DESC');
        // $builder->limit(1);
        // $query = $builder->get();
        // return $query->getResultArray();

        return $this->orderBy('id_Sett', 'DESC')->limit(1)->first();
    }
}
