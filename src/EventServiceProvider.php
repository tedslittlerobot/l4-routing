<?php namespace Tlr\Routing;

use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Kick off the router using events
	 * @return [type] [description]
	 */
	public function boot()
	{
		$startRouter = function()
		{
			$this->app['events']->fire('routes.start', array( $this->app['router'], $this->app['events'] ));
			$this->app['events']->fire('routes.finish', array( $this->app['router'], $this->app['events'] ));
		};

		$this->app['events']->listen('artisan.start', $startRouter);
		$this->app['events']->listen('router.before', $startRouter);
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register() {}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
