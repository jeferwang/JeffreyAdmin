@extends('layouts.auth')

@section('content')
	<div id="forgot-box" class="forgot-box widget-box no-border visible">
		<div class="widget-body">
			<div class="widget-main">
				<h4 class="header red lighter bigger">
					<i class="ace-icon fa fa-key"></i>
					Retrieve Password
				</h4>
				<div class="space-6"></div>
				@if (session('status'))
					<div class="alert alert-success">
						{{ session('status') }}
					</div>
				@endif
				<p>
					Enter your email and to receive instructions
				</p>
				<form method="POST" action="{{ route('password.request') }}">
					{{ csrf_field() }}
					<input type="hidden" name="token" value="{{ $token }}">
					<fieldset>
						<label class="block clearfix">
							<span class="block input-icon input-icon-right">
								<input type="email" class="form-control" placeholder="Email" id="email" name="email" value="{{ $email or old('email') }}" required autofocus/>
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
								<input type="password" class="form-control" placeholder="Re-Password" id="password-confirm" name="password_confirmation" required/>
								<i class="ace-icon fa fa-lock"></i>
							</span>
							@if ($errors->has('password_confirmation'))
								<span class="help-block">
									<strong>{{ $errors->first('password_confirmation') }}</strong>
								</span>
							@endif
						</label>
						<div class="clearfix">
							<button class="width-60 pull-right btn btn-sm btn-danger">
								<i class="ace-icon fa fa-lightbulb-o"></i>
								<span class="bigger-110">Reset Password</span>
							</button>
						</div>
					</fieldset>
				</form>
			</div><!-- /.widget-main -->
			<div class="toolbar center">
				<a href="{{ url('/login') }}" class="back-to-login-link">
					Back to login
					<i class="ace-icon fa fa-arrow-right"></i>
				</a>
			</div>
		</div><!-- /.widget-body -->
	</div><!-- /.forgot-box -->
@endsection
