<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Traits\EntrustPermissionTrait;

class Permission extends Model
{
	use EntrustPermissionTrait;
	
	/**
	 * 删除权限
	 * 1,解除和角色的关系
	 * 2,删除权限本身
	 * @return bool|null
	 */
	public function delPermission()
	{
		// 解除和角色的关系
		foreach ($this->roles as $role) {
			$role->detachPermission($this);
		}
		// 删除权限本身
		return $this->delete();
	}
}
