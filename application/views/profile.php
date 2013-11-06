<?php  
	include('dashboard_profile_header.php');
	$profile_user = $this->session->userdata['profile_user'];
	$this->session->unset_userdata('profile_user');
	$this->load->model('messages_model');
	$this->load->model('comments_model');
	$this->load->model('user_model');
	
	$messages = $this->messages_model->get_messages_byid($this->session->userdata['profile_id']);
	$comments = $this->comments_model->get_comments_byid($this->session->userdata['profile_id']);
?>

<div class='container'>
	<h2>Welcome To <?=$profile_user->first_name?>'s Profile</h2>
	<div class='row info'>
		<div class='col-md-12'>
			<table class='table'>
				<tr><th>Email Address</th><th>Description</th><th>Registered At</th></tr>
				<tr><td><?=$profile_user->email?></td><td><?=$profile_user->description?></td><td><?=$profile_user->created_at?></td></tr>
			</table>
		</div>
	</div>
	<div class='row'> 
		<div class='col-md-9'>
			<form action="add_message" method='post'>			
				<label>Leave a message</label>
				<textarea placeholder='Add a message...' class='form-control' name="message" id="message_input" cols="30" rows="3"></textarea>
				<input class='btn btn-success right' type="submit" value ='Post'>
			</form>
		</div>
	</div>
	<div id='margin'></div>
<?php 
		if(count($messages) > 0) {
			foreach($messages as $message) {
?>		
		<div class='row'>
			<div class='col-md-10'>
				<label class='names'><?=$message->first_name . ' ' . $message->last_name?></label>

				<div  class='message_area'>
					<p><?=$message->message?></p>
				</div>
<?php
					foreach ($comments as $comment) {
						if($comment->messages_id == $message->id) {
?>		
						<div class='row'>
							<div class='col-md-12'>
								<label class='comment_names'><?=$comment->first_name . ' ' . $comment->last_name?></label>		
								<div class='comment_area'>
									<p><?=$comment->comment?></p>
								</div>
							</div>
						</div>
<?php
						}
					}
?>
				<div  class='col-md-10 comment_input'>
					<form action="add_comment/<?=$message->id?>" method='post'>			
						<textarea placeholder='Add a comment...' class='form-control' name="comment" id="comment_input" cols='5' rows="2"></textarea>
						<input class='btn btn-success right' type="submit" value ='Post'>
					</form>
				</div>
			</div>
		</div>
<?php	
			}
		}

?>
	
</div>
</body>
</html>