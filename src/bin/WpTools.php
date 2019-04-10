<?php

namespace Peterconsuegra\WordPressPlusLaravel\bin;

use Log;

class WpTools{
	
	public static function insert_template($template_path,$file_path){
		
		if (!copy($template_path, $file_path)) {
		    echo "failed to copy $template_path...\n";
		}
	}
	
	public static function add_code_to_file($file,$pointer,$var,$first=true){
		$lines = array();
		$sw = false;
		foreach(file($file) as $line)
		{
			//Log::info($line);
			
			if($var == trim($line)){
				$first = false;
			}
			
			if($pointer == trim($line) && ($sw == false) && ($first == true))
			{
				array_push($lines, "$var  \n");
				$sw = true;
			}
			array_push($lines, $line);
		}
		file_put_contents($file, $lines);
	}
	
	public static function set_column_to_null_by_default($table,$column_name){
		$db_name = env('DB_DATABASE');
		$db_user_pass = env('DB_PASSWORD');
		$db_user = env('DB_USERNAME');
		
		$conn=mysqli_connect("localhost",$db_user,$db_user_pass,$db_name);
		// Check connection
		if (mysqli_connect_errno()){
		  Log::info("Failed to connect to MySQL: " . mysqli_connect_error());
		 }else{
		   Log::info("success conection");
		 }
			
		$conn->query("ALTER TABLE `$table` CHANGE `$column_name` `$column_name` DATETIME NULL DEFAULT NULL");
		$conn->close();
	}
	
	public static function add_column_to_table($table,$column_name,$data_type,$column_after){
		
		$db_name = env('DB_DATABASE');
		$db_user_pass = env('DB_PASSWORD');
		$db_user = env('DB_USERNAME');
		
		$conn=mysqli_connect("localhost",$db_user,$db_user_pass,$db_name);
		// Check connection
		if (mysqli_connect_errno()){
		  Log::info("Failed to connect to MySQL: " . mysqli_connect_error());
		 }else{
		   Log::info("success conection");
		 }
		
 		$conn->query("ALTER TABLE `$table` ADD `$column_name` $data_type NULL AFTER `$column_after`;");
 		$conn->close();

	}
	
	public static function hello_world(){
		Log::info("hello world 777");
	}
	
}