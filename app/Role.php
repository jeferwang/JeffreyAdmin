<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mockery\Exception;
use Zizaco\Entrust\Traits\EntrustRoleTrait;

class Role extends Model
{
	use EntrustRoleTrait;
	
	protected $fillable = ['name', 'display_name', 'description'];
	
	/**
	 * 删除角色
	 * 1,解除和所有相关权限的关系
	 * 2,解除和所有相关用户的关系
	 * 3,删除角色本身
	 * @return mixed
	 */
	public function delRole()
	{
		// 解除角色和权限的关联关系
		$this->detachPermissions($this->perms);
		// 解除每个相关用户与本角色的关联关系
		foreach ($this->users as $user) {
			$user->detachRole($this);
		}
		// 删除角色本身
		return $this->delete();
	}
	
	public function updatePermissions($newPermissionsIdArray)
	{
		try {
			// 把权限ID数组转换成权限对象数组
			$newPermissionsArray = collect($newPermissionsIdArray)->map(function ($pmid) {
				return Permission::find($pmid);
			});
			// 取消当前所有权限
			$this->detachPermissions($this->perms);
			// 重新关联新的权限
			$this->attachPermissions($newPermissionsArray);
		} catch (Exception $e) {
			\Log::error($e->getMessage());
			return false;
		}
		return true;
	}
}
