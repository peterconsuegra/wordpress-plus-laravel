<?php

namespace Vendor\Package\Commands;

use Illuminate\Console\Command;

class FooCommand extends Command {

    protected $signature = 'foo:method';

    protected $description = 'Command description';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        $this->comment("Hola Pedro desde package");
    }

}
