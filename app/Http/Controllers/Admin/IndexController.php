<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
	/**
	 * 后台管理的首页
	 */
	public function index()
	{
		return view('admin.index.index');
    }
}
