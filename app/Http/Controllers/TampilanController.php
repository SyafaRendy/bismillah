<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TampilanController extends Controller
{
    public function profile_siswa(){
        return view('profile');
    }

    public function profile_guru(){
        return view('profile_guru');
    }

    public function absen(){
        return view('absen');
    }

    public function jurnal(){
        return view('jurnal');
    }

    public function data_jurnal(){
        return view('data_jurnal');
    }
}
