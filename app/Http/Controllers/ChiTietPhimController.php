<?php

namespace App\Http\Controllers;

use App\Phim;
use App\DanhGia;
use App\QuocGia;
use App\TheLoai;
use App\LoaiBaiDang;

class ChiTietPhimController extends Controller
{
    public function __construct()
    {
        $loaiBaiDangs = LoaiBaiDang::all();
        $theLoais = TheLoai::all();
        $quocGias = QuocGia::all();

        view()->share(compact('loaiBaiDangs'));
        view()->share(compact('theLoais'));
        view()->share(compact('quocGias'));
    }

    public function show($phim, $slug)
    {
        $phim = Phim::findOrFail($phim);
        $danhGias = DanhGia::with('user')->orderby('created_at', 'desc')->get();
        return view('pages.chitietphim', compact('phim', 'danhGias'));
    }
}
