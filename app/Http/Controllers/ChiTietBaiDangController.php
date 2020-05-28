<?php

namespace App\Http\Controllers;

use App\BaiDang;
use App\QuocGia;
use App\TheLoai;
use App\LoaiBaiDang;
use Illuminate\Support\Facades\Session;

class ChiTietBaiDangController extends Controller
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

    public function show($baiDang, $slug)
    {
        $sessionKey = 'post_' . $baiDang;
        $sessionView = Session::get($sessionKey);
        $baiDang = BaiDang::findOrFail($baiDang);
        if (!$sessionView) { //nếu chưa có session
            Session::put($sessionKey, 1); //set giá trị cho session
            $baiDang->increment('luot_xem');
        }
        return view('pages.baidang', compact('baiDang'));
    }
}
