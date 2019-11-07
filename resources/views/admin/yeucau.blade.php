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
                                <h2 class="text-white pb-2 fw-bold">Danh sách yêu cầu</h2>
                                <input type="text" id="id_hk_change" hidden>
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
                                                    <th>Mã lớp HP</th>
                                                    <th>Tên lớp HP</th>
                                                    <th>Tên cán bộ</th>
                                                    <th>Thứ</th>
                                                    <th>Buổi</th>
                                                    <th class="text-center">Chọn phòng</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th class="text-center">STT</th>
                                                    <th>Mã lớp HP</th>
                                                    <th>Tên lớp HP</th>
                                                    <th>Tên cán bộ</th>
                                                    <th>Thứ</th>
                                                    <th>Buổi</th>
                                                    <th class="text-center">Chọn phòng</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                @foreach($yeucau as $yc)
                                                <tr>
                                                    <td class="text-center">{{$loop->iteration}}</td>
                                                    <td>{{$yc->real_ma_lhp}}</td>
                                                    <td>{{$yc->ten_lophp}}</td>
                                                    <td>{{$yc->ten_cb }}</td>
                                                    <td>{{$yc->thu}}</td>
                                                    <td>{{$yc->buoi}}</td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn_control text-primary" data-toggle="modal" data-target="#addPhong" onclick="loadYC({{$yc->id_chitietyc}})">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                        <button type="button" class="btn_control text-danger" onclick="deleteNganh('{{$yc->id_yeucau}}')">
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
            <!-- Modal Edit-->
            <div class="modal fade" id="addPhong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h3 class="modal-title text-secondary">Chọn phòng</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="editForm" method="get">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                <table id="choosesv-datatables" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Tuần</th>
                                                <th>Phòng</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center">Tuần</th>
                                                <th>Phòng</th>
                                            </tr>
                                        </tfoot>
                                        <tbody class="tbl_yc_content">

                                        </tbody>
                                    </table>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <button type="submit" class="btn btn-primary  mr-2 float-right"><i class="fas fa-paper-plane"></i> Chọn</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ================================= -->
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

    function changePName(malhp, macb, thu, buoi) {
    	$("div#selectMalhp select").val(""+malhp);
        $("div#selectCB select").val(""+macb);
        $('input[name=new_thu]').val('' + thu);
        $('input[name=new_buoi]').val('' + buoi);
    }

    function editSubmit() {
        $("#editForm").submit();
    }

    </script>

    <script>
    function deleteNganh(id) {
        var url = '{{ route("deleteYeucau", ":id") }}';
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

    <script>
        function loadYC(id){
        $.ajax({
            url: "{{ asset('/loadYC') }}",
            method: "GET",
            data: { 'phong_id': id },
            success: function(data) {
                $(".tbl_yc_content").css("display", "none");
                $(".tbl_yc_content").html(data);
                $(".tbl_yc_content").fadeIn(500);
                console.log('get full list success');
            }
        });
    }
    </script>

    <script>
        function changePhong(tuanyc, phong, id_yeucau) {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
            url: "{{ asset('/sapxep') }}",
            method: "POST",
            data: { 
                'tuanyc_id': tuanyc,
                'phong_id': phong,
                'id_yeucau': id_yeucau,
                 },
            success: function(data) {
                
                console.log('success');
            }
        });
    }
        
    </script>
</body>

</html>