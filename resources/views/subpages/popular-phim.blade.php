<h4 class="font-weight-normal">Phim xem nhiều</h4>
<hr class="bg-light">
<div style="height: 650px; overflow-y: auto;">
  <ul class="list-group">
      @foreach ($popularPhims as $phim)
      <li class="list-group-item">
          <a class="text-decoration-none text-dark" href="{{ $phim->path() }}">
              <div class="card border border-0">
                  <div class="card-boby">
                      <div class="row">
                          <div class="col-5">
                              <img src="upload/phim/{{ $phim->anh_poster }}" class="w-100 rounded-lg" alt="{{ $phim->ten_chinh }}">
                          </div>
                          <div class="col-7">
                              <div><strong>{{ $phim->ten_chinh }}</strong></div>
                              <div>{{ $phim->ten_phu }}</div>
                              <div>Đánh giá: {{ get_ratingformat($phim->diem_trung_binh) }}<i class="fas fa-star text-warning"></i></div>
                          </div>
                      </div>
                  </div>        
              </div>
          </a>
      </li>    
      @endforeach
  </ul>
</div>