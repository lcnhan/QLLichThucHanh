{{-- @extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
--}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="" type="image/x-icon">
    <base href="{{asset('')}}">
    <title>Hệ thống lịch thực hành - CIT</title>
    <!--CSS-->
    <link rel="stylesheet" href="src/css/login.css">
    <link rel="stylesheet" href="src/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!--JS-->
    <script src="src/lib/jquery/jquery-3.4.1.min.js"></script>
    <script src="src/lib/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="src/lib/bootstrap/bootstrap.min.js"></script>
    <script src="src/lib/popper/popper.min.js"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container h-100 d-flex justify-content-center">
        <div class="my-auto w-75 text-center">
            <div class="login_panel mt-3 row">
                <div class="left_pn col-12 col-sm-12 col-md-6 col-lg-6 bg-light my-auto">
                    <div class="lockicon mx-auto"></div>
                    <p class="title">Hệ thống lịch thực hành</p>
                    <!-- <p class="des">Khoa CNTT&TT - Đại Học Cần Thơ</p> -->
                    <br>
                    <small>Bạn đã có tài khoản? <a class="font-weight-bold" href="{{ url('login') }}">ĐĂNG NHẬP</a></small>
                </div>
                <div class="right_pn col-12 col-sm-12 col-md-6 col-lg-6">
                    <p class="title">ĐĂNG KÝ</p>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group d-none">
                            <label for="name" class="text-white font-weight-bold align-self-end mr-2"><i class="fas fa-user"></i></label>
                            <input id="name" type="text" name="name">
                            <div class="bg1"></div>
                        </div>
                        <div class="form-group d-flex">
                            <label for="email" class="text-white font-weight-bold align-self-end mr-2"><i class="fas fa-envelope-open"></i></label>
                            <input id="email" type="email" placeholder="@error('email') ✖ {{ $message }}  @else Email (abc@email.com)  @enderror" class="form-control @error('email') is-invalid @enderror" required name="email" onchange="getName()">
                            <div class="bg1"></div>
                        </div>
                        <div class="form-group d-flex">
                            <label for="pass1" class="text-white font-weight-bold align-self-end mr-2"><i class="fas fa-key"></i></label>
                            <input id="pass1" type="password" placeholder="@error('password') ✖ {{ $message }} @else Password (At least 8 characters long) @enderror" class="form-control @error('password') is-invalid @enderror" required name="password">
                            <div class="bg2"></div>
                        </div>
                        <div class="form-group d-flex">
                            <label for="pass2" class="text-white font-weight-bold align-self-end mr-2"><i class="fab fa-keycdn"></i></label>
                            <input id="pass2" type="password" placeholder=" Retype Password" class="form-control" name="password_confirmation" required autocomplete="new-password" >
                            <div class="bg2"></div>
                        </div>
                        <div class="form-group mt-4">
                            <button class="btn_login" type="submit">Register <i class="fas fa-arrow-right"></i></button>
                        </div>
                        <small><a href="#" data-toggle="modal" data-target="#TermsOfUse">Điều khoản sử dụng</a></small>
                    </form>
                </div>
            </div>
            <div class="fixed-bottom">
                <h6 class="text-white">Khoa Công nghệ Thông tin & Truyền thông - Trường Đại học Cần Thơ</h6>
                <small class="text-white font-weight-bold">Copyright © 2019 <a href="http://elcit.ctu.edu.vn">ELCIT</a> All Rights Reserved</h6>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="TermsOfUse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary">Terms Of Use</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6 class="text-secondary font-weight-bold">Tài khoản đăng nhập phải là email thuộc <strong class="text-primary">Trường Đại Học Cần Thơ</strong>, cụ thể:</h6>
                    <p class="text-secondary"><small>▫</small><strong class="text-primary"> Đối với Giảng Viên:</strong> Chỉ bao gồm tài khoản Cán bộ Giảng Viên thuộc Khoa Công nghệ Thông tin & Truyền thông.</p>
                    <p class="text-secondary"><small>▫</small><strong class="text-primary"> Đối với Sinh Viên:</strong> Bao gồm tất cả sinh viên có email thuộc Trường Đại học Cần Thơ. </p>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function getName(){
        var email = document.getElementById('email').value;
        var name   = email.substring(0, email.lastIndexOf("@"));
        document.getElementById('name').value = name;
    }
</script>
</html>
