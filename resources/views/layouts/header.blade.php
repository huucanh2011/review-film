<div class="bg-light">
    <nav class="container navbar navbar-expand-lg">
        <form action="{{ route('search') }}" method="GET">
            <input type="search" name="keyword" class="form-control bg-white"
                placeholder="Tìm kiếm..." aria-describedby="button-search" style="width: 300px">
        </form>

        <ul class="navbar-nav ml-auto font-weight-normal text-capitalize">
            @guest
            <li class="nav-item">
                <a class="d-none d-sm-block btn btn-dark" role="button" data-toggle="modal" href="#modalLogin">Đăng nhập</a>
                <a class="d-sm-none nav-link" data-toggle="modal" href="#modalLogin"><i class="fas fa-sign-in-alt"></i></a>
            </li>
            @endguest
            
            @auth
            <li class="nav-item">
                <a class="nav-link text-dark" href="#modalPost" data-toggle="modal" role="button">Viết bài</a>
            </li>

            @can('is_admin_or_hangphim')
            <li class="nav-item">
                <a class="d-none d-sm-block nav-link text-dark" role="button"
                    @if(auth()->user()->quyen_id==1) href="{{ route('admin.dashboard') }}"
                    @else
                    @if(auth()->user()->quyen_id==2) href="{{ route('filmstudio.dashboard') }}" 
                    @endif @endif target="_blank">Quản trị
                </a>
                <a class="d-sm-none nav-link text-dark" role="button"
                    @if(auth()->user()->quyen_id==1) href="{{ route('admin.dashboard') }}"
                    @else
                    @if(auth()->user()->quyen_id==2) href="{{ route('filmstudio.dashboard') }}" 
                    @endif @endif target="_blank">
                    <i class="fas fa-user-cog"></i>
                </a>
            </li>
            @endcan

            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle text-dark" href="#" id="userDropdown" data-toggle="dropdown"
                role="button" aria-haspopup="true" aria-expanded="false">
                    <span class="font-weight-bold text-capitalize d-none d-lg-inline text-gray-600 mr-2">
                        {{ Auth::user()->ten_hien_thi }}
                    </span>
                    @if (is_null(Auth::user()->provider_name))
                        <img class="rounded-circle" src="upload/users/{{ Auth::user()->hinh_dai_dien }}"
                        style="width: 1.615rem">    
                    @else
                        <img class="rounded-circle" src="{{ Auth::user()->hinh_dai_dien }}"
                        style="width: 1.615rem">
                    @endif
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('profile') }}">Trang cá nhân</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}">Đăng xuất</a>
                </div>
            </li>
            @endauth
        </ul>
    </nav>
</div>

<div class="navbar-light bg-white border-bottom border-light shadow-sm">
    <nav class="container navbar navbar-expand-sm">
            
        <ul class="navbar-nav font-weight-normal text-uppercase">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="image/logo.svg" style="width: 2rem">
            </a>

            <div style="margin: 0 4px; width: 0; border-right: 1px solid #eee"></div>

            <li class="nav-item">
                <a class="d-none d-sm-block nav-link" href="{{ route('community') }}">Cộng đồng</a>
            </li>
            @guest
            <li class="nav-item">
                <a class="d-none d-sm-block nav-link" href="{{ route('cooperate.index') }}">Hợp tác</a>
            </li>
            @endguest         
            <li class="nav-item dropdown no-arrow">
                <a class="d-none d-sm-block nav-link dropdown-toggle" href="#" id="theloaiDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Thể loại
                </a>
                <div class="dropdown-menu" aria-labelledby="theloaiDropdown" style="min-width: 58rem">
                    <div class="row">
                        @foreach ($theLoais as $theLoai)
                            <div class="col-3">
                                <a class="dropdown-item" href="all-movies/?theloai={{ $theLoai->id }}">{{ $theLoai->ten_the_loai }}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown no-arrow">
                <a class="d-none d-sm-block nav-link dropdown-toggle" href="#" id="quocGiaDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Quốc Gia
                </a>
                <div class="dropdown-menu" aria-labelledby="quocGiaDropdown" style="min-width: 30rem">
                    <div class="row">
                        @foreach ($quocGias as $quocGia)
                            <div class="col-6">
                                <a class="dropdown-item" href="all-movies/?quocgia={{ $quocGia->id }}">{{ $quocGia->ten_quoc_gia }}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </li>
        </ul>
    </nav>
</div>

<!-- Modal Login -->
<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Đăng nhập</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div>@include('layouts.alert-custom')</div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Email"
                            value="{{old('email')}}" required>
                    </div> 
                    <div class="form-group">
                        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                            name="password" placeholder="Mật khẩu" required>
                        
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                            @if ($errors->has('g-recaptcha-response'))
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark btn-block btn-lg">Đăng nhập</button>
                    <div class="text-center my-2">Hoặc đăng nhập bằng</div>
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('auth.social', 'facebook') }}" class="btn btn-outline-primary btn-block">
                                <i class="fab fa-facebook-f"></i> Facebook
                            </a>
                        </div>
                        <div class="col">
                            <a href="{{ route('auth.social', 'google') }}" class="btn btn-outline-danger btn-block">
                                <i class="fab fa-google"></i> Google
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                Hoặc&nbsp;<a class="text-success mr-auto" data-toggle="modal" data-dismiss="modal" href="#modalSignup">Đăng ký ngay!</a>
                <a class="text-danger ml-auto" href="#">Quên mật khẩu?</a>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Login -->

<!-- Modal Signup -->
<div class="modal fade" id="modalSignup" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Đăng ký</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('register.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                            name="name" placeholder="Tên hiển thị" value="{{ old('name') }}" required>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                            name="email" placeholder="Email" value="{{ old('email') }}" required>
                        
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif                        
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                            name="password" placeholder="Mật khẩu" required>

                        @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif                    
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password_confirmation"
                            placeholder="Xác nhận mật khẩu" required>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                            @if ($errors->has('g-recaptcha-response'))
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark btn-block btn-lg">Đăng ký</button>
                </form>
            </div>
            <div class="modal-footer">
                Hoặc&nbsp;<a class="text-success mr-auto" data-toggle="modal" data-dismiss="modal" href="#modalLogin">Đăng nhập!</a>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Signup -->

@include('layouts.modal-post')