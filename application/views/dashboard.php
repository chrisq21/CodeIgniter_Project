<?php  
	include('dashboard_profile_header.php');
	$users = array();
	$users = $this->session->userdata['all_users'];
	$this->session->unset_userdata('user_id');
?>

	<div class='container'>
		<h4>All Users</h4>
		<table class='table table-striped table-bordered'>
			<tr>
				<td>ID</td>
				<td>Name</td>
				<td>Email</td>
				<td>Created At</td>
				<td>User Level</td>
			</tr>
<?php
			foreach ($users as $user) {
?>
				<tr>
					<td><?=$user->id?></td>
					<td><a href="../profile/profile_id/<?=$user->id?>"><?=$user->first_name . ' ' . $user->last_name?></a></td>
					<td><?=$user->email?></td><td><?=$user->created_at?></td>
					<td><?=$user->user_level?></td>
				</tr>
<?php 	
				
			}
?>
		</table>
	</div>
</body>
</html>