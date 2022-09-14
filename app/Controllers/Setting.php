<?php

namespace App\Controllers;

use App\Models\SettingModel;
use CodeIgniter\HTTP\Request;

class Setting extends BaseController
{
    protected $settingModel;

    public function __construct()
    {
        $this->settingModel   = new SettingModel();

        date_default_timezone_set("Asia/Jakarta");
    }

    public function index()
    {

        $cekProfil = $this->settingModel->adaData();


        if ($cekProfil > 0) {
            $data = [
                'title'     => 'Setting',
                'adaData'   => $this->settingModel->adaData(),
                'profil'    => $this->settingModel->getProfil(),
            ];
        } else {
            $data = [
                'title'     => 'Setting',
                'adaData'   => $this->settingModel->adaData(),
                'profil'     => null
            ];
        }

        // d($data['profil']);
        return view('setting/sb_index', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required'
            ],
            'slogan' => [
                'rules' => 'required'
            ],
            'alamat' => [
                'rules' => 'required'
            ],
            'no_telp' => [
                'rules' => 'required'
            ]

        ])) {
            return redirect()->to('/setting')->withInput();
        }

        // simpan ke database
        $this->settingModel->save([
            'nama'           => $this->request->getVar('nama'),
            'slogan'         => $this->request->getVar('slogan'),
            'alamat'         => $this->request->getVar('alamat'),
            'no_telp'        => $this->request->getVar('no_telp')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('/setting');
    }

    public function update($id_sett)
    {

        if (!$this->validate([
            'nama' => [
                'rules' => 'required'
            ],
            'slogan' => [
                'rules' => 'required'
            ],
            'alamat' => [
                'rules' => 'required'
            ],
            'no_telp' => [
                'rules' => 'required'
            ]
        ])) {
            return redirect()->to('/setting')->withInput();
        }

        // simpan ke database
        $this->settingModel->save([
            'id_sett'        => $id_sett,
            'nama'          => $this->request->getVar('nama'),
            'slogan'        => $this->request->getVar('slogan'),
            'alamat'        => $this->request->getVar('alamat'),
            'no_telp'       => $this->request->getVar('no_telp')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');

        return redirect()->to('/setting');
    }
}
