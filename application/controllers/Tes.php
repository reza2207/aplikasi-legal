<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tes extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){

		parent::__construct();
		
		$this->load->model('Tes_model');
		$this->load->helper('terbilang_helper');

	}	
	public function index()
	{	
		$this->load->view('tes');
	}

	public function get_data_tes()
	{
		$list = $this->Tes_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->idtes;
			$row[] = $field->nama;
			$row[] = $field->alamat;
			$row[] = 'id'.$field->idtes;
		
			$data[] = $row;
			
		}

		$output = array(
			"draw"=> $_POST['draw'], 
			"recordsTotal" =>$this->Tes_model->count_all(),
			"recordsFiltered"=>$this->Tes_model->count_filtered(),
			"data"=>$data,
		);
		echo json_encode($output);
	}
}
