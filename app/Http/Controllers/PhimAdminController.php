<?php

namespace App\Http\Controllers;

use App\Phim;
use App\DoTuoi;
use App\QuocGia;
use App\TheLoai;
use Illuminate\Http\Request;

class PhimAdminController extends Controller
{
    public function __construct()
    {
        $doTuois = DoTuoi::all();
        $theLoais = TheLoai::all();
        $quocGias = QuocGia::all();
        $phims = Phim::with('user')->orderby('ngay_khoi_chieu', 'desc')->get();

        view()->share(compact('phims'));
        view()->share(compact('doTuois'));
        view()->share(compact('theLoais'));
        view()->share(compact('quocGias'));
    }

    public function index()
    {
        return view('admin.phim.index');
    }

    public function show($id)
    {
        $phim = Phim::findOrFail($id);
        return view('admin.phim.show', compact('phim'));
    }
}
