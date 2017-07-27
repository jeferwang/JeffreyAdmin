@extends('layouts.admin')
@section('title','角色列表')
@section('content')
	<div class="row">
		<form action="" method="post" class="form-horizontal panel" id="add-role-form">
			<h4 class="panel-heading">添加新角色</h4>
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
					<a href="javascript:void(0)" id="role-add" class="btn btn-success">
						<span class="fa fa-plus-circle"></span>
						Add
					</a>
				</div>
			</div>
		</form>
	</div>
	<div class="row">
		<div class="col-md-12 panel">
			<h4 class="panel-heading">角色列表</h4>
			<div class="panel-body">
				<table class="table table-hover table-responsive table-bordered">
					<tr>
						<th>Name</th>
						<th>DisplayName</th>
						<th>Description</th>
						<th>Options</th>
					</tr>
					@if($roles->isEmpty())
						<tr>
							<td colspan="3" style="text-align: center;">无数据</td>
						</tr>
					@else
						@foreach($roles as $role)
							<tr>
								<td>{{$role->name}}</td>
								<td>{{$role->display_name}}</td>
								<td>{{$role->description}}</td>
								<td style="white-space: nowrap;">
									<a href="javascript:void(0)" class="btn btn-xs btn-primary">修改</a>
									<a href="javascript:void(0)" class="btn btn-xs btn-danger del-role-btn" data-id="{{$role->id}}">删除</a>
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
		var addBtn = $('#role-add');
		var addForm = $('#add-role-form');
		$().ready(function () {
			addForm.ajaxForm();
		});
		addBtn.on('click', function () {
			addForm.ajaxSubmit(ajaxFormOptions);
		});
		$('.del-role-btn').on('click', function (event) {
			var rid = event.target.getAttribute('data-id');
			layer.alert('确认删除角色吗 ? 这将会解除所有用户与本角色的关联和本角色与权限的关联 !', {
				icon: 3
				, btn: ['删除', '取消']
				, yes: function () {
					ajaxOptions.url = "{{route('admin.role.del-role')}}";
					ajaxOptions.data = {'_token': csrfToken, 'rid': rid};
					$.ajax(ajaxOptions);
				}
			})
		});
	</script>
@endsection