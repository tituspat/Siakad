<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Spp;
use App\Models\Absen;
use App\Models\Kehadiran;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Crypt;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::OrderBy('nama_kelas', 'asc')->get();
        $SPP = spp::OrderBy('nominal', 'asc')->get();
        return view('admin.siswa.index', compact('kelas', 'SPP'));
    }

    public function tagihan()
    {
        $siswa = Siswa::OrderBy('id', 'asc')->get();
        $spp = spp::first();
        return view('admin.siswa.tagihan', compact('siswa', 'spp'));
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
        $this->validate($request, [
            'no_induk' => 'required|string|unique:siswa',
            'nama_siswa' => 'required',
            'jk' => 'required',
            'id_spp'=> 'required',
            'kelas_id' => 'required'
        ]);

        if ($request->foto) {
            $foto = $request->foto;
            $new_foto = date('siHdmY') . "_" . $foto->getClientOriginalName();
            $foto->move('uploads/siswa/', $new_foto);
            $nameFoto = 'uploads/siswa/' . $new_foto;
        } else {
            if ($request->jk == 'L') {
                $nameFoto = 'uploads/siswa/52471919042020_male.jpg';
            } else {
                $nameFoto = 'uploads/siswa/50271431012020_female.jpg';
            }
        }

        $siswa = Siswa::create([
            'no_induk' => $request->no_induk,
            'nama_siswa' => $request->nama_siswa,
            'jk' => $request->jk,
            'kelas_id' => $request->kelas_id,
            'telp' => $request->telp,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'id_spp' => $request->id_spp,
            'foto' => $nameFoto
        ]);

            // Menambahkan tagihan otomatis
        $jenisSppBaru = 'baru';
        $nominalBaru = 300000; // ganti dengan nominal yang sesuai
        $tagihan = Tagihan::create([
        'siswa_id' => $siswa->id,
        'spp_id' => $siswa->id_spp,
        'jatuh_tempo' => now()->addDays(10), // Menambahkan tagihan pada tanggal saat ini
        'status' => 'paid',
    ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan data siswa baru!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $siswa = Siswa::findorfail($id);
        return view('admin.siswa.details', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $siswa = Siswa::findorfail($id);
        $kelas = Kelas::all();
        return view('admin.siswa.edit', compact('siswa', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_siswa' => 'required',
            'jk' => 'required',
            'kelas_id' => 'required'
        ]);

        $siswa = Siswa::findorfail($id);
        $user = User::where('no_induk', $siswa->no_induk)->first();
        if ($user) {
            $user_data = [
                'name' => $request->nama_siswa
            ];
            $user->update($user_data);
        } else {
        }
        $siswa_data = [
            'nis' => $request->nis,
            'nama_siswa' => $request->nama_siswa,
            'jk' => $request->jk,
            'kelas_id' => $request->kelas_id,
            'telp' => $request->telp,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
        ];
        $siswa->update($siswa_data);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
    }



    public function ubah_foto($id)
    {
        $id = Crypt::decrypt($id);
        $siswa = Siswa::findorfail($id);
        return view('admin.siswa.ubah-foto', compact('siswa'));
    }

    public function update_foto(Request $request, $id)
    {
        $this->validate($request, [
            'foto' => 'required'
        ]);

        $siswa = Siswa::findorfail($id);
        $foto = $request->foto;
        $new_foto = date('s' . 'i' . 'H' . 'd' . 'm' . 'Y') . "_" . $foto->getClientOriginalName();
        $siswa_data = [
            'foto' => 'uploads/siswa/' . $new_foto,
        ];
        $foto->move('uploads/siswa/', $new_foto);
        $siswa->update($siswa_data);

        return redirect()->route('siswa.index')->with('success', 'Berhasil merubah foto!');
    }

    public function view(Request $request)
    {
        $siswa = Siswa::OrderBy('nama_siswa', 'asc')->where('kelas_id', $request->id)->get();

        foreach ($siswa as $val) {
            $newForm[] = array(
                'kelas' => $val->kelas->nama_kelas,
                'no_induk' => $val->no_induk,
                'nama_siswa' => $val->nama_siswa,
                'jk' => $val->jk,
                'foto' => $val->foto
            );
        }

        return response()->json($newForm);
    }


    public function kelas($id)
    {
        $id = Crypt::decrypt($id);
        $siswa = Siswa::where('kelas_id', $id)->OrderBy('nama_siswa', 'asc')->get();
        $kelas = Kelas::findorfail($id);
        return view('admin.siswa.show', compact('siswa', 'kelas'));
    }

    public function absen()
    {
        $siswa = Siswa::all();
        $absen = Absen::where('tanggal', date('Y-m-d'))->get();
        $kehadiran = Kehadiran::limit(4)->get();
        return view('guru.siswa.absen', compact('absen', 'kehadiran', 'siswa'));
    }

    public function simpan(Request $request)
    {
        $this->validate($request, [
            'no_induk' => 'required',
            'kehadiran_id' => 'required'
        ]);
            $siswa = Siswa::where('no_induk', $request->no_induk)->first();
            if ($siswa->no_induk == $request->no_induk) {
                $cekAbsen = Absen::where('siswa_id', $siswa->id)->where('tanggal', date('Y-m-d'))->count();
                if ($cekAbsen == 0) {
                    if (date('w') != '0' && date('w') != '6') {
                        Absen::create([
                            'tanggal' => date('Y-m-d'),
                            'siswa_id' => $siswa->id,
                            'kehadiran_id' => $request->kehadiran_id,
                        ]);
                        return redirect()->back()->with('success', 'Absensi behasil!');
                    } else {
                        $namaHari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"];
                        $d = date('w');
                        $hari = $namaHari[$d];
                        return redirect()->back()->with('info', 'Maaf Bimble hari ' . $hari . ' libur!');
                    }
                } else {
                    return redirect()->back()->with('warning', 'Maaf absensi tidak bisa dilakukan 2x!');
                }
            } else {
                return redirect()->back()->with('error', 'Maaf id card ini bukan milik anda!');
            }
    }
    
    public function absensi()
    {
        $siswa = Siswa::all();
        return view('admin.siswa.absen', compact('siswa'));
    }

    public function kehadiran($id)
    {
        $id = Crypt::decrypt($id);
        $siswa = Siswa::findorfail($id);
        $absen = Absen::orderBy('tanggal', 'desc')->where('siswa_id', $id)->get();
        return view('admin.siswa.kehadiran', compact('siswa', 'absen'));
    }

    public function deleteAll()
    {
        $siswa = Siswa::all();
        if ($siswa->count() >= 1) {
            Siswa::whereNotNull('id')->delete();
            Siswa::withTrashed()->whereNotNull('id')->forceDelete();
            return redirect()->back()->with('success', 'Data table siswa berhasil dihapus!');
        } else {
            return redirect()->back()->with('warning', 'Data table siswa kosong!');
        }
    }


    public function confirm(Request $request, $id)
    {
        $requestData = $request->all();

        $calonSiswa = Users::where('id', $id)->get();

        if ($request->foto) {
            $foto = $request->foto;
            $new_foto = date('siHdmY') . "_" . $foto->getClientOriginalName();
            $foto->move('uploads/siswa/', $new_foto);
            $nameFoto = 'uploads/siswa/' . $new_foto;
        } else {
            if ($request->jk == 'L') {
                $nameFoto = 'uploads/siswa/52471919042020_male.jpg';
            } else {
                $nameFoto = 'uploads/siswa/50271431012020_female.jpg';
            }
        }

        // Data untuk tabel users
        $userData = [
            'no_induk' => $requestData['no_induk'],
        ];

        $kelas_id = Kelas::where('nama_kelas', $requestData['kelas'])->value('id') ;
        $id_spp = Spp::where('nominal', $requestData['spp'])->value('id') ;

        // Data untuk tabel siswa
        $siswaData = [
            'no_induk' => $request->no_induk,
            'nama_siswa' => $request->nama_siswa,
            'jk' => $request->jk,
            'kelas_id' => $request->kelas_id,
            'telp' => $request->telp,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'id_spp' => $request->id_spp,
            'foto' => $nameFoto
        ];

        $user=User::findOrFail($id);
        $user->update($userData);

        // Buat data baru pada tabel siswa
        $siswaData['no_induk'] = $user->no_induk; // Asosiasikan dengan user yang baru dibuat atau diupdate
        Siswa::create($siswaData);

        return redirect()->back()->with('success', 'Data berhasil diupdate dan dibuat baru.');
    }
}
