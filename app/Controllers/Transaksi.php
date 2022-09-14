<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\LayananModel;
use App\Models\JasaModel;
use App\Models\PelangganModel;
use CodeIgniter\HTTP\Request;

class Transaksi extends BaseController
{
    protected $transaksiModel;
    protected $layananModel;
    protected $jasaModel;
    protected $pelangganModel;

    public function __construct()
    {
        $this->transaksiModel   = new TransaksiModel();
        $this->layananModel     = new LayananModel();
        $this->jasaModel        = new JasaModel();
        $this->pelangganModel   = new PelangganModel();
        date_default_timezone_set("Asia/Jakarta");
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_tb_transaksi') ? $this->request->getVar('page_tb_transaksi') : 1;
        $data = [
            'title'                 => 'Transaksi',
            'transaksi'             => $this->transaksiModel->orderBy('status', 'ASC')->paginate(10, 'tb_transaksi'),
            'pager'                 => $this->transaksiModel->pager,
            'currentPage'           => $currentPage,
            'jmlSemuaTransaksi'     => $this->transaksiModel->jmlSemuaTransaksi(),
            'jmlTransaksiOpen'      => $this->transaksiModel->jmlTransaksiOpen(),
            'jmlTransaksiProcess'   => $this->transaksiModel->jmlTransaksiProcess(),
            'jmlTransaksiWaiting'   => $this->transaksiModel->jmlTransaksiWaiting(),
            'jmlTransaksiSukses'    => $this->transaksiModel->jmlTransaksiSukses()
        ];
        return view('transaksi/sb_index', $data);
        // return view('transaksi/index', $data);
    }

    public function create()
    {
        $data = [
            'title'         => 'Transaksi baru',
            'validation'    => \Config\Services::validation(),
            'layanan'       => $this->layananModel->getLayanan(),
            'jasa'          => $this->jasaModel->getJasa(),
            'pelanggan'     => $this->pelangganModel->getPelanggan()
        ];

        return view('transaksi/sb_create', $data);
        // return view('transaksi/create', $data);
    }

    public function get_nama()
    {
        if (isset($_GET['term'])) {
            $result = $this->pelangganModel->cariNama($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[]  = array(
                        'label'         => $row->nama,
                        'alamat'        => $row->alamat,
                        'no_telp'       => $row->no_telp
                    );
                echo json_encode($arr_result);
            }
        }
    }

    public function save()
    {
        $tglMasuk           = date('Y-m-d');
        $jamMasuk           = date('H:i:s');

        $detLayanan         = $this->request->getVar('layanan');
        $detJasa            = $this->request->getVar('jasa');
        $detQty             = $this->request->getVar('qty');

        $explodedLayanan    = explode('|', $detLayanan);
        $explodedJasa       = explode('|', $detJasa);

        $layanan       = $explodedLayanan[0];
        $esti          = $explodedLayanan[1];
        $stEsti        = $explodedLayanan[2];
        $hrgLayanan    = $explodedLayanan[3];

        $jasa          = $explodedJasa[0];
        $hrgJasa       = $explodedJasa[1];
        $satuan        = $explodedJasa[2];

        if ($stEsti == "1") {
            $estimasi = $esti . " Jam";
        } else if ($stEsti == "2") {
            $estimasi = $esti . " Hari";
        }

        if ($satuan == "1") {
            $qty = $detQty . " Kg";
        } else if ($satuan == "2") {
            $qty = $detQty . " Pcs";
        }

        $tglSelesai     = date('Y-m-d', strtotime('+' . $esti . 'days', strtotime($tglMasuk)));
        $jamSelesai     = date('H:i:s', strtotime('+' . $esti . 'hours', strtotime($jamMasuk)));

        $tglKode        = date('y-m-d');
        $tglKodeString  = date('ymd', strtotime($tglKode));

        $cekData = $this->transaksiModel->getTransaksi();
        if (count($cekData) > 0) {
            $tglMulai   = date('Y-m-d');
            $result     = $this->transaksiModel->genKodeTr($tglMulai);
            if (count($result) > 0) {
                foreach ($result as $row) {
                    $kodeTrLama = $row->kode_tr;
                }

                $newKode        = substr($kodeTrLama, -3);
                $intNewKode     = (int) $newKode;
                $intNewKode     = $intNewKode + 1;
                $stringNewKode  = (string) $intNewKode;

                $jml_string     = strlen($stringNewKode);

                if ($jml_string <= 1) {
                    $stringNewKode  = "00" . $stringNewKode;
                } else if ($jml_string == 2) {
                    $stringNewKode  = "0" . $stringNewKode;
                }
                $kodeTr = "T" . $tglKodeString . $stringNewKode;
            } else if (count($result) < 1) {
                $kodeTr = "T" . $tglKodeString . "001";
            }
        } else {
            $kodeTr = "T" . $tglKodeString . "001";
        }

        if (!$this->validate([
            'nama' => [
                'rules' => 'required'
            ],
            'qty' => [
                'rules' => 'required'
            ],
            'jasa' => [
                'rules' => 'required'
            ],
            'layanan' => [
                'rules' => 'required'
            ]

        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/novel/create')->withInput()->with('validation', $validation);
            return redirect()->to('/transaksi/create')->withInput();
        }

        // note
        // simpan ke database
        // status default 1 = open, 2 = process, 3 = waiting, 4 = close
        // pembayaran 1 = lunas, 2 = Saat Pengambilan

        $create_by = user()->firstname;
        $status = 1;
        $simpanData = array(
            'kode_tr'      => $kodeTr,
            'pelanggan'    => $this->request->getVar('nama'),
            'kontak_plg'   => $this->request->getVar('no_telp'),
            'alamat_plg'   => $this->request->getVar('alamat'),
            'layanan'      => $layanan,
            'jasa'         => $jasa,
            'qty'          => $qty,
            'hrg_jsa'      => $hrgJasa,
            'hrg_lyn'      => $hrgLayanan,
            'tgl_masuk'    => $tglMasuk,
            'total'        => $this->request->getVar('total'),
            'pembayaran'   => $this->request->getVar('pembayaran'),
            'status'       => $status,
            'create_by'    => $create_by
        );

        $jamData = array(
            'estimasi'     => $estimasi,
            'jam_masuk'    => $jamMasuk,
            'jam_selesai'  => $jamSelesai
        );

        $tanggalData = array(
            'estimasi'     => $estimasi,
            'tgl_selesai'  => $tglSelesai
        );

        if ($stEsti == 1) {
            //Estimasi Jam
            $simpanDgJam = array_merge($simpanData, $jamData);
            $this->transaksiModel->save($simpanDgJam);
        } else {
            //Estimasi Hari
            $simpanDgTanggal = array_merge($simpanData, $tanggalData);
            $this->transaksiModel->save($simpanDgTanggal);
        }

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/transaksi');
    }

    // cek status transaksi
    function cek_transaksi()
    {
        $no_tr = $this->request->getVar('no_tr');

        if (isset($_POST['submit'])) {
            $no_tr_encode = base64_encode($no_tr);
            $no_tr_decoded = base64_decode($no_tr_encode);
            if ($result = $this->transaksiModel->cariTransaksi($no_tr_decoded)) {
                return redirect()->to('/transaksi/hasil_cari/' . $no_tr_encode);
            } else {
                session()->setFlashdata('pesan', 'No Transaksi tidak ditemukan');
            }
        }

        $data = [
            'title'         => 'Cek Transaksi',
            'validation'    => \Config\Services::validation()
        ];

        return view('transaksi/sb_cek_transaksi', $data);
        // return view('transaksi/cek_transaksi', $data);
    }

    //status transaksi
    function hasil_cari($no_tr_encode)
    {
        $no_tr_decoded = base64_decode($no_tr_encode);
        $data = [
            'title'         => 'Status Transaksi',
            'validation'    => \Config\Services::validation(),
            'cek_tr'        => $this->transaksiModel->cariTransaksi($no_tr_decoded)
        ];

        return view('transaksi/sb_status_transaksi', $data);
        // return view('transaksi/status_transaksi', $data);
    }

    public function edit($id_tr)
    {
        $data = [
            'title'         => 'Status Transaksi',
            'validation'    => \Config\Services::validation(),
            'transaksi'     => $this->transaksiModel->getTransaksiById($id_tr)
            // 'transaksi'     => $this->transaksiModel->getTransaksi($slug)
            // 'pelanggan' => $this->pelangganModel->getPelanggan($slug)
        ];

        // d($data['transaksi']);

        // echo $transaksi['kode_tr'];

        // return view('pelanggan/edit', $data);
        return view('transaksi/sb_edit', $data);
    }

    public function laporan()
    {
        $data = [
            'title'         => 'Laporan',
            'transaksi'     => $this->transaksiModel->getTransaksi()
        ];

        // dd($data['transaksi']);
        return view('transaksi/sb_laporan', $data);
    }

    public function update($id_tr)
    {
        $id_tr = url_title($this->request->getVar('id_tr'), '-', true);
        // dd($id_tr);

        $update_by = user()->firstname;

        $this->transaksiModel->save([
            'id_tr'     => $id_tr,
            'status'    => $this->request->getVar('status'),
            'update_by' => $update_by
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');

        // dd($id_tr);

        return redirect()->to('/transaksi/edit/' . $id_tr);
    }

    public function open()
    {
        $currentPage = $this->request->getVar('page_tb_transaksi') ? $this->request->getVar('page_tb_transaksi') : 1;
        $data = [
            'title'                 => 'Transaksi Open',
            'sukses'                => $this->transaksiModel->where('status', '1')->paginate(10, 'tb_transaksi'),
            'pager'                 => $this->transaksiModel->pager,
            'currentPage'           => $currentPage,
            'jmlSemuaTransaksi'     => $this->transaksiModel->jmlSemuaTransaksi(),
            'jmlTransaksiOpen'      => $this->transaksiModel->jmlTransaksiOpen(),
            'jmlTransaksiProcess'   => $this->transaksiModel->jmlTransaksiProcess(),
            'jmlTransaksiWaiting'   => $this->transaksiModel->jmlTransaksiWaiting(),
            'jmlTransaksiSukses'    => $this->transaksiModel->jmlTransaksiSukses()
        ];

        return view('transaksi/sb_open', $data);
    }

    public function process()
    {
        $currentPage = $this->request->getVar('page_tb_transaksi') ? $this->request->getVar('page_tb_transaksi') : 1;
        $data = [
            'title'                 => 'Transaksi Process',
            'sukses'                => $this->transaksiModel->where('status', '2')->paginate(10, 'tb_transaksi'),
            'pager'                 => $this->transaksiModel->pager,
            'currentPage'           => $currentPage,
            'jmlSemuaTransaksi'     => $this->transaksiModel->jmlSemuaTransaksi(),
            'jmlTransaksiOpen'      => $this->transaksiModel->jmlTransaksiOpen(),
            'jmlTransaksiProcess'   => $this->transaksiModel->jmlTransaksiProcess(),
            'jmlTransaksiWaiting'   => $this->transaksiModel->jmlTransaksiWaiting(),
            'jmlTransaksiSukses'    => $this->transaksiModel->jmlTransaksiSukses()
        ];

        return view('transaksi/sb_process', $data);
    }

    public function waiting()
    {
        $currentPage = $this->request->getVar('page_tb_transaksi') ? $this->request->getVar('page_tb_transaksi') : 1;
        $data = [
            'title'                 => 'Transaksi Waiting',
            'sukses'                => $this->transaksiModel->where('status', '3')->paginate(10, 'tb_transaksi'),
            'pager'                 => $this->transaksiModel->pager,
            'currentPage'           => $currentPage,
            'jmlSemuaTransaksi'     => $this->transaksiModel->jmlSemuaTransaksi(),
            'jmlTransaksiOpen'      => $this->transaksiModel->jmlTransaksiOpen(),
            'jmlTransaksiProcess'   => $this->transaksiModel->jmlTransaksiProcess(),
            'jmlTransaksiWaiting'   => $this->transaksiModel->jmlTransaksiWaiting(),
            'jmlTransaksiSukses'    => $this->transaksiModel->jmlTransaksiSukses()
        ];

        return view('transaksi/sb_waiting', $data);
    }

    public function success()
    {
        $currentPage = $this->request->getVar('page_tb_transaksi') ? $this->request->getVar('page_tb_transaksi') : 1;
        $data = [
            'title'                 => 'Transaksi Sukses',
            'sukses'                => $this->transaksiModel->where('status', '4')->paginate(10, 'tb_transaksi'),
            'pager'                 => $this->transaksiModel->pager,
            'currentPage'           => $currentPage,
            'jmlSemuaTransaksi'     => $this->transaksiModel->jmlSemuaTransaksi(),
            'jmlTransaksiOpen'      => $this->transaksiModel->jmlTransaksiOpen(),
            'jmlTransaksiProcess'   => $this->transaksiModel->jmlTransaksiProcess(),
            'jmlTransaksiWaiting'   => $this->transaksiModel->jmlTransaksiWaiting(),
            'jmlTransaksiSukses'    => $this->transaksiModel->jmlTransaksiSukses()
        ];

        return view('transaksi/sb_success', $data);
    }
}
