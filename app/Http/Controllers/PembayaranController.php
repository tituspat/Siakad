<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\User;
use App\Models\Siswa;

class PembayaranController extends Controller
{
   
   public function __construct(){
         $this->middleware([
            'auth',
         ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'pembayaran' => Pembayaran::orderBy('id', 'DESC')->paginate(10),
            'user' => User::find(auth()->user()->id)
        ];
      
        return view('entri-pembayaran.index', $data);
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
    public function store(Request $req)
    {
      
        $message = [
            'required' => ':attribute harus di isi',
            'numeric' => ':attribute harus berupa angka',
            'min' => ':attribute minimal harus :min angka',
            'max' => ':attribute maksimal harus :max angka',
         ];
         
        $req->validate([
            'nisn' => 'required',
            'spp_bulan' => 'required',
            'jumlah_bayar' => 'required|numeric'
         ], $message);
         
         // if(Siswa::where('nisn',$req->nisn)->exists() == false):
         //    Alert::error('Terjadi Kesalahan!', 'Siswa dengan NISN ini Tidak di Temukan');
         //   return back();
         //    exit;
         // endif;
            
         
         $siswa = Siswa::where('nisn',$req->nisn)->get();
         
         foreach($siswa as $val){
            $id_siswa = $val->id;
         }
         
         Pembayaran::create([
            'id_siswa' => $id_siswa,
            'spp_bulan' => $req->spp_bulan,
            'jumlah_bayar' => $req->jumlah_bayar,
         ]);
         
         return redirect()->back()->with('success', 'Pembayaran Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
            'edit' => Pembayaran::find($id),
            'user' => User::find(auth()->user()->id)
         ];
         
         return view('entri-pembayaran.edit', $data);
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
         $message = [
            'required' => ':attribute harus di isi',
            'numeric' => ':attribute harus berupa angka',
            'min' => ':attribute minimal harus :min angka',
            'max' => ':attribute maksimal harus :max angka',
         ];
         
        $req->validate([
            'nisn' => 'required',
            'spp_bulan' => 'required',
            'jumlah_bayar' => 'required|numeric'
         ], $message);
         
         $pembayaran = Pembayaran::find($id);
         
         $pembayaran->update([
             'spp_bulan' => $req->spp_bulan,
            'jumlah_bayar' => $req->jumlah_bayar
         ]);
         
         // if(Siswa::where('nisn',$req->nisn)->exists() == false):
         //    Alert::error('Terjadi Kesalahan!', 'Siswa dengan NISN ini Tidak di Temukan');
         //   return back();
         //    exit;
         // endif;

         if($req->nisn != $pembayaran->siswa->nisn) :
            $siswa = Siswa::where('nisn',$req->nisn)->get();
         
            foreach($siswa as $val){
               $id_siswa = $val->id;
            }
            
            $pembayaran->update([
               'id_siswa' => $id_siswa,
            ]);
         endif;
         
         Alert::success('Berhasil!', 'Pembayaran berhasil di Edit');
         return redirect()->back()->with('success', 'Pembayaran berhasil di Edit');
    }


}
