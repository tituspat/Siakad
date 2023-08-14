<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tagihan;
use Auth;

class TagihanController extends Controller
{
    public function siswa()
    {
        $user_id = Auth::user()->id;
        $bills = tagihan::where('user_id', $user_id)->orderBy('jatuh_tempo', 'asc')->get();
        return view('siswa.spp.index', compact('bills'));
    }
}
