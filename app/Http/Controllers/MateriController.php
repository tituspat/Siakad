<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Materi;
use App\Models\Kelas;

use Illuminate\Support\Facades\Crypt;
class MateriController extends Controller
{
    public function index()
    {
        $materi = Materi::OrderBy('created_at', 'asc')->get();
        $kelas = Kelas::orderBy('nama_kelas')->get();

        return view('materi.index', compact('materi', 'kelas'));
    }
    public function store(Request $request)
    {
        $request->validate([
        ]);

        $embedCode = $this->embedVideo($request->link_video);
        $kelas_id = Kelas::where('nama_kelas', $request->nama_kelas)->value('id');

        Materi::create([
            'judul' => $request->judul,
            'kelas_id' => $kelas_id,
            'link_video' => $embedCode,
            'link_materi' => $request->link_materi,
            'materi_baca' => $request->materi_baca,
            'text' => $request->text,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }


    // link converter
    private function embedVideo($url) {
        // YouTube
        if (strpos($url, 'youtu.be') !== false || strpos($url, 'youtube.com') !== false) {
            $videoId = $this->getYouTubeVideoId($url);
            return '<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$videoId.'" frameborder="0" allowfullscreen></iframe>';;
        }
        
        // Google Drive
        if (strpos($url, 'drive.google.com') !== false) {
            $fileId = $this->getGoogleDriveFileId($url);
            return '<iframe src="https://drive.google.com/file/d/'.$fileId.'/preview" width="640" height="480" allow="autoplay"></iframe>';
        }
        
        // Tambahkan penanganan untuk jenis tautan video lainnya di sini
        
        // Jika tidak ada penanganan yang sesuai, kembalikan tautan asli
        return $url;
    }

    private function getYouTubeVideoId($url) {
        // Mendapatkan video ID dari tautan YouTube
        $parsedUrl = parse_url($url);
        
        if (isset($parsedUrl['host']) && ($parsedUrl['host'] === 'www.youtube.com' ||   $parsedUrl ['host'] === 'youtube.com' || $parsedUrl['host'] === 'youtu.be')) {
            if (isset($parsedUrl['query'])) {
                parse_str($parsedUrl['query'], $query);
                if (isset($query['v'])) {
                    return $query['v'];
                    }
            }
        
            // Jika menggunakan format youtu.be
            if (isset($parsedUrl['path'])) {
                $pathSegments = explode('/', trim($parsedUrl['path'], '/'));
                return end($pathSegments);
            }
        }

        return null; // Jika tidak ditemukan video ID yang valid
    }
    
    private function getGoogleDriveFileId($url) {
        // Misalnya, jika URL Google Drive adalah https://drive.google.com/file/d/abc123/view
        $parts = explode('/', parse_url($url, PHP_URL_PATH));
        return $parts[count($parts) - 2];
    }
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $materi = Materi::where('kelas_id', $id)->first();
        $kelas = Kelas::where('id', $id);
        return view('materi.show', compact('materi', 'kelas'));
    }
}
