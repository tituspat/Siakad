<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Materi;

class MateriController extends Controller
{
    public function index()
    {
        $materi = Materi::OrderBy('created_at', 'asc')->get();

        return view('materi.index', compact('materi'));
    }
    public function store(Request $request)
{
    $request->validate([
        'judul' => 'string',
        'link_video' => 'string',
        'link_materi_baca' => 'string',
        'materi_baca' => 'string',
        'text' => '',
    ]);

    $embedCode = $this->embedVideo($request->link_video);

    Materi::create([
        'judul' => $request->judul,
        'link_video' => $embedCode,
        'link_materi_baca' => $request->link_materi_baca,
        'materi_baca' => $request->link_materi,
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
    
if (isset($parsedUrl['host']) && ($parsedUrl['host'] === 'www.youtube.com' || $parsedUrl['host'] === 'youtube.com' || $parsedUrl['host'] === 'youtu.be')) {
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
    }
