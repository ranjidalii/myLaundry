<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Myth\Auth\Models\UserModel;
use App\Models\UsersModel;
use Myth\Auth\Password;

class Users extends BaseController
{
    protected $usersModel;
    protected $userModelMyth;
    public function __construct()
    {
        $this->usersModel       = new UsersModel();
        $this->userModelMyth    = new UserModel();
    }

    public function index()
    {
        $data = [
            'title'     => 'Data User',
            'users'     => $this->usersModel->getUsers()
        ];

        return view('user/sb_index', $data);
        // return view('user/index', $data);
    }

    public function create()
    {
        $data = [
            'title'     => 'Tambah User',
            'validation'    => \Config\Services::validation(),
            'groups'    => $this->usersModel->getGroups()
        ];

        // d($data['groups']);
        return view('user/sb_create', $data);
        // return view('user/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'username' => [
                'rules' => 'required|is_unique[users.username]',
                'errors' => [
                    'required' => '{field} Username harus diisi',
                    'is_unique' => '{field} Username sudah terdaftar'
                ]
            ],
            'firstname' => [
                'rules' => 'required'
            ],
            'lastname' => [
                'rules' => 'required'
            ],
            'email' => [
                'rules' => 'required'
            ],
            'group' => [
                'rules' => 'required'
            ]

        ])) {
            return redirect()->to('/users/create')->withInput();
        }
        // $role = "$this->request->getVar('group')";
        $role = $this->request->getVar('group');
        $this->userModelMyth->withGroup($role)->save([
            'firstname'      => $this->request->getVar('firstname'),
            'lastname'       => $this->request->getVar('lastname'),
            'username'       => $this->request->getVar('username'),
            'email'          => $this->request->getVar('email'),
            'password_hash'  => Password::hash("123456"),
            'active'         => 1
        ]);

        // d($savess);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('/users');
    }

    public function delete($id)
    {
        // cari gambar berdasarkan id
        $pelanggan = $this->userModelMyth->find($id);

        // hapus data di database
        $this->usersModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/users');
    }

    public function reset_password($id)
    {
        $this->usersModel->save([
            'id'                => $id,
            'password_hash'     => Password::hash("123456")
        ]);

        session()->setFlashdata('pesan', 'Reset Password Berhasil');
        return redirect()->to('/users');
    }
}
