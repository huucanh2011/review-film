@extends('layouts.index')
@section('content')
<div class="container">
    <h4 class="font-weight-normal">Tất cả phim</h4>
    <hr>
    <div class="form-inline my-3">
        <input type="text" class="form-control mr-2" placeholder="Tìm theo tên" style="width: 200px">
        <label for="theLoai">Thể loại</label>
        <select class="form-control mx-2" name="theLoai" id="theLoai" style="width: 200px">
            <option selected>Chọn</option>
            @foreach ($theLoais as $theLoai)
                <option value="{{ $theLoai->id }}">{{ $theLoai->ten_the_loai }}</option>
            @endforeach
        </select>
        <label for="quocGia">Quốc gia</label>
        <select class="form-control mx-2" name="quocGia" id="quocGia" style="width: 200px">
            <option selected>Chọn</option>
            @foreach ($quocGias as $quocGia)
                <option value="{{ $quocGia->id }}">{{ $quocGia->ten_quoc_gia }}</option>
            @endforeach
        </select>
        <button class="btn btn-primary ml-3" style="width: 100px">Lọc</button>
    </div>
    <div id="all-phim">
        <div class="card-deck row">
            @foreach($allPhim as $phim)
            <div class="col-lg-2 col-md-4">
                <a class="text-decoration-none" href="{{ $phim->path() }}">
                    <div class="card border border-0 m-0">
                        <img class="card-img-top rounded-lg" src="upload/phim/{{ $phim->anh_poster }}">
                        <div class="card-body py-3 px-1">
                            <h6 class="card-title text-center text-muted">{{ $phim->ten_chinh }}</h6>
                        </div>
                    </div>
                </a>
            </div>        
            @endforeach
        </div>
    </div>
    <div class="col-md-12">
        <ul class="pagination justify-content-center" style="margin:20px 0">
            <li class="page-item">{!! $allPhim->links() !!}</li>
        </ul>
    </div>
</div>
@endsection

@push('script')
    <script>
        $(function () {
            // $('#all-phim').load('ajax/all-phim');

            $('body').on('change', '#js-sap-xep-phim', function (e) {
                e.preventDefault();
                var value = $(this).val();

                $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "get",
                    url: "ajax/sort-film",
                    data: { value : value },
                    success: function (response) {
                        console.log(response);
                        
                    }
                });
            });
        });
    </script>
@endpush