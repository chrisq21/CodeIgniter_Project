<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {
	protected $view_data = array();
	protected $user_info = NULL;

	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('messages_model');
		$this->load->model('comments_model');
		$this->load->library('form_validation');
		$this->load->library('encrypt');
	}

	public function profile_id($id) {
		$this->session->set_userdata('profile_id', $id);
		redirect(base_url('profile/profile_page'));
	}

	public function profile_page() {
		$profile_user = $this->user_model->get_user_byid($this->session->userdata['profile_id']);
		$logged_in_user = $this->user_model->get_user_byid($this->session->userdata('logged_in_id'));
		$this->session->set_userdata('profile_user', $profile_user);
		$this->load->view('profile');
	}

	public function add_message() {
		$logged_in_id = $this->session->userdata('logged_in_id');
		$profile_id = $this->session->userdata('profile_id');
		$this->session->unset_userdata('profile_id');
		$message = $this->input->post('message');
		$message_data = array(
						'profile_id' => $profile_id,
						'user_id' => $logged_in_id,
						'message' => $message,
						'created_at' => date('Y-m-d H:i:s'));

		$this->messages_model->add_message($message_data);
		redirect(base_url('profile/profile_id/'.$profile_id));
	}

	public function add_comment($message_id) {
		$logged_in_id = $this->session->userdata('logged_in_id');
		$profile_id = $this->session->userdata('profile_id');
		$this->session->unset_userdata('profile_id');
		$comment = $this->input->post('comment');
		$comment_data = array(
						'profile_id' => $profile_id,
						'user_id' => $logged_in_id,
						'comment' => $comment,
						'messages_id' => $message_id,
						'created_at' => date('Y-m-d H:i:s'));

		$this->comments_model->add_comment($comment_data);
		redirect(base_url('profile/profile_id/'.$profile_id));
	}

	public function edit_profile() {
		redirect(base_url('users/edit_profile'));
	}

	public function dashboard() {
		redirect(base_url('users/dashboard'));
		$this->load->view('dashboard');	
	}	
}