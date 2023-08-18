<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Soal;
use App\Models\kelas;
use App\Models\Test;
use App\Models\Nilai;
use Auth;
use Illuminate\Support\Facades\Crypt;

class TestController extends Controller
{
    public function index($id)
    {
        //
    }

    public function show($id)
    {
        $soal = Soal::where('id_test', $id)->get();
        $test = test::where('id', $id)->first();
        
        
        return view('test.show', compact('soal', 'test'));
    }

    public function selesai(Request $request, $id)
    {
        $test = Test::findOrFail($id);
        $soal = Soal::where('id_test', $test->id)->get();


        $jumlahSoal = count($soal);
        $skor = 0;
    
        foreach ($soal as $s) {
            $jawabanSiswa = $request->input('jawaban_' . $s->id);
    
            if ($jawabanSiswa == $s->jawaban_benar) {
                $skor++;
            }
        }
    
        $skorAkhir = ($skor / $jumlahSoal) * 100;
    
        Nilai::create([
            'no_induk' => Auth::user()->no_induk,
            'nilai' => $skorAkhir,
            'id_test' => $test->id,
        ]);

        // Simpan skor siswa ke dalam database atau lakukan sesuai kebutuhan
        // Contoh: $siswa->update(['skor' => $skor]);

        return redirect()->route('home')->with('success', 'Ujian telah selesai. Skor Anda: ' . $skorAkhir);
    }

    public function store(Request $request)
    {
        $soalData = $request->input('soal');

        $kelasId = Kelas::where('nama_kelas', $request->kelas)->value('id');
        Test::create([
            'nama_test' => $request->nama_test,
            'kelas_id' => $kelasId,
        ]);

        $id_test = Test::where('nama_test', $request->nama_test)->value('id');

        foreach ($soalData as $data) {
            Soal::create([
                'pertanyaan' => $data['pertanyaan'],
                'pilihan_a' => $data['pilihan_a'],
                'pilihan_b' => $data['pilihan_b'],
                'pilihan_c' => $data['pilihan_c'],
                'pilihan_d' => $data['pilihan_d'],
                'jawaban_benar' => $data['jawaban_benar'],
    
                'id_test' => $id_test,
            ]);
        }

        return redirect()->back()->with('success', 'Soal berhasil ditambahkan.');
    }


}
