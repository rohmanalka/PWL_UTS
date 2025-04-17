<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    public function index() {
        $data = DB::select('select * from mahasiswa');
        return view('mahasiswa.index', ['data' => $data]);
    }
}
