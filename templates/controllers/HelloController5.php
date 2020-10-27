<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Log;

class HelloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	
	public function __construct()
	{
	     $this->middleware('auth.wp');
	}
		
	public function wordpress_plus_laravel_examples(){
		
		return view('wordpress_plus_laravel_examples');
	}
	
	public function list_users(){
		
		$blogusers = get_users( array( 'fields' => array( 'display_name','user_email','ID') ) );
		return view('list_users',compact('blogusers'));
	}
	
	public function list_posts(){
		
		return view('list_posts');
	}
	
	public function list_products(){
		
		
	    $args = array(
	        'post_type'      => 'product',
	        'posts_per_page' => 10,
	       // 'product_cat'    => 'hoodies'
	    );

	    $products = new \WP_Query( $args );
		
		return view('list_products',compact('products'));
	}
	
	public function list_orders(){
		
		$users = get_users( array( 'fields' => array( 'display_name','user_email','ID') ) );
		
		return view('list_orders',compact('users'));
	}
	
	public function edit_posts(){
		
		return view('edit_posts');
	}
	
	public function edit_post(){
		$post_id = Input::get('post_id');
		$post = get_post( $post_id );
		return view('edit_post',compact('post'));
	}
	
	public function update_post(){
		
		$post_id = input::get('post_id');
		$post_content = input::get('post_content');
		$post_title = input::get('post_title');
		
		wp_update_post(
			array (
				'ID'            => $post_id,
				'post_content'     => $post_content,
				'post_title' => $post_title
			)
		);
		
		return Redirect::to('/edit_posts');
	}

   
}
