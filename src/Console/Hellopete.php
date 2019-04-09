<?php

namespace Peterconsuegra\WordPressPlusLaravel\Console;

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
		
		$template_path = base_path()."/vendor"."/peteconsuegra"."/wordpress-plus-laravel"."/templates"."/wplogic.php";
		$file_path = base_path()."/app"."/Http"."/Middleware"."/wplogic.php";
		
		if (!copy($template_path, $file_path)) {
		    echo "failed to copy $template_path...\n";
			
		}
		
        
    }

}
