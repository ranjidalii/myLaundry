<?php

namespace App\Controllers;

use App\Models\PelangganModel;
use App\Models\TransaksiModel;

class Home extends BaseController
{

    protected $pelangganModel;
    protected $transaksiModel;
    public function __construct()
    {
        $this->pelangganModel = new PelangganModel();
        $this->transaksiModel   = new TransaksiModel();
        date_default_timezone_set("Asia/Jakarta");
    }

    public function index()
    {
        $data = [
            'title'                     => 'Home',
            'tt_pelanggan'              => $this->pelangganModel->countPelanggan(),
            'tr_sukses'                 => $this->transaksiModel->transaksiSukses(),
            'tr_hari_ini'               => $this->transaksiModel->transaksiHariIni(),
            'pendapatan_hari_ini'       => $this->transaksiModel->pendapatanHariIni()
        ];

        if (logged_in()) {
            return view('home/index', $data);
            // return view('sblayout/template', $data);
        } else {
            return redirect()->to(base_url('login'));
        }
    }
}
