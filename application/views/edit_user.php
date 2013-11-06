<?php  
	include('dashboard_profile_header.php');
?>
	<div class='container'>
		<h3>Edit User</h3>	
		<div class='row'>
			
			<div class='col-md-6'>
				<h4 class='edit_header'>Edit Information</h4>
				<div class='box_border'>
					<form action="save/edit_user/user" method='post'>
						<label>Email Address</label>
						<input class='form-control' type="text" name='email'>
						<label>First Name</label>
						<input class='form-control' type="text" name='first_name'>
						<label>Last Name</label>
						<input class='form-control' type="text" name='last_name'>
						<label for="User Level">User Level</label>
						<select class='form-control' name="user_level">
							<option value="normal">Normal</option>
							<option value="admin">Admin</option>
						</select>
						<input class="btn btn-success right" type="Submit" value='Save'>
					</form>
				</div>
			</div>
			
			<div class='col-md-6 right'>
				<h4 class='edit_header'>Change Password</h4>
				<div class='box_border'>
					<form action="update_password/edit_user" method='post' id='login'>
						<label>Password</label>
						<input class='form-control' type="password" name='password'>
						<label>Confirm Password</label>
						<input class='form-control' type="password" name='cf_password'>
						<input class="btn btn-success right" type="Submit" value='Update Password'>
					</form>
				</div>	
			</div>
		</div>
	</div>
</body>
</html>