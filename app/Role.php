<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Traits\EntrustRoleTrait;

class Role extends Model
{
	use EntrustRoleTrait;
	
	protected $fillable = ['name', 'display_name', 'description'];
	
	/**
	 * Role和User的关联关系
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function users()
	{
		return $this->belongsToMany('App\User');
	}
	
	/**
	 * Role和Permission的关联关系
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function permissions()
	{
		return $this->belongsToMany('App\Permission');
	}
	
	public function delRole()
	{
		// 解除角色和权限的关联关系
		$this->detachPermissions($this->permissions);
		// 解除每个相关用户与本角色的关联关系
		foreach ($this->users as $user) {
			$user->detachRole($this);
		}
		// 删除角色本身
		return $this->delete();
	}
}
