<?php

namespace App\Http\Controllers;

use App\Phim;
use App\BaiDang;
use App\DanhGia;
use App\QuocGia;
use App\TheLoai;
use App\LoaiBaiDang;
use App\PhimQuocGia;
use App\TheLoaiPhim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
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

    public function getHome()
    {
        $hotPhims = Phim::where('trang_thai', 1)
            ->get(['id', 'ten_chinh', 'anh_poster']);
        $allPhims = Phim::latest()
            ->take(8)
            ->get(['id', 'ten_chinh', 'anh_poster']);
        $popularPhims = Phim::leftJoin('danh_gias', function ($join) {
            $join->on('phims.id', '=', 'danh_gias.phim_id');
        })
            ->selectRaw('phims.id, phims.ten_chinh, phims.ten_phu, phims.anh_poster, AVG(danh_gias.diem) as diem_trung_binh')
            ->groupBy(['phims.id', 'phims.ten_chinh', 'phims.ten_phu', 'phims.anh_poster'])
            ->orderByDesc('diem_trung_binh')
            ->take(8)
            ->get();

        $tinTucs = BaiDang::with('loaiBaiDang', 'user')
            ->where('loaibd_id', 1)
            ->where('trang_thai', 0)
            ->orderby('created_at', 'desc')
            ->take(6)->get();
        $baiViets = BaiDang::with('loaiBaiDang', 'user')
            ->where('loaibd_id', '!=', 1)
            ->where('trang_thai', 0)
            ->orderby('created_at', 'desc')
            ->take(6)->get();

        return view('pages.home', compact('hotPhims', 'allPhims', 'popularPhims', 'tinTucs', 'baiViets'));
    }

    public function getAllPhim(Request $request)
    {
        $theLoaiId = $request->theloai;
        $quocGiaId = $request->quocgia;
        $phimIds_1 = [];
        $phimIds_2 = [];
        $phimIds = [];
        if (!is_null($theLoaiId)) {
            $phimIds_1 = TheLoaiPhim::where('theloai_id', $theLoaiId)
                ->get('phim_id');
        }
        if (!is_null($quocGiaId)) {
            $phimIds_2 = PhimQuocGia::where('quocgia_id', $quocGiaId)
                ->get('phim_id');
        }
        if (count($phimIds_1) > 0 && count($phimIds_2) > 0) {
            $phimIds = array_unique(array_merge($phimIds_1, $phimIds_2));
        } else if (count($phimIds_1) > 0 && count($phimIds_2) == 0) {
            $phimIds = $phimIds_1;
        } else if (count($phimIds_1) == 0 && count($phimIds_2) > 0) {
            $phimIds = $phimIds_2;
        }

        $allPhim = Phim::with('doTuoi', 'user');
        if ($theLoaiId || $quocGiaId) {
            $allPhim = $allPhim->whereIn('id', $phimIds);
        }
        $allPhim = $allPhim->orderby('id', 'desc')
            ->paginate(12);

        return view('pages.allphim', compact('allPhim'));
    }

    public function getCommunity()
    {
        $baiDangs = BaiDang::with('loaiBaiDang', 'user')->where('trang_thai', 0)->get();
        $baiNoiBats = BaiDang::with('loaiBaiDang', 'user')
            ->where('trang_thai', 0)
            ->orderby('created_at', 'desc')
            ->take(6)->get();
        return view('pages.community', compact('baiDangs', 'baiNoiBats'));
    }

    public function getProfile()
    {
        $user = Auth::user();
        $baiDangs = BaiDang::with('loaiBaiDang', 'user')->where('user_id', $user->id)->orderby('created_at', 'desc')->get();
        $danhGias = DanhGia::with('phim', 'user')->where('user_id', $user->id)->orderby('created_at', 'desc')->get();
        return view('pages.profile', compact('user', 'baiDangs', 'danhGias'));
    }

    public function indexAdmin()
    {
        return view('admin.dashboard');
    }

    public function indexFilmStudio()
    {
        return view('hangphim.dashboard');
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $convertLowerCase = strtolower($keyword);
        $phims = Phim::whereRaw("LOWER(ten_chinh) LIKE '%" . $convertLowerCase . "%'")
            ->orWhereRaw("LOWER(ten_phu) LIKE '%" . $convertLowerCase . "%'")
            ->get();
        $baiDangs = BaiDang::where('tieu_de', 'like', '%' . $keyword . '%')->get();

        $popularPhims = Phim::leftJoin('danh_gias', function ($join) {
            $join->on('phims.id', '=', 'danh_gias.phim_id');
        })
            ->selectRaw('phims.id, phims.ten_chinh, phims.ten_phu, phims.anh_poster, AVG(danh_gias.diem) as diem_trung_binh')
            ->groupBy(['phims.id', 'phims.ten_chinh', 'phims.ten_phu', 'phims.anh_poster'])
            ->orderByDesc('diem_trung_binh')
            ->take(8)
            ->get();

        return view('pages.search', compact('phims', 'baiDangs', 'popularPhims'));
    }
}
