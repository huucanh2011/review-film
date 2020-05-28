@extends('layouts.index')
@section('content')
<section class="container">
    <!-- Hot -->
    <h4 class="font-weight-normal">Phim đang Hot</h4>
    <hr class="bg-light">
    <div class="row responsive1">
        @foreach($hotPhims as $phim)
        <div class="col-md-2 col-sm-6 col-6">
            <a class="text-decoration-none" href="{{ $phim->path() }}">
                <div class="card border border-0 ">
                <img src="upload/phim/{{ $phim->anh_poster }}" class="card-img-top rounded-lg" alt="{{ $phim->ten_chinh }}">
                <div class="card-body py-3 px-1">
                    <h6 class="card-title text-muted text-center">{{ $phim->ten_chinh }}</h6>
                </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    <!-- End Hot -->
</section>
<section class="container">
    <div class="row">
        <div class="col-md-8">
            <h4><a class="font-weight-normal text-dark" href="{{ route('all-movies') }}">Tất cả phim</a></h4>
            <hr class="bg-light">
            <div class="row">
                @foreach($allPhims as $phim)
                <div class="col-md-3 col-sm-6 col-6">
                    <a class="text-decoration-none" href="{{ $phim->path() }}">
                        <div class="card border border-0 ">
                        <img src="upload/phim/{{ $phim->anh_poster }}" class="card-img-top rounded-lg" alt="{{ $phim->ten_chinh }}">
                        <div class="card-body py-3 px-1">
                            <h6 class="card-title text-dark text-center">{{ $phim->ten_chinh }}</h6>
                        </div>
                        </div>
                    </a>
                </div>
                @endforeach
                <div class="col-12 text-center mt-2">
                    <a href="{{ route('all-movies') }}" class="btn btn-outline-dark rounded-pill">Xem thêm</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            @include('subpages.popular-phim')
        </div>
    </div>
</section>
<section class="container">
    <!-- News -->
    <h4 class="font-weight-normal">Tin tức</h4>
    <hr class="bg-light">
    <div class="row">
        <div class="card-deck">
        @foreach($tinTucs as $tinTuc)
        <div class="col-md-4">
        <a class="text-decoration-none" href="{{ $tinTuc->url() }}">
                <div class="card mx-0 my-3 rounded-lg border-0 shadow-sm" style="min-height: 18rem">
                <img src="upload/post/{{ $tinTuc->anh_poster }}" class="card-img-top" style="height: 11rem" alt="{{ $tinTuc->tieu_de }}">
                <div class="card-body py-1">
                    <p class="card-text text-dark">{{ $tinTuc->tieu_de }}</p>
                </div>
                <div class="card-footer border-top-0 bg-transparent">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="text-dark">{{ $tinTuc->user->ten_hien_thi }} &nbsp;<i class="font-weight-light text-muted">{{ date_format($tinTuc->created_at, 'd/m/Y') }}</i></h6>
                        <small class="font-weight-nomarl text-dark">{{ get_demLuotThich($tinTuc->id) }} điểm</small>
                    </div>
                </div>
                </div>
            </a>
        </div>
        @endforeach
        </div>
        <div class="col-md-12 text-center">
            <a class="btn btn-outline-dark rounded-pill" role="button" href="{{ route('community') }}">
                Xem thêm
            </a>
        </div>
    </div>
    <!-- End News -->
</section>

<section class="container my-3">
    <h4 class="font-weight-normal">Bài viết</h4>
    <hr class="bg-light">
    <div class="row">
        <div class="card-deck">
            @foreach($baiViets as $baiViet)
            <div class="col-md-4">
                <a class="text-decoration-none" href="{{ $baiViet->url() }}">
                    <div class="card mx-0 my-3 rounded-lg border-0 shadow-sm" style="min-height: 18rem">
                    <img src="upload/post/{{ $baiViet->anh_poster }}" class="card-img-top" style="height: 11rem" alt="{{ $baiViet->tieu_de }}">
                    <div class="card-body py-1">
                        <p class="card-text text-dark">{{ $baiViet->tieu_de }}</p>
                    </div>
                    <div class="card-footer border-top-0 bg-transparent">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="text-dark">{{ $baiViet->user->ten_hien_thi }} &nbsp;<i class="font-weight-light text-muted">{{ date_format($baiViet->created_at, 'd/m/Y') }}</i></h6>
                            <small class="font-weight-nomarl text-dark">{{ get_demLuotThich($baiViet->id) }} điểm</small>
                        </div>
                    </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <div class="col-md-12 text-center">
            <a class="btn btn-outline-dark rounded-pill" role="button" href="{{ route('community') }}">
                Xem thêm
            </a>
        </div>
    </div>
</section>
@endsection