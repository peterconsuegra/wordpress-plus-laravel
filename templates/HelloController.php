<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
	
    public function world()
    {
       
	   return view('hello.world');
    }
	
	public function wordpress_code_example(){
		
		return view('hello.wordpress_code_example');
	}

   
}
