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
	
		  <h3>List WordPress users</h3>            
		  <table class="table table-hover">
		    <thead>
		      <tr>
		        <th>ID</th>
		        <th>Display name</th>
		        <th>Email</th>
		      </tr>
		    </thead>
		    <tbody>
				<?php foreach ( $blogusers as $user ) {
					
					?>
					
	  		      <tr>
	  		        <td>{{$user->ID}}</td>
	  		        <td>{{$user->display_name}}</td>
	  		        <td>{{$user->user_email}}</td>
	  		      </tr>
				  
				  </tr>
				  
				<?php 	
				}
				?>
		      
		    </tbody>
		  </table>
		  
		<br />
		<a href="/">List examples</a>
		  
		</div>
		
		
    </body>
</html>