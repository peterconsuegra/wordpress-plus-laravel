<?php

/* 
 * Created by : Digvijay
 * ProjectName : TestPackage
 * Purpose : Submit to packagist
 */

namespace testPackage;

class testPackage {
    public function pack() {
        return "Hello Packagist! I am coming";
    }
	
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
	    if ($this->app->runningInConsole()) {
	        $this->commands([
	            FooCommand::class,
	        ]);
	    }
	}
	
}

