<?php
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// 用于添加默认的管理员账户
		$this->call(DefaultAdmin::class);
	}
}
