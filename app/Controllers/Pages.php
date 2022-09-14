<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home'
        ];

        if (logged_in()) {
            return view('pages/home', $data);
        } else {
            return redirect()->to(base_url('login'));
        }
    }

    public function dashboard()
    {
        $data = [
            'title' => 'Dasboard'
        ];

        echo view('pages/dashboard', $data);
    }

    public function pelanggan()
    {
        $data = [
            'title' => 'Pelanggan'
        ];

        echo view('pages/pelanggan', $data);
    }

    public function transaksi()
    {
        $data = [
            'title' => 'Transaksi'
        ];

        echo view('pages/transaksi', $data);
    }

    public function laporan()
    {
        $data = [
            'title' => 'Laporan'
        ];

        echo view('pages/laporan', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About',
            'name' => 'My Laundry'
        ];

        echo view('pages/about', $data);
    }
}
