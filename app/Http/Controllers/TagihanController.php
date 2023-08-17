<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tagihan;
use App\Models\Siswa;
use Auth;

class TagihanController extends Controller
{
    public function siswa()
    {
        // Ambil data siswa berdasarkan user yang sedang login
        $siswa = Siswa::where('id', Auth::user()->no_induk)->first();

        // Ambil semua tagihan siswa
        $tagihan = $siswa->tagihan;
        return view('siswa.spp.index', compact('tagihan', 'siswa'));
    }

    public function Owner()
    {
        // Ambil data siswa berdasarkan user yang sedang login
        $siswa = Siswa::where('id', Auth::user()->no_induk)->first();

        // Ambil semua tagihan siswa
        $tagihan = $siswa->tagihan;
        return view('siswa.spp.index', compact('tagihan', 'siswa'));
    }

    public function Admin()
    {
        // Ambil data siswa berdasarkan user yang sedang login
        $siswa = Siswa::where('id', Auth::user()->no_induk)->first();

        // Ambil semua tagihan siswa
        $tagihan = $siswa->tagihan;
        return view('siswa.spp.index', compact('tagihan', 'siswa'));
    }
}
