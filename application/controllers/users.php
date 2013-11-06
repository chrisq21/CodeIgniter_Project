<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
	protected $view_data = array();
	protected $user_info = NULL;

	public function __construct() {
		parent::__construct();
		$this->user_info = $this->session->userdata('user_info');
		$this->load->model('user_model');
		$this->load->model('messages_model');
		$this->load->model('comments_model');
		$this->load->library('form_validation');
		$this->load->library('encrypt');
	}

	public function dashboard() {
		$all_users = $this->user_model->get_all_users();
		$this->session->set_userdata('all_users', $all_users);
		if($this->session->userdata['user_level'] == 'admin')
			$this->load->view('admin_dashboard');
		else 
			$this->load->view('dashboard');	
	}
	
	public function log_off() {
		$this->load->view('welcome');
	}

	public function add_new_user() {
		$this->load->view('new_user');
	}

	public function create_user() {
		$this->form_validation->set_rules('first_name', 'First Name', 'alpha|required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'alpha|required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'min_length[8]|required|xss_clean');
		$this->form_validation->set_rules('cf_password', 'Confirm Password', "min_length[8]|matches[password]|xss_clean");

		if($this->form_validation->run() == FALSE) {
			$errors = validation_errors();
			$this->session->set_userdata('result', $errors);
			redirect(base_url('/users/add_new_user'));
		} else {
			//CHECK IF USER EXISTS IN DATABASE
			if($this->user_model->email_exists($this->input->post('email'))) {
				$email = $this->input->post('email');
				$this->session->set_userdata('result', $email.' Is Already Registered');
				redirect(base_url('/users/add_new_user'));
			} else {
				//Encrypt password before sending it to the database
				$email = $this->input->post('email');
				$encrypted_password = $this->encrypt->sha1($this->input->post('password'));

				$user = array(
						'first_name' => $this->input->post('first_name'), 
						'last_name' => $this->input->post('last_name'), 
						'email' => $email,
						'password' => $encrypted_password, 
						'user_level' => 'normal',
						'description' => $this->input->post('about_me'),
						'created_at' => date('Y-m-d H:i:s'));

				$this->user_model->insert_user($user);		
				redirect(base_url('Login_Controller/dashboard'));
			}
		}
		echo 'create_user';
	}

	public function remove_user($id) {
		if($id == $this->session->userdata['logged_in_id']) {
			$this->session->set_userdata('result', 'You Cannot Delete Yourself!');
			redirect(base_url('users/dashboard'));
		} else {
			$this->comments_model->delete_comments($id);
			$this->messages_model->delete_messages($id);
			$this->user_model->delete_user($id);
			
			redirect(base_url('users/dashboard'));	
		}
	}

	public function edit_user($id) {
		$this->session->set_userdata('profile_id', $id);
		redirect(base_url('users/load_edit_user'));
	}

	public function load_edit_user() {
		$this->load->view('edit_user');	
	}

	public function edit_profile() {
		$this->load->view('edit_profile');
	}

	public function save($from) {
		
		if($from == 'profile')
			$id = $this->session->userdata('logged_in_id');	
		else 
			$id = $this->session->userdata('profile_id');			

		$this->form_validation->set_rules('first_name', 'First Name', 'alpha|required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'alpha|required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|required|xss_clean');

		if($this->form_validation->run() == FALSE) {
			$errors = validation_errors();
			$this->session->set_userdata('result', $errors);
			if($from == 'profile')
				redirect(base_url('/users/edit_profile'));
			else 
				redirect(base_url('/users/edit_user/user'));
		} else {
				if($from == 'profile') {
					$user = array(
							'first_name' => $this->input->post('first_name'), 
							'last_name' => $this->input->post('last_name'), 
							'email' => $this->input->post('email'),
							'updated_at' => date('Y-m-d H:i:s'));
				} else {
					$user = array(
							'first_name' => $this->input->post('first_name'), 
							'last_name' => $this->input->post('last_name'), 
							'email' => $this->input->post('email'),
							'user_level' => $this->input->post('user_level'),
							'updated_at' => date('Y-m-d H:i:s'));
				}

			$this->user_model->update_user($id, $user);		
			redirect(base_url('users/dashboard'));
		}

		redirect(base_url('Login_Controller/dashboard'));
	}

	public function update_password($from) {
		if($from == 'profile')
			$id = $this->session->userdata('logged_in_id');
		else
			$id = $this->session->userdata('profile_id');

		$this->form_validation->set_rules('password', 'Password', 'min_length[8]|required|xss_clean');
		$this->form_validation->set_rules('cf_password', 'Confirm Password', "min_length[8]|required|matches[password]|xss_clean");

		if($this->form_validation->run() == FALSE) {

			$errors = validation_errors();
			$this->session->set_userdata('result', $errors);
			if($from == 'profile')
				redirect(base_url('users/edit_profile'));
			else
				redirect(base_url('users/load_edit_user'));
		} else {
				$encrypted_password = $this->encrypt->sha1($this->input->post('password'));
				$user = array(
						'password' => $encrypted_password, 
						'updated_at' => date('Y-m-d H:i:s'));

				$this->user_model->update_user($id, $user);

				redirect(base_url('users/dashboard'));
		}
	}

	public function update_about_me() {
		$this->form_validation->set_rules('about_me', 'About Me', 'required|xss_clean');
		$id = $this->session->userdata('logged_in_id');

		if($this->form_validation->run() == FALSE) {
			$errors = validation_errors();
			$this->session->set_userdata('result', $errors);
			redirect(base_url('/users/edit_profile'));
		} else {
				$user = array(
						'description' => $this->input->post('about_me'),
						'updated_at' => date('Y-m-d H:i:s'));

				$this->user_model->update_user($id, $user);		
				redirect(base_url('Login_Controller/dashboard'));
		}
	}
}