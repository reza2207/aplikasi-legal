<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	
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
		$this->load->helper(array('form', 'url'));
		$this->load->helper('terbilang_helper');
		$this->load->helper('tanggal_helper');
	}	


	public function index()
	{	
		$data = new stdClass();
		$data->title = 'Register';
		$data->page = 'register';
		$this->load->view('header', $data);
		$this->load->view('register');
		
	}

	public function profile()
	{
		$this->load->view('profile');

	}
	

	public function submit_register(){

		$data = new stdClass();
		$data->title = 'Register';
		//initialize button submit
	
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('encryption');
		
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[10]',
                array('required' => 'You must provide a %s.')
        );
        $this->form_validation->set_rules('full_name', 'Full Name', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('recovery', 'Recovery Question', 'required|trim|min_length[10]');
        $this->form_validation->set_rules('recovery_answer', 'Recovery Answer', 'required|trim');
        $this->form_validation->set_rules('role', 'Role', 'required');

		$username = $this->input->post('username',TRUE);
		$password = $this->input->post('password');
		$fullname = $this->input->post('full_name',TRUE);
		$recovery = $this->input->post('recovery', TRUE);
		$answer = $this->input->post('recovery_answer', TRUE);
		$role = $this->input->post('role');
        if ($this->form_validation->run() == FALSE){

            $errors = validation_errors();
            $respons_ajax['status'] = 'error';
            $respons_ajax['pesan'] = $errors;
            echo json_encode($respons_ajax);

        }else{
			$this->user_model->create_user($username, $password, $fullname, $recovery, $answer, $role);
			$respons_ajax['status'] = 'success';
			$respons_ajax['pesan'] = '<b>'.$username.'</b> berhasil dibuat!';
			echo json_encode($respons_ajax);		
		}
		

	}

	
}