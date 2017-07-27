@extends('layouts.admin')
@section('title','权限列表')
@section('content')
	<div class="row">
		<form action="" method="post" class="form-horizontal panel" id="add-permission-form">
			<h4 class="panel-heading">添加新权限</h4>
			{{csrf_field()}}
			<div class="form-group panel-body">
				<label for="name" class="control-label col-md-1">Name</label>
				<div class="col-md-2">
					<input name="name" id="name" class="form-control">
				</div>
				<label for="display_name" class="control-label col-md-1">DisplayName</label>
				<div class="col-md-2">
					<input name="display_name" id="display_name" class="form-control">
				</div>
				<label for="description" class="control-label col-md-1">Description</label>
				<div class="col-md-2">
					<input name="description" id="description" class="form-control">
				</div>
				<div class="col-md-3">
					<a href="javascript:void(0)" id="permission-add" class="btn btn-success">
						<span class="fa fa-plus-circle"></span>
						Add Permission
					</a>
				</div>
			</div>
		</form>
	</div>
	<div class="row">
		<div class="col-md-12 panel">
			<h4 class="panel-heading">权限列表</h4>
			<div class="panel-body">
				<table class="table table-hover table-responsive table-bordered">
					<tr>
						<th>Name</th>
						<th>DisplayName</th>
						<th>Description</th>
						<th>Roles</th>
						<th>Options</th>
					</tr>
					@if($permissions->isEmpty())
						<tr>
							<td colspan="5" style="text-align: center;">无数据</td>
						</tr>
					@else
						@foreach($permissions as $permission)
							<tr>
								<td>{{$permission->name}}</td>
								<td>{{$permission->display_name}}</td>
								<td>{{$permission->description}}</td>
								<td>
									@foreach($permission->roles as $role)
										<span class="badge">{{$role->display_name}}</span>
									@endforeach
								</td>
								<td style="white-space: nowrap;">
									<a href="{{route('admin.permission.edit-permission',['pmid'=>$permission->id])}}" class="btn btn-xs btn-primary">修改</a>
									<a href="javascript:void(0)" class="btn btn-xs btn-danger del-permission-btn" data-id="{{$permission->id}}">删除</a>
								</td>
							</tr>
						@endforeach
					@endif
				</table>
			</div>
		</div>
	</div>
@endsection
@section('foot')
	<script>
		var addBtn = $('#permission-add');
		var addForm = $('#add-permission-form');
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
		$('.del-permission-btn').on('click', function (event) {
			var pmid = event.target.getAttribute('data-id');
			layer.alert('确认删除权限吗 ? 这将会解除所有角色与本权限的关联 !', {
				icon: 3
				, btn: ['删除', '取消']
				, yes: function () {
					ajaxOptions.url = "{{route('admin.permission.del-permission')}}";
					ajaxOptions.data = {'_token': csrfToken, 'pmid': pmid};
					ajaxOptions.success = function (data) {
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
					$.ajax(ajaxOptions);
				}
			})
		});
	</script>
@endsection