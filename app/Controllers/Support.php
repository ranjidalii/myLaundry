<?php

namespace App\Controllers;

use App\Models\SupportModel;
use CodeIgniter\HTTP\Request;

class Support extends BaseController
{
    protected $supportModel;

    public function __construct()
    {
        $this->supportModel   = new SupportModel();

        date_default_timezone_set("Asia/Jakarta");
    }

    public function index()
    {

        $data = [
            'title'     => 'Kritik & Saran',
        ];

        // d($data['profil']);
        return view('support/sb_index', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required'
            ],
            'email' => [
                'rules' => 'required'
            ],
            'no_telp' => [
                'rules' => 'required'
            ],
            'feedback' => [
                'rules' => 'required'
            ]

        ])) {
            return redirect()->to('/support')->withInput();
        }

        // simpan ke database
        $this->supportModel->save([
            'nama'          => $this->request->getVar('nama'),
            'email'         => $this->request->getVar('email'),
            'no_telp'       => $this->request->getVar('no_telp'),
            'feedback'      => $this->request->getVar('feedback')
        ]);

        session()->setFlashdata('pesan', 'Terima kasih Kritik & Sarannya');

        if ($this->request->getMethod() == 'post') {
            $email_tujuan = $this->request->getVar('email');
            $no_telp = $this->request->getVar('no_telp');
            $nama = $this->request->getVar('nama');
            $isi = $this->request->getVar('feedback');

            $pesan = "Pengirim : " . $nama . " Kontak : " . $no_telp . " Pesan : " . $isi;

            $email = service('email');
            $email->setTo($email_tujuan);
            $email->setFrom('ranjid.alii@gmail.com', 'Kritik & Saran');

            $email->setSubject('Kritik & Saran');
            $email->setMessage($pesan);

            if ($email->send()) {
                session()->setFlashdata('pesan', 'Email Berhasil Terkirim');
            } else {
                $data = $email->printDebugger(['headers']);
                // print_r($data);
            }
        } else {
            return view('/support');
        }

        return redirect()->to('/support');
    }
}
