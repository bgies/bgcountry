<?php namespace Bgies\BgCountry;

use Illuminate\Support\ServiceProvider;
//use Bgies;

class BgCountryServiceProvider extends ServiceProvider
{
	
//	protected $defer = true;

	
	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
//		$this->app->alias('bgcountry', 'Bgies\BgCountry');
		
		
		//include __DIR__.'/routes.php';
		$this->mergeConfigFrom(
				__DIR__.'/config.php', 'bgcountry'
		);
		 
		 
		$this->registerCommands();
	}
	
	
	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
//	public function provides()
//	{
//		return ['Bgies\BgCountry\BgCountryServiceProvider'];
//	}	
	
	
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    	if (! $this->app->routesAreCached()) {
    		//require __DIR__.'/../../routes.php';
    		require __DIR__.'/routes.php';
    	}  
    	
    	
       $this->loadViewsFrom(__DIR__.'/views', 'bgcountry');
       $this->publishes([
          __DIR__.'/views' => base_path('resources/views/vendor/bgcountry'),
          __DIR__.'/css' => public_path(''),
     		 __DIR__.'/js' => public_path('')
       ]);
       // Register commands
       $this->commands('command.bgcountry.migration');
       
       $this->app->make('Bgies\BgCountry\BgCountryController');
    }

    
    /**
     * Register the artisan commands.
     *
     * @return void
     */
    private function registerCommands()
    {
    	$this->app->bindShared('command.bgcountry.migration', function ($app) {
    		return new MigrationCommand();
    	});
  		$this->commands('command.bgcountry.migration');
    }
    
}
