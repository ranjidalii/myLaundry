<?php

namespace App\Controllers;

use Myth\Auth\Models\UserModel;
use App\Models\UsersModel;
use Myth\Auth\Password;

class Profil extends BaseController
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
            'title' => 'Update Profil',
            'validation'    => \Config\Services::validation(),
            'profil' => $this->usersModel->getUsers(user_id())
        ];
        // d($data['profil']);
        return view('user/sb_update_profil', $data);
    }

    public function update_profil($id)
    {
        if (!$this->validate([
            'username' => [
                'rules' => 'required'
            ],
            'firstname' => [
                'rules' => 'required'
            ],
            'lastname' => [
                'rules' => 'required'
            ],
            'email' => [
                'rules' => 'required'
            ]

        ])) {
            return redirect()->to('/users/create')->withInput();
        }
        // $role = "$this->request->getVar('group')";
        // $role = $this->request->getVar('group');
        $this->usersModel->save([
            'id'             => $id,
            'firstname'      => $this->request->getVar('firstname'),
            'lastname'       => $this->request->getVar('lastname'),
            'username'       => $this->request->getVar('username'),
            'email'          => $this->request->getVar('email')
        ]);

        // d($savess);
        session()->setFlashdata('pesan', 'Data berhasil diubah');

        return redirect()->to('/profil');
    }

    public function change_password()
    {
        $data = [
            'title' => 'Ubah Password',
            'validation'    => \Config\Services::validation(),
            // 'profil' => $this->usersModel->getUsers(user_id())
        ];
        // d($data['profil']);
        return view('user/sb_edit_password', $data);
    }

    public function update_password($id)
    {
        if (!$this->validate([
            'password_lama' => [
                'rules' => 'required'
            ],
            'password_baru' => [
                'rules' => 'required'
            ],
            'konfirm_password' => [
                'rules' => 'required|matches[password_baru]'
            ]

        ])) {
            return redirect()->to('/password')->withInput();
        }

        $this->usersModel->save([
            'id'                    => $id,
            'password_hash'         => Password::hash($this->request->getVar('password_baru'))
        ]);

        // d($savess);
        session()->setFlashdata('pesan', 'Data berhasil diubah');

        return redirect()->to('/password');
    }
}
