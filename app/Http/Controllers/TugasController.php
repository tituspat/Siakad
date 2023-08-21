<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use Auth;
use App\Models\Kelas;
use App\Models\Tugas;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\JawabanTugas;

class TugasController extends Controller
{
    public function index($id)
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_tugas' => 'required|string|max:25',
            'file_pdf' => 'mimes:pdf|max:2048',
            'kelas' => 'string|max:255',
            'text' => '',
        ]);

        $pdfPath = $request->file('file_pdf')->store('pdfs', 'public');
        
        $kelas_id = Kelas::where('nama_kelas', $request->kelas)->value('id');

        Tugas::create([
            'pdf_path' => $pdfPath,
            'judul_tugas' => $request->judul_tugas,
            'kelas_id' => $kelas_id,
            'text' => $request->text,

        ]);

        return redirect()->back()->with('success', 'File PDF berhasil diunggah dan disimpan.');
    
    }

    public function guruIndex()
    {
        $user = Auth::user();

        if ($user) {
            $guru = Guru::where('id_card', $user->id_card)->first();
            $kelas = Kelas::where('guru_id', $guru->id)->first();
            $tugas = Tugas::where('kelas_id', $kelas->id)->get();

            return view('guru.tugas.index', compact('guru', 'kelas', 'tugas'));
        } else {
            // Tindakan yang akan diambil jika user tidak ditemukan (belum login)
            return redirect()->back()->with('error', 'Anda belum login atau data tidak ditemukan.');
        }
    }

    public function guruShow($id)
    {
        $user = Auth::user();
        $guru = Guru::where('id_card', $user->id_card)->first();
        $kelas = Kelas::where('guru_id', $guru->id)->first();
        $tugas = Tugas::where('kelas_id', $kelas->id)->first();
        $jawaban = JawabanTugas::where('tugas_id', $tugas->id)->get();
        $siswa = Siswa::where('kelas_id', $kelas->id)->first();

        return view('guru.tugas.show', compact('guru', 'kelas', 'tugas', 'jawaban', 'siswa'));
    }

    public function guruNilai(Request $request, $id)
    {

        $data = JawabanTugas::findOrFail($id);
        $request->validate([
            'nilai' => 'required|integer|max:100',
        ]);

        $data->nilai = $request->nilai;

        $data->save();

        return redirect()->back()->with('success', 'File berhasil diunggah dan disimpan.');
    
    }

    public function siswaIndex()
    {
        $user = Auth::user();

        if ($user) {
            $siswa = Siswa::where('no_induk', $user->no_induk)->first();
            $kelas = Kelas::where('id', $siswa->kelas_id)->first();
            $tugas = Tugas::where('kelas_id', $kelas->id)->get();

            return view('siswa.tugas.index', compact('siswa', 'kelas', 'tugas'));
        } else {
            // Tindakan yang akan diambil jika user tidak ditemukan (belum login)
            return redirect()->back()->with('error', 'Anda belum login atau data tidak ditemukan.');
        }
    }

    public function siswaPost(Request $request, $id)
    {
        $request->validate([
            'judul_tugas' => 'required|string|max:25',
            'pdf_path' => 'mimes:pdf|max:2048',
            'kelas' => 'string|max:255',
            'judul_tugas' => 'string|max:255',
            'text' => '',
        ]);

        $pdfPath = $request->file('pdf_path')->store('pdfs', 'public');
        $siswa = Siswa::where('no_induk', Auth::user()->no_induk)->value('id');
        $tugas = Tugas::where('judul_tugas', $request->judul_tugas)->value('id');
        $kelas_id = Kelas::where('nama_kelas', $request->kelas)->value('id');

        JawabanTugas::create([
            'tugas_id' => $id,
            'pdf_path' => $pdfPath,
            'tugas_id' => $tugas,
            'siswa_id' => $siswa,

        ]);

        return redirect()->back()->with('success', 'File berhasil diunggah dan disimpan.');
    }
}
