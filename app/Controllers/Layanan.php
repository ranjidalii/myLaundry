<?php

namespace App\Controllers;

use App\Models\LayananModel;
use Config\Services;

use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\CapabilityProfile;
use Mike42\Escpos\Printer;

class Layanan extends BaseController
{

    protected $layananModel;
    public function __construct()
    {
        $this->layananModel = new LayananModel();
        date_default_timezone_set("Asia/Jakarta");
    }

    public function index()
    {
        //$novel = $this->novelModel->findAll();
        $data = [
            'title' => 'Daftar Layanan',
            'layanan' => $this->layananModel->getLayanan()
        ];

        return view('layanan/sb_index', $data);
        // return view('layanan/index', $data);
    }

    public function detail($slug)
    {

        $data = [
            'title' => 'Detail Layanan',
            'layanan' => $this->layananModel->getLayanan($slug)
        ];

        // jika novel tidak ada di tabel
        if (empty($data['layanan'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Nama Layanan ' . $slug . ' Tidak ditemukan.');
        }

        return view('layanan/detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Layanan',
            'validation' => \Config\Services::validation()
        ];

        return view('layanan/sb_create', $data);
        // return view('layanan/create', $data);
    }

    public function save()
    {

        if (!$this->validate([
            'layanan' => [
                'rules' => 'required|is_unique[tb_layanan.layanan]',
                'errors' => [
                    'required' => '{field} Layanan harus diisi',
                    'is_unique' => '{field} Layanan sudah terdaftar'
                ]
            ],
            'harga' => [
                'rules' => 'required'
            ],
            'estimasi' => [
                'rules' => 'required'
            ],
            'st_esti' => [
                'rules' => 'required'
            ]

        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/novel/create')->withInput()->with('validation', $validation);
            return redirect()->to('/layanan/create')->withInput();
        }

        $slug = url_title($this->request->getVar('layanan'), '-', true);

        // simpan ke database
        $this->layananModel->save([
            'layanan'       => $this->request->getVar('layanan'),
            'slug'          => $slug,
            'harga'         => $this->request->getVar('harga'),
            'estimasi'      => $this->request->getVar('estimasi'),
            'st_esti'       => $this->request->getVar('st_esti')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('/layanan');
    }

    public function delete($id_lyn)
    {
        // cari gambar berdasarkan id
        $layanan = $this->layananModel->find($id_lyn);

        // hapus data di database
        $this->layananModel->delete($id_lyn);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/layanan');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Form Edit Layanan',
            'validation' => \Config\Services::validation(),
            'layanan' => $this->layananModel->getLayanan($slug)
        ];

        return view('layanan/sb_edit', $data);
        // return view('layanan/edit', $data);
    }

    public function update($id_lyn)
    {
        // cek layanan !
        $layananLama = $this->layananModel->getLayanan($this->request->getVar('slug'));
        if ($layananLama['layanan'] == $this->request->getVar('layanan')) {
            $rule_layanan = 'required';
        } else {
            $rule_layanan = 'required|is_unique[tb_layanan.layanan]';
        }

        if (!$this->validate([
            'layanan' => [
                'rules' => 'required'
            ],
            'harga' => [
                'rules' => 'required'
            ],
            'estimasi' => [
                'rules' => 'required'
            ],
            'st_esti' => [
                'rules' => 'required'
            ]
        ])) {
            return redirect()->to('/layanan/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $slug = url_title($this->request->getVar('layanan'), '-', true);

        // simpan ke database
        $this->layananModel->save([
            'id_lyn'        => $id_lyn,
            'layanan'       => $this->request->getVar('layanan'),
            'slug'          => $slug,
            'harga'         => $this->request->getVar('harga'),
            'estimasi'      => $this->request->getVar('estimasi'),
            'st_esti'       => $this->request->getVar('st_esti')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');

        return redirect()->to('/layanan');
    }

    public function cetakStruk()
    {
        $profile = CapabilityProfile::load("simple");
        $connector = new WindowsPrintConnector("EPSON-L3150-Series");
        $printer = new Printer($connector, $profile);

        $printer->text('Hello World');
        $printer->feed(4);
        // $printer->cut();
        $printer->close();
    }
}
