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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet" />
    <link rel="stylesheet" href="../src/admin/assets/css/preloader.css">
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
                                {{-- <h2 class="text-white pb-2 fw-bold">Danh sách sinh viên lớp: {{$mslop}} - @foreach($tenlop as $ten){{$ten->ten_lophp}}@endforeach</h2> --}}
                                <h2 class="text-white pb-2 fw-bold">Danh sách sinh viên lớp</h2>
                                <select name="slc_lhp" id="slc_lhp">
                                    @foreach($allLHP as $all_lhp)
                                    <option value="{{$all_lhp->ma_lophp}}" @foreach($tenlop as $ten) @if($mslop==$all_lhp->ma_lophp) selected @break @endif @endforeach>{{$all_lhp->real_ma_lhp}} - {{$all_lhp->ten_lophp}} (Học kỳ {{$all_lhp->ky_hieu}}, {{$all_lhp->nien_khoa}})</option>
                                    @endforeach
                                </select>
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
                                                    <th>MSSV</th>
                                                    <th>Tên sinh viên</th>
                                                    <th>Khóa</th>
                                                    <th>Email</th>
                                                    <th>SĐT</th>
                                                    <th class="text-center">Control</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th class="text-center">STT</th>
                                                    <th>MSSV</th>
                                                    <th>Tên sinh viên</th>
                                                    <th>Khóa</th>
                                                    <th>Email</th>
                                                    <th>SĐT</th>
                                                    <th class="text-center">Control</th>
                                                </tr>
                                            </tfoot>
                                            <tbody class="tbl_content">
                                                @foreach($dssv as $sv)
                                                <tr>
                                                    <td class="text-center">{{$loop->iteration}}</td>
                                                    <td>{{$sv->mssv}}</td>
                                                    <td>{{$sv->ten_sv}}</td>
                                                    <td>{{$sv->khoa_hoc}}</td>
                                                    <td>{{$sv->email}}</td>
                                                    <td>{{$sv->sdt}}</td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn_control text-danger" onclick="deleteData({{$sv->id_sv_lhp}})">
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
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title text-secondary">Thêm sinh viên cho lớp học phần <span></span></h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('addSV_LHP') }}" method="POST">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12" id="selectsv">
                                    <label for="selectLOP" class="placeholder">Sinh viên</label>
                                    <table id="choosesv-datatables" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">STT</th>
                                                <th>MSSV</th>
                                                <th>Tên sinh viên</th>
                                                <th class="text-center">Chọn</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center">STT</th>
                                                <th>MSSV</th>
                                                <th>Tên sinh viên</th>
                                                <th class="text-center">Chọn</th>
                                            </tr>
                                        </tfoot>
                                        <tbody class="tbl_content">
                                            @foreach($allSV as $sv)
                                            <tr>
                                                <td class="text-center py-0">{{$loop->iteration}}</td>
                                                <td class="py-0">{{$sv->mssv}}</td>
                                                <td class="py-0">{{$sv->ten_sv}}</td>

                                                <td class="text-center py-0" @foreach($dssv as $ds) @if($sv->mssv == $ds->mssv) hidden @break @endif @endforeach>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="checkbox" value="{{$sv->mssv}}" name="chon_sv[]">
                                                            <span class="form-check-sign"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12" id="selectLHP">
                                    <label for="selectLOP" class="placeholder">Lớp học phần</label>
                                    <select class="form-control input-border-bottom" id="selectLOP" name="malop" required>
                                        @foreach($allLHP as $all_lhp)
                                            <option value="{{$all_lhp->ma_lophp}}" @foreach($tenlop as $ten) @if($mslop==$all_lhp->ma_lophp) selected @break @endif @endforeach>{{$all_lhp->real_ma_lhp}} - {{$all_lhp->ten_lophp}} (Học kỳ {{$all_lhp->ky_hieu}}, {{$all_lhp->nien_khoa}})</option>
                                        @endforeach
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

            <!-- Modal Import-->
            <div class="modal fade" id="Import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h3 class="modal-title text-secondary">Thêm từ file Excel</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('importSVLHP') }}" enctype="multipart/form-data" method="POST">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <script>
    $(document).ready(function() {
        $('#basic-datatables').DataTable({});
        $('#choosesv-datatables').DataTable({});

        $('#ngsinh').datepicker({
            format: 'dd/mm/yyyy',
            uiLibrary: 'bootstrap'
        });

        $("#nghoc").datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
        });

        $('#new_ngsinh').datepicker({
            format: 'dd/mm/yyyy',
            uiLibrary: 'bootstrap'
        });

        $("#new_nghoc").datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
        });
    });

    $(".btn_upload").click(function() {
        $(".preloader").css('display', "inline-block");
        $(".preloader").delay(10).css('opacity', 0).animate({ 'opacity': 1 }, 200);
    });

    $('input[type="file"]').change(function(e) {
        var fileName = e.target.files[0].name;
        $('.uploaded_file_name').text("Selected: " + fileName);
        $(".btn_upload").css({ display: "unset" });
    });

    $("#slc_lhp").change(function() {
        var lhpid = $('#slc_lhp').val();
        console.log('loading: ' + lhpid);
        $.ajax({
            url: "{{ asset('/loadDSSV_LHP') }}",
            method: "GET",
            data: { 'lhp_id': lhpid },
            success: function(data) {
                $(".table-responsive").css("display", "none");
                $(".table-responsive").html(data);
                $(".table-responsive").fadeIn(500);
                $('#basic-datatables').DataTable({});
                window.history.pushState('page2', 'Title', '/dssv/' + lhpid);
                $("div#selectLHP select").val("" + lhpid);
                reloadDSSV(lhpid);
                console.log('get full list success');
            }
        });
    });

    function reloadDSSV(lhp){
        console.log('loading: ' + lhp);
        $.ajax({
            url: "{{ asset('/reloadDSSV_LHP') }}",
            method: "GET",
            data: { 'lhp_id': lhp },
            success: function(data) {
                $("#selectsv").css("display", "none");
                $("#selectsv").html(data);
                $("#selectsv").fadeIn(500);
                $('#choosesv-datatables').DataTable({});
                console.log('get full list success');
            }
        });
    }

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

    @if(Session::has('Error'))
    <script>
    noti("danger", "Thêm thất bại!");
    </script>
    @endif

    @if(Session::has('NoSV'))
    <script>
    noti("danger", "Thêm thất bại! Lỗi chưa chọn sinh viên");
    </script>
    @endif

    @if(Session::has('MSSVFail'))
    <script>
    noti("danger", "Thêm thất bại! Mã số sinh viên đã tồn tại");
    </script>
    @endif

    @if(Session::has('EmailFail'))
    <script>
    noti("danger", "Thêm thất bại! Email sinh viên đã tồn tại");
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
    noti("success", "Sửa thất bại! Mã số sinh viên đã tồn tại");
    </script>
    @endif

    @if(Session::has('AddFail'))
    <script>
    noti("danger", "Lỗi tài khoản đã tồn tại!");
    </script>
    @endif

    @if(Session::has('SuccessfullyDelete'))
    <script>
    noti("success", "Đã xóa!");
    </script>
    @endif

    @if(Session::has('ErrorDelete'))
    <script>
    noti("danger", "Không thể xóa do tài khoản đang được sử dụng!");
    </script>
    @endif

    <script>
    function deleteData(id) {
        var url = '{{ route("deleteSVLHP", ":id") }}';
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
