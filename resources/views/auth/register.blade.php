@extends('layouts.auth')
@section('title','注册')
@section('content')
	<div id="signup-box" class="signup-box widget-box no-border visible">
		<div class="widget-body">
			<div class="widget-main">
				<h4 class="header green lighter bigger">
					<i class="ace-icon fa fa-users blue"></i>
					New User Registration
				</h4>
				<div class="space-6"></div>
				<p> Enter your details to begin: </p>
				<form method="POST" action="{{ route('register') }}">
					{{ csrf_field() }}
					<fieldset>
						<label class="block clearfix">
							<span class="block input-icon input-icon-right">
								<input class="form-control" placeholder="Username" id="name" name="name" value="{{ old('name') }}" required autofocus/>
								<i class="ace-icon fa fa-user"></i>
							</span>
							@if ($errors->has('name'))
								<span class="help-block">
									<strong>{{ $errors->first('name') }}</strong>
								</span>
							@endif
						</label>
						<label class="block clearfix">
							<span class="block input-icon input-icon-right">
								<input type="email" class="form-control" placeholder="Email" id="email" name="email" value="{{ old('email') }}" required/>
								<i class="ace-icon fa fa-envelope"></i>
							</span>
							@if ($errors->has('email'))
								<span class="help-block">
									<strong>{{ $errors->first('email') }}</strong>
								</span>
							@endif
						</label>
						<label class="block clearfix">
							<span class="block input-icon input-icon-right">
								<input type="password" class="form-control" placeholder="Password" id="password" name="password" required/>
								<i class="ace-icon fa fa-lock"></i>
							</span>
							@if ($errors->has('password'))
								<span class="help-block">
									<strong>{{ $errors->first('password') }}</strong>
								</span>
							@endif
						</label>
						<label class="block clearfix">
							<span class="block input-icon input-icon-right">
								<input type="password" class="form-control" placeholder="Repeat password" id="password-confirm" name="password_confirmation" required/>
								<i class="ace-icon fa fa-retweet"></i>
							</span>
						</label>
						<label class="block">
							<input type="checkbox" class="ace" id="accept-agreement"/>
							<span class="lbl" onclick="accept()">
								I accept the
								<a href="#">User Agreement</a>
							</span>
						</label>
						<div class="space-24"></div>
						<div class="clearfix">
							<button type="reset" class="width-30 pull-left btn btn-sm">
								<i class="ace-icon fa fa-refresh"></i>
								<span class="bigger-110">Reset</span>
							</button>
							<button id="register-btn" class="width-65 pull-right btn btn-sm btn-success" disabled="disabled">
								<span class="bigger-110">Register</span>
								<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
							</button>
						</div>
					</fieldset>
				</form>
			</div>
			<div class="toolbar center">
				<a href="{{ url('/login') }}" data-target="#login-box" class="back-to-login-link">
					<i class="ace-icon fa fa-arrow-left"></i>
					Back to login
				</a>
			</div>
		</div><!-- /.widget-body -->
	</div>
@endsection
@section('foot')
	<script>
		function accept() {
			if (document.getElementById('accept-agreement').checked) {
				$('#register-btn').attr('disabled', 'disabled')
			} else {
				$('#register-btn').removeAttr('disabled')
			}
		}
	</script>
@endsection
