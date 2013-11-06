<?php  
	include('log_in_header.php');
?>

<div class='container'>
	<div class='row'>
		<div class='col-md-6'>
			<form action="/Login_Controller/process_registration" method='post'>
				<h2>Register</h2>
				<label>First Name</label>
				<input class='form-control' type="text" name='first_name'>
				<label>Last Name</label>
				<input class='form-control' type="text" name='last_name'>
				<label>Email</label>
				<input class='form-control' type="text" name='email'>
				<label>Password</label>
				<input class='form-control' type="password" name='password'>
				<label>Confirm Password</label>
				<input class='form-control' type="password" name='cf_password'>
				<label>About Me</label>
				<textarea name="about_me" placeholder='Enter a short description about yourself' class='form-control' cols="100" rows="3"></textarea>
				<input class="btn btn-success" type="submit" value='Register'>
			</form>
			<a class='toggle_login_link' href="login">Already have an account? Login</a>
		</div>
	</div>	
</div>