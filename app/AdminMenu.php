<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class AdminMenu extends Model
{
    public $timestamps = false;

    public function submenus()
    {
        return $this->hasMany(AdminMenu::class, 'pid', 'id');
    }

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
}
