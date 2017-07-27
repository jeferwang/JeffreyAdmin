<?php

namespace App\Http\Controllers\Admin;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
	/**
	 * 权限列表
	 * @param Request $request
	 * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
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
	
	/**
	 * 删除权限
	 * 1,根据pmid得到Permission对象
	 * 2,判断是否存在
	 * 3,存在则执行删除操作
	 * @param Request $request
	 * @return array
	 */
	public function delPermission(Request $request)
	{
		$permission = Permission::find($request->input('pmid'));
		if (!$permission) {
			return ['status' => 'error', 'msg' => '要删除的权限不存在 !'];
		} else {
			return $permission->delPermission() ? ['status' => 'success', 'msg' => '删除权限成功 , 并已经解除权限和角色的关联 !'] : ['status' => 'error', 'msg' => '删除权限失败 , 请开发者排查问题 !'];
		}
	}
	
	public function editPermission(Request $request)
	{
		$permission = Permission::find($request->route('pmid'));
		if ($request->isMethod('get')) { // GET请求返回编辑的视图
			$roles = Role::all();
			return view('admin.permission.edit-permission', ['roles' => $roles, 'permission' => $permission]);
		} else {  // POST请求处理权限信息编辑
			$validator = validator($request->all(), [
				'name'         => ['required', Rule::unique('permissions', 'name')->ignore($permission->id)],
				'display_name' => ['required'],
				'description'  => ['required'],
			]);
			if ($validator->fails()) {
				return ['status' => 'error', 'msg' => $validator->errors()->first()];
			} else {
				// 更新权限的三个基本信息
				$permission->fill($request->all());
				// 更新包含此权限的角色关联关系
				$newRoleIdArray = $request->input('rolesId',[]);
				if ($permission->save() && $permission->updateRole($newRoleIdArray)) {
					return ['status' => 'success', 'msg' => '更新权限信息成功 !'];
				} else {
					return ['status' => 'success', 'msg' => '更新权限信息失败 , 请查看Log文件 !'];
				}
			}
		}
	}
}
