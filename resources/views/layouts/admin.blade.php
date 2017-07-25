<!doctype html>
<html lang="zh_CN">

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{asset(config('static.dir.admin').'/assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset(config('static.dir.admin').'/assets/vendor/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset(config('static.dir.admin').'/assets/vendor/linearicons/style.css')}}">
    <!--LayUI-->
    <link rel="stylesheet" href="{{asset(config('static.dir.vendor').'/layui/css/layui.css')}}">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{asset(config('static.dir.admin').'/assets/css/main.css')}}">
    <link rel="stylesheet" href="{{asset(config('static.dir.admin').'/assets/css/diy.css')}}">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset(config('static.dir.admin').'/assets/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset(config('static.dir.admin').'/assets/img/favicon.png')}}">
    @yield('head')
</head>

<body>
<!-- WRAPPER -->
<div id="wrapper">
    <!-- NAVBAR -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="brand">
            <a href="index.html"><img src="{{asset(config('static.dir.admin').'/assets/img/logo-dark.png')}}" alt="Klorofil Logo"
                                      class="img-responsive logo"></a>
        </div>
        <div class="container-fluid">
            <div class="navbar-btn">
                <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
            </div>
            <form class="navbar-form navbar-left">
                <div class="input-group">
                    <input value="" class="form-control" placeholder="Search dashboard...">
                    <span class="input-group-btn"><button type="button" class="btn btn-primary">Go</button></span>
                </div>
            </form>
            <div class="navbar-btn navbar-btn-right">
                <a class="btn btn-success update-pro" href="javascript:void(0)" title="Upgrade to Pro"
                   target="_blank"><i class="fa fa-rocket"></i>
                    <span>UPGRADE TO PRO</span></a>
            </div>
            <div id="navbar-menu">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                            <i class="lnr lnr-alarm"></i>
                            <span class="badge bg-danger">5</span>
                        </a>
                        <ul class="dropdown-menu notifications">
                            <li><a href="#" class="notification-item"><span class="dot bg-warning"></span>System space is almost full</a></li>
                            <li><a href="#" class="notification-item"><span class="dot bg-danger"></span>You have 9 unfinished tasks</a></li>
                            <li><a href="#" class="notification-item"><span class="dot bg-success"></span>Monthly report is available</a></li>
                            <li><a href="#" class="notification-item"><span class="dot bg-warning"></span>Weekly meeting in 1 hour</a></li>
                            <li><a href="#" class="notification-item"><span class="dot bg-success"></span>Your request has been approved</a></li>
                            <li><a href="#" class="more">See all notifications</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="lnr lnr-question-circle"></i> <span>Help</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Basic Use</a></li>
                            <li><a href="#">Working With Data</a></li>
                            <li><a href="#">Security</a></li>
                            <li><a href="#">Troubleshooting</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{asset(config('static.dir.admin').'/assets/img/user.png')}}" class="img-circle" alt="Avatar"> <span>Samuel</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
                            <li><a href="#"><i class="lnr lnr-envelope"></i> <span>Message</span></a></li>
                            <li><a href="#"><i class="lnr lnr-cog"></i> <span>Settings</span></a></li>
                            <li><a href="#"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
                        </ul>
                    </li>
                    <!-- <li>
                        <a class="update-pro" href="#downloads/klorofil-pro-bootstrap-admin-dashboard-template/?utm_source=klorofil&utm_medium=template&utm_campaign=KlorofilPro" title="Upgrade to Pro" target="_blank"><i class="fa fa-rocket"></i> <span>UPGRADE TO PRO</span></a>
                    </li> -->
                </ul>
            </div>
        </div>
    </nav>
    <!-- END NAVBAR -->
    <!-- LEFT SIDEBAR -->
    <div id="sidebar-nav" class="sidebar">
        <div class="sidebar-scroll">
            <nav>
                <ul class="nav">
                    @foreach($adminMenu as $am)
                        @if($am->submenus->isEmpty())
                            <li>
                                <a href="{{$am->route_name!=null?call_user_func_array('route',[$am->route_name]):$am->url}}" @if($am->isActive()) class="active" @endif>
                                    <i class="{{$am->icon_class}}"></i>
                                    <span>{{$am->text}}</span>
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="#subMenu{{$am->id}}" data-toggle="collapse" class="collapsed @if($am->isActive()) active @endif">
                                    <i class="{{$am->icon_class}}"></i>
                                    <span>{{$am->text}}</span>
                                    <i class="icon-submenu lnr lnr-chevron-left"></i>
                                </a>
                                <div id="subMenu{{$am->id}}" class="collapse">
                                    <ul class="nav">
                                        @foreach($am->submenus as $bm)
                                            <li>
                                                <a href="{{$bm->route_name!=null?call_user_func_array('route',[$bm->route_name]):$bm->url}}" class="">{{$bm->text}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            <!--
				<ul class="nav">
					<li>
						<a href="index.html" class="active">
							<i class="lnr lnr-home"></i>
							<span>Dashboard</span>
						</a>
					</li>
					<li>
						<a href="#subPages1" data-toggle="collapse" class="collapsed">
							<i class="lnr lnr-file-empty"></i>
							<span>Pages</span>
							<i class="icon-submenu lnr lnr-chevron-left"></i>
						</a>
						<div id="subPages1" class="collapse ">
							<ul class="nav">
								<li><a href="{{route('admin.index.index')}}" class="">Profile</a></li>
							</ul>
						</div>
					</li>
				</ul>
				-->
            </nav>
        </div>
    </div>
    <!-- END LEFT SIDEBAR -->
    <!-- MAIN -->
    <div class="main">
        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
        <!-- END MAIN CONTENT -->
    </div>
    <!-- END MAIN -->
    <div class="clearfix"></div>
    <footer>
        <div class="container-fluid">
            <p class="copyright">&copy; {{date('Y')}} Jeffrey</p>
        </div>
    </footer>
</div>
<!-- END WRAPPER -->
<!-- Javascript -->
<script src="{{asset(config('static.dir.admin').'/assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset(config('static.dir.admin').'/assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset(config('static.dir.vendor').'/jquery-form/jquery.form.min.js')}}"></script>
<script src="{{asset(config('static.dir.vendor').'/layui/layui.js')}}"></script>
<script>
    //获取layer实例
    $().ready(function () {
        var csrfToken = "{{csrf_token()}}";
        layui.use(['layer'], function () {
            window.layer = layui.layer;
        });
    });
</script>
@yield('foot')
</body>

</html>
