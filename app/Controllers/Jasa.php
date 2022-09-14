<?php

namespace App\Controllers;

use App\Models\JasaModel;

class Jasa extends BaseController
{

    protected $jasaModel;
    public function __construct()
    {
        $this->jasaModel = new JasaModel();
        date_default_timezone_set("Asia/Jakarta");
    }

    public function index()
    {
        //$novel = $this->novelModel->findAll();
        $data = [
            'title' => 'Jasa',
            'jasa' => $this->jasaModel->getJasa()
        ];

        d($data['jasa']);

        // return view('jasa/index', $data);
        return view('jasa/sb_index', $data);
    }

    public function detail($slug)
    {

        $data = [
            'title' => 'Detail Jasa',
            'jasa' => $this->jasaModel->getLayanan($slug)
        ];

        // jika novel tidak ada di tabel
        if (empty($data['jasa'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Nama Jasa ' . $slug . ' Tidak ditemukan.');
        }

        // return view('jasa/detail', $data);
        return view('jasa/sb_detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Jasa',
            'validation' => \Config\Services::validation()
        ];

        return view('jasa/sb_create', $data);
        // return view('jasa/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'jasa' => [
                'rules' => 'required|is_unique[tb_jasa.jasa]',
                'errors' => [
                    'required' => '{field} Layanan harus diisi',
                    'is_unique' => '{field} Layanan sudah terdaftar'
                ]
            ],
            'harga' => [
                'rules' => 'required'
            ],
            'satuan' => [
                'rules' => 'required'
            ]

        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/novel/create')->withInput()->with('validation', $validation);
            return redirect()->to('/jasa/create')->withInput();
        }

        $slug = url_title($this->request->getVar('jasa'), '-', true);

        // simpan ke database
        $this->jasaModel->save([
            'jasa'      => $this->request->getVar('jasa'),
            'slug'      => $slug,
            'harga'    => $this->request->getVar('harga'),
            'satuan'   => $this->request->getVar('satuan')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('/jasa');
    }

    public function delete($id_jsa)
    {
        // cari gambar berdasarkan id
        $jasa = $this->jasaModel->find($id_jsa);

        // hapus data di database
        $this->jasaModel->delete($id_jsa);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/jasa');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Form Edit Jasa',
            'validation' => \Config\Services::validation(),
            'jasa' => $this->jasaModel->getJasa($slug)
        ];

        return view('jasa/sb_edit', $data);
        // return view('jasa/edit', $data);
    }

    public function update($id_jsa)
    {
        // cek layanan !
        $jasaLama = $this->jasaModel->getJasa($this->request->getVar('slug'));
        if ($jasaLama['jasa'] == $this->request->getVar('jasa')) {
            $rule_jasa = 'required';
        } else {
            $rule_jasa = 'required|is_unique[tb_jasa.jasa]';
        }


        if (!$this->validate([
            'jasa' => [
                'rules' => 'required'
            ],
            'harga' => [
                'rules' => 'required'
            ],
            'satuan' => [
                'rules' => 'required'
            ]
        ])) {
            return redirect()->to('/jasa/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $slug = url_title($this->request->getVar('jasa'), '-', true);

        // simpan ke database
        $this->jasaModel->save([
            'id_jsa'        => $id_jsa,
            'jasa'          => $this->request->getVar('jasa'),
            'slug'          => $slug,
            'harga'         => $this->request->getVar('harga'),
            'satuan'        => $this->request->getVar('satuan')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');

        return redirect()->to('/jasa');
    }
}
