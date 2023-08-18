<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Kelas;
use App\Models\Spp;
use App\Models\Siswa;
use Crypt;

class OwnerController extends Controller
{
    public function index()
    {
        $kelas = Kelas::OrderBy('nama_kelas', 'asc')->get();
        $SPP = spp::OrderBy('nominal', 'asc')->get();
        return view('owner.siswa.index', compact('kelas', 'SPP'));
    }

    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $siswa = Siswa::where('kelas_id', $id)->OrderBy('nama_siswa', 'asc')->get();
        $kelas = Kelas::findorfail($id);
        return view('owner.siswa.show', compact('siswa', 'kelas'));
    }

    public function details($id)
    {
        $id = Crypt::decrypt($id);
        $siswa = Siswa::findorfail($id);
        return view('owner.siswa.details', compact('siswa'));
    }

}
