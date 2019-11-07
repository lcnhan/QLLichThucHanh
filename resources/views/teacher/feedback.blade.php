<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="" type="image/x-icon">
    <title>Hệ thống lịch thực hành - CIT</title>
    <!--CSS-->
    <link rel="stylesheet" href="{{ url('src/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('src/css/user.css') }}">
    <link rel="stylesheet" href="{{ url('src/css/notifi.css') }}">
    <link rel="stylesheet" href="{{ url('src/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ url('src/lib/multiselect/multiselect.css') }}">
    <link rel="stylesheet" href="{{ url('src/lib/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('src/lib/datatable/material.min.css') }}">
    <link rel="stylesheet" href="{{ url('src/lib/datatable/dataTables.material.min.css') }}">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!--JS-->
    <script src="{{ url('src/lib/jquery/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ url('src/lib/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('src/lib/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ url('src/lib/popper/popper.min.js') }}"></script>
    <script src="{{ url('src/lib/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('src/lib/datatable/dataTables.material.min.js') }}"></script>
    <script src="{{ url('src/lib/multiselect/multiselect.min.js') }}"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
    @include('layouts.header')
    <section id="sec1" class="mt-5">
        <div class="container justify-content-center main pt-1">
            <div class="row">
                @include('layouts.teacher_menu')
                <div class="line"></div>
                <div class="col-lg-12 main pt-4">
                    <h5 class="font-weight-bold text-primary text-center">Danh sách phản hồi điểm danh</h5>
                </div>
                <div class="col-lg-6 main pt-2 text-center mx-auto">
                    <div class="form-group">
                        <select name="mhp" id="mhp" class="custom_select">
                            @foreach($lophp as $lhp)
                            @foreach($macanbo as $mcb)
                            @if($mcb->ma_canbo == $lhp->ma_canbo)
                            <option value="{{$lhp->ma_lophp}}">{{$lhp->real_ma_lhp}} - {{$lhp->ten_lophp}}</option>
                            @endif
                            @endforeach
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-12 main loadFB">
                    <table id="example" class="mdl-data-table table-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>MSSV</th>
                                <th>Họ tên SV</th>
                                <th>Tên phản hồi</th>
                                <th>Nội dung</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                           <!--  <tr>
                                <td>1</td>
                                <td>B1507301</td>
                                <td>Nguyên văn A</td>
                                <td>Phản hồi lý do vắng</td>
                                <td>Hôm đó em bệnh, nên không thể đi học được</td>
                                <td>
                                    <button type="button" class="btn btn-success">Chấp nhận</button>
                                </td>  
                            </tr> -->
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>STT</th>
                                <th>MSSV</th>
                                <th>Họ tên SV</th>
                                <th>Tên phản hồi</th>
                                <th>Nội dung</th>
                                <th>Trạng thái</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
    @include('layouts.footer')
    <!-- Modal -->
    

    <script src="{{ url('/src/admin/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            loadDSSV();
            $('[data-toggle="tooltip"]').tooltip();
            $(".img_menu2").addClass("menu_active");
            $(".p_menu2").removeClass("text-secondary");
            $(".p_menu2").addClass("text-danger");

            $('#example').DataTable({
                columnDefs: [{
                    targets: [0, 1, 2],
                    className: 'mdl-data-table__cell--non-numeric'
                }]
            });
            $('#selectSofware').multiselect();
            $('#testSelect1').multiselect();
        });

        $("#mhp").change(function() {
        loadDSSV();
        });

        function loadDSSV(){
            var lhpid = $('#mhp').val();
            console.log('loading: ' + lhpid);
            $.ajax({
                url: "{{ asset('/reload_fb') }}",
                method: "GET",
                data: { 'lhp_id': lhpid },
                success: function(data) {
                    $(".loadFB").css("display", "none");
                    $(".loadFB").html(data);
                    $(".loadFB").fadeIn(500);
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
    @if(Session::has('AddError'))
    <script>
        noti("danger", "Thêm thất bại!");
    </script>
    @endif
</body>

</html>
