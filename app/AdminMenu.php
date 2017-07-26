<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class AdminMenu extends Model
{
    public $timestamps = false;
    protected $fillable = ['pid', 'text', 'route_name', 'url', 'icon_class'];

    /**
     * 获取当前菜单的子菜单
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function submenus()
    {
        return $this->hasMany(AdminMenu::class, 'pid', 'id');
    }

    /**
     * 当前路由为该菜单或其子菜单的路由时,菜单高亮显示
     * 判断菜单是否需要附加active属性
     * @return bool
     */
    public function isActive()
    {
        if ($this->pid != 0) {
            return false;
        } else {
            if ($this->submenus->isEmpty()) {
                return Route::is($this->route_name);
            } else {
                foreach ($this->submenus as $submenu) {
                    if (Route::is($submenu->route_name)) {
                        return true;
                    }
                }
                return false;
            }
        }
    }

    /**
     * 判断数据库中是否含有包含这个Id的菜单
     */
    public static function haveMenuId($mid)
    {
        if ($mid == 0 || AdminMenu::where('id', $mid)->exists()) {
            return true;
        }
        return false;
    }

    /**
     * 删除菜单
     */
    public static function deleteMenu($mid)
    {
        function del($m_id)
        {
            $submenus = AdminMenu::find($m_id)->submenus;
            if (!$submenus->isEmpty()) {
                foreach ($submenus as $submenu) {
                    del($submenu->id);
                }
            }
            AdminMenu::where('id', $m_id)->delete();
        }

        del($mid);
    }
}
