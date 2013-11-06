<?php  
	include('dashboard_profile_header.php');
	$users = array();
	$users = $this->session->userdata['all_users'];
	$this->session->unset_userdata('user_id');
?>

	<div class='container'>
		<h4 class='inline_block'>Manage Users</h4>
		<form action="add_new_user">
			<input type="submit" id='add_new_user_button' class='btn btn-success right' value='Add New'>
		</form>
		<table class='table table-striped table-bordered'>
			<tr>
				<td>ID</td>
				<td>Name</td>
				<td>Email</td>
				<td>Created At</td>
				<td>User Level</td>
				<td>Actions</td>
			</tr>
<?php
			foreach ($users as $user) {
?>
				<tr>
					<td><?=$user->id?></td>
					<td><a href="../profile/profile_id/<?=$user->id?>"><?=$user->first_name . ' ' . $user->last_name?></a></td><td><?=$user->email?></td>
					<td><?=$user->created_at?></td>
					<td><?=$user->user_level?></td>
					<td><a href="edit_user/<?=$user->id?>">edit</a><a onclick="return confirm('Are You Sure You Want To Delete This User?')" class='right' href="remove_user/<?=$user->id?>">remove</a></td>
				</tr>
<?php 			
				
			}
?>
		</table>
	</div>
</body>
</html>