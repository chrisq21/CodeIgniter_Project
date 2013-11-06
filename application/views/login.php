<?php
	$this->session->set_userdata('logged_in', FALSE);  
	$this->session->unset_userdata('user');
	$this->session->unset_userdata('password');
	$this->session->unset_userdata('all_users');
	$this->session->unset_userdata('user_id');
	$this->session->unset_userdata('logged_in_user');
	$this->session->unset_userdata('logged_in_id');
	$this->session->unset_userdata('profile_id');
	

	include('log_in_header.php');
?>
	<div class='container'>
		<div class='row'>
			<div class='col-md-6'>
				<form action="process_login" method='post' id='login'>
					<h2>Sign In</h2>
					<label>Email</label>
					<input class='form-control' type="text" name='email'>
					<label>Password</label>
					<input class='form-control' type="password" name='password'>
					<input class="btn btn-success" type="Submit" value='Sign In'>
				</form>
				<a class='toggle_login_link' href="register">Don't Have An Account? Register</a>
			</div>	
		</div>
	</div>
</body>
</html>

