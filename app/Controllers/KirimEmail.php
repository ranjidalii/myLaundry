<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class KirimEmail extends BaseController
{
    // public function index()
    // {
    //     if ($this->request->getMethod() == 'post') {
    //         $email_tujuan = $this->request->getVar('email_tujuan');
    //         $subject = $this->request->getVar('subject');
    //         $pesan = $this->request->getVar('pesan');

    //         $email = service('email');
    //         $email->setTo($email_tujuan);
    //         $email->setFrom('ranjid.alii@gmail.com', 'Codeigniter 4 Send EMail');

    //         $email->setSubject($subject);
    //         $email->setMessage($pesan);

    //         if ($email->send()) {
    //             echo 'Email berhasil terkirim';
    //         } else {
    //             $data = $email->printDebugger(['headers']);
    //             print_r($data);
    //         }
    //     } else {
    //         return view('email');
    //     }
    // }

    public function index()
    {
        return view('auth/login');
    }
}
