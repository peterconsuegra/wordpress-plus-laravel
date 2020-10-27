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
			$controller_reference = "";
			$controller_reference .= "Route::get('list_users','HelloController@list_users');\n";
			$controller_reference .= "Route::get('list_orders', 'HelloController@list_orders');\n";
			$controller_reference .= "Route::get('list_posts', 'HelloController@list_posts');\n";
			$controller_reference .= "Route::get('list_products', 'HelloController@list_products');\n";
			$controller_reference .= "Route::get('edit_posts', 'HelloController@edit_posts');\n";
			$controller_reference .= "Route::get('edit_post', 'HelloController@edit_post');\n";
			$controller_reference .= "Route::post('update_post', 'HelloController@update_post');\n";
			$controller_reference .= "Route::get('/wordpress_examples', 'HelloController@wordpress_code_example');\n";
			
		}else{
			$user_model_path = "/app/Models/User.php";
			$user_reference = "use App\Models\User;";
			$controller_reference = "";
			$controller_reference .= "Route::get('list_users', [HelloController::class,'list_users']);\n";
			$controller_reference .= "Route::get('list_orders', [HelloController::class,'list_orders']);\n";
			$controller_reference .= "Route::get('list_posts', [HelloController::class,'list_posts']);\n";
			$controller_reference .= "Route::get('list_products', [HelloController::class,'list_products']);\n";
			$controller_reference .= "Route::get('edit_posts', [HelloController::class, 'edit_posts']);\n";
			$controller_reference .= "Route::get('edit_post', [HelloController::class, 'edit_post']);\n";
			$controller_reference .= "Route::post('update_post', [HelloController::class, 'update_post']);\n";
			$controller_reference .= "Route::get('/wordpress_examples', [HelloController::class, 'wordpress_code_example']);\n";
		}
		
		if($float_version >= 6){
			$controller_template_path = base_path()."/vendor/peteconsuegra/wordpress-plus-laravel/templates/controllers/HelloController6.php";
		}else{
			$controller_template_path = base_path()."/vendor/peteconsuegra/wordpress-plus-laravel/templates/controllers/HelloController5.php";
		}
			
		//Add file WPAuthMiddleware to /app/Http/Middleware/WPAuthMiddleware.php
		$template_path = base_path()."/vendor/peteconsuegra/wordpress-plus-laravel/templates/middleware/WPAuthMiddleware.php";
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
		$file_path = base_path()."/app/Http/Controllers/HelloController.php";	
		WpTools::insert_template($controller_template_path,$file_path);
		$this->comment("Add HelloController.php to /app/Http/Controllers/HelloController.php");
		
        //Adding template views
		$template_path = base_path()."/vendor/peteconsuegra/wordpress-plus-laravel/templates/views/wordpress_code_example.blade.php";
		$file_path = base_path()."/resources/views/wordpress_code_example.blade.php";	
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
