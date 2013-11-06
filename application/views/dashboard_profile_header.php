
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome</title>
	<link rel='stylesheet' type='text/css' href='http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css'>
	<link rel="stylesheet" type='text/css' href="../assets/css/layout.css">
	<script>
		function show_confirm() {
			var x;
			var result = confirm("Are You Want To Delete This User?");
			if(result == true) 
				return true;
			else 
				return false;
		}
	</script>
</head>
<body>
	<div class='navbar navbar-default'>
		<ul class='nav nav-pills header_links'>
			<li><a href="../Login_Controller/home" style='color:black;'><h3 class='header_head'>My App</h3></a></li>
			<li><a href="dashboard">Dashboard</a></li>
			<li><a href="edit_profile">Edit Profile</a></li>
			<li class='navbar-right '><a href="../Login_Controller/home">Log Off</a></li>
		</ul>
	</div>


<?php  
		if(isset($this->session->userdata['result'])) {
			$errors = $this->session->userdata['result'];
			$this->session->unset_userdata('result');
?>
		<div class='errors_area'>
<?php
			echo $errors;
?>
		</div>
<?php 
		}
?>