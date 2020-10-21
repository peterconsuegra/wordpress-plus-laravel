<?php

namespace Peterconsuegra\WordPressPlusLaravel\Console;

use Illuminate\Console\Command;
use Log;
use Peterconsuegra\WordPressPlusLaravel\bin\WpTools;

class NewWordPressPlusLaravel extends Command {
	
	
    protected $name = 'new_wordpress_plus_laravel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'New WordPressPlusLaravel Command';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'new_wordpress_plus_laravel';

    
    public function handle() {
		
		$version = app()->version();
		$num = substr($version, 0, 3);
		$float_version = (float)$num;
		$this->comment("Laravel version: ".$float_version);
		
		//if($float_version >=5.6){
		
		if($float_version < 8){
			$user_model_path = "/app/User.php";
			$user_reference = "use App\User;";
			$controller_reference = "Route::get('/', 'HelloController@wordpress_code_example');";
		}else{
			$user_model_path = "/app/Models/User.php";
			$user_reference = "use App\Models\User;";
			$controller_reference = "Route::get('/', [HelloController::class, 'wordpress_code_example']);";
		}
			
		//Add file WPAuthMiddleware to /app/Http/Middleware/WPAuthMiddleware.php
		$template_path = base_path()."/vendor/peteconsuegra/wordpress-plus-laravel/templates/WPAuthMiddleware.php";
		$file_path = base_path()."/app/Http/Middleware/WPAuthMiddleware.php";	
		WpTools::insert_template($template_path,$file_path);
		$this->comment("Add WPAuthMiddleware.php to /app/Http/Middleware/WPAuthMiddleware.php");
		//Add user model to WPAuthMiddleware
		WpTools::add_code_to_file(base_path()."/app/Http/Middleware/WPAuthMiddleware.php",'/*user model',$user_reference);
			
		//Add code protected $primaryKey = 'ID'; to app/User.php
		$code = "protected " .'$primaryKey'." = 'ID';";
		WpTools::add_code_to_file(base_path().$user_model_path,'/**',$code);
		$this->comment("Add code $code to app/User.php");
		
		//Add code protected $table = 'wp_users'; to app/User.php	
		$code = "protected ".'$table'." = 'wp_users';";
		WpTools::add_code_to_file(base_path().$user_model_path,'/**',$code);
		$this->comment("Add code $code to app/User.php");
		
		//SQL operation: ALTER TABLE `wp_users` CHANGE `user_registered` `user_registered` DATETIME NULL DEFAULT NULL
		WpTools::set_column_to_null_by_default("wp_users","user_registered");
		$this->comment("SQL operation: ALTER TABLE `wp_users` CHANGE `user_registered` `user_registered` DATETIME NULL DEFAULT NULL");	
		
		//SQL operation: ALTER TABLE `wp_users` ADD `remember_token` VARCHAR(255) NULL AFTER `display_name`;
		WpTools::add_column_to_table("wp_users","remember_token","VARCHAR(255)","display_name");
		$this->comment("SQL operation: ALTER TABLE `wp_users` ADD `remember_token` VARCHAR(255) NULL AFTER `display_name`;");
		
		//Add HelloController
		$template_path = base_path()."/vendor/peteconsuegra/wordpress-plus-laravel/templates/HelloController.php";
		$file_path = base_path()."/app/Http/Controllers/HelloController.php";	
		WpTools::insert_template($template_path,$file_path);
		$this->comment("Add HelloController.php to /app/Http/Controllers/HelloController.php");
		
		//Add view to wordpress_code_example.php to app/resources/views/wordpress_code_example.php
		$template_path = base_path()."/vendor/peteconsuegra/wordpress-plus-laravel/templates/wordpress_code_example.blade.php";
		$file_path = base_path()."/resources/views/wordpress_code_example.blade.php";	
		WpTools::insert_template($template_path,$file_path);
		$this->comment("Add view to wordpress_code_example.php to app/resources/views/wordpress_code_example.php");
		
		//Add route to wordpress_code_example
		$file_path = base_path()."/routes/web.php";
		WpTools::add_code_to_end_of_file($file_path,$controller_reference);
		$this->comment("Add code Route::get('/', 'HelloController@wordpress_code_example'); to routes/web.php");
		
		if($float_version >= 8){
			$code = "use App\Http\Controllers\HelloController;";
			WpTools::add_code_to_file($file_path,'/*',$code);
		}
			
		//Rename helpers method __ to ___ in vendor/laravel/framework/src/Illuminate/Foundation/helpers.php
		WpTools::renameHelperFunctions();
		$this->comment("Rename helpers method __ to ___ in vendor/laravel/framework/src/Illuminate/Foundation/helpers.php");
		
		if($float_version <= 5.6){
			
			//Add code middleware "'auth.wp' => \App\Http\Middleware\WPAuthMiddleware::class," to app/Http/Kernel.php
			WpTools::add_code_to_file(base_path()."/app/Http/Kernel.php","'auth' => \Illuminate\Auth\Middleware\Authenticate::class,","'auth.wp' => \App\Http\Middleware\WPAuthMiddleware::class,");
			$this->comment("Add code middleware 'auth.wp' => \App\Http\Middleware\WPAuthMiddleware::class, to app/Http/Kernel.php");
			
		}else{
			
			//Add code middleware "'auth.wp' => \App\Http\Middleware\WPAuthMiddleware::class," to app/Http/Kernel.php
			WpTools::add_code_to_file(base_path()."/app/Http/Kernel.php","'auth' => \App\Http\Middleware\Authenticate::class,","'auth.wp' => \App\Http\Middleware\WPAuthMiddleware::class,");
			$this->comment("Add code middleware 'auth.wp' => \App\Http\Middleware\WPAuthMiddleware::class, to app/Http/Kernel.php");
			
		}
		
		//}
		
    }

}
