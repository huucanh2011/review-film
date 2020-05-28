<?php

namespace App\Http\Controllers\API;

use App\Phim;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChatBotController extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->type) {
            switch ($request->type) {
                case 'new':
                    $phims = Phim::latest();
                    break;
                case 'hot':
                    $phims = Phim::hot();
                    break;
                case 'popular':
                    $phims = Phim::leftJoin('danh_gias', function ($join) {
                        $join->on('phims.id', '=', 'danh_gias.phim_id');
                    })
                        ->selectRaw('phims.id, phims.ten_chinh, phims.anh_poster, AVG(danh_gias.diem) as diem_trung_binh')
                        ->groupBy(['phims.id', 'phims.ten_chinh', 'phims.ten_phu', 'phims.anh_poster'])
                        ->orderByDesc('diem_trung_binh');
                    break;
            }

            $phims = $phims->take(6)->get(['id', 'ten_chinh', 'anh_poster']);

            foreach ($phims as $phim) {
                $id = $phim['id'];
                $tenSlug = Str::slug($phim['ten_chinh']);
                $phim['slug'] = $id . '-' . $tenSlug;
            }

            return response()->json($phims, 200);
        }
    }
}
