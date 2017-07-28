<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
	/**
	 * 用户列表
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function userList()
	{
		$users = User::paginate(15);
		return view('admin.user.user-list', ['users' => $users]);
	}
	
	/**
	 * 删除用户
	 * @param Request $request $request->input('uid') UserId
	 * @return array Ajax返回
	 */
	public function delUser(Request $request)
	{
		$user = User::find($request->input('uid'));
		return $user->delUser() ? ['status' => 'success', 'msg' => '删除用户成功 , 并已经解除关联的角色 !'] : ['status' => 'error', 'msg' => '删除用户失败 !'];
	}
	
	/**
	 * 编辑用户信息
	 * GET 显示编辑界面
	 * POST 执行编辑操作
	 * @param Request $request
	 * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function editUser(Request $request)
	{
		$user = User::find($request->route('uid'));
		if ($request->isMethod('get')) {
			$roles=Role::all();
			return view('admin.user.edit-user', ['user' => $user,'roles'=>$roles]);
		} else {
			// 更新用户的基本信息
			$validator = validator($request->all(), [
				'name'  => 'required|string|max:255',
				'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
			]);
			if ($validator->fails()) {
				return ['status' => 'error', 'msg' => $validator->errors()->first()];
			}
			$user->name = $request->input('name');
			$user->email = $request->input('email');
			if ($request->input('password')) {
				$user->password = bcrypt($request->input('password'));
			}
			return ($user->updateRoles($request->input('rolesId')) && $user->save()) ? ['status' => 'success', 'msg' => '修改用户信息操作成功 !'] : ['status' => 'error', 'msg' => '修改用户信息操作失败 !'];
		}
	}
	
	/**
	 * 添加新用户
	 * 1,验证
	 * 2,创建
	 * @param Request $request
	 * @return array
	 */
	public function addUser(Request $request)
	{
		// 验证
		$validator = validator($request->all(), [
			'name'     => 'required|string|max:255',
			'email'    => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:6',
		]);
		if ($validator->fails()) {
			return ['status' => 'error', 'msg' => $validator->errors()->first()];
		}
		$data = $request->all();
		// 创建
		if (User::create([
			'name'     => $data['name'],
			'email'    => $data['email'],
			'password' => bcrypt($data['password']),
		])) {
			return ['status' => 'success', 'msg' => '创建用户成功 !'];
		} else {
			return ['status' => 'error', 'msg' => '创建用户失败 !'];
		}
	}
}
