<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="" type="image/x-icon">
    <title>Hệ thống lịch thực hành - CIT</title>
    <!--CSS-->
    <link rel="stylesheet" href="{{ url('src/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('src/css/user.css') }}">
    <link rel="stylesheet" href="{{ url('src/lib/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('src/lib/datatable/material.min.css') }}">
    <link rel="stylesheet" href="{{ url('src/lib/datatable/dataTables.material.min.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!--JS-->
    <script src="{{ url('src/lib/jquery/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ url('src/lib/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('src/lib/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ url('src/lib/popper/popper.min.js') }}"></script>
    <script src="{{ url('src/lib/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('src/lib/datatable/dataTables.material.min.js') }}"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
    @include('layouts.header')
    <section id="sec1" class="mt-5">
        <div class="container justify-content-center main pt-1">
            <div class="row">
                @include('layouts.teacher_menu')
                <div class="line"></div>
                <div class="col-lg-12 main pt-4">
                    <h5 class="font-weight-bold text-primary text-center">Lịch thực hành của bạn</h5>
                </div>
                  <div class="container justify-content-center main pt-1">
            @foreach($now_hk as $nhk)
            <h4 class="text-center font-weight-bold text-uppercase text-secondary py-2">Lịch thực hành - Học Kỳ {{$nhk->ky_hieu}} ({{$nhk->nien_khoa}})</h4>
            @break
            @endforeach
            <hr>
            <ul class="nav nav-tabs nav-justified justify-content-center text-center tabs_week">
                @foreach($now_hk as $nhk)
                <li><a data-toggle="tab" href="#t{{$nhk->id_tuan}}" class="w_{{$loop->iteration}}">{{$nhk->stt_tuan}}</a></li>
                @endforeach
            </ul>
            <div class="tab-content pb-3">
                @foreach($now_hk as $nhk)
                <div id="t{{$nhk->id_tuan}}" class="tab-pane fade">
                    <h5 class="text-left py-2">{{$nhk->stt_tuan}} ({{$nhk->ngay_bd}} <i class="fas fa-arrow-right"></i> {{$nhk->ngay_kt}})</h5>
                    <table class="mt-2 table table-bordered table-responsive text-center">
                        <thead>
                            <tr>
                                <th scope="col">Buổi</th>
                                <th scope="col">Phòng</th>
                                <th scope="col">Thứ 2</th>
                                <th scope="col">Thứ 3</th>
                                <th scope="col">Thứ 4</th>
                                <th scope="col">Thứ 5</th>
                                <th scope="col">Thứ 6</th>
                                <th scope="col">Thứ 7</th>
                                <th scope="col">CN</th>
                            </tr>
                        </thead>
                        <tbody>

                            <td rowspan="{{count($phong)+1}}" class="font-weight-bold text-primary align-middle">SÁNG</td>
                            
                            @foreach($phong as $p)
                            <tr>

                                <th scope="row" class="align-middle">{{$p->ten_phong}}</th>
                                <td class="align-middle">
                                    @foreach($alldatasang as $all)
                                    @if($all->thu == "2" && $all->buoi =="Sáng" && $all->id_phong == $p->id_phong && $all->id_tuan == $nhk->id_tuan)
                                    <b>{{$all->real_ma_lhp}}</b><br> {{$all->ten_cb}}
                                    @else

                                    @endif

                                    @endforeach
                                </td>
                                <td class="align-middle">
                                    @foreach($alldatasang as $all)
                                    @if($all->thu == "3" && $all->buoi =="Sáng" && $all->id_phong == $p->id_phong && $all->id_tuan == $nhk->id_tuan)
                                    <b>{{$all->real_ma_lhp}}</b><br> {{$all->ten_cb}}
                                    @else

                                    @endif

                                    @endforeach
                                </td>
                                <td class="align-middle">
                                    @foreach($alldatasang as $all)
                                    @if($all->thu == "4" && $all->buoi =="Sáng" && $all->id_phong == $p->id_phong && $all->id_tuan == $nhk->id_tuan)
                                    <b>{{$all->real_ma_lhp}}</b><br> {{$all->ten_cb}}
                                    @else

                                    @endif

                                    @endforeach
                                </td>
                                <td class="align-middle">
                                    @foreach($alldatasang as $all)
                                    @if($all->thu == "5" && $all->buoi =="Sáng" && $all->id_phong == $p->id_phong && $all->id_tuan == $nhk->id_tuan)
                                    <b>{{$all->real_ma_lhp}}</b><br> {{$all->ten_cb}}
                                    @else

                                    @endif

                                    @endforeach
                                </td>
                                <td class="align-middle">
                                    @foreach($alldatasang as $all)
                                    @if($all->thu == "6" && $all->buoi =="Sáng" && $all->id_phong == $p->id_phong && $all->id_tuan == $nhk->id_tuan)
                                    <b>{{$all->real_ma_lhp}}</b><br> {{$all->ten_cb}}
                                    @else

                                    @endif

                                    @endforeach
                                </td>
                                <td class="align-middle">
                                    @foreach($alldatasang as $all)
                                    @if($all->thu == "7" && $all->buoi =="Sáng" && $all->id_phong == $p->id_phong && $all->id_tuan == $nhk->id_tuan)
                                    <b>{{$all->real_ma_lhp}}</b><br> {{$all->ten_cb}}
                                    @else

                                    @endif

                                    @endforeach
                                </td>
                                <td class="align-middle">
                                    @foreach($alldatasang as $all)
                                    @if($all->thu == "CN" && $all->buoi =="Sáng" && $all->id_phong == $p->id_phong && $all->id_tuan == $nhk->id_tuan)
                                    <b>{{$all->real_ma_lhp}}</b><br> {{$all->ten_cb}}
                                    @else

                                    @endif

                                    @endforeach
                                </td>
                            </tr>
                            @endforeach
                            
                       <!--      <tr>
                                <td colspan="9" class="bg-secondary"></td>
                            </tr>
                            <tr>
                                <td rowspan="{{count($phong)+1}}" class="font-weight-bold text-primary align-middle">CHIỀU</td>
                            </tr>
                            @foreach($phong as $p)
                            <tr>
                                <th scope="row" class="align-middle">{{$p->ten_phong}}</th>
                                <td class="align-middle"><b>CT18102</b> <br> Thầy PN Quyền</td>
                                <td class="align-middle">CT18102 <br> Thầy PN Quyền</td>
                                <td class="align-middle">CT18102 <br> Thầy PN Quyền</td>
                                <td class="align-middle"><button class="btn-primary">Đăng ký</button></td>
                                <td class="align-middle">CT18102 <br> Thầy PN Quyền</td>
                                <td class="align-middle">CT18102 <br> Thầy PN Quyền</td>
                                <td class="align-middle">CT18102 <br> Thầy PN Quyền</td>
                            </tr>
                            @endforeach -->

                            <td rowspan="{{count($phong)+1}}" class="font-weight-bold text-primary align-middle">CHIỀU</td>
                            
                            @foreach($phong as $p)
                            <tr>

                                <th scope="row" class="align-middle">{{$p->ten_phong}}</th>
                                <td class="align-middle">
                                    @foreach($alldatachieu as $all)
                                    @if($all->thu == "2" && $all->buoi =="Sáng" && $all->id_phong == $p->id_phong && $all->id_tuan == $nhk->id_tuan)
                                    <b>{{$all->real_ma_lhp}}</b><br> {{$all->ten_cb}}
                                    @else

                                    @endif

                                    @endforeach
                                </td>
                                <td class="align-middle">
                                    @foreach($alldatachieu as $all)
                                    @if($all->thu == "3" && $all->buoi =="Sáng" && $all->id_phong == $p->id_phong && $all->id_tuan == $nhk->id_tuan)
                                    <b>{{$all->real_ma_lhp}}</b><br> {{$all->ten_cb}}
                                    @else

                                    @endif

                                    @endforeach
                                </td>
                                <td class="align-middle">
                                    @foreach($alldatachieu as $all)
                                    @if($all->thu == "4" && $all->buoi =="Sáng" && $all->id_phong == $p->id_phong && $all->id_tuan == $nhk->id_tuan)
                                    <b>{{$all->real_ma_lhp}}</b><br> {{$all->ten_cb}}
                                    @else

                                    @endif

                                    @endforeach
                                </td>
                                <td class="align-middle">
                                    @foreach($alldatachieu as $all)
                                    @if($all->thu == "5" && $all->buoi =="Sáng" && $all->id_phong == $p->id_phong && $all->id_tuan == $nhk->id_tuan)
                                    <b>{{$all->real_ma_lhp}}</b><br> {{$all->ten_cb}}
                                    @else

                                    @endif

                                    @endforeach
                                </td>
                                <td class="align-middle">
                                    @foreach($alldatachieu as $all)
                                    @if($all->thu == "6" && $all->buoi =="Sáng" && $all->id_phong == $p->id_phong && $all->id_tuan == $nhk->id_tuan)
                                    <b>{{$all->real_ma_lhp}}</b><br> {{$all->ten_cb}}
                                    @else

                                    @endif

                                    @endforeach
                                </td>
                                <td class="align-middle">
                                    @foreach($alldatachieu as $all)
                                    @if($all->thu == "7" && $all->buoi =="Sáng" && $all->id_phong == $p->id_phong && $all->id_tuan == $nhk->id_tuan)
                                    <b>{{$all->real_ma_lhp}}</b><br> {{$all->ten_cb}}
                                    @else

                                    @endif

                                    @endforeach
                                </td>
                                <td class="align-middle">
                                    @foreach($alldatachieu as $all)
                                    @if($all->thu == "CN" && $all->buoi =="Sáng" && $all->id_phong == $p->id_phong && $all->id_tuan == $nhk->id_tuan)
                                    <b>{{$all->real_ma_lhp}}</b><br> {{$all->ten_cb}}
                                    @else

                                    @endif

                                    @endforeach
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
                @endforeach
            </div>
        </div>
            </div>
        </div>
    </section>
    <footer>
    	<div class="row text-center justify-content-center py-4 mx-0">
    		<div class="col-6 col-sm-6 col-md-4 col-lg-2">
    			<img src="src/images/logo-ctu.png" alt="" width="50%">
    		</div>
    		<div class="col-12 col-sm-12 col-md-6 col-lg-6 align-self-center">
    			<p class="mb-0 font-weight-bold">Khoa Công nghệ Thông tin & Truyền thông - Trường Đại học Cần Thơ</p>
    			<small class="mb-0">Khu 2, đường 3/2, Phường Xuân Khánh, Q. Ninh Kiều, TP. Cần Thơ, Việt Nam</small>
    			<br>
    			<small class="mb-0">Điện thoại: 84 0292 3 734713 - 0292 3 831301; Fax: 84 0292 3830841; Email: office@cit.ctu.edu.vn</small>
    		</div>
    		<div class="col-12 col-sm-12 col-md-6 col-lg-2">
    			<img src="src/images/logo.png" alt="" width="50%">
    			<p>Copyright © 2019 | Practice Manager of CIT</p>
    		</div>
    	</div>
    </footer>
    <script>
    $(document).ready(function() {
        $(".img_menu4").addClass("menu_active");
        $(".p_menu4").removeClass("text-secondary");
        $(".p_menu4").addClass("text-danger");
        $(".t1").click();
        $('#tbl').DataTable();
    });
    </script>
</body>

</html>