<?php

namespace Vendor\Package;

class MyServiceProvider extends ServiceProvider {

    protected $commands = [
        'Vendor\Package\Commands\FooCommand',
    ];

    public function register(){
        $this->commands($this->commands);
    }
}