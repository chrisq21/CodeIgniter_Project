<?php
	$this->session->set_userdata('logged_in', FALSE);  

	include('dashboard_profile_header.php');
?>
	<div class='container'>
		<div class='row'>
			<form action="dashboard">
				<input type="submit" value='Return To Dashboard' class='btn btn-primary right'>
			</form>
			<div class='col-md-6'>
				<form action="create_user" method='post' id='login'>
					<h2>Add a new user</h2>
					<label>Email Address</label>
					<input class='form-control' type="text" name='email'>
					<label>First Name</label>
					<input class='form-control' type="text" name='first_name'>
					<label>Last Name</label>
					<input class='form-control' type="text" name='last_name'>
					<label>Password</label>
					<input class='form-control' type="password" name='password'>
					<label>Confirm Password</label>
					<input class='form-control' type="password" name='cf_password'>
					<label for="About Me">About Me</label>
					<textarea name="about_me" placeholder='Enter a short description about yourself' class='form-control' id="" cols="100" rows="3"></textarea>
					<input class="btn btn-success right" type="Submit" value='Create'>
				</form>
			</div>	
		</div>
	</div>
</body>
</html>