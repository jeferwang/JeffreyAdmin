@extends('layouts.admin')
@section('title','用户列表')
@section('content')
	<div class="row">
		<div class="col-md-12 panel">
			<form action="{{route('admin.user.add-user')}}" method="post" class="form-horizontal" id="add-user-form">
				<h4 class="panel-heading">添加新用户</h4>
				{{csrf_field()}}
				<div class="form-group panel-body">
					<label for="name" class="control-label col-md-1">Name</label>
					<div class="col-md-2">
						<input name="name" id="name" class="form-control">
					</div>
					<label for="email" class="control-label col-md-1">Email</label>
					<div class="col-md-2">
						<input name="email" id="email" class="form-control">
					</div>
					<label for="password" class="control-label col-md-1">Password</label>
					<div class="col-md-2">
						<input name="password" id="password" class="form-control">
					</div>
					<div class="col-md-3">
						<a href="javascript:void(0)" id="add-user" class="btn btn-success">
							<span class="fa fa-plus-circle"></span>
							Add User
						</a>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 panel">
			<h4 class="panel-heading">用户列表</h4>
			<div class="panel-body">
				<table class="table table-hover table-responsive table-bordered">
					<tr>
						<th>用户名</th>
						<th>登录邮箱</th>
						<th>注册时间</th>
						<th>角色</th>
						<th>操作</th>
					</tr>
					@if($users->isEmpty())
						<tr>
							<td colspan="5" style="text-align: center;">无数据</td>
						</tr>
					@else
						@foreach($users as $user)
							<tr>
								<td>{{$user->name}}</td>
								<td>{{$user->email}}</td>
								<td>{{$user->created_at}}</td>
								<td>
									@foreach($user->roles as $role)
										<span class="badge">{{$role->display_name}}</span>
									@endforeach
								</td>
								<td style="white-space: nowrap;">
									<a href="{{route('admin.user.edit-user',['uid'=>$user->id])}}" class="btn btn-xs btn-primary">修改</a>
									<a href="javascript:void(0)" class="btn btn-xs btn-danger del-user-btn" data-id="{{$user->id}}">删除</a>
								</td>
							</tr>
						@endforeach
						<tr>
							<td colspan="5" style="text-align: center;">
								@if($users->total()==1)
									没有更多数据
								@else
									{{$users->links()}}
								@endif
							</td>
						</tr>
					@endif
				</table>
			</div>
		</div>
	</div>
@endsection
@section('foot')
	<script>
		var addBtn = $('#add-user');
		var addForm = $('#add-user-form');
		$().ready(function () {
			addForm.ajaxForm();
		});
		addBtn.on('click', function () {
			ajaxFormOptions.success = function (data) {
				if (data.status === 'success') {
					layer.alert(data.msg, {
						icon: 6
						, yes: function () {
							location.reload(true);
						}
					});
				} else {
					layer.alert(data.msg, {icon: 5});
				}
			};
			addForm.ajaxSubmit(ajaxFormOptions);
		});
		// 点击删除用户按钮之后执行的操作
		$('.del-user-btn').on('click', function () {
			var uid = $(this).attr('data-id');
			layer.alert('确认删除用户吗 ? 这将会解除本用户与角色的关联 !', {
				icon: 3
				, btn: ['删除', '取消']
				, yes: function () {
					ajaxOptions.url = "{{route('admin.user.del-user')}}";
					ajaxOptions.data = {'_token': csrfToken, 'uid': uid};
					ajaxOptions.success = function (data) {
						if (data.status === 'success') {
							layer.alert(data.msg, {
								icon: 6
								, btn: ['刷新']
								, yes: function () {
									location.reload(true);
								}
							});
						} else {
							layer.alert(data.msg, {icon: 5});
						}
					};
					$.ajax(ajaxOptions);
				}
			});
		});
	</script>
@endsection