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
			 <h3>Edit post id: {{$post->ID}}</h3> 
			 
             <form action="{{$app_route}}/update_post" method="POST">
                 
				 <input type="hidden" name="post_id" value="{{$post->ID}}">
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
				 
				 <label>Post title</label>
			 	<input type="text" class="form-control" id="post_title" name="post_title" value="{{$post->post_title}}">
				<br />
			 
			 <label>Post content</label>
			 <textarea class="form-control" id="post_content" name="post_content" rows="4" cols="50">
			 {{$post->post_content}}
			 </textarea><br />

			 <input type="submit" class="form-control" value="Save">
			 
			 <br />
		
		<a href="{{$app_route}}/wordpress_plus_laravel_examples">List examples</a>
    </body>
</html>