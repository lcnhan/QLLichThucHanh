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
                                <h2 class="text-white pb-2 fw-bold">Danh sách phòng thực hành</h2>
                                <h5 class="text-white op-7 mb-2">Quản lý phòng thực hành</h5>
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
                                        <table id="basic-datatables" class="display table table-striped table-hover text-center">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">STT</th>
                                                    <th>Tên phòng</th>
                                                    <th>Số lượng máy</th>
                                                    <th>Hệ điều hành</th>
                                                    <th>Ram</th>
                                                    <th>CPU</th>
                                                    <th class="text-center">Control</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th class="text-center">STT</th>
                                                    <th>Tên phòng</th>
                                                    <th>Số lượng máy</th>
                                                    <th>Hệ điều hành</th>
                                                    <th>Ram</th>
                                                    <th>CPU</th>
                                                    <th class="text-center">Control</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                @foreach($phong as $ph)
                                                <tr>
                                                    <td class="text-center">{{$loop->iteration}}</td>
                                                    <td><a class="select_room" onclick="loadsoftware('{{$ph->id_phong}}', '{{$ph->ten_phong}}')" href="#" data-toggle="modal" data-target="#modalSoftware">{{$ph->ten_phong}}</a></td>
                                                    <td>{{$ph->soluong_may}}</td>
                                                    <td>{{$ph->hdh}}</td>
                                                    <td>{{$ph->ram}}</td>
                                                    <td>{{$ph->cpu}}</td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn_control text-primary" data-toggle="modal" data-target="#EditClass" onclick="editData('{{$ph->id_phong}}'); changePName('{{$ph->ten_phong}}','{{$ph->soluong_may}}','{{$ph->hdh}}','{{$ph->ram}}','{{$ph->cpu}}')">
                                                            <i class="fas fa-pen"></i>
                                                        </button>
                                                        <button type="button" class="btn_control text-danger" onclick="deleteNganh('{{$ph->id_phong}}')">
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
                            <h3 class="modal-title text-secondary">Thêm phòng mới</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('addPhong') }}" method="POST">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                <div class="form-group form-floating-label col-12 col-sm-12 col-md-12 col-lg-12">
                                    <input id="ten_phong" name="ten_phong" type="text" class="form-control input-border-bottom" required>
                                    <label for="ten_phong" class="placeholder">Tên Phòng</label>
                                </div>
                                <div class="form-group form-floating-label col-12 col-sm-12 col-md-12 col-lg-12">
                                    <input id="soluong_may" name="soluong_may" type="text" class="form-control input-border-bottom" required>
                                    <label for="soluong_may" class="placeholder">Số lượng máy</label>
                                </div>
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="hdh" class="placeholder">Hệ điều hành</label>
                                    <select class="form-control input-border-bottom" id="hdh" name="hdh" required>
                                        <option value="Windows">Windows</option>
                                        <option value="Ubuntu">Ubuntu</option>
                                    </select>
                                </div>
                                <div id="ram" class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="ram" class="placeholder">Ram</label>
                                    <select class="form-control input-border-bottom" id="ram" name="ram" required>
                                        <option value="1 Gb">1 Gb</option>
                                        <option value="2 Gb">2 Gb</option>
                                        <option value="4 Gb">4 Gb</option>
                                        <option value="8 Gb">8 Gb</option>
                                    </select>
                                </div>
                                <div id="new_cpu" class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="new_cpu" class="placeholder">Hệ điều hành</label>
                                    <select class="form-control input-border-bottom" id="selectHDH" name="cpu" required>
                                        <option value="CORE i3">CORE i3</option>
                                        <option value="CORE i5">CORE i5</option>
                                        <option value="CORE i7">CORE i7</option>
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
            <!-- Edit -->
            <div class="modal fade" id="EditClass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h3 class="modal-title text-secondary">Sửa thông tin phòng thực hành</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" id="editForm" method="get">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                <div class="form-group form-floating-label col-12 col-sm-12 col-md-12 col-lg-12">
                                    <input id="new_ten_phong" name="new_ten_phong" type="text" class="form-control input-border-bottom" required>
                                    <label for="new_ten_phong" class="placeholder">Tên Phòng</label>
                                </div>
                                <div class="form-group form-floating-label col-12 col-sm-12 col-md-12 col-lg-12">
                                    <input id="new_soluong_may" name="new_soluong_may" type="text" class="form-control input-border-bottom" required>
                                    <label for="new_soluong_may" class="placeholder">Số lượng máy</label>
                                </div>
                                <div id="selectHDH" class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="new_hdh" class="placeholder">Hệ điều hành</label>
                                    <select class="form-control input-border-bottom" id="new_hdh" name="new_hdh" required>
                                        <option value="Windows">Windows</option>
                                        <option value="Ubuntu">Ubuntu</option>
                                    </select>
                                </div>
                                <div id="selectRam" class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="new_ram" class="placeholder">Ram</label>
                                    <select class="form-control input-border-bottom" id="new_Ram" name="new_ram" required>
                                        <option value="1 Gb">1 Gb</option>
                                        <option value="2 Gb">2 Gb</option>
                                        <option value="4 Gb">4 Gb</option>
                                        <option value="8 Gb">8 Gb</option>
                                    </select>
                                </div>
                                <div id="selectCPU" class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="new_cpu" class="placeholder">Hệ điều hành</label>
                                    <select class="form-control input-border-bottom" id="new_CPU" name="new_cpu" required>
                                        <option value="CORE i3">CORE i3</option>
                                        <option value="CORE i5">CORE i5</option>
                                        <option value="CORE i7">CORE i7</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center mt-3">
                                    <button type="submit" class="btn btn-primary mr-2" onclick="editSubmit()"><i class="fas fa-paper-plane"></i> Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalSoftware" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h3 class="modal-title text-secondary">Danh sách phần mềm <span class="room_name"></span></h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body listpm text-center">
                            <ul class="list-group listpm_data">
                            </ul>
                            <button type="button" class="btn_control text-primary mt-2 btn_add_pm" data-toggle="modal" data-target="#modaladdSoftware" data-dismiss="modal">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modaladdSoftware" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h3 class="modal-title text-secondary">Thêm phần mềm cho <span class="room_name"></span></h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body listpm text-center">
                            <form action="{{ route('addPM_R') }}" method="POST">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                <input type="text" class="pr_id" name="pr_id" hidden>
                                <ul class="list-group list_all_pm">
                                </ul>
                                <div class="text-center mt-2">
                                    <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-plus"></i> Thêm</button>
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

    function loadsoftware(id, name) {
        $('.room_name').text(name);
        $('.pr_id').val(id);
        loadallsoftware(id);
        $.ajax({
            url: "{{ asset('loadPMofROOM') }}",
            method: "GET",
            data: { 'idphong': id },
            success: function(data) {
                $(".listpm").css("display", "none");
                $(".listpm_data").html(data);
                $(".listpm").fadeIn(100);
                console.log('get list success');
            }
        });
    }

    function loadallsoftware(id) {
        $.ajax({
            url: "{{ asset('loadallPM') }}",
            method: "GET",
            data: { 'idphong': id },
            success: function(data) {
                $(".list_all_pm").css("display", "none");
                $(".list_all_pm").html(data);
                $(".list_all_pm").fadeIn(100);
                console.log('get list success');
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
        var url = '{{ route("editPhong", ":id") }}';
        url = url.replace(':id', id);
        $("#editForm").attr('action', url);
    }

    function changePName(ten, slm, hdh, ram, cpu) {
        $('input[name=new_ten_phong]').val('' + ten);
        $('input[name=new_soluong_may]').val('' + slm);
        $('div#selectHDH select').val("" + hdh);
        $('div#selectRam select').val("" + ram);
        $('div#selectCPU select').val("" + cpu);
    }

    function editSubmit() {
        $("#editForm").submit();
    }

    </script>
    <script>
    function deleteNganh(id) {
        var url = '{{ route("deletePhong", ":id") }}';
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

    function del_pm(id) {

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
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('input[name="_token"]').val()
                        }
                    });
                    $.ajax({
                        url: "{{ asset('/deletePMR') }}",
                        method: "GET",
                        data: { 'idpmr': id },
                        success: function(data) {
                             noti("success", "Đã xóa!");
                        },
                        error: function(data){
                           noti("danger", "Không thể xóa!");
                        }
                    });
                    $(".li_item_"+id).remove();
                } else {
                    swal.close();
                }
            });
        }
    </script>
</body>

</html>
