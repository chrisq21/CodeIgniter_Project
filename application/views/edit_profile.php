<?php  
	include('dashboard_profile_header.php');
?>
	<div class='container'>
		<h3>Edit Profile</h3>	
		<div class='row'>	
			<div class='col-md-6'>
				<h4 class='edit_header'>Edit Information</h4>
				<div class='box_border'>
					<form action="save/profile" method='post' id='login'>
						<label>Email Address</label>
						<input class='form-control' type="text" name='email'>
						<label>First Name</label>
						<input class='form-control' type="text" name='first_name'>
						<label>Last Name</label>
						<input class='form-control' type="text" name='last_name'>
						<input class="btn btn-success right" type="Submit" value='Save'>
					</form>
				</div>
			</div>
			
			<div class='col-md-6 right'>
				<h4 class='edit_header'>Change Password</h4>
				<div class='box_border'>
					<form action="update_password/profile" method='post'>
						<label>Password</label>
						<input class='form-control' type="password" name='password'>
						<label>Confirm Password</label>
						<input class='form-control' type="password" name='cf_password'>
						<input class="btn btn-success right" type="Submit" value='Update Password'>
					</form>
				</div>	
			</div>
		</div>
		<div class='row'>
			<h4 class='edit_header'>Change Description</h4>
			<div class='box_border'>
				<form action="update_about_me" method='post' id='login'>
					<textarea class='form-control' name="about_me" cols="30" rows="4"></textarea>
					<input class="btn btn-success right" type="Submit" value='Update Description'>
				</form>
			</div>
		</div>
	</div>
</body>
</html>