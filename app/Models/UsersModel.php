<?php

namespace App\Models;

use CodeIgniter\Model;
use LDAP\Result;

class UsersModel extends Model
{
    protected $table            = 'users';
    // protected $primaryKey       = 'id';
    protected $useTimestamps    = true;
    // protected $useSoftDeletes   = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $allowedFields    = ['firstname', 'lastname', 'email', 'username', 'password_hash', 'active'];

    public function getUsers($id = false)
    {
        if ($id === false) {
            return $this->select('users.id, firstname, lastname, username, email, gu.group_id, g.name group_name')
                ->join('auth_groups_users gu', 'users.id = gu.user_id')
                ->join('auth_groups g', 'g.id = gu.group_id')
                ->findAll();
        } else {
            return $this->where(['id' => $id])->first();
        }
    }

    public function getGroups()
    {
        // return $this->findAll();
        $builder = $this->db->table('auth_groups');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
