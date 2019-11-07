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
                    <h5 class="font-weight-bold text-primary text-center">Thông báo</h5>
                </div>
                <div class="container main">
                    <div class="row noti">
                        <div class="col-1 col-sm-1 col-md-1 col-lg-1 noti_bell text-center align-self-center">
                            <span class="text-danger"><i class="fas fa-bell"></i></span>
                        </div>
                        <div class="col-10 col-sm-10 col-md-10 col-lg-10 noti_content">
                            <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit quae non corporis earum sed quas dolor doloribus, maiores libero, nihil officiis eveniet explicabo expedita impedit fuga vitae distinctio ipsa perferendis!</span>
                        </div>
                        <div class="col-1 col-sm-1 col-md-1 col-lg-1 noti_delete text-center align-self-center">
                            <button class="btn_contrl"><span class="text-danger"><i class="fas fa-trash"></i></span></button>
                        </div>
                        
                    </div>
                    <div class="row noti">
                        <div class="col-1 col-sm-1 col-md-1 col-lg-1 noti_bell text-center align-self-center">
                            <span class="text-danger"><i class="fas fa-bell"></i></span>
                        </div>
                        <div class="col-10 col-sm-10 col-md-10 col-lg-10 noti_content">
                            <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit quae non corporis earum sed quas dolor doloribus, maiores libero, nihil officiis eveniet explicabo expedita impedit fuga vitae distinctio ipsa perferendis!</span>
                        </div>
                        <div class="col-1 col-sm-1 col-md-1 col-lg-1 noti_delete text-center align-self-center">
                            <button class="btn_contrl"><span class="text-danger"><i class="fas fa-trash"></i></span></button>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    <script>
    $(document).ready(function() {
        $(".img_menu6").addClass("menu_active");
        $(".p_menu6").removeClass("text-secondary");
        $(".p_menu6").addClass("text-danger");
    });
    </script>
    <script>
    $(document).ready(function() {
        $('#example').DataTable({
            columnDefs: [{
                targets: [0, 1, 2],
                className: 'mdl-data-table__cell--non-numeric'
            }]
        });
    });
    </script>
</body>

</html>