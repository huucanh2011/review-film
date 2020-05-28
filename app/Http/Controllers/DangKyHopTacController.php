<?php

namespace App\Http\Controllers;

use App\User;
use App\QuocGia;
use App\TheLoai;
use App\GoiDangKy;
use App\LoaiBaiDang;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DangKyHopTacController extends Controller
{
    public function __construct()
    {
        $loaiBaiDangs = LoaiBaiDang::all();
        $goiDangKys = GoiDangKy::all();
        $theLoais = TheLoai::all();
        $quocGias = QuocGia::all();

        view()->share(compact('loaiBaiDangs'));
        view()->share(compact('goiDangKys'));
        view()->share(compact('theLoais'));
        view()->share(compact('quocGias'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.dangkyhoptac');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'ten_hien_thi' => 'min:3|max:40',
                'email' => 'unique:users|min:3|max:255',
                'password' => 'confirmed|min:6'
                // 'hinh_dai_dien'
            ],
            [
                'ten_hien_thi.min' => 'Tên ít nhất :min ký tự',
                'ten_hien_thi.max' => 'Tên nhiều nhất :max ký tự',
                'email.unique' => 'Email này đã có người sử dụng',
                'email.min' => 'Email ít nhất :min ký tự',
                'email.max' => 'Email nhiều nhất :max ký tự',
                'password.confirmed' => 'Nhập lại mật khẩu chưa đúng',
                'password.min' => 'Mật khẩu ít nhất :min ký tự',
            ]
        );
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()->with(['error_dangkyhoptac' => 'Loi dang ky']);
        }

        $hinh_dai_dien = '';

        if ($request->hasFile('hinh_dai_dien')) {
            $file = $request->file('hinh_dai_dien');
            $name = $file->getClientOriginalName();
            $hinh_dai_dien = time() . '_' . Str::random(5) . '-' . $name;
            $file->move(public_path('upload/users'), $hinh_dai_dien);
        } else {
            $hinh_dai_dien = 'no-image.svg';
        }

        $user = new User;
        $user->email = $request->email;
        $user->ten_hien_thi = $request->ten_hien_thi;
        $user->password = Hash::make($request->password);
        $user->hinh_dai_dien = $hinh_dai_dien;
        $user->goidangky_id = $request->goi_dang_ky;
        $user->trang_thai = 2;
        $user->quyen_id = 2;
        $user->save();

        return back()->with(['thongbao' => 'Đăng ký thành công', 'type' => 'success']);
    }
}
