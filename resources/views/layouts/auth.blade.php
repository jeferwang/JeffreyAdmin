<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<meta charset="utf-8"/>
	<title>@yield('title')</title>
	<meta name="description" content="User login page"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
	<!-- bootstrap & fontawesome -->
	<link rel="stylesheet" href="{{asset(config('static.dir.admin').'/assets/css/bootstrap.min.css')}}"/>
	<link rel="stylesheet" href="{{asset(config('static.dir.admin').'/assets/font-awesome/4.7.0/css/font-awesome.min.css')}}"/>
	<!-- text fonts -->
	<link rel="stylesheet" href="{{asset(config('static.dir.admin').'/assets/css/fonts.googleapis.com.css')}}"/>
	<!-- ace styles -->
	<link rel="stylesheet" href="{{asset(config('static.dir.admin').'/assets/css/ace.min.css')}}"/>
	<!--[if lte IE 9]>
	<link rel="stylesheet" href="{{asset(config('static.dir.admin').'/assets/css/ace-part2.min.css')}}"/>
	<![endif]-->
	<link rel="stylesheet" href="{{asset(config('static.dir.admin').'/assets/css/ace-rtl.min.css')}}"/>
	<!--[if lte IE 9]>
	<link rel="stylesheet" href="{{asset(config('static.dir.admin').'/assets/css/ace-ie.min.css')}}"/>
	<![endif]-->
	<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->
	<!--[if lte IE 8]>
	<script src="{{asset(config('static.dir.admin').'/assets/js/html5shiv.min.js')}}"></script>
	<script src="{{asset(config('static.dir.admin').'/assets/js/respond.min.js')}}"></script>
	<![endif]-->
	@yield('head')
</head>
<body class="login-layout">
<div class="main-container">
	<div class="main-content">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="login-container">
					<div class="center">
						<h1>
							<i class="ace-icon fa fa-leaf green"></i>
							<span class="red">Jeffrey</span>
							<span class="white" id="id-text2">Application</span>
						</h1>
						<h4 class="blue" id="id-company-text">&copy; Company Name</h4>
					</div>
					<div class="space-6"></div>
					<div class="position-relative">
						@yield('content')
					</div>
					<!-- /.position-relative -->
					<div class="navbar-fixed-top align-right">
						<br/>
						&nbsp;
						<a id="btn-login-dark" href="#">Dark</a>
						&nbsp;
						<span class="blue">/</span>
						&nbsp;
						<a id="btn-login-blur" href="#">Blur</a>
						&nbsp;
						<span class="blue">/</span>
						&nbsp;
						<a id="btn-login-light" href="#">Light</a>
						&nbsp; &nbsp; &nbsp;
					</div>
				</div>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.main-content -->
</div><!-- /.main-container -->
<!-- basic scripts -->
<!--[if !IE]> -->
<script src="{{asset(config('static.dir.admin').'/assets/js/jquery-2.1.4.min.js')}}"></script>
<!-- <![endif]-->
<!--[if IE]>
<script src="{{asset(config('static.dir.admin').'/assets/js/jquery-1.11.3.min.js')}}"></script>
<![endif]-->
<script type="text/javascript">
	if ('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
</script>
<!-- inline scripts related to this page -->
<script type="text/javascript">
	jQuery(function ($) {
		$('#btn-login-dark').on('click', function (e) {
			$('body').attr('class', 'login-layout');
			$('#id-text2').attr('class', 'white');
			$('#id-company-text').attr('class', 'blue');
			e.preventDefault();
		});
		$('#btn-login-light').on('click', function (e) {
			$('body').attr('class', 'login-layout light-login');
			$('#id-text2').attr('class', 'grey');
			$('#id-company-text').attr('class', 'blue');
			e.preventDefault();
		});
		$('#btn-login-blur').on('click', function (e) {
			$('body').attr('class', 'login-layout blur-login');
			$('#id-text2').attr('class', 'white');
			$('#id-company-text').attr('class', 'light-blue');
			e.preventDefault();
		});
		
	});
</script>
@yield('foot')
</body>
</html>
