<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Traits\EntrustRoleTrait;

class Role extends Model
{
	use EntrustRoleTrait;
	
	public static function addRole($name,$display_name,$description=null)
	{
		$role=new Role();
		$role->name=$name;
		$role->display_name=$display_name;
		$role->description=$description;
		$role->save();
	}
}
