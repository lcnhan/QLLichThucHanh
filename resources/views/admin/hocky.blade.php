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
    <link rel="stylesheet" href="../src/lib/gijgo/gijgo.min.css">
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
                                <h2 class="text-white pb-2 fw-bold">Danh sách học kỳ</h2>
                                <input type="text" id="id_hk_change" hidden>
                            </div>
                            <div class="ml-md-auto py-2 py-md-0">
                                <a href="#" data-toggle="modal" data-target="#Add" class="btn btn-secondary btn-round">Thêm <i class="fas fa-plus-circle"></i></a>
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
                                                    <th>Tên học kỳ</th>
                                                    <th>Ngày bắt đầu</th>
                                                    <th>Ngày kết thúc</th>
                                                    <th>Số tuần</th>
                                                    <th>Trạng thái</th>
                                                    <th class="text-center">Control</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th class="text-center">STT</th>
                                                    <th>Tên học kỳ</th>
                                                    <th>Ngày bắt đầu</th>
                                                    <th>Ngày kết thúc</th>
                                                    <th>Số tuần</th>
                                                    <th>Trạng thái</th>
                                                    <th class="text-center">Control</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                @foreach($hocky as $hk)
                                                <tr>
                                                    <td class="text-center">{{$loop->iteration}}</td>
                                                    <td><a href="{{ url('dslhp/'.$hk->id_hk) }}">Học kỳ {{$hk->ky_hieu}} ({{$hk->nien_khoa}})</a></td>
                                                    <td>{{$hk->ngay_bd}}</td>
                                                    <td>{{$hk->ngay_kt}}</td>
                                                    <td>
                                                        {{
                                                            $weeks = number_format(Carbon\Carbon::createFromFormat('d/m/Y', $hk->ngay_bd)->diffInDays(Carbon\Carbon::createFromFormat('d/m/Y', $hk->ngay_kt))/7, 0, '.', '')
                                                        }} tuần
                                                    </td>
                                                    <td>
                                                        <select name="slc_lhp" id="slc_hocky_{{$loop->iteration}}" class="slc_hocky text-primary" onchange="changeStatus({{$loop->iteration}})" onclick="setChangeID({{$hk->id_hk}});">
                                                            <option @if($hk->status == "Now") selected @endif value="Now">Hiện tại</option>
                                                            <option @if($hk->status == "Expired") selected @endif value="Expired">Đã xong</option>
                                                        </select>
                                                    </td>
                                                    <td class="text-center">
                                                        {{-- <button type="button" class="btn_control text-primary" data-toggle="modal" data-target="#edit" onclick="editData({{$hk->id_hk}}); changePName('{{$hk->ky_hieu}}', '{{$hk->ngay_bd}}', '{{$hk->ngay_kt}}')">
                                                            <i class="fas fa-pen"></i>
                                                        </button> --}}
                                                        <button type="button" class="btn_control text-danger" onclick="deleteData('{{$hk->id_hk}}')">
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
            <form action="" id="changeForm" method="post" hidden></form>
            <!-- Modal Add-->
            <div class="modal fade" id="Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h3 class="modal-title text-secondary">Thêm học kỳ mới</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('addHK') }}" method="POST">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="tenhk" class="placeholder">Kí hiệu (1, 2, 3)</label>
                                    <input id="tenhk" name="tenhk" type="number" min="1" max="3" class="form-control input-border-bottom" required>
                                </div>
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="ngaybd">Ngày bắt đầu</label>
                                    <input id="ngaybd" name="ngaybd" type="text" class="form-control input-border-bottom" required>
                                    
                                </div>
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="ngaykt">Ngày kết thúc</label>
                                    <input id="ngaykt" name="ngaykt" type="text" class="form-control input-border-bottom" required>
                                    
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
                            <h3 class="modal-title text-secondary">Sửa thông tin học kỳ</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="editForm" method="get">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                 <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="new_tenhk" class="placeholder">Tên học kỳ</label>
                                    <input id="new_tenhk" name="new_tenhk" type="text" class="form-control input-border-bottom" required>
                                </div>
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="new_ngaybd">Ngày bắt đầu</label>
                                    <input id="new_ngaybd" name="new_ngaybd" type="text" class="form-control input-border-bottom" required>
                                    
                                </div>
                                <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="new_ngaykt">Ngày kết thúc</label>
                                    <input id="new_ngaykt" name="new_ngaykt" type="text" class="form-control input-border-bottom" required>
                                    
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
    <script src="../src/lib/gijgo/gijgo.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#basic-datatables').DataTable({});

        $('#ngaybd').datepicker({
            format: 'dd/mm/yyyy',
            uiLibrary: 'bootstrap'
        });
    
        $('#ngaykt').datepicker({
            format: 'dd/mm/yyyy',
            uiLibrary: 'bootstrap'
        });

        $('#new_ngaybd').datepicker({
            format: 'dd/mm/yyyy',
            uiLibrary: 'bootstrap'
        });
    
        $('#new_ngaykt').datepicker({
            format: 'dd/mm/yyyy',
            uiLibrary: 'bootstrap'
        });
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
    @if(Session::has('Error'))
    <script>
        noti("danger", "Thêm thất bại!");
    </script>
    @endif

    @if(Session::has('Edited'))
    <script>
        noti("success", "Sửa thành công!");
    </script>
    @endif

    @if(Session::has('DateFail'))
    <script>
        noti("danger", "Lỗi ngày bắt đầu lớn hơn ngày kết thúc!");
    </script>
    @endif

    @if(Session::has('NumDateFail'))
    <script>
        noti("danger", "Số ngày trong học kỳ không được vượt quá 150 ngày!");
    </script>
    @endif

    @if(Session::has('SuccessfullyDelete'))
    <script>
        noti("success", "Đã xóa!");
    </script>
    @endif

    @if(Session::has('ErrorDelete'))
    <script>
        noti("danger", "Không thể xóa do học kỳ đang được sử dụng!");
    </script>
    @endif

    <script type="text/javascript">
    function editData(id) {
        var url = '{{ route("editHK", ":id") }}';
        url = url.replace(':id', id);
        $("#editForm").attr('action', url);
    }

    function changePName(ten, bd, kt) {
        $('input[name=new_tenhk]').val('' + ten);
        $('input[name=new_ngaybd]').val('' + bd);
        $('input[name=new_ngaykt]').val('' + kt);
    }

    function editSubmit() {
        $("#editForm").submit();
    }

    </script>

    <script>
    function deleteData(id) {
        var url = '{{ route("deleteHK", ":id") }}';
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

    function setChangeID(id){
        $('#id_hk_change').val(id);
    }

    function changeStatus(pos_status){
        var status = $('#slc_hocky_'+pos_status).val();
        var id = $('#id_hk_change').val();
        swal({
            title: 'Bạn có chắc?',
            text: "Sẽ thay đổi trạng thái của học kỳ này!",
            type: 'warning',
            buttons: {
                confirm: {
                    text: 'Đồng ý!',
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
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                });
                $.ajax({
                    url: "{{ asset('/editHKStatus') }}",
                    method: "POST",
                    data: { 
                        'hk_id': id,
                        'sta': status
                     },
                    success: function(data) {
                       location.reload();
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