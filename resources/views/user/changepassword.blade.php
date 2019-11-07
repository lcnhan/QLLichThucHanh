<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="icon" href="src/images/favicon.png" type="image/x-icon">
	<title>Hệ thống lịch thực hành - CIT</title>
	<!--CSS-->
	<link rel="stylesheet" href="src/css/style.css">
	<link rel="stylesheet" href="src/lib/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	<!--JS-->
	<script src="src/lib/jquery/jquery-3.4.1.min.js"></script>
	<script src="src/lib/bootstrap/bootstrap.bundle.min.js"></script>
	<script src="src/lib/bootstrap/bootstrap.min.js"></script>
	<script src="src/lib/popper/popper.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
	@include('layouts.header')
	<section id="sec1" class="mt-5">
		<div class="col-xs-6 col-sm-6 col-md-6">	
			<!-- .student-info -->
			<div class="student-info">
				@if(Session::has('message'))
				<div class="alert alert-success">{{Session::get('message')}}</div>
				@endif
				@if(Session::has('loi'))
				<div class="alert alert-danger">{{Session::get('loi')}}</div>
				@endif
				<form action="changepassword" method="Post" enctype="multipart/form-data">
					{!!csrf_field()!!}
					<h2>Đổi Mật Khẩu</h2>
					<div class="input-container">
						<i class="fa fa-key icon"></i>
						<input class="input-field" type="text" placeholder="Mật Khẩu Cũ" name="oldpassword">
					</div>

					<div class="input-container">
						<i class="fa fa-key icon"></i>
						<input class="input-field" type="password" placeholder="Mật Khẩu Mới" name="password">
					</div>

					<div class="input-container">
						<i class="fa fa-check-square icon"></i>
						<input class="input-field" type="password" placeholder="Nhập Lại Mật Khẩu"  name="repassword" >
					</div>
					<button type="submit" class="btn">Xác Nhận</button>
				</form>
			</div>
			<!-- .student-info -->
		</div>				
	</section>

	<style type="text/css">
		* {box-sizing: border-box;}

		/* Style the input container */
		.input-container {
		  display: flex;
		  width: 100%;
		  margin-bottom: 15px;
		}

		/* Style the form icons */
		.icon {
		  padding: 10px;
		  background: dodgerblue;
		  color: white;
		  min-width: 50px;
		  text-align: center;
		}

		/* Style the input fields */
		.input-field {
		  width: 100%;
		  padding: 10px;
		  outline: none;
		}

		.input-field:focus {
		  border: 2px solid dodgerblue;
		}

		/* Set a style for the submit button */
		.btn {
		  background-color: dodgerblue;
		  color: white;
		  padding: 15px 20px;
		  border: none;
		  cursor: pointer;
		  width: 100%;
		  opacity: 0.9;
		}

		.btn:hover {
		  opacity: 1;
		}
	</style>
	<script>
		$(document).ready(function() {
			$(".w_1").click();
        // $('#tbl').DataTable();
    });
	</script>
</body>

</html>