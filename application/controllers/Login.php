<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct(){

		parent::__construct();
		$this->load->model('user_model');
		$this->load->helper('terbilang_helper');
		$this->load->helper('tanggal_helper');
		

	}	


	public function index() {
		// create the data object
		$data = new stdClass();
		$data->title = "Beranda";
		$this->load->helper('form');
		
		$this->load->view('login', $data);
	}

	public function profile()
	{
		$this->load->view('profile');

	}

	public function login() {
					
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		// set validation rules
		$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == false) {
			
			$errors = validation_errors();
            $respons_ajax['status'] = 'error';
            $respons_ajax['pesan'] = $errors;
            echo json_encode($respons_ajax);
			
		} else {

			// set variables from the form
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			if ($this->user_model->resolve_user_login($username, $password)) {
				
				$user  = $this->user_model->get_user($username);
				
				// set session user datas
				$_SESSION['username']     = (string)$user->username;
				$_SESSION['logged_in']    = (bool)true;
				$_SESSION['role']     = (string) $user->role;
				$_SESSION['nama'] = (string)$user->nama;

				$respons_ajax['status'] = 'success';
				$respons_ajax['pesan'] = 'Welcome <b>'.$username.'</b>!';
				echo json_encode($respons_ajax);
				
			} else {
				
				// login failed
				$respons_ajax['status'] = 'error';
				$respons_ajax['pesan'] = 'Wrong Username or Password!';
				echo json_encode($respons_ajax);
				
			}
			
		}
		
	}

	public function logout() {
		
		// create the data object
		$data = new stdClass();
		
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			
			// remove session datas
			foreach ($_SESSION as $key => $value) {
				unset($_SESSION[$key]);
			}
			
			// user logout ok
			redirect(base_url());
		} else {
			
			// there user was not logged in, we cannot logged him out,
			// redirect him to site root
			redirect(base_url());
			
		}
		
	}

	public function forgot_password(){

		$data = new stdClass();

		$this->load->view('header');
		$this->load->view('footer');
	}
}