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
			 <h3>List WordPress posts</h3> 
			
			<?php
			    $args = array(
			        'post_type' => 'post'
			    );

			    $post_query = new WP_Query($args);

			    if($post_query->have_posts() ) {
			        while($post_query->have_posts() ) {
			            $post_query->the_post();
			            ?>
			            <h2><?php the_title(); ?></h2>
						<p>{{the_excerpt()}}</p>
						<a href="/edit_post?post_id={{the_id()}}">Edit</a>
			            <?php
			            }
			        }
			?>
			
		<br />
		<br />
		<br />
		<a href="/">List examples</a>
    </body>
</html>