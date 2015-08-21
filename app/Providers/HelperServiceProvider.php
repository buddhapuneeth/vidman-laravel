<?php namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class HelperServiceProvider extends ServiceProvider {

	public function register()
	{

		$this->app->bind('authHelper', function()
		{
		    return new App\Helpers\AuthHelper;
		});

		$this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('AuthHelper', 'App\Helpers\AuthHelper');
        });
	}


}

?>
