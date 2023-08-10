<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengumuman;

class MateriController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::where('opsi', 'pengumuman')->first();
        return view('materi.index', compact('pengumuman'));
    }

    public function simpan(Request $request)
    {
        $this->validate($request, [
            'isi' => 'required',
        ]);

        Pengumuman::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'isi' => $request->isi,
            ]
        );

        return redirect()->back()->with('success', 'Pengumuman berhasil di perbarui!');
    }
}
