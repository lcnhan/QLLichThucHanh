<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>PMCIT Admin Dashboard</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="../src/admin/assets/img/icon.ico" type="image/x-icon" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                                <h2 class="text-white pb-2 fw-bold">Danh sách lớp</h2>
                                <h5 class="text-white op-7 mb-2">Quản lý lớp của mỗi ngành</h5>
                            </div>
                            <div class="ml-md-auto py-2 py-md-0">
                                <a href="#" class="btn btn-secondary btn-round" data-toggle="modal" data-target="#AddClass">Add <i class="fas fa-plus-circle"></i></a>
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
                                                    <th>Ngành</th>
                                                    <th>Số sinh viên</th>
                                                    <th>Control</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th class="text-center">STT</th>
                                                    <th>Mã lớp</th>
                                                    <th>Tên lớp</th>
                                                    <th>Ngành</th>
                                                    <th>Số sinh viên</th>
                                                    <th>Control</th>
                                                </tr>
                                            </tfoot>
                                            <tbody class="tbl_content">
                                            </tbody>
                                            <form action="" id="deleteForm" method="get" hidden>
                                            </form>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="AddClass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h3 class="modal-title text-secondary">Thêm lớp</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('addClass') }}" method="POST">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                <div class="form-group form-floating-label col-12 col-sm-12 col-md-12 col-lg-12">
                                    <select class="form-control input-border-bottom" id="selectFloatingLabel" name="manganh" required>
                                        @foreach($nganh as $ng)
                                        <option value="{{$ng->ma_nganh}}">{{$ng->ma_nganh}} - {{$ng->ten_nganh}}</option>
                                        @endforeach
                                    </select>
                                    <label for="selectFloatingLabel" class="placeholder">Ngành</label>
                                </div>
                                <div class="form-group form-floating-label col-12 col-sm-12 col-md-12 col-lg-12">
                                    <input id="malop" name="malop" type="text" class="form-control input-border-bottom" required>
                                    <label for="malop" class="placeholder">Mã lớp</label>
                                </div>
                                <div class="form-group form-floating-label col-12 col-sm-12 col-md-12 col-lg-12">
                                    <input id="tenlop" name="tenlop" type="text" class="form-control input-border-bottom" required>
                                    <label for="tenlop" class="placeholder">Tên lớp</label>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center mt-3">
                                    <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-plus"></i> Thêm</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="EditClass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h3 class="modal-title text-secondary">Thêm lớp</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" id="editForm" method="get">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                <div class="form-group form-floating-label col-12 col-sm-12 col-md-12 col-lg-12 " id="new_nganh">
                                    <select class="form-control input-border-bottom" id="selectFloatingLabel" name="new_manganh" required>
                                        @foreach($nganh as $ng)
                                        <option value="{{$ng->ma_nganh}}">{{$ng->ma_nganh}} - {{$ng->ten_nganh}}</option>
                                        @endforeach
                                    </select>
                                    <label for="selectFloatingLabel" class="placeholder">Ngành</label>
                                </div>
                                <div class="form-group form-floating-label col-12 col-sm-12 col-md-12 col-lg-12">
                                    <input id="malop" name="new_malop" type="text" class="form-control input-border-bottom" required>
                                    <label for="malop" class="placeholder">Mã lớp</label>
                                </div>
                                <div class="form-group form-floating-label col-12 col-sm-12 col-md-12 col-lg-12">
                                    <input id="tenlop" name="new_tenlop" type="text" class="form-control input-border-bottom" required>
                                    <label for="tenlop" class="placeholder">Tên lớp</label>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center mt-3">
                                    <button type="submit" class="btn btn-primary mr-2"><i class="fab fa-cloudscale fa-spin"></i> Cập nhật</button>
                                </div>
                            </form>
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
        var selected = $(".sidebar li.nav-item:nth-child(3)");
        selected.addClass("active");
        load_list();
    });

    function load_list() {
        console.log('loading.');
        $.ajax({
            url: "{{ asset('/loadLop') }}",
            method: "GET",
            success: function(data) {
                $(".table-responsive").css("display", "none");
                $(".tbl_content").html(data);
                $(".table-responsive").fadeIn(500);
                $('#basic-datatables').DataTable({
                    "pageLength": 10
                });
                console.log('get full list success');
            }
        });
    }

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
    @if(Session::has('Edited'))
    <script>
    noti("success", "Sửa thành công!");

    </script>
    @endif

    @if(Session::has('SuccessfullyDelete'))
    <script>
        noti("success", "Đã xóa!");
    </script>
    @endif

    @if(Session::has('ErrorDelete'))
    <script>
        noti("danger", "Không thể xóa do có sinh viên thuộc lớp này!");
    </script>
    @endif

    @if(Session::has('AddFail'))
    <script>
        noti("danger", "Thêm thất bại! Mã lớp đã tồn tại");
    </script>
    @endif

    <script type="text/javascript">
    function editData(id) {
        var url = '{{ route("editClass", ":id") }}';
        url = url.replace(':id', id);
        $("#editForm").attr('action', url);
    }

    function changePName(manganh, malop, ten) {
        $("div#new_nganh select").val(""+manganh);
        $('input[name=new_malop]').val('' + malop);
        $('input[name=new_tenlop]').val('' + ten);
        console.log(manganh + ' - ' + ten + ' - ' + malop);
    }

    function editSubmit() {
        $("#editForm").submit();
    }

    </script>

    <script>
    function deleteClass(id) {
        var url = '{{ route("deleteLop", ":id") }}';
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
