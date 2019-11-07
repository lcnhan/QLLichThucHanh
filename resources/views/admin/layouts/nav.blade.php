<div class="main-header">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="blue">
        <a href="index.html" class="logo">
            <span class="text-white font-weight-bold">PMCIT</span>
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="icon-menu"></i>
            </span>
        </button>
        <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
        <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
                <i class="icon-menu"></i>
            </button>
        </div>
    </div>
    <!-- End Logo Header -->
    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <li class="nav-item dropdown hidden-caret">
                    {{-- <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell"></i>
                        <span class="notification">4</span>
                    </a> --}}
                    <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                        <li>
                            <div class="dropdown-title">You have 4 new notification</div>
                        </li>
                        <li>
                            <div class="notif-scroll scrollbar-outer">
                                <div class="notif-center">
                                    <a href="#">
                                        <div class="notif-icon notif-primary"> <i class="fa fa-user-plus"></i> </div>
                                        <div class="notif-content">
                                            <span class="block">
                                                New user registered
                                            </span>
                                            <span class="time">5 minutes ago</span>
                                        </div>
                                    </a>
                                    <a href="#">
                                        <div class="notif-icon notif-success"> <i class="fa fa-comment"></i> </div>
                                        <div class="notif-content">
                                            <span class="block">
                                                Rahmad commented on Admin
                                            </span>
                                            <span class="time">12 minutes ago</span>
                                        </div>
                                    </a>
                                    <a href="#">
                                        <div class="notif-img">
                                            <img src="" alt="Img Profile">
                                        </div>
                                        <div class="notif-content">
                                            <span class="block">
                                                Reza send messages to you
                                            </span>
                                            <span class="time">12 minutes ago</span>
                                        </div>
                                    </a>
                                    <a href="#">
                                        <div class="notif-icon notif-danger"> <i class="fa fa-heart"></i> </div>
                                        <div class="notif-content">
                                            <span class="block">
                                                Farrah liked Admin
                                            </span>
                                            <span class="time">17 minutes ago</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a class="see-all" href="javascript:void(0);">See all notifications<i class="fa fa-angle-right"></i> </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="avatar-sm">
                            <img src="{{ url('images/useravt/'.Auth::user()->user_avt)}}" alt="..." class="avatar-img rounded-circle">
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg"><img src="{{ url('images/useravt/'.Auth::user()->user_avt)}}" alt="image profile" class="avatar-img rounded"></div>
                                    <div class="u-text">
                                        <h4>Admin</h4>
                                        <p class="text-muted">admin@ctu.edu.vn</p><a href="profile.html" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>
<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">
                <li class="nav-item">
                    <a href="{{ url('dashboard/Admin') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Chức năng</h4>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#list">
                        <i class="fas fa-layer-group"></i>
                        <p>Danh sách</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="list">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ url('admin/hk') }}">
                                    <p class="sub-item">Danh sách học kỳ</p>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('admin/nganh') }}">
                                    <p class="sub-item">Danh sách ngành</p>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('admin/lhp') }}">
                                    <p class="sub-item">Danh sách lớp học phần</p>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('admin/lop') }}">
                                    <p class="sub-item">Danh sách lớp</p>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('admin/monhoc') }}">
                                    <p class="sub-item">Danh sách môn học</p>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('admin/phanmem') }}">
                                    <p class="sub-item">Danh sách phần mềm</p>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('admin/phong') }}">
                                    <p class="sub-item">Danh sách phòng máy</p>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('admin/yeucau') }}">
                                    <p class="sub-item">Danh sách yêu cầu</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#account">
                        <i class="fas fa-user"></i>
                        <p>Tài khoản</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="account">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ url('admin/dscb') }}">
                                    <p class="sub-item">Tài khoản cán bộ</p>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('admin/dssv') }}">
                                    <p class="sub-item">Tài khoản sinh viên</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
