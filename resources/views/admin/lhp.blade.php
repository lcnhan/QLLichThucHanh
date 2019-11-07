<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>PMCIT Admin Dashboard</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="../src/admin/assets/img/icon.ico" type="image/x-icon" />
    <base href="{{asset('')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Fonts and icons -->
    <script src="../src/admin/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
			google: {"families":["Roboto:300,400,700,900"]},
			custom: {"families":["Roboto", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../src/admin/assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
    <!-- CSS Files -->
    <link rel="stylesheet" href="../src/admin/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/admin/assets/css/atlantis.min.css">
    <link rel="stylesheet" href="../src/admin/assets/css/custom.css">
    <link rel="stylesheet" href="../src/admin/assets/css/preloader.css">
    <link rel="stylesheet" href="../src/lib/gijgo/gijgo.min.css">
</head>

<body>
    <div class="preloader">
        <div class="preloader-container">
            <span class="animated-preloader"></span>
        </div>
    </div>
    <div class="wrapper sidebar_minimize">
        @include('admin.layouts.nav')
        <!-- End Sidebar -->
        <div class="main-panel">
            <div class="content">
                <div class="panel-header bg-primary-gradient">
                    <div class="page-inner py-5">
                        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                            <div>
                                <h2 class="text-white pb-2 fw-bold">Danh sách lớp học phần</h2>
                            </div>
                            <div class="ml-md-auto py-2 py-md-0">
                                <a href="#" data-toggle="modal" data-target="#Add" class="btn btn-secondary btn-round">Thêm <i class="fas fa-plus-circle"></i></a>
                                <a href="#" data-toggle="modal" data-target="#Import" class="btn btn-secondary btn-round">Nhập từ Excel <i class="fas fa-file-excel"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner mt--5">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="basic-datatables" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">STT</th>
                                                    <th>Mã lớp</th>
                                                    <th>Tên lớp</th>
                                                    <th>Số buổi thực hành</th>
                                                    <th>Số lượng sinh viên</th>
                                                    <th>Cán bộ phụ trách</th>
                                                    <th>Môn học</th>
                                                    <th>Học kỳ</th>
                                                    <th class="text-center">Control</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th class="text-center">STT</th>
                                                    <th>Mã lớp</th>
                                                    <th>Tên lớp</th>
                                                    <th>Số buổi thực hành</th>
                                                    <th>Số lượng sinh viên</th>
                                                    <th>Cán bộ phụ trách</th>
                                                    <th>Môn học</th>
                                                    <th>Học kỳ</th>
                                                    <th class="text-center">Control</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                @foreach($lophp as $lhp)
                                                <tr>
                                                    <td class="text-center">{{$loop->iteration}}</td>
                                                    <td>{{$lhp->real_ma_lhp}}</td>
                                                    <td><a href="{{ url('dssv/'.$lhp->ma_lophp) }}">{{$lhp->ten_lophp}}</a></td>
                                                    <td>{{$lhp->so_buoi_th}}</td>
                                                    <td>{{$lhp->so_luong_sv}}</td>
                                                    <td>{{$lhp->ten_cb}}</td>
                                                    <td>{{$lhp->ma_mon}} - {{$lhp->ten_mon}}</td>
                                                    <td>Học kỳ {{$lhp->ky_hieu}} ({{$lhp->nien_khoa}})</td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn_control text-primary" data-toggle="modal" data-target="#edit" onclick="editData('{{$lhp->ma_lophp}}'); changePName('{{$lhp->real_ma_lhp}}', '{{$lhp->ten_lophp}}', '{{$lhp->ma_mon}}', '{{$lhp->so_buoi_th}}', '{{$lhp->ma_canbo}}', '{{$lhp->id_hk}}', '{{$lhp->thu}}', '{{$lhp->tietbd}}' );">
                                                            <i class="fas fa-pen"></i>
                                                        </button>
                                                        <button type="button" class="btn_control text-danger" onclick="deleteData('{{$lhp->ma_lophp}}')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form action="" id="deleteForm" method="get" hidden></form>
            <!-- Modal Add-->
            <div class="modal fade" id="Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h3 class="modal-title text-secondary">Thêm lớp học phần mới</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('addLHP') }}" method="POST">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="selectMON" class="placeholder">Môn</label>
                                    <select class="form-control input-border-bottom" id="selectMON" name="mon" required>
                                        @foreach($monhoc as $mon)
                                            <option value="{{$mon->ma_mon}}">{{$mon->ma_mon}} - {{$mon->ten_mon}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="malhp" class="placeholder">Mã lớp học phần</label>
                                    <input id="malhp" name="malhp" type="text" class="form-control input-border-bottom" required>
                                </div>
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="tenlhp" class="placeholder">Tên lớp học phần</label>
                                    <input id="tenlhp" name="tenlhp" type="text" class="form-control input-border-bottom" required>
                                </div>
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="buoith" class="placeholder">Số buổi thực hành</label>
                                    <input id="buoith" name="buoith" type="number" max="60" min="1" class="form-control input-border-bottom" required>
                                </div>
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="selectCB" class="placeholder">Cán bộ giảng viên</label>
                                    <select class="form-control input-border-bottom" id="selectCB" name="cb" required>
                                        @foreach($canbo as $cb)
                                            <option value="{{$cb->ma_canbo}}">{{$cb->ma_canbo}} - {{$cb->ten_cb}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="selectHK" class="placeholder">Học kỳ</label>
                                    <select class="form-control input-border-bottom" id="selectHK" name="hk" required>
                                        @foreach($hocky as $hk)
                                            <option value="{{$hk->id_hk}}">Học kỳ {{$hk->ky_hieu}} ({{$hk->nien_khoa}})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="selectTHU" class="placeholder">Thứ</label>
                                    <select class="form-control input-border-bottom" id="selectTHU" name="thu" required>
                                        <option value="2">Thứ 2</option>
                                        <option value="3">Thứ 3</option>
                                        <option value="4">Thứ 4</option>
                                        <option value="5">Thứ 5</option>
                                        <option value="6">Thứ 6</option>
                                        <option value="7">Thứ 7</option>
                                        <option value="cn">Chủ Nhật</option>
                                    </select>
                                </div>
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="selectTIET" class="placeholder">Tiết bắt đầu</label>
                                    <select class="form-control input-border-bottom" id="selectTIET" name="tiet" required>
                                        <option value="1">Tiết 1</option>
                                        <option value="2">Tiết 2</option>
                                        <option value="3">Tiết 3</option>
                                        <option value="4">Tiết 4</option>
                                        <option value="5">Tiết 5</option>
                                        <option value="6">Tiết 6</option>
                                        <option value="7">Tiết 7</option>
                                        <option value="8">Tiết 8</option>
                                        <option value="9">Tiết 9</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center mt-3">
                                    <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-plus"></i> Thêm</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit-->
            <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h3 class="modal-title text-secondary">Sửa thông tin lớp học phần</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="editForm" method="get">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12" id="e_selectMON">
                                    <label for="new_selectMON" class="placeholder">Môn</label>
                                    <select class="form-control input-border-bottom" id="new_selectMON" name="new_mon" required>
                                        @foreach($monhoc as $mon)
                                            <option value="{{$mon->ma_mon}}">{{$mon->ma_mon}} - {{$mon->ten_mon}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="new_malhp" class="placeholder">Mã lớp học phần</label>
                                    <input id="new_malhp" name="new_malhp" type="text" class="form-control input-border-bottom" required>
                                </div>
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="new_tenlhp" class="placeholder">Tên lớp học phần</label>
                                    <input id="new_tenlhp" name="new_tenlhp" type="text" class="form-control input-border-bottom" required>
                                </div>
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="new_buoith" class="placeholder">Số buổi thực hành</label>
                                    <input id="new_buoith" name="new_buoith" type="number" max="60" min="1" class="form-control input-border-bottom" required>
                                </div>
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12" id="e_selectCB">
                                    <label for="new_selectCB" class="placeholder">Cán bộ giảng viên</label>
                                    <select class="form-control input-border-bottom" id="new_selectCB" name="new_cb" required>
                                        @foreach($canbo as $cb)
                                            <option value="{{$cb->ma_canbo}}">{{$cb->ma_canbo}} - {{$cb->ten_cb}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12" id="e_selectHK">
                                    <label for="new_selectHK" class="placeholder">Học kỳ</label>
                                    <select class="form-control input-border-bottom" id="new_selectHK" name="new_hk" required>
                                        @foreach($hocky as $hk)
                                            <option value="{{$hk->id_hk}}">Học kỳ {{$hk->ky_hieu}} ({{$hk->nien_khoa}})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12" id="e_selectTHU">
                                    <label for="new_selectTHU" class="placeholder">Thứ</label>
                                    <select class="form-control input-border-bottom" id="new_selectTHU" name="new_thu" required>
                                        <option value="2">Thứ 2</option>
                                        <option value="3">Thứ 3</option>
                                        <option value="4">Thứ 4</option>
                                        <option value="5">Thứ 5</option>
                                        <option value="6">Thứ 6</option>
                                        <option value="7">Thứ 7</option>
                                        <option value="cn">Chủ Nhật</option>
                                    </select>
                                </div>
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12" id="e_selectTIET">
                                    <label for="new_selectTIET" class="placeholder">Tiết bắt đầu</label>
                                    <select class="form-control input-border-bottom" id="new_selectTIET" name="new_tiet" required>
                                        <option value="1">Tiết 1</option>
                                        <option value="2">Tiết 2</option>
                                        <option value="3">Tiết 3</option>
                                        <option value="4">Tiết 4</option>
                                        <option value="5">Tiết 5</option>
                                        <option value="6">Tiết 6</option>
                                        <option value="7">Tiết 7</option>
                                        <option value="8">Tiết 8</option>
                                        <option value="9">Tiết 9</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center mt-3">
                                    <button type="submit" class="btn btn-primary mr-2"><i class="fab fa-cloudscale fa-spin"></i> Cập nhật</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Import-->
            <div class="modal fade" id="Import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h3 class="modal-title text-secondary">Thêm lớp học phần từ file Excel</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('importLHP') }}" enctype="multipart/form-data" method="POST">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 file_upload text-center">
                                    <input id="excel" name="excel_file" type="file" class="form-control input-border-bottom" accept=".xlsx,.xls" required>
                                    <label for="excel" class="placeholder">Tải lên file .xls/.xlsx</label>
                                    <small class="font-weight-bold text-secondary uploaded_file_name"></small>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center mt-3">
                                    <button type="submit" class="btn btn-primary mr-2 btn_upload" style="display: none;"><i class="fas fa-upload"></i> Import</button>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center mt-3 img_ct">
                                    <p class="font-weight-bold text-secondary font-italic">Cấu trúc file:</p>
                                    <a href="#" data-toggle="modal" data-target="#Ex">Xem mẫu file Excel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- EX-->
            <div class="modal fade" id="Ex" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body row">
                            <img src="../src/admin/assets/img/ex.png" width="100%" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="copyright ml-auto">
                        2019, by <a href="">PMCIT</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!--   Core JS Files   -->
    <script src="../src/admin/assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="../src/admin/assets/js/core/popper.min.js"></script>
    <script src="../src/admin/assets/js/core/bootstrap.min.js"></script>
    <!-- jQuery UI -->
    <script src="../src/admin/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="../src/admin/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
    <!-- jQuery Scrollbar -->
    <script src="../src/admin/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <!-- Chart JS -->
    <script src="../src/admin/assets/js/plugin/chart.js/chart.min.js"></script>
    <!-- jQuery Sparkline -->
    <script src="../src/admin/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>
    <!-- Chart Circle -->
    <script src="../src/admin/assets/js/plugin/chart-circle/circles.min.js"></script>
    <!-- Datatables -->
    <script src="../src/admin/assets/js/plugin/datatables/datatables.min.js"></script>
    <!-- Bootstrap Notify -->
    <script src="../src/admin/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
    <!-- jQuery Vector Maps -->
    <script src="../src/admin/assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
    <script src="../src/admin/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>
    <!-- Sweet Alert -->
    <script src="../src/admin/assets/js/plugin/sweetalert/sweetalert.min.js"></script>
    <!-- Atlantis JS -->
    <script src="../src/admin/assets/js/atlantis.min.js"></script>
    <script src="../src/lib/gijgo/gijgo.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#basic-datatables').DataTable({});        
    });

    $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('.uploaded_file_name').text("Selected: "+fileName);
        $(".btn_upload").css({ display: "unset" });
    });

    $(".btn_upload").click(function(){
        $(".preloader").css('display',"inline-block");
        $(".preloader").delay(10).css('opacity',0).animate({'opacity': 1}, 200);
    });
    </script>
    <script>
    $(document).ready(function() {
        var selected = $(".sidebar li.nav-item:nth-child(3)");
        selected.addClass("active");
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
    @if(Session::has('AddFail'))
    <script>
        noti("danger", "Thêm thất bại! Mã lớp học phần đã tồn tại");
    </script>
    @endif
    @if(Session::has('ErrorFileExtension'))
    <script>
        noti("danger", "Định dạng file không hợp lệ!");
    </script>
    @endif
    @if(Session::has('ErrorFileStruct'))
    <script>
        noti("danger", "Cấu trúc file không hợp lệ!");
    </script>
    @endif

    @if(Session::has('Edited'))
    <script>
        noti("success", "Sửa thành công!");
    </script>
    @endif

    @if(Session::has('EditFail'))
    <script>
        noti("danger", "Sửa thất bại! Mã học phần đã tồn tại!");
    </script>
    @endif

    @if(Session::has('SuccessfullyDelete'))
    <script>
        noti("success", "Đã xóa!");
    </script>
    @endif

    @if(Session::has('ErrorDelete'))
    <script>
        noti("danger", "Không thể xóa do có sinh viên đang học lớp này!");
    </script>
    @endif

    <script type="text/javascript">
    function editData(id) {
        var url = '{{ route("editLHP", ":id") }}';
        url = url.replace(':id', id);
        $("#editForm").attr('action', url);
    }

    function changePName(malhp, tenlhp, mon, buoith, cb, hk, thu, tiet) {
        $('input[name=new_malhp]').val('' + malhp);
        $('input[name=new_tenlhp]').val('' + tenlhp);
        $('input[name=new_buoith]').val('' + buoith);
        $("div#e_selectMON select").val(""+mon);
        $("div#e_selectCB select").val(""+cb);
        $("div#e_selectHK select").val(""+hk);
        $("div#e_selectTHU select").val(""+thu);
        $("div#e_selectTIET select").val(""+tiet);
    }

    function editSubmit() {
        $("#editForm").submit();
    }

    </script>

    <script>
    function deleteData(id) {
        var url = '{{ route("deleteLHP", ":id") }}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);

        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            buttons: {
                confirm: {
                    text: 'Yes, delete it!',
                    className: 'btn btn-success'
                },
                cancel: {
                    visible: true,
                    className: 'btn btn-danger'
                }
            }
        }).then((Delete) => {
            if (Delete) {
                $("#deleteForm").submit();
            } else {
                swal.close();
            }
        });
    }

    </script>
</body>

</html>