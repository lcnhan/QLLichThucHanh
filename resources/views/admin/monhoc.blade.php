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
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../src/admin/assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
    <!-- CSS Files -->
    <link rel="stylesheet" href="../src/admin/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/admin/assets/css/atlantis.min.css">
    <link rel="stylesheet" href="../src/admin/assets/css/custom.css">
</head>

<body>
    <div class="wrapper sidebar_minimize">
        @include('admin.layouts.nav')
        <!-- End Sidebar -->
        <div class="main-panel">
            <div class="content">
                <div class="panel-header bg-primary-gradient">
                    <div class="page-inner py-5">
                        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                            <div>
                                <h2 class="text-white pb-2 fw-bold">Danh sách môn học</h2>
                                <h5 class="text-white op-7 mb-2">Quản lý môn học được mở trong học kỳ</h5>
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
                                                    <th>Mã môn học</th>
                                                    <th>Tên môn học</th>
                                                    <th>Tín chỉ</th>
                                                    <th>Số tiết lý thuyết</th>
                                                    <th>Số tiết thực hành</th>
                                                    <th class="text-center">Control</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th class="text-center">STT</th>
                                                    <th>Mã môn học</th>
                                                    <th>Tên môn học</th>
                                                    <th>Tín chỉ</th>
                                                    <th>Số tiết lý thuyết</th>
                                                    <th>Số tiết thực hành</th>
                                                    <th class="text-center">Control</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                @foreach($mon as $m)
                                                <tr>
                                                    <td class="text-center">{{$loop->iteration}}</td>
                                                    <td>{{$m->ma_mon}}</td>
                                                    <td>{{$m->ten_mon}}</td>
                                                    <td>{{$m->tin_chi}}</td>
                                                    <td>{{$m->so_tiet_lt}}</td>
                                                    <td>{{$m->so_tiet_th}}</td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn_control text-primary" data-toggle="modal" data-target="#edit" onclick="editData('{{$m->ma_mon}}'); changePName('{{$m->ma_mon}}', '{{$m->ten_mon}}', '{{$m->tin_chi}}', '{{$m->so_tiet_lt}}', '{{$m->so_tiet_th}}')">
                                                            <i class="fas fa-pen"></i>
                                                        </button>
                                                        <button type="button" class="btn_control text-danger" onclick="deleteData('{{$m->ma_mon}}')">
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
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h3 class="modal-title text-secondary">Thêm môn học mới</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('addSubject') }}" method="POST">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                <div class="form-group form-floating-label col-12 col-sm-12 col-md-12 col-lg-12">
                                    <input id="mamon" name="mamon" type="text" class="form-control input-border-bottom" required>
                                    <label for="mamon" class="placeholder">Mã môn học</label>
                                </div>
                                <div class="form-group form-floating-label col-12 col-sm-12 col-md-12 col-lg-12">
                                    <input id="tenmon" name="tenmon" type="text" class="form-control input-border-bottom" required>
                                    <label for="tenmon" class="placeholder">Tên môn học</label>
                                </div>
                                <div class="form-group form-floating-label col-12 col-sm-12 col-md-12 col-lg-12">
                                    <select class="form-control input-border-bottom" id="selectFloatingLabel" name="tinchi" required>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="10">10</option>
                                    </select>
                                    <label for="selectFloatingLabel" class="placeholder">Tín chỉ</label>
                                </div>
                                <div class="form-group form-floating-label col-12 col-sm-12 col-md-12 col-lg-12">
                                    <input id="sotietlt" name="sotietlt" type="number" min="0" max="100" class="form-control input-border-bottom" required>
                                    <label for="sotietlt" class="placeholder">Số tiết lý thuyết</label>
                                </div>
                                <div class="form-group form-floating-label col-12 col-sm-12 col-md-12 col-lg-12">
                                    <input id="sotietth" name="sotietth" type="number" min="0" max="100" class="form-control input-border-bottom" required>
                                    <label for="sotietth" class="placeholder">Số tiết thực hành</label>
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
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h3 class="modal-title text-secondary">Sửa môn học</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" id="editForm" method="get">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                <div class="form-group form-floating-label col-12 col-sm-12 col-md-12 col-lg-12">
                                    <input id="new_mamon" name="new_mamon" type="text" class="form-control input-border-bottom" required>
                                    <label for="new_mamon" class="placeholder">Mã môn học</label>
                                </div>
                                <div class="form-group form-floating-label col-12 col-sm-12 col-md-12 col-lg-12">
                                    <input id="new_tenmon" name="new_tenmon" type="text" class="form-control input-border-bottom" required>
                                    <label for="new_tenmon" class="placeholder">Tên môn học</label>
                                </div>
                                <div class="form-group form-floating-label col-12 col-sm-12 col-md-12 col-lg-12" id="new_tc">
                                    <select class="form-control input-border-bottom" id="selectFloatingLabel" name="new_tinchi" required>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="10">10</option>
                                    </select>
                                    <label for="selectFloatingLabel" class="placeholder">Tín chỉ</label>
                                </div>
                                <div class="form-group form-floating-label col-12 col-sm-12 col-md-12 col-lg-12">
                                    <input id="new_sotietlt" name="new_sotietlt" type="number" min="0" max="100" class="form-control input-border-bottom" required>
                                    <label for="new_sotietlt" class="placeholder">Số tiết lý thuyết</label>
                                </div>
                                <div class="form-group form-floating-label col-12 col-sm-12 col-md-12 col-lg-12">
                                    <input id="new_sotietth" name="new_sotietth" type="number" min="0" max="100" class="form-control input-border-bottom" required>
                                    <label for="new_sotietth" class="placeholder">Số tiết thực hành</label>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center mt-3">
                                    <button type="submit" class="btn btn-primary mr-2" onclick="editSubmit()"><i class="fab fa-cloudscale fa-spin"></i> Cập nhật</button>
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
                            <h3 class="modal-title text-secondary">Thêm môn học từ file Excel</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('importSubject') }}" enctype="multipart/form-data" method="POST">
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
    <script>
    $(document).ready(function() {
        $('#basic-datatables').DataTable({});
    });

    $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('.uploaded_file_name').text("Selected: "+fileName);
        $(".btn_upload").css({ display: "unset" });
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
    @if(Session::has('AddError'))
    <script>
        noti("danger", "Thêm thất bại! Mã môn đã tồn tại");
    </script>
    @endif
    @if(Session::has('ErrorFileExtension'))
    <script>
        noti("danger", "Định dạng file không hợp lệ!");
    </script>
    @endif
    @if(Session::has('ErrorFile'))
    <script>
        noti("danger", "Thêm thất bại!");
    </script>
    @endif

    @if(Session::has('Edited'))
    <script>
        noti("success", "Sửa thành công!");
    </script>
    @endif

    @if(Session::has('EditError'))
    <script>
        noti("danger", "Sửa thất bại! Mã môn đã tồn tại");
    </script>
    @endif

    @if(Session::has('SuccessfullyDelete'))
    <script>
        noti("success", "Đã xóa!");
    </script>
    @endif

    @if(Session::has('ErrorDelete'))
    <script>
        noti("danger", "Không thể xóa do có lớp học phần thuộc môn này!");
    </script>
    @endif

    <script type="text/javascript">
    function editData(id) {
        var url = '{{ route("editSubject", ":id") }}';
        url = url.replace(':id', id);
        $("#editForm").attr('action', url);
    }

    function changePName(mamon, tenmon, tinchi, lt, th) {
        $('input[name=new_mamon]').val('' + mamon);
        $('input[name=new_tenmon]').val('' + tenmon);
        $('input[name=new_sotietlt]').val('' + lt);
        $('input[name=new_sotietth]').val('' + th);
        $("div#new_tc select").val(""+tinchi);
        console.log("changed");
    }

    function editSubmit() {
        $("#editForm").submit();
    }

    </script>

    <script>
    function deleteData(id) {
        var url = '{{ route("deleteSubject", ":id") }}';
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