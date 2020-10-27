<?php

namespace App\Http\Middleware;

use Closure;
use Log;


/*user model
*/
use Illuminate\Support\Facades\Auth;

class WPAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
	
    public function handle($request, Closure $next)
    {
    	include_once(env('WP_LOAD_PATH')."/wp-load.php");  
	
        $wp_user = wp_get_current_user();
			
        if ($wp_user->ID > 0) {
			
			$current_user = Auth::loginUsingId($wp_user->ID,true);
			$user = User::find($wp_user->ID);
		
			#Log::info("usuario logeado: ".$wp_user->user_login);
			#Log::info("usuario logeado desde laravel: ".$current_user->user_login);
			#Log::info("usuario elocuent: ".$user->user_login);
			
        } else {
            Auth::logout();
            return redirect(env('WP_URL').'/wp-login.php');
        }
		
        return $next($request);
    }
}
