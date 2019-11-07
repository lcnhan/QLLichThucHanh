<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">
        <img src="{{ url('src/images/logo.png') }}" width="100" height="50" alt="" class="d-inline-block align-center">
        <h6 class="d-inline-block align-center">LỊCH THỰC HÀNH</h6>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>



    <div class="collapse navbar-collapse float-right" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto text-center">
            <li class="nav-item my-auto active">
                <a class="nav-link bg-primary" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            @if(Auth::user()->role == "Student")
                <li class="nav-item my-auto active">
                    <a class="nav-link  bg-primary" data-toggle="modal" data-target="#feedback" href="#"><span class="text-white"> Gửi phản hồi</span></a>
                </li>
                <li class="nav-item my-auto active">
                    <a class="nav-link bg-primary" data-toggle="modal" data-target="#watchFeedback" href="#"><span class="text-white"> Xem phản hồi</span></a> 
                </li>
            @endif
            
            
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
            @else
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="acc_dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ url('images/useravt/'.Auth::user()->user_avt) }}" class="user_avt" alt="">
                </a>
                <div class="dropdown-menu user_dropdown" aria-labelledby="acc_dropdown">
                    <a class="dropdown-item font-weight-bold text-primary text-uppercase" href="{{ url('profile/'.Auth::user()->id) }}">{{ Auth::user()->name }}<span class="text-secondary">'s Profile</span></a>
                    <a class="dropdown-item disabled" href="#"><i class="fas fa-envelope"></i> {{ Auth::user()->email }}</a>
                    @if(Auth::user()->role == "Admin")
                        <a class="dropdown-item" href="{{ url('dashboard/Admin') }}"><i class="fas fa-tag"></i> {{ Auth::user()->role }} Dashboard</a>
                    @endif
                    @if(Auth::user()->role == "Lecturers")
                        <a class="dropdown-item" href="{{ url('teacher/dashboard') }}"><i class="fas fa-tag"></i> {{ Auth::user()->role }} Dashboard</a>
                    @endif
                    
                    <a class="dropdown-item text-primary" href="{{ route('changepass') }}" ><i class="fas fa-sign-out-alt"></i> Change Pass</a>

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            @endguest
        </ul>
    </div>
    <!-- <div class="modal fade" id="feedback" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h3 class="modal-title text-secondary">Thêm lớp học phần mới</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{-- {{ route('addPhanHoi') }} --}}" method="POST">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                        <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                            <label for="selectMON" class="placeholder">Lớp học phần</label>
                            <select class="form-control input-border-bottom" id="selectMON" name="mon" required>
                                {{-- @foreach($monhoc as $mon)
                                    <option value="{{$mon->ma_mon}}">{{$mon->ma_mon}} - {{$mon->ten_mon}}</option>
                                @endforeach --}}
                            </select>
                        </div>
                        <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12">
                            <label for="malhp" class="placeholder">Nội dung phản hồi</label>
                            <textarea id="malhp" name="malhp" type="text" class="form-control input-border-bottom" required></textarea> 
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center mt-3">
                            <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-paper-plane"></i> Gửi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="watchFeedback" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-secondary">Danh sách phản hồi <span></span></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{-- {{ route('addSV_LHP') }} --}}" method="POST">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                        <div class="form-group form-group-default col-12 col-sm-12 col-md-12 col-lg-12" id="selectsv">
                            <table id="#" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>MSSV</th>
                                        <th>Họ tên SV</th>
                                        <th>Mã lớp HP</th>
                                        <th>Tên lớp HP</th>
                                        <th>Tên phản hồi</th>
                                        <th>Nội dung</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>B1507301</td>
                                        <td>Nguyên văn A</td>
                                        <td>CT101H01</td>
                                        <td>Tin học căn bản</td>
                                        <td>Phản hồi lý do vắng</td>
                                        <td>Hôm đó em bệnh, nên không thể đi học được</td>
                                        <td><span class="badge badge-pill badge-success px-4 py-2 ">Chấp nhận</span></td>  
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>STT</th>
                                        <th>MSSV</th>
                                        <th>Họ tên SV</th>
                                        <th>Mã lớp HP</th>
                                        <th>Tên lớp HP</th>
                                        <th>Tên phản hồi</th>
                                        <th>Nội dung</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center mt-3">
                            <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-plus"></i> Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
</nav>
