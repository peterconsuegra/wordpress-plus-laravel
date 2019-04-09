<?php

namespace Novius\ArtisanCommands\Console\Database;

use Illuminate\Console\Command;

class Hellopete extends Command {
	
    protected $name = 'hellopete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hello pete';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hellopete';

    
    public function handle() {
        $this->comment("Hola Pete desde package");
    }

}
