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
                                <h2 class="text-white pb-2 fw-bold">Danh sách cán bộ</h2>
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
                                                    <th>Mã cán bộ</th>
                                                    <th>Tên cán bộ</th>
                                                    <th>Email</th>
                                                    <th>SĐT</th>
                                                    <th>Giới tính</th>
                                                    <th>Ngày sinh</th>
                                                    <th>Ngày vào làm</th>
                                                    <th>Phân quyền</th>
                                                    <th class="text-center">Control</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th class="text-center">STT</th>
                                                    <th>Mã cán bộ</th>
                                                    <th>Tên cán bộ</th>
                                                    <th>Email</th>
                                                    <th>SĐT</th>
                                                    <th>Giới tính</th>
                                                    <th>Ngày sinh</th>
                                                    <th>Ngày vào làm</th>
                                                    <th>Phân quyền</th>
                                                    <th class="text-center">Control</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                @foreach($canbo as $cb)
                                                <tr>
                                                    <td class="text-center">{{$loop->iteration}}</td>
                                                    <td>{{$cb->ma_canbo}}</td>
                                                    <td>{{$cb->ten_cb}}</td>
                                                    <td>{{$cb->email}}</td>
                                                    <td>{{$cb->sdt}}</td>
                                                    <td>{{$cb->gioi_tinh}}</td>
                                                    <td>{{$cb->ngay_sinh}}</td>
                                                    <td>{{$cb->ngay_vao_lam}}</td>
                                                    <td>{{$cb->role}}</td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn_control text-primary" data-toggle="modal" data-target="#edit" onclick="editData('{{$cb->ma_canbo}}'); changePName('{{$cb->ma_canbo}}', '{{$cb->ten_cb}}', '{{$cb->email}}', '{{$cb->sdt}}', '{{$cb->gioi_tinh}}', '{{$cb->ngay_sinh}}', '{{$cb->ngay_vao_lam}}', '{{$cb->role}}')">
                                                            <i class="fas fa-pen"></i>
                                                        </button>
                                                        <button type="button" class="btn_control text-danger" onclick="deleteData('{{$cb->ma_canbo}}', '{{$cb->id_account}}')">
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
            <!-- Modal Add-->
            <div class="modal fade" id="Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h3 class="modal-title text-secondary">Thêm cán bộ mới</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('addCB') }}" method="POST">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="macb" class="placeholder">Mã cán bộ</label>
                                    <input id="macb" name="macb" type="text" class="form-control input-border-bottom" required>
                                </div>
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="tencb" class="placeholder">Tên cán bộ</label>
                                    <input id="tencb" name="tencb" type="text" class="form-control input-border-bottom" required>
                                </div>
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="email" class="placeholder">Email</label>
                                    <input id="email" name="email" type="email" class="form-control input-border-bottom" required>
                                </div>
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="pass" class="placeholder">Mật khẩu mặc định</label>
                                    <input id="pass" name="pass" type="text" class="form-control input-border-bottom" required>
                                </div>
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="selectRole" class="placeholder">Phân quyền</label>
                                    <select class="form-control input-border-bottom" id="selectRole" name="role" required>
                                        <option value="Admin">Admin</option>
                                        <option value="Tech">Cán bộ kỹ thuật</option>
                                        <option value="Lecturers" selected>Cán bộ giảng viên</option>
                                    </select>
                                </div>
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="selectGT" class="placeholder">Giới tính</label>
                                    <select class="form-control input-border-bottom" id="selectGT" name="gt" required>
                                        <option value="Nam">Nam</option>
                                        <option value="Nữ">Nữ</option>
                                    </select>
                                </div>
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="sdt" class="placeholder">SĐT</label>
                                    <input id="sdt" name="sdt" type="text" class="form-control input-border-bottom" required>
                                </div>
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="ngsinh">Ngày sinh</label>
                                    <input id="ngsinh" name="ngsinh" type="text" class="form-control input-border-bottom" required>
                                </div>
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="nglam">Ngày vào làm</label>
                                    <input id="nglam" name="nglam" type="text" class="form-control input-border-bottom" required>
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
                            <h3 class="modal-title text-secondary">Sửa thông tin cán bộ</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="editForm" method="get">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="new_macb" class="placeholder">Mã cán bộ</label>
                                    <input id="new_macb" name="new_macb" type="text" class="form-control input-border-bottom" required>
                                </div>
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="new_tencb" class="placeholder">Tên cán bộ</label>
                                    <input id="new_tencb" name="new_tencb" type="text" class="form-control input-border-bottom" required>
                                </div>
                                <div class="form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="new_email" class="placeholder">Tài khoản</label>
                                    <input id="new_email" name="new_email" type="email" class="form-control input-border-bottom" readonly required>
                                    <button class="my-2 btn-danger float-right">Đổi mật khẩu</button>
                                </div>
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="new_selectRole" class="placeholder">Phân quyền</label>
                                    <select class="form-control input-border-bottom" id="new_selectRole" name="new_role" required>
                                        <option value="Admin">Admin</option>
                                        <option value="Tech">Cán bộ kỹ thuật</option>
                                        <option value="Lecturers" selected>Cán bộ giảng viên</option>
                                    </select>
                                </div>
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="new_selectGT" class="placeholder">Giới tính</label>
                                    <select class="form-control input-border-bottom" id="new_selectGT" name="new_gt" required>
                                        <option value="Nam">Nam</option>
                                        <option value="Nữ">Nữ</option>
                                    </select>
                                </div>
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="new_sdt" class="placeholder">SĐT</label>
                                    <input id="new_sdt" name="new_sdt" type="text" class="form-control input-border-bottom" required>
                                </div>
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="new_ngsinh">Ngày sinh</label>
                                    <input id="new_ngsinh" name="new_ngsinh" type="text" class="form-control input-border-bottom" required>
                                </div>
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="new_nglam">Ngày vào làm</label>
                                    <input id="new_nglam" name="new_nglam" type="text" class="form-control input-border-bottom" required>
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
                            <h3 class="modal-title text-secondary">Thêm tài khoản cán bộ từ file Excel</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('importCB') }}" enctype="multipart/form-data" method="POST">
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

        $('#ngsinh').datepicker({
            format: 'dd/mm/yyyy',
            uiLibrary: 'bootstrap'
        });

        $('#nglam').datepicker({
            format: 'dd/mm/yyyy',
            uiLibrary: 'bootstrap'
        });

        $('#new_ngsinh').datepicker({
            format: 'dd/mm/yyyy',
            uiLibrary: 'bootstrap'
        });

        $('#new_nglam').datepicker({
            format: 'dd/mm/yyyy',
            uiLibrary: 'bootstrap'
        });
    });

    $(".btn_upload").click(function(){
        $(".preloader").css('display',"inline-block");
        $(".preloader").delay(10).css('opacity',0).animate({'opacity': 1}, 200);
    });

    $('input[type="file"]').change(function(e) {
        var fileName = e.target.files[0].name;
        $('.uploaded_file_name').text("Selected: " + fileName);
        $(".btn_upload").css({ display: "unset" });
    });

    </script>
    <script>
    $(document).ready(function() {
        var selected = $(".sidebar li.nav-item:nth-child(4)");
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
    @if(Session::has('ErrorFileExtension'))
    <script>
    noti("danger", "Định dạng file không hợp lệ!");

    </script>
    @endif
    @if(Session::has('ErrorFileStruct'))
    <script>
    noti("danger", "Lỗi cấu trúc file!");

    </script>
    @endif
    @if(Session::has('Edited'))
    <script>
    noti("success", "Sửa thành công!");

    </script>
    @endif
    @if(Session::has('AddFail'))
    <script>
    noti("danger", "Lỗi tài khoản đã tồn tại!");

    </script>
    @endif
    @if(Session::has('DateFail'))
    <script>
    noti("danger", "Lỗi ngày sinh sau ngày vào làm!");

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
    <script type="text/javascript">
    function editData(id) {
        var url = '{{ route("editCB", ":id") }}';
        url = url.replace(':id', id);
        $("#editForm").attr('action', url);
    }

    function changePName(ma_cb, ten_cb, email, sdt, gioi_tinh, ngay_sinh, ngay_vao_lam, role) {
        $('input[name=new_macb]').val('' + ma_cb);
        $('input[name=new_tencb]').val('' + ten_cb);
        $('input[name=new_sdt]').val('' + sdt);
        $('input[name=new_ngsinh]').val('' + ngay_sinh);
        $('input[name=new_nglam]').val('' + ngay_vao_lam);
        $('input[name=new_email]').val('' + email);
        $("div#new_gt select").val("" + gioi_tinh);
        $("div#new_role select").val("" + role);
    }

    function editSubmit() {
        $("#editForm").submit();
    }

    </script>
    <script>
    function deleteData(id, idusr) {
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

                swal({
                    title: 'Deleted!',
                    text: 'Your file has been deleted.',
                    type: 'success'
                });

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ asset('/deleteCB') }}",
                    method: "POST",
                    data: {
                        "idcb": id,
                        "id_usr": idusr
                    },
                    success: function(data) {
                        location.reload();
                        console.log('delete success');
                    }
                });

            } else {
                swal.close();
            }
        });
    }

    </script>
</body>

</html>
