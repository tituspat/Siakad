<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Nilai;
use App\Models\Test;
use Auth;

class NilaiController extends Controller
{
    public function guru()
    {
        $guru = Guru::where('id_card', Auth::user()->id_card)->first();
        $kelas = kelas::where('guru_id', $guru->id)->first();
        $siswa = Siswa::where('kelas_id', $kelas->id)->get();
    
        $testResults = [];
    
        foreach ($siswa as $s) {
            $nilai = Nilai::where('no_induk', $s->no_induk)->first();
            if ($nilai) {
                $test = Test::find($nilai->id_test);
                $testResults[] = [
                    'siswa' => $s,
                    'nilai' => $test ? $test->nilai : 'belum dikerjakan',
                ];
            } else {
                $testResults[] = [
                    'siswa' => $s,
                    'nilai' => 'belum dikerjakan',
                ];
            }
        }
    
        return view('guru.nilai', compact('guru', 'kelas', 'testResults'));
    }
}
