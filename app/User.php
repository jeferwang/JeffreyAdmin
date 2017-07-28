<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Mockery\Exception;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
	use Notifiable;
	use EntrustUserTrait;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password',
	];
	
	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];
	
	/**
	 * 删除用户
	 * 1,删除和角色的关联关系
	 * 2,删除用户本身
	 * @return mixed
	 */
	public function delUser()
	{
		// 删除所有本用户的角色关联
		$this->detachRoles($this->roles);
		// 删除用户本身
		return $this->delete();
	}
	
	public function updateRoles($rolesId)
	{
		try {
			// 把ID集合转换成对象集合
			$roles = collect($rolesId)->map(function ($rid) {
				return Role::find($rid);
			});
			// 解除之前的所有关联
			$this->detachRoles($this->roles);
			// 创建新的关联关系
			$this->attachRoles($roles);
		} catch (Exception $e) {
			\Log::error($e->getMessage());
			return false;
		}
		return true;
	}
	
}
