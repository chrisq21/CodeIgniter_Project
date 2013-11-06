<?php  
	include('log_in_header.php');
?>
	<div class='container'>
		
		<div class='jumbotron'>
			<h1>Welcome To The Site!</h1>
			<label for="">This is a small website built with CodeIgniter at the Coding Dojo</label>
			<form action="/Login_Controller/login">
				<input id='start_button' type="submit" value='Start' class='btn btn-primary'>
			</form>
		</div>

		<div class='row'>
			<div class='col-md-4'> 
				<h4>Manage Users</h4>
				<p for="">Using this application, you'll learn how to add, remove, and edit users for the application</p>
			</div>
			<div class='col-md-4'>
				<h4>Leave Messages</h4>
				<p for="">Users will be able to leave a message to another user using this appplication</p>
			</div>
			<div class='col-md-4'>
				<h4>Edit User Information</h4>
				<p for="">Admins will be able to edit another user's information (email addfress, first name, last name, etc.)</p>
			</div>
		</div>
	</div>
</body>
</html>