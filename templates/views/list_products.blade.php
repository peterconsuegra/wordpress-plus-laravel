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
			 <h3>List Woocommerce products</h3> 
			 <h6>With WordPress Pete you can use WordPress classes and methods in views or controller:</h6>
			 
			 @if ( class_exists( 'WooCommerce' ) ) 
			   // code that requires WooCommerce
			 
			
			<p>Executing WordPress code from view:</p>
			<?php  
			
				//With WordPress Pete you can use WordPress methods in views or contoller
			
			    $args = array(
			        'post_type'      => 'product',
			        'posts_per_page' => 10,
			       // 'product_cat'    => 'hoodies'
			    );

			    $loop = new WP_Query( $args );

			    while ( $loop->have_posts() ) : $loop->the_post();
			        global $product;
			        echo '<br /><a href="'.get_permalink().'">' . woocommerce_get_product_thumbnail().' '.get_the_title().'</a>';
			    endwhile;

			    wp_reset_query();
			?>
			
			
			<p>Using WordPress code from controller:</p>
			
			<?php  
			
				//With WordPress Pete you can use WordPress methods in views or contoller
			
			    while ( $products->have_posts() ) : $products->the_post();
			        global $product;
			        echo '<br /><a href="'.get_permalink().'">' . woocommerce_get_product_thumbnail().' '.get_the_title().'</a>';
			    endwhile;

			    wp_reset_query();
			?>
			
		 @else
		   // you don't appear to have WooCommerce activated
		 @endif
		 
		<br />
		<a href="/">List examples</a>

    </body>
</html>