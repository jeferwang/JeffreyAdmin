<?php

namespace App\Http\Controllers\Admin;

use App\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
	public function permissionList(Request $request)
	{
		if ($request->isMethod('get')) {
			$permissions = Permission::all();
			return view('admin.permission.permission-list', ['permissions' => $permissions]);
		} else {
			$validator = validator($request->all(), [
				'name'         => ['required', Rule::unique('roles', 'name')],
				'display_name' => ['required'],
				'description'  => ['required'],
			]);
			if ($validator->fails()) {
				return ['status' => 'error', 'msg' => $validator->errors()->first()];
			} else {
				$createPermission = Permission::create($request->all());
				return $createPermission ? ['status' => 'success', 'msg' => '添加权限成功 !'] : ['status' => 'error', 'msg' => '添加权限失败 !'];
			}
		}
	}
	
	
	public function delPermission(Request $request)
	{
		$permission = Permission::find($request->input('pmid'));
		if (!$permission) {
			return ['status' => 'error', 'msg' => '要删除的权限不存在 !'];
		} else {
			return $permission->delPermission() ? ['status' => 'success', 'msg' => '删除权限成功 , 并已经解除权限和角色的关联 !'] : ['status' => 'error', 'msg' => '删除权限失败 , 请开发者排查问题 !'];
		}
	}
}
