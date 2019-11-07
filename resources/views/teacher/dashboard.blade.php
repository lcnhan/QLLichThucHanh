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
            </div>
        </div>
    </section>
    <!-- @include('layouts.footer') -->
    <script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });

   
    </script>
</body>

</html>