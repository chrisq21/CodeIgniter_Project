<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_Controller extends CI_Controller {
	protected $view_data = array();
	protected $user_info = NULL;

	public function __construct() {
		parent::__construct();
		$this->user_info = $this->session->userdata('user_info');
		$this->load->model('user_model');
		$this->load->library('form_validation');
		$this->load->library('encrypt');
	}

	public function index() {
		redirect(base_url('Login_Controller/home'));
	}

	public function home() {
		$this->load->view('welcome');
	}

	public function login() {
		$this->load->view('login');
	}

	public function dashboard() {
		redirect(base_url('users/dashboard'));
	}


	public function process_login() {
		//FORM VALIDATION
		
		$this->form_validation->set_rules('email', 'Email', 'valid_email|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'min_length[8]|required|xss_clean');

		if($this->form_validation->run() == FALSE) {
			$errors = validation_errors();
			$this->session->set_userdata('result', $errors);
			redirect(base_url('Login_Controller/login'));
		} else {
			$this->session->set_userdata('email', $this->input->post('email'));
			$this->session->set_userdata('password', $this->input->post('password'));
			redirect(base_url('Login_Controller/check_user'));
		}
	}

	public function process_registration() {
		$this->form_validation->set_rules('first_name', 'First Name', 'alpha|required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'alpha|required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'min_length[8]|required|xss_clean');
		$this->form_validation->set_rules('cf_password', 'Confirm Password', "min_length[8]|required|matches[password]|xss_clean");
		$this->form_validation->set_rules('about_me', 'About Me', "required|xss_clean");

		if($this->form_validation->run() == FALSE) {
			$errors = validation_errors();
			$this->session->set_userdata('result', $errors);
			redirect(base_url('/Login_Controller/register'));
		} else {
			//Check whether the email exists in the DB
			if($this->user_model->email_exists($this->input->post('email'))) {
				$email = $this->input->post('email');
				$this->session->set_userdata('result', $email.' Is Already Registered');
				redirect(base_url('/Login_Controller/register'));
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
						'created_at' => date('y-m-d h:i:s'));

				$this->user_model->insert_user($user);
				$new_user = $this->user_model->get_user($email);

				if(count($new_user) > 0) {
					$this->session->set_userdata('user', $new_user);
					$this->session->set_userdata('user_level', 'normal');
					$this->session->set_userdata('logged_in_id', $new_user->id);
					$this->session->set_userdata('logged_in', TRUE);
					redirect(base_url('Login_Controller/dashboard'));
				}
			}
		}
	}

	public function register() {
		$this->load->view('register');
	}

	public function check_user() {
		$email = $this->session->userdata('email');
		$this->session->unset_userdata('email');
		$user = $this->user_model->get_user($email);		
		if(count($user) > 0) {
		// If email exists, encrypt given password and check it against encrypted db password
			$db_password = $user->password;
			$password = $this->session->userdata('password');
			$this->session->unset_userdata('password');
			$encrypted_pass = $this->encrypt->sha1($password);

			if($db_password == $encrypted_pass) {
				$this->session->set_userdata('logged_in_id', $user->id);
				$this->session->set_userdata('logged_in', TRUE);
				if($user->user_level == 'admin') 
					$this->session->set_userdata('user_level', 'admin');
				else 
					$this->session->set_userdata('user_level', 'normal');

				redirect(base_url('/Login_Controller/dashboard'));
			} else {
				$this->session->set_userdata('result', 'Password Is Incorrect');
				redirect(base_url('/Login_Controller/login'));
			}
		} else {
			$this->session->set_userdata('result', 'Email Not Registered');
			redirect(base_url('/Login_Controller/login'));
		}
	}
}