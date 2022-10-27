<html>

	<head>
		
		<!-- CSS -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

		<!-- jQuery and JS bundle w/ Popper.js -->
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
		
	</head>

    <body>

		<div class="container">
			
			<br />		
			 <h3>List Woocommerce orders by user</h3>  
			 
			 @if ( class_exists( 'WooCommerce' ) ) 
			  

			@foreach ( $users as $user ) 
				
				<p>{{$user->user_email}} order:</p>
				
				<?php
				$args = array(
				    'customer_id' => $user->ID
				);
				$orders = wc_get_orders($args);
				?>
				
	  		  <table class="table table-hover">
	  		    <thead>
	  		      <tr>
	  		        <th>ID</th>
	  		        <th>Status</th>
	  		        <th>Total</th>
	  		      </tr>
	  		    </thead>
	  		    <tbody>
				
				@foreach( $orders as $order )
  	  		      <tr>
  	  		        <td>{{$order->get_id()}}</td>
  	  		        <td>{{$order->get_status()}}</td>
  	  		        <td>{{$order->get_total()}}</td>
  	  		      </tr>
				  
  				  </tr>
					
				@endforeach
				
			</table>
			
			@endforeach
			
			@else
			// you don't appear to have WooCommerce activated
			@endif
			
			<br />
			<a href="{{$app_route}}/wordpress_plus_laravel_examples">List examples</a>
		
		</div>
		
    </body>
</html>