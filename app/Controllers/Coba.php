<?php

namespace App\Controllers;

class Coba extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function coba(){
        echo "Menampilkan Coba";
    }


    function hallo(){
return view('hello');
    }

}

