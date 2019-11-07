<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>PMCIT Admin Dashboard</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="src/admin/assets/img/icon.ico" type="image/x-icon" />
    <base href="{{asset('')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Fonts and icons -->
    <script src="src/admin/assets/js/plugin/webfont/webfont.min.js"></script>
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
    <link rel="stylesheet" href="src/admin/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="src/admin/assets/css/atlantis.min.css">
    <link rel="stylesheet" href="src/admin/assets/css/custom.css">
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
                                <h2 class="text-white pb-2 fw-bold">Danh sách phần mềm</h2>
                                <h5 class="text-white op-7 mb-2">Quản lý phần mềm</h5>
                            </div>
                            <div class="ml-md-auto py-2 py-md-0">
                                <a href="#" data-toggle="modal" data-target="#AddClass" class="btn btn-secondary btn-round">Add <i class="fas fa-plus-circle"></i></a>
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
                                                    <th>Tên phần mềm</th>
                                                    <th>Version</th>
                                                    <th class="text-center">Control</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th class="text-center">STT</th>
                                                    <th>Tên phần mềm</th>
                                                    <th>Version</th>
                                                    <th class="text-center">Control</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                @foreach($phanmem as $pm)
                                                <tr>
                                                    <td class="text-center">{{$loop->iteration}}</td>
                                                    <td>{{$pm->ten_pm}}</td>
                                                    <td>{{$pm->version}}</td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn_control text-primary" data-toggle="modal" data-target="#EditClass" onclick="editData('{{$pm->id_pm}}'); changePName('{{$pm->ten_pm}}','{{$pm->version}}')">
                                                            <i class="fas fa-pen"></i>
                                                        </button>
                                                        <button type="button" class="btn_control text-danger" onclick="deleteNganh('{{$pm->id_pm}}')">
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
            <!-- Modal -->
            <div class="modal fade" id="AddClass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h3 class="modal-title text-secondary">Thêm phần mềm mới</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('addPM') }}" method="POST">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                <div class="form-group form-floating-label col-12 col-sm-12 col-md-12 col-lg-12">
                                    <input id="ten_pm" name="ten_pm" type="text" class="form-control input-border-bottom" required>
                                    <label for="ten_pm" class="placeholder">Tên phần mềm</label>
                                </div>
                                <div class="form-group form-floating-label col-12 col-sm-12 col-md-12 col-lg-12">
                                    <input id="version" name="version" type="text" class="form-control input-border-bottom" required>
                                    <label for="version" class="placeholder">Version</label>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center mt-3">
                                    <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-plus"></i> Thêm</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Edit -->
            <div class="modal fade" id="EditClass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h3 class="modal-title text-secondary">Sửa thông tin chuyên ngành</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" id="editForm" method="get">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                <div class="form-group form-floating-label col-12 col-sm-12 col-md-12 col-lg-12">
                                    <input id="new_tenPM" name="new_tenPM" type="text" class="form-control input-border-bottom" required>
                                    <label for="new_tenPM" class="placeholder">Tên phần mềm</label>
                                </div>
                                <div class="form-group form-floating-label col-12 col-sm-12 col-md-12 col-lg-12">
                                    <input id="new_version" name="new_version" type="text" class="form-control input-border-bottom" required>
                                    <label for="new_version" class="placeholder">Version</label>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center mt-3">
                                    <button type="submit" class="btn btn-primary mr-2" onclick="editSubmit()"><i class="fas fa-paper-plane"></i> Update</button>
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
        $('#basic-datatables').DataTable({});
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

    @if(Session::has('AddFailed'))
    <script>
    noti("danger", "Thêm thất bại! Mã ngành đã tồn tại");
    </script>
    @endif

    @if(Session::has('Edited'))
    <script>
    noti("success", "Sửa thành công!");
    </script>
    @endif

    @if(Session::has('EditFailed'))
    <script>
    noti("danger", "Sửa thất bại! Mã ngành đã tồn tại");
    </script>
    @endif

    @if(Session::has('SuccessfullyDelete'))
    <script>
        noti("success", "Đã xóa!");
    </script>
    @endif

    @if(Session::has('ErrorDelete'))
    <script>
        noti("danger", "Không thể xóa do có lớp trong ngành này!");
    </script>
    @endif

    <script type="text/javascript">
    function editData(id) {
        var url = '{{ route("editPM", ":id") }}';
        url = url.replace(':id', id);
        $("#editForm").attr('action', url);
    }

    function changePName(ten, ver) {
        $('input[name=new_tenPM]').val('' + ten);
        $('input[name=new_version]').val('' + ver);
    }

    function editSubmit() {
        $("#editForm").submit();
    }

    </script>
    <script>
    function deleteNganh(id) {
        var url = '{{ route("deletePM", ":id") }}';
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
