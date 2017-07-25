<?php

namespace App\Http\Controllers\Admin;

use App\AdminMenu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    /**
     * 后台菜单管理页面
     */
    public function adminMewnuIndex()
    {
        $menus = AdminMenu::where('pid', 0)->get();
        return view('admin.menu.admin-menu-index', ['menus' => $menus]);
    }

    /**
     * 接收数据,添加后台界面菜单
     * @param Request $request
     */
    public function addAdminMenu(Request $request)
    {
        //验证器
        $vali = validator($request->all(), [
            'text' => ['required'],
            'pid' => ['required', 'numeric'],
        ], [
            'text.required' => '菜单名称必须填写 ! ',
            'pid.required' => '上级菜单参数缺失 ! ',
            'pid.numeric' => '上级菜单参数个数错误 ! ',
        ]);
        if ($vali->fails()) {
            return ['status' => 'error', 'msg' => $vali->errors()->first()];
        }
        // 判断新添加的菜单所指定的父级菜单是否存在
        if (!AdminMenu::haveMenuId($request->input('pid'))) {
            return ['status' => 'error', 'msg' => '父级菜单不存在 ! '];
        }
        $create = AdminMenu::create($request->all());
        if ($create) {
            return ['status' => 'success', 'msg' => '添加菜单成功'];
        } else {
            return ['status' => 'error', 'msg' => '添加菜单失败,请刷新重试'];
        }
    }
}
