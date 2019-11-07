<!DOCTYPE html>
<html lang="en">

<head>
    <base href="{{asset('')}}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="src/images/favicon.png" type="image/x-icon">
    <title>Hệ thống lịch thực hành - CIT</title>
    <!--CSS-->
    <link rel="stylesheet" href="src/css/style.css">
    <link rel="stylesheet" href="src/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!--JS-->
    <script src="src/lib/jquery/jquery-3.4.1.min.js"></script>
    <script src="src/lib/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="src/lib/bootstrap/bootstrap.min.js"></script>
    <script src="src/lib/popper/popper.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
    @include('layouts.header')
    <section id="sec1" class="mt-5">

        @if(Session::has('message'))
        <div class="alert alert-success">{{Session::get('message')}}</div>
        @endif
        @if(Session::has('loi'))
        <div class="alert alert-danger">{{Session::get('loi')}}</div>
        @endif
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

                            <tr>
                                <td colspan="9" class="bg-secondary"></td>
                            </tr>

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

        <div class="modal fade" id="feedback" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h3 class="modal-title text-secondary">Thêm lớp học phần mới</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/addFeedback" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}" />

                            <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                <label for="selectMON" class="placeholder">Lớp học phần</label>
                                <select class="form-control input-border-bottom" id="selectMON" name="mon" required>
                                    @foreach($monhoc as $mon)
                                    <option value="{{$mon->ma_mon}}">{{$mon->ma_mon}} - {{$mon->ten_mon}}</option>
                                    @endforeach 
                                </select>
                            </div>
                            <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                <label for="chude" class="placeholder">Chủ đề phản hồi</label>
                                <input id="malhp" name="ten_phanhoi" type="text" class="form-control input-border-bottom" required></textarea> 
                            </div>
                            <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                <label for="nd" class="placeholder">Nội dung phản hồi</label>
                                <textarea id="malhp" name="noidung_phanhoi" type="text" class="form-control input-border-bottom" required></textarea>
                            </div>
                            <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                <label for="mau_don" class="placeholder">Tệp đính kèm</label>
                                <input class="form-control" type="file" name="mau_don" placeholder="Chọn file" required>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center mt-3">
                                <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-paper-plane"></i> Gửi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="watchFeedback" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title text-secondary">Danh sách phản hồi <span></span></h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{-- {{ route('addSV_LHP') }} --}}" method="POST">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                            <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12" id="selectsv">
                                <table id="#" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>MSSV</th>
                                            <th>Họ tên SV</th>
                                            <th>Mã lớp HP</th>
                                            <th>Tên lớp HP</th>
                                            <th>Tên phản hồi</th>
                                            <th>Nội dung</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($phanhoi as $ph)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$ph->mssv}}</td>
                                            <td>{{$ph->ten_sv}}</td>
                                            <td>{{$ph->ma_lophp}}</td>
                                            <td>{{$ph->ten_lophp}}</td>
                                            <td>{{$ph->ten_phanhoi}}</td>
                                            <td>{{$ph->noidung_phanhoi}}</td>
                                            <td>
                                                @if($ph->status == 1)
                                                <span class="badge badge-pill badge-success px-4 py-2 ">Chấp nhận</span>
                                                @else
                                                <span class="badge badge-pill badge-danger px-4 py-2 ">Chưa Duyệt</span>
                                                @endif
                                            </td>  
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>STT</th>
                                            <th>MSSV</th>
                                            <th>Họ tên SV</th>
                                            <th>Mã lớp HP</th>
                                            <th>Tên lớp HP</th>
                                            <th>Tên phản hồi</th>
                                            <th>Nội dung</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center mt-3">
                                <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-plus"></i> Thêm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $(".w_1").click();
        // $('#tbl').DataTable();
    });
</script>


</body>

</html>