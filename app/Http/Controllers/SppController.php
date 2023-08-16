<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Siswa;
use App\Models\tagihan;
use App\Models\Spp;

class SppController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'spp' => Spp::orderBy('id', 'DESC')->paginate(10),
            'user' => Siswa::find(auth()->user()->id)
        ];
      
         return view('admin.spp.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $messages = [
            'required' => ':attribute tidak boleh kosong!',
            'numeric' => ':attribute harus berupa angka!',
            'min' => ':attribute minimal harus :min angka!',
            'max' => ':attribute maksimal harus :max angka!',
            'integer' => ':attribute harus berupa nilai uang tanpa titik!'
         ];
         
        $validasi = $request->validate([
            'tahun' => 'required|min:4|max:4',
            'nominal' => 'required|integer',
        ], $messages);
      
       if($validasi) :
           $store = Spp::create([
               'tahun' => $request->tahun,
               'nominal' => $request->nominal,
           ]);
         endif;
      
      return redirect()->back()->with('success', 'Berhasil Menambahkan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $siswa=siswa::get();
        $siswa_id=siswa::first();
        $tagihan=tagihan::where('siswa_id', $siswa_id->id)->first();
        $spp=spp::where('id', $siswa_id->id_spp)->first();

        return view('admin.history.index', compact('siswa', 'tagihan', 'spp'));
    }
    public function owner()
    {
        $siswa=siswa::get();
        $siswa_id=siswa::first();
        $tagihan=tagihan::where('siswa_id', $siswa_id->id)->first();
        $spp=spp::where('id', $siswa_id->id_spp)->first();

        return view('admin.history.index', compact('siswa', 'tagihan', 'spp'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirm($id)
    {
        try {
            $tagihan = Tagihan::findOrFail($id);
            
            // Ubah status tagihan berdasarkan status sebelumnya
            $tagihan->status = ($tagihan->status == 'paid') ? 'unpaid' : 'paid';
            $tagihan->save();
    
            return redirect()->back()->with('success', 'Status tagihan berhasil diubah.');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Tagihan tidak ditemukan.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'edit' => Spp::find($id),
             'user' => User::find(auth()->user()->id)
        ];
      
        return view('dashboard.data-spp.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        if($update = Spp::find($id)) :         
               $stat = $update->update([
                  'tahun' => $req->tahun,
                  'nominal' => $req->nominal
               ]);
               if($stat) :
                      Alert::success('Berhasil!', 'Data Berhasil di Edit');
                   else :
                     Alert::error('Terjadi Kesalahan!', 'Data Gagal di Edit');
                     return back();
                  endif;
            endif;
            
            return redirect('dashboard/data-spp');
    }
            /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function siswa()
    {
        $data = [
            'spp' => Spp::orderBy('id', 'DESC')->paginate(10),
            'user' => Siswa::find(auth()->user()->id)
        ];
      
         return view('siswa.spp.index', $data);
    }

}
