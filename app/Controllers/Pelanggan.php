<?php

namespace App\Controllers;

use App\Models\PelangganModel;

class Pelanggan extends BaseController
{

    protected $pelangganModel;
    public function __construct()
    {
        $this->pelangganModel = new PelangganModel();
        date_default_timezone_set("Asia/Jakarta");
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_tb_pelanggan') ? $this->request->getVar('page_tb_pelanggan') : 1;

        //$novel = $this->novelModel->findAll();
        $data = [
            'title'          => 'Daftar Pelanggan',
            'pelanggan'      => $this->pelangganModel->orderBy('nama', 'ASC')->paginate(6, 'tb_pelanggan'),
            'pager'          => $this->pelangganModel->pager,
            'currentPage'    => $currentPage,
            'tt_pelanggan'   => $this->pelangganModel->countPelanggan()
        ];

        // d($data['tt_pelanggan']);
        return view('pelanggan/sb_index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Detail Pelanggan',
            'pelanggan' => $this->pelangganModel->getPelanggan($slug)
        ];

        // jika novel tidak ada di tabel
        if (empty($data['pelanggan'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Nama Pelanggan ' . $slug . ' Tidak ditemukan.');
        }
        // return view('pelanggan/detail', $data);
        return view('pelanggan/sb_detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Pelanggan',
            'validation' => \Config\Services::validation()
        ];

        return view('pelanggan/sb_create', $data);
        // return view('pelanggan/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|is_unique[tb_pelanggan.nama]',
                'errors' => [
                    'required' => '{field} nama harus diisi',
                    'is_unique' => '{field} nama sudah terdaftar'
                ]
            ],
            'alamat' => [
                'rules' => 'required'
            ],
            'no_telp' => [
                'rules' => 'required'
            ],
            'jenkel' => [
                'rules' => 'required'
            ],
            'tgl_lahir' => [
                'rules' => 'required'
            ]

        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/novel/create')->withInput()->with('validation', $validation);
            return redirect()->to('/pelanggan/create')->withInput();
        }

        $slug = url_title($this->request->getVar('nama'), '-', true);

        // simpan ke database
        $tgl_lahir = $this->request->getVar('tgl_lahir');
        $this->pelangganModel->save([
            'nama'      => $this->request->getVar('nama'),
            'slug'      => $slug,
            'alamat'    => $this->request->getVar('alamat'),
            'no_telp'   => $this->request->getVar('no_telp'),
            'jenkel'    => $this->request->getVar('jenkel'),
            'tgl_lahir' => date("Y-m-d", strtotime($tgl_lahir))
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('/pelanggan');
    }

    public function delete($id_plg)
    {
        // cari gambar berdasarkan id
        $pelanggan = $this->pelangganModel->find($id_plg);

        // hapus data di database
        $this->pelangganModel->delete($id_plg);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/pelanggan');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Form Edit Pelanggan',
            'validation' => \Config\Services::validation(),
            'pelanggan' => $this->pelangganModel->getPelanggan($slug)
        ];
        // d($data['pelanggan']);
        // return view('pelanggan/edit', $data);
        return view('pelanggan/sb_edit', $data);
    }

    public function update($id_plg)
    {
        // cek nama !
        $pelangganLama = $this->pelangganModel->getPelanggan($this->request->getVar('slug'));
        if ($pelangganLama['nama'] == $this->request->getVar('nama')) {
            $rule_nama = 'required';
        } else {
            $rule_nama = 'required|is_unique[tb_pelanggan.nama]';
        }

        if (!$this->validate([
            'nama' => [
                'rules' => $rule_nama,
                'errors' => [
                    'required' => '{field} nama harus diisi',
                    'is_unique' => '{field} nama sudah terdaftar'
                ]
            ],
            'alamat' => [
                'rules' => 'required'
            ],
            'no_telp' => [
                'rules' => 'required'
            ],
            'jenkel' => [
                'rules' => 'required'
            ],
            'tgl_lahir' => [
                'rules' => 'required'
            ]
        ])) {
            return redirect()->to('/pelanggan/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $slug = url_title($this->request->getVar('nama'), '-', true);

        // dd($slug);

        // simpan ke database
        $tgl_lahir = $this->request->getVar('tgl_lahir');
        $this->pelangganModel->save([
            'id_plg'    => $id_plg,
            'nama'      => $this->request->getVar('nama'),
            'slug'      => $slug,
            'alamat'    => $this->request->getVar('alamat'),
            'no_telp'   => $this->request->getVar('no_telp'),
            'jenkel'    => $this->request->getVar('jenkel'),
            'tgl_lahir' => date("Y-m-d", strtotime($tgl_lahir))
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');

        return redirect()->to('/pelanggan');
    }
}
