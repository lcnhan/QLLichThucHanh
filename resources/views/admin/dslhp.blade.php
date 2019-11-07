<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>PMCIT Admin Dashboard</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="../src/admin/assets/img/icon.ico" type="image/x-icon" />
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
                                <h2 class="text-white pb-2 fw-bold">Danh sách sinh viên</h2>
                                <h5 class="text-white op-7 mb-2">Quản lý tài khoản, phân quyền</h5>
                            </div>
                            <div class="ml-md-auto py-2 py-md-0">
                                <a href="#" class="btn btn-secondary btn-round">Add <i class="fas fa-plus-circle"></i></a>
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
                                                    <th>STT</th>
                                                    <th>MSCB</th>
                                                    <th>Họ tên</th>
                                                    <th>Giới tính</th>
                                                    <th>Email</th>
                                                    <th>SĐT</th>
                                                    <th>Bộ môn</th>
                                                    <th>Quyền hệ thống</th>
                                                    <th>Control</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>MSCB</th>
                                                    <th>Họ tên</th>
                                                    <th>Giới tính</th>
                                                    <th>Email</th>
                                                    <th>SĐT</th>
                                                    <th>Bộ môn</th>
                                                    <th>Quyền hệ thống</th>
                                                    <th>Control</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>T125425</td>
                                                    <td>Nguyễn Thanh Hải</td>
                                                    <td>Nam</td>
                                                    <td>nthai@cit.ctu.edu.vn</td>
                                                    <td>0969696969</td>
                                                    <td>Công nghệ thông tin</td>
                                                    <td>Cán bộ kỹ thuật</td>
                                                    <td>
                                                        <button type="button" class="btn btn-icon btn-round btn-primary mx-1">
                                                            <i class="fas fa-user-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-icon btn-round btn-danger mx-1">
                                                            <i class="fas fa-user-times"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
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
</body>

</html>