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
    <link rel="stylesheet" href="{{ url('src/css/notifi.css') }}">
    <link rel="stylesheet" href="{{ url('src/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ url('src/lib/multiselect/multiselect.css') }}">
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
    <script src="{{ url('src/lib/multiselect/multiselect.min.js') }}"></script>
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
                    <h5 class="font-weight-bold text-primary text-center">Danh sách lớp thực hành <button data-toggle="modal" data-target="#AddClass" class="btn_contrl text-primary" data-toggle="tooltip" title="Đề nghị mở lớp thực hành mới"><i class="fas fa-plus-circle"></i></button></h5>
                </div>
                <div class="col-lg-12 main">
                    <table id="example" class="mdl-data-table table-responsive" style="width:100%">
                        <thead>
                            <tr>
                                
                                <th>Mã lớp</th>
                                <th>Tên lớp</th>
                                <th>Tín chỉ</th>
                                <th>Số tiết TH</th>
                                <th>Học kỳ</th>
                                <th>Năm học</th>
                                <th>Số lượng SV</th>
                                <th>Trạng thái</th>
                                <th>Control</th>
                                <!-- <th>Control</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lophp as $lhp)
                                @if($lhp->id_account == Auth::user()->id)
                            <tr>
                                <td>{{$lhp->real_ma_lhp}}</td>
                                <td>{{$lhp->ten_lophp }}</td>
                                <td>{{$lhp->tin_chi  }}</td>
                                <td>{{$lhp->so_tiet_th}}</td>
                                <td>{{$lhp->ky_hieu }}</td>
                                <td>{{$lhp->nien_khoa }}</td>
                                <td>{{$lhp->so_luong_sv }}</td>
                                <td>
                                    @if($lhp->status == 1)
                                    <span class="badge badge-pill badge-success px-4 py-2">Đang mở</span>
                                    @else
                                    <span class="badge badge-pill badge-danger px-4 py-2">Chờ Duyệt</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn_contrl btn_edit"><span class="text-success"><i class="fas fa-pen"></i></span></button>
                                </td>  
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                
                                <th>Mã lớp</th>
                                <th>Tên lớp</th>
                                <th>Tín chỉ</th>
                                <th>Số tiết TH</th>
                                <th>Học kỳ</th>
                                <th>Năm học</th>
                                <th>Số lượng SV</th>
                                <th>Trạng thái</th>
                                <th>Control</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="AddClass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title text-primary">Đề nghị mở lớp thực hành mới</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('addYeucaulth') }}" class="row" method="POST">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                        <div class="form-group col-12 col-sm-4 col-md-4 col-lg-3 align-self-center pr-0">
                            <i class="fas fa-door-open font-weight-bold text-secondary"></i>
                            <span class="font-weight-bold text-secondary">Mã lớp học phần</span>
                        </div>
                        <div class="form-group col-12 col-sm-8 col-md-8 col-lg-9">
                            <select name="mhp" id="mhp" class="custom_select">
                                @foreach($lophp as $lhp)
                                @foreach($macanbo as $mcb)
                                @if($mcb->ma_canbo == $lhp->ma_canbo)
                                <option value="{{$lhp->ma_lophp}}">{{$lhp->real_ma_lhp}} - {{$lhp->ten_lophp}} ({{$lhp->tin_chi}} Tín chỉ | Học kỳ {{$lhp->ky_hieu}} - {{$lhp->nien_khoa}})</option>
                                @endif
                                @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div class="line"></div>
                        <div class="form-group col-12 col-sm-8 col-md-8 col-lg-9">
                            <i class="fab fa-accusoft font-weight-bold text-secondary mt-2"></i>
                            <span class="font-weight-bold text-secondary my-4 "> Yêu cầu phần mềm</span>
                            <div class="selectgroup selectgroup-pills mt-2">
                                @foreach($phanmem as $pm)
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="pm[]" value="{{$pm->id_pm}}" class="selectgroup-input">
                                    <span class="selectgroup-button">{{$pm->ten_pm}} - Version: {{$pm->version}}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group col-4 col-sm-4 col-md-4 col-lg-4">
                            <label for="thu" class="pr-1">Thứ</label> <!-- dotw = Days of the week -->
                            <select name="thu" id="thu" class="custom_select">
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="CN">CN</option>
                            </select>
                        </div>
                        <div class="form-group col-4 col-sm-4 col-md-4 col-lg-4">
                            <label for="buoi" class="pr-1">Buổi</label> <!-- dotw = Days of the week -->
                            <select name="buoi" id="buoi" class="custom_select">
                                <option value="Sáng">Sáng</option>
                                <option value="Chiều">Chiều</option>
                                <option value="Tối">Tối</option>
                            </select>
                        </div>
                        <div class="form-group col-12 col-sm-8 col-md-8 col-lg-9">
                            <i class="fab fa-accusoft font-weight-bold text-secondary mt-2"></i>
                            <span class="font-weight-bold text-secondary my-4 "> Yêu cầu phần mềm</span>
                            <div class="selectgroup selectgroup-pills mt-2">
                                @foreach($tuan as $t)
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="tuan[]" value="{{$t->id_tuan}}" class="selectgroup-input">
                                    <span class="selectgroup-button">{{$t->stt_tuan }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <button type="submit" class="btn btn-primary  mr-2 float-right"><i class="fas fa-paper-plane"></i> Gửi yêu cầu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ url('/src/admin/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
        $(".img_menu3").addClass("menu_active");
        $(".p_menu3").removeClass("text-secondary");
        $(".p_menu3").addClass("text-danger");

        $('#example').DataTable({
            columnDefs: [{
                targets: [0, 1, 2],
                className: 'mdl-data-table__cell--non-numeric'
            }]
        });
        $('#selectSofware').multiselect();
        $('#testSelect1').multiselect();
    });
    </script>
    <script>
    function noti(type, message) {
        var placementFrom = "top";
        var placementAlign = "right";
        var state = type;
        var style = "withicon";
        var content = {};

        content.message = message;
        content.title = 'Thông báo';
        if (style == "withicon") {
            content.icon = 'fa fa-bell';
        } else {
            content.icon = 'none';
        }
        $.notify(content, {
            type: state,
            placement: {
                from: placementFrom,
                align: placementAlign
            },
            time: 1000,
            delay: 3000,
        });
    }

    </script>
    @if(Session::has('Added'))
    <script>
        noti("success", "Thêm thành công!");
    </script>
    @endif
    @if(Session::has('AddError'))
    <script>
        noti("danger", "Thêm thất bại!");
    </script>
    @endif
</body>

</html>
