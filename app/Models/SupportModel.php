<?php

namespace App\Models;

use CodeIgniter\Model;
use LDAP\Result;

class SupportModel extends Model
{
    protected $table            = 'tb_support';
    protected $primaryKey       = 'id_supp';
    protected $useTimestamps    = true;
    protected $createdField     = 'create_at';
    protected $updatedField     = 'update_at';
    protected $allowedFields    = ['nama', 'email', 'no_telp', 'feedback'];
}
