<?php

namespace Peterconsuegra\WordPressPlusLaravel\Console;

use Illuminate\Console\Command;
use Log;
use Peterconsuegra\WordPressPlusLaravel\bin\WpTools;

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
		
		//Add WPAuthMiddleware
		$template_path = base_path()."/vendor"."/peteconsuegra"."/wordpress-plus-laravel"."/templates"."/WPAuthMiddleware.php";
		$file_path = base_path()."/app"."/Http"."/Middleware"."/WPAuthMiddleware.php";	
		WpTools::insert_template($template_path,$file_path);
		
		//Add HelloController
		$template_path = base_path()."/vendor"."/peteconsuegra"."/wordpress-plus-laravel"."/templates"."/HelloController.php";
		$file_path = base_path()."/app"."/Http"."/Middleware"."/HelloController.php";	
		WpTools::insert_template($template_path,$file_path);
		
		//Add protected $primaryKey = 'ID'; to app/User.php
		$code = "protected " .'$primaryKey'." = 'ID';";
		WpTools::add_code_to_file(base_path()."/app/User.php",'/**',$code);
		
		//Add protected $table = 'wp_users'; to app/User.php
		$code = "protected ".'$table'." = 'wp_users';";
		WpTools::add_code_to_file(base_path()."/app/User.php",'/**',$code);
		
		//ALTER TABLE `wp_users` ADD `remember_token` VARCHAR(255) NULL AFTER `display_name`;
		WpTools::add_column_to_table("wp_users","remember_token","VARCHAR(255)","display_name");
		
		//Set user_registered column default to null
		WpTools::set_column_to_null_by_default("wp_users","user_registered");
		
		//Add middleware route in app/Http/Kernel.php
		WpTools::add_code_to_file(base_path()."/app/Http/Kernel.php","'auth' => \App\Http\Middleware\Authenticate::class,","'auth.wp' => \App\Http\Middleware\WPAuthMiddleware::class,");
			
    }

}
