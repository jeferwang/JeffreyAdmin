<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
	public function roleList()
	{
		$roles = Role::all();
		return view('admin.role.roleList');
	}
}
