<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mockery\Exception;
use Zizaco\Entrust\Traits\EntrustPermissionTrait;

class Permission extends Model
{
	use EntrustPermissionTrait;
	
	protected $fillable = ['name', 'display_name', 'description'];
	
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
	
	/**
	 * 更新权限和角色的关联
	 * @param $newRoleIdArray
	 * @return bool
	 */
	public function updateRole($newRoleIdArray)
	{
		try {
			foreach (Role::all() as $role) {
				if ($role->hasPermission($this->name)) {
					if (!in_array($role->id, $newRoleIdArray)) {
						$role->detachPermission($this);
					}
				} else {
					if (in_array($role->id, $newRoleIdArray)) {
						$role->attachPermission($this);
					}
				}
			}
		} catch (Exception $e) {
			\Log::error($e->getMessage());
			return false;
		}
		return true;
	}
}
