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
    protected $signature = 'new_wordpress_plus_laravel {--integration_type=}';

    
    public function handle() {
		
		//GET LARAVEL VERSION
		$version = app()->version();
		$num = substr($version, 0, 3);
		$float_version = (float)$num;
		$this->comment("Laravel version: ".$float_version);
		
		//Replace migrations if table exists
		WpTools::replace_migration_if_table_exists("users","create_users_table.php");
		WpTools::replace_migration_if_table_exists("password_resets","create_password_resets_table.php");
		
		$user_model_path = WpTools::search_file(base_path(),"User.php","namespace App");
		$user_model_path = WpTools::$file_path;
		$user_reference = WpTools::get_user_namespace($user_model_path,"namespace");
		
		//SET WPAuthMiddleware.php
		//Add file WPAuthMiddleware to /app/Http/Middleware/WPAuthMiddleware.php
		$template_path = base_path()."/vendor/peteconsuegra/wordpress-plus-laravel/templates/middleware/WPAuthMiddleware.php";
		$file_path = base_path()."/app/Http/Middleware/WPAuthMiddleware.php";	
		WpTools::insert_template($template_path,$file_path);
		$this->comment("Add WPAuthMiddleware.php to /app/Http/Middleware/WPAuthMiddleware.php");
		//Add user model to WPAuthMiddleware
		WpTools::add_code_to_file(base_path()."/app/Http/Middleware/WPAuthMiddleware.php",'/*user model',$user_reference);
		
		//SET USER MODEL	
		WpTools::delete_code_in_file($file_path,"'users'");
		WpTools::delete_code_in_file($file_path,'$primaryKey');
		//Add primaryKey
		$code = "protected " .'$primaryKey'." = 'ID';";
		WpTools::add_code_to_file_pro($user_model_path,'class User extends Authenticatable',$code,2);
		$this->comment("Add code $code to $file_path");
		//Add code protected $table = 'wp_users'; to app/User.php	
		$code = "protected ".'$table'." = 'wp_users';";
		WpTools::add_code_to_file_pro($user_model_path,'class User extends Authenticatable',$code,2);
		$this->comment("Add code $code to $file_path");
		
		//SQL HACKS
		//SQL operation: ALTER TABLE `wp_users` CHANGE `user_registered` `user_registered` DATETIME NULL DEFAULT NULL
		WpTools::set_column_to_null_by_default("wp_users","user_registered");
		$this->comment("SQL operation: ALTER TABLE `wp_users` CHANGE `user_registered` `user_registered` DATETIME NULL DEFAULT NULL");	
		//SQL operation: ALTER TABLE `wp_users` ADD `remember_token` VARCHAR(255) NULL AFTER `display_name`;
		WpTools::add_column_to_table("wp_users","remember_token","VARCHAR(255)","display_name");
		$this->comment("SQL operation: ALTER TABLE `wp_users` ADD `remember_token` VARCHAR(255) NULL AFTER `display_name`;");
		
		//ADD HELLO CONTROLLER FOR BUILT IN EXAMPLES
		$controller_template_path = WpTools::get_hello_controller($float_version);
		$file_path = base_path()."/app/Http/Controllers/HelloController.php";	
		WpTools::insert_template($controller_template_path,$file_path);
		$this->comment("Add HelloController.php to /app/Http/Controllers/HelloController.php");
		
        //ADD HELLO CONTROLLER VIEWS
		$template_path = base_path()."/vendor/peteconsuegra/wordpress-plus-laravel/templates/views/wordpress_plus_laravel_examples.blade.php";
		$file_path = base_path()."/resources/views/wordpress_plus_laravel_examples.blade.php";	
		WpTools::insert_template($template_path,$file_path);
		$this->comment("Add file wordpress_code_example.php ");
		
		$template_path = base_path()."/vendor/peteconsuegra/wordpress-plus-laravel/templates/views/edit_post.blade.php";
		$file_path = base_path()."/resources/views/edit_post.blade.php";	
		WpTools::insert_template($template_path,$file_path);
		$this->comment("Add file edit_post.blade.php ");
		
		$template_path = base_path()."/vendor/peteconsuegra/wordpress-plus-laravel/templates/views/edit_posts.blade.php";
		$file_path = base_path()."/resources/views/edit_posts.blade.php";	
		WpTools::insert_template($template_path,$file_path);
		$this->comment("Add file edit_posts.blade.php");
		
		$template_path = base_path()."/vendor/peteconsuegra/wordpress-plus-laravel/templates/views/list_orders.blade.php";
		$file_path = base_path()."/resources/views/list_orders.blade.php";	
		WpTools::insert_template($template_path,$file_path);
		$this->comment("Add file list_orders.blade.php");
		
		$template_path = base_path()."/vendor/peteconsuegra/wordpress-plus-laravel/templates/views/list_posts.blade.php";
		$file_path = base_path()."/resources/views/list_posts.blade.php";	
		WpTools::insert_template($template_path,$file_path);
		$this->comment("Add file list_posts.blade.php");
		
		$template_path = base_path()."/vendor/peteconsuegra/wordpress-plus-laravel/templates/views/list_products.blade.php";
		$file_path = base_path()."/resources/views/list_products.blade.php";	
		WpTools::insert_template($template_path,$file_path);
		$this->comment("Add file list_products.blade.php");
		
		$template_path = base_path()."/vendor/peteconsuegra/wordpress-plus-laravel/templates/views/list_users.blade.php";
		$file_path = base_path()."/resources/views/list_users.blade.php";	
		WpTools::insert_template($template_path,$file_path);
		$this->comment("Add file list_users.blade.php");
		
		//ADD HELLO CONTROLLER ROUTES
		$file_path = base_path()."/routes/web.php";
		$routes_code = WpTools::get_laravel_routes_code($float_version);
		WpTools::add_code_to_end_of_file($file_path,$routes_code);
		$this->comment("Add code Route::get('/', 'HelloController@wordpress_code_example'); to routes/web.php");
		
		if($float_version >= 8){
			$code = "use App\Http\Controllers\HelloController;";
			WpTools::add_code_to_file($file_path,'/*',$code);
		}
		
		//FIX renameHelperFunctions
		//Rename helpers method __ to ___ in vendor/laravel/framework/src/Illuminate/Foundation/helpers.php
		WpTools::renameHelperFunctions();
		$this->comment("Rename helpers method __ to ___ in vendor/laravel/framework/src/Illuminate/Foundation/helpers.php");
		
		//ADD REFERENCE TO WPAuthMiddleware::class
		if($float_version <= 5.6){
			
			//Add code middleware "'auth.wp' => \App\Http\Middleware\WPAuthMiddleware::class," to app/Http/Kernel.php
			WpTools::add_code_to_file(base_path()."/app/Http/Kernel.php","'auth' => \Illuminate\Auth\Middleware\Authenticate::class,","'auth.wp' => \App\Http\Middleware\WPAuthMiddleware::class,");
			$this->comment("Add code middleware 'auth.wp' => \App\Http\Middleware\WPAuthMiddleware::class, to app/Http/Kernel.php");
			
		}else{
			
			//Add code middleware "'auth.wp' => \App\Http\Middleware\WPAuthMiddleware::class," to app/Http/Kernel.php
			WpTools::add_code_to_file(base_path()."/app/Http/Kernel.php","'auth' => \App\Http\Middleware\Authenticate::class,","'auth.wp' => \App\Http\Middleware\WPAuthMiddleware::class,");
			$this->comment("Add code middleware 'auth.wp' => \App\Http\Middleware\WPAuthMiddleware::class, to app/Http/Kernel.php");
			
		}
		
		if($this->option('integration_type') == "inside_wordpress"){
			
			$this->comment("Inside WordPress option");
			rename(base_path()."/public/.htaccess", base_path()."/.htaccess");
			
			//delete index.php file
			unlink(base_path()."/public/index.php");
			
			$template_path = base_path()."/vendor/peteconsuegra/wordpress-plus-laravel/templates/files/index.php";
			$file_path = base_path()."/index.php";	
			WpTools::insert_template($template_path,$file_path);
		}

		
    }

}