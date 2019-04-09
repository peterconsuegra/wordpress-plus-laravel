<?php

namespace Peterconsuegra\WordPressPlusLaravel\Console;

use Illuminate\Console\Command;

class InstallWPMiddleware extends Command {
	
    protected $name = 'install_wp_middleware';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Wp Middleware';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install_wp_middleware';

    
    public function handle() {
		
		$template_path = base_path()."/vendor"."/peteconsuegra"."/wordpress-plus-laravel"."/templates"."/WPAuthMiddleware.php";
		$file_path = base_path()."/app"."/Http"."/Middleware"."/WPAuthMiddleware.php";
		
		if (!copy($template_path, $file_path)) {
		    echo "failed to copy $template_path...\n";
			
		}
		
        
    }

}
