<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="" type="image/x-icon">
    <title>Hệ thống lịch thực hành - CIT</title>
    <!--CSS-->
    <link rel="stylesheet" href="{{ url('src/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('src/css/user.css') }}">

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
                    <h5 class="font-weight-bold text-primary text-center">Điểm danh sinh viên</h5>
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
                <div class="col-lg-12 main loadSV" >
                	<table id="example" class="mdl-data-table table-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>MSSV</th>
                                <th>Họ tên</th>
                                <th>Tuần 1</th>
                                <th>Tuần 2</th>
                                <th>Tuần 3</th>
                                <th>Tuần 4</th>
                                <th>Tuần 5</th>
                                <th>Tuần 6</th>
                                <th>Tuần 7</th>
                                <th>Tuần 8</th>
                                <th>Tuần 9</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach($dssv as $sv)
                                    <tr>
                                        <td class="text-center">{{$loop->iteration}}</td>
                                        <td>{{$sv->mssv}}</td>
                                        <td>{{$sv->ten_sv}}</td>
                                        <td>
		                                    <input type="checkbox" id="t1-1">
		                                    <label for="t1-1"> </label>
		                                </td>
		                                <td>
		                                    <input type="checkbox" id="t1-2">
		                                    <label for="t1-2"> </label>
		                                </td>
		                                <td>
		                                    <input type="checkbox" id="t1-3">
		                                    <label for="t1-3"> </label>
		                                </td>
		                                <td>
		                                    <input type="checkbox" id="t1-4">
		                                    <label for="t1-4"> </label>
		                                </td>
		                                <td>
		                                    <input type="checkbox" id="t1-5">
		                                    <label for="t1-5"> </label>
		                                </td>
		                                <td>
		                                    <input type="checkbox" id="t1-6">
		                                    <label for="t1-6"> </label>
		                                </td>
		                                <td>
		                                    <input type="checkbox" id="t1-7">
		                                    <label for="t1-7"> </label>
		                                </td>
		                                <td>
		                                    <input type="checkbox" id="t1-8">
		                                    <label for="t1-8"> </label>
		                                </td>
		                                <td>
		                                    <input type="checkbox" id="t1-9">
		                                    <label for="t1-9"> </label>
		                                </td>
                                        <td class="text-center">
                                            <button type="button" class="btn_control text-danger" onclick="deleteData({{$sv->id_sv_lhp}})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach --}}
                        </tbody>
                        <tfoot>
                            <tr>
                                
                                <th>STT</th>
                                <th>MSSV</th>
                                <th>Họ tên</th>
                                <th>Tuần 1</th>
                                <th>Tuần 2</th>
                                <th>Tuần 3</th>
                                <th>Tuần 4</th>
                                <th>Tuần 5</th>
                                <th>Tuần 6</th>
                                <th>Tuần 7</th>
                                <th>Tuần 8</th>
                                <th>Tuần 9</th>
                            </tr>
                        </tfoot>
                    </table>
                    
                </div>
            </div>
        </div>
    </section>
    <script>
    $(document).ready(function() {
        loadDSSV();
        $('[data-toggle="tooltip"]').tooltip();
        $(".img_menu5").addClass("menu_active");
        $(".p_menu5").removeClass("text-secondary");
        $(".p_menu5").addClass("text-danger");

        $('#example').DataTable({
            columnDefs: [{
                targets: [0, 1, 2],
                className: 'mdl-data-table__cell--non-numeric'
            }]
        });
        $('#testSelect1').multiselect();
    });

    $("#mhp").change(function() {
        loadDSSV();
    });

    function loadDSSV(){
        var lhpid = $('#mhp').val();
        console.log('loading: ' + lhpid);
        $.ajax({
            url: "{{ asset('/reload_Teacher_attendance') }}",
            method: "GET",
            data: { 'lhp_id': lhpid },
            success: function(data) {
                $(".loadSV").css("display", "none");
                $(".loadSV").html(data);
                $(".loadSV").fadeIn(500);
                console.log('get full list success');
            }
        });
    }

    function checkDD(mssv, tuan){
        var mlhp = $('#mhp').val();
        if (!$("#"+mssv+"-"+tuan).is(":checked")) {
           removeAttendance(mssv, tuan, mlhp);
        }
        else{
            addAttendance(mssv, tuan, mlhp);
        }
    }

    function addAttendance(mssv, tuan, mlhp){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ asset('/addAttendance') }}",
            method: "POST",
            data: { 
                "malhp": mlhp,
                "mssv": mssv,
                "tuan": tuan,
             },
            success: function(data) {
                console.log('đã điểm danh cho: '+mssv+'- tuần: '+tuan);
            }
        });
    }

    function removeAttendance(mssv, tuan, mlhp){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ asset('/removeAttendance') }}",
            method: "POST",
            data: { 
                "malhp": mlhp,
                "mssv": mssv,
                "tuan": tuan,
             },
            success: function(data) {
                console.log('delete success');
            }
        });
    }
    </script>
</body>

</html>