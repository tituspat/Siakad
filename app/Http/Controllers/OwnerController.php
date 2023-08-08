<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Kelas;

class OwnerController extends Controller
{
    public function show()
    {
        $kelas = Kelas::OrderBy('nama_kelas', 'asc')->get();
        return view('owner.siswa.index', compact('kelas'));
    }
}
