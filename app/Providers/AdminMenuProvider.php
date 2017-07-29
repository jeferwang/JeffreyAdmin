<?php

namespace App\Providers;

use App\AdminMenu;
use Illuminate\Contracts\View\View;
use Illuminate\Support\ServiceProvider;

class AdminMenuProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		view()->composer('admin.*', function (View $view) {
			$view->with('adminMenu', AdminMenu::where('pid', 0)->orderBy('sort_num', 'desc')->get());
		});
	}
	
	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}
}
