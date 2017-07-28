@extends('layouts.admin')
@section('title','更新用户 : '.$user->email)
@section('head')
	<style>
		.role-box {
			cursor: pointer;
		}
		
		.role-box td {
			padding: 0 5px;
		}
	</style>
@endsection
@section('content')
	<form action="" method="post" class="form-horizontal" id="edit-user-form">
		{{csrf_field()}}
		<div class="row panel">
			<h4 class="panel-heading">更新用户 : {{$user->email}}</h4>
		</div>
		<div class="row panel">
			<h4 class="panel-heading">基本信息</h4>
			<div class="col-md-12">
				<div class="form-group panel-body">
					<label for="name" class="control-label col-md-1">Name</label>
					<div class="col-md-3">
						<input name="name" id="name" class="form-control" value="{{$user->name}}">
					</div>
					<label for="email" class="control-label col-md-1">Email</label>
					<div class="col-md-3">
						<input name="email" id="email" class="form-control" value="{{$user->email}}">
					</div>
					<label for="password" class="control-label col-md-1">Password</label>
					<div class="col-md-3">
						<input name="password" id="password" class="form-control" placeholder="留空保持密码不变">
					</div>
				</div>
			</div>
		</div>
		<div class="row panel">
			<h4 class="panel-heading">关联角色</h4>
			<div class="panel-body">
				@foreach($roles as $role)
					@php
						$style=$user->hasRole($role->name)?'success':'danger';
						$checked=$user->hasRole($role->name)?'checked':'';
					@endphp
					<div class="alert alert-{{$style}} col-md-3 role-box" data-style="{{$style}}">
						<input type="checkbox" class="role-id" name="rolesId[]" style="display: none;" value="{{$role->id}}" {{$checked}}>
						<div>{{$role->name}}</div>
						<div>{{$role->display_name}}</div>
						<div>{{$role->description}}</div>
					</div>
				@endforeach
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<a href="javascript:void(0)" id="user-update" class="btn btn-success">
					<span class="fa fa-upload"></span>
					Update User
				</a>
			</div>
		</div>
	</form>
@endsection
@section('foot')
	<script>
		var roleBox = $('.role-box');
		roleBox.on('click', function () {
			$(this).children()[0].checked = !$(this).children()[0].checked;
			if ($(this).children()[0].checked) {
				$(this).removeClass('alert-danger').addClass('alert-success').attr('data-style', 'success');
			} else {
				$(this).removeClass('alert-success').addClass('alert-danger').attr('data-style', 'danger');
			}
		}).on('mouseover', function () {
			var dataStyle = $(this).attr('data-style');
			$(this).removeClass('alert-' + dataStyle).addClass('alert-info');
		}).on('mouseout', function () {
			var dataStyle = $(this).attr('data-style');
			$(this).removeClass('alert-info').addClass('alert-' + dataStyle);
		});
		$().ready(function () {
			$('#edit-user-form').ajaxForm();
		});
		$('#user-update').on('click', function () {
			ajaxFormOptions.success = function (data) {
				if (data.status === 'success') {
					layer.alert(data.msg, {
						icon: 6
						, btn: ['返回', '留下']
						, yes: function () {
							location.href = "{{route('admin.user.user-list')}}"
						}
					});
				} else {
					layer.alert(data.msg, {icon: 5});
				}
			};
			$('#edit-user-form').ajaxSubmit(ajaxFormOptions)
		});
	</script>
@endsection