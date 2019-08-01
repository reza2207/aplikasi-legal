<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tdr extends CI_Controller {

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
		
		$this->load->helper('terbilang_helper');
		$this->load->helper('tanggal_helper');
		$this->load->model('tdr_model');

	}	
	public function index(){
		
		
		$this->load->helper('form');
		
		if(isset($_SESSION['username'])){
			$this->load->library('pagination');
			$this->load->model('tdr_model');
			$data = new stdClass();
			$data->role = $_SESSION['role'];
			 //konfigurasi pagination
	        $config['base_url'] = base_url('tdr/page/'); //site url
	        $config['total_rows'] = $this->db->count_all('tdr'); //total row
	        $config['per_page'] = 50;  //show record per halaman
	        $config["uri_segment"] = 3;  // uri parameter
	        $choice = $config["total_rows"] / $config["per_page"];
	        $config["num_links"] = floor($choice);
	 		$config['use_page_numbers'] = TRUE;
	 		$config['attributes']['rel'] = FALSE;
	 		//$config['reuse_query_string'] = TRUE;
	 		//$config['page_query_string'] = TRUE;
	 		
	 		//$config['suffix'] = '';
	 		$config['first_url'] = base_url('tdr');
	        // Membuat Style pagination untuk Materialize
	      	$config['first_link']       = 'First';
	        $config['last_link']        = 'Last';
	        $config['next_link']        = 'Next';
	        $config['prev_link']        = 'Prev';
	        $config['full_tag_open']    = '<div class="col push-l3 l9 s12 center"><ul class="pagination">';
	        $config['full_tag_close']   = '</li></ul></div>';
	        $config['num_tag_open']     = '<li class="waves-effect">';
	        $config['num_tag_close']    = '</li>';
	        $config['cur_tag_open']     = '<li class="active"><a>';
	        $config['cur_tag_close']    = '</a></li>';
	        $config['next_tag_open']    = '<li class="waves-effect">';
	        $config['next_tagl_close']  = '&raquo;</li>';
	        $config['prev_tag_open']    = '<li class="waves-effect">';
	        $config['prev_tagl_close']  = 'Next</li>';
	        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
	        $config['first_tagl_close'] = '</span></li>';
	        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['last_tagl_close']  = '</span></li>';
	 
	        $this->pagination->initialize($config);
	        $data->page = ($this->uri->segment(3)) ? ($this->uri->segment(3)-1)*$config['per_page'] : 0;
	 
	        //panggil function list_perusahaan di model. 
	        $data->data = $this->tdr_model->list_tdr($config["per_page"], $data->page);
	 
	        $data->pagination = $this->pagination->create_links();
			
			$data->title = 'Welcome '.$_SESSION['nama'].'!';

			//get vendor id
			$data->vendor = $this->get_vendor();

			if($this->tdr_model->count_all_tdr(date('Ymd')) > 0){

				$lastid = $this->tdr_model->get_id_tdr(date('Ymd'));
				$lastid = $lastid->tdr_id;
				$codeunix = explode('.', $lastid);
				$newid = date('Ymd').'.'.str_pad($codeunix[1]+1, 3, '00', STR_PAD_LEFT);
				$data->id = $newid;
			}else{

				$data->id = date('Ymd').'.001';
			}
			$data->page = 'tdr';
			$this->load->view('header', $data);
			$this->load->view('tdr', $data);

		}else{
			$data = new stdClass();
			$data->title = 'Login';
			$this->load->view('login', $data);
		}

	}

	public function get_vendor(){
		return $this->tdr_model->list_perusahaan();
	}


	public function submit_tdr(){

		$id_tdr = $this->input->post('id_tdr', TRUE);
		$id_vendor = $this->input->post('id_vendor', TRUE);
		$no_tdr = $this->input->post('no_tdr', TRUE);
		$tgl_tdr = $this->input->post('tgl_tdr', TRUE);
		$start_date = $this->input->post('start_date', TRUE);
		$end_date = $this->input->post('end_date', TRUE);
		$keterangan = $this->input->post('keterangan', TRUE);

		$this->tdr_model->submit_tdr($id_tdr, $id_vendor, $no_tdr, $tgl_tdr, $start_date, $end_date, $keterangan);

		//$s = $id_tdr.$id_vendor.$no_tdr.$tgl_tdr.$start_date.$end_date.$keterangan;
		
		if($this->tdr_model->count_all_tdr(date('Ymd')) > 0){

			$lastid = $this->tdr_model->get_id_tdr(date('Ymd'));
			$lastid = $lastid->tdr_id;
			$codeunix = explode('.', $lastid);
			$newid = date('Ymd').'.'.str_pad($codeunix[1]+1, 3, '00', STR_PAD_LEFT);
			$id = $newid;
		}else{

			$id = date('Ymd').'.001';
		}

		$data = array('status'=>'success', 'pesan'=>'Berhasil!', 'idbaru'=>$id);
		echo json_encode($data);
		
	}

	public function modal_edit(){
		$this->load->helper('form');
		$data = new stdClass();
		$data->id = $this->input->post('id');
		$data->idvendor = $this->input->post('idvendor');
		$data->namavendor = $this->input->post('namavendor');
		$data->vendor = $this->get_vendor_exc($data->idvendor);
		$data->row = $this->tdr_model->get_tdr($data->id);
		
		$this->load->view('modal_edit_tdr', $data);

	}

	public function get_vendor_exc($v){
		return $this->tdr_model->list_perusahaan_exc($v);
	}

	public function submit_modal_edit(){
		$idtdr = $this->input->post('id_tdr');
		$idvendor = $this->input->post('id_vendor');
		$notdr = $this->input->post('no_tdr');
		$tgltdr = $this->input->post('tgl_tdr');
		$startdate = $this->input->post('start_date');
		$enddate = $this->input->post('end_date');
		$keterangan = $this->input->post('keterangan');

		if($this->tdr_model->update_tdr($idtdr, $idvendor, $notdr, $tgltdr, $startdate, $enddate, $keterangan)){
			$data = array('status'=>'success', 'pesan'=>'Berhasil!');
			echo json_encode($data);
		}else{
			$data = array('status'=>'error', 'pesan'=>'Gagal!');
			echo json_encode($data);
		}
	}

	public function hapus_tdr(){
		$idtdr = $this->input->post('id');

		if($this->tdr_model->hapus_tdr($idtdr)){
			$data = array('status'=>'success', 'pesan'=>'Berhasil!', 'id'=>$idtdr);
			echo json_encode($data);
		}else{
			$data = array('status'=>'error', 'pesan'=>'Gagal!');
			echo json_encode($data);
		}
	}

	public function cari_tdr(){
		
		$this->load->helper('form');
		if(isset($_SESSION['username'])){
			$data = new stdClass();

			$url_1 = $this->uri->slash_segment(1);
			$url_2 = $this->uri->slash_segment(2);
			$full_url = uri_string();
			//$value = uri_string();
			$value =  get_value_url($url_1, $url_2, $full_url);
			$data->value = $value;
			$data->title = 'Search TDR';
			$data->role = $_SESSION['role'];
			
			if($this->tdr_model->count_all_tdr(date('Ymd')) > 0){

				$lastid = $this->tdr_model->get_id_tdr(date('Ymd'));
				$lastid = $lastid->tdr_id;
				$codeunix = explode('.', $lastid);
				$newid = date('Ymd').'.'.str_pad($codeunix[1]+1, 3, '00', STR_PAD_LEFT);
				$data->id = $newid;
			}else{

				$data->id = date('Ymd').'.001';
			}
			if($this->tdr_model->count_cari_data_tdr($value) > 0){

				
				$data->jml = $this->tdr_model->count_cari_data_tdr($value);
				$data->data = $this->tdr_model->cari_data_tdr($value);
				$data->page = 'tdr';
				$data->vendor = $this->get_vendor();
				$this->load->view('header', $data);
				$this->load->view('cari_tdr');

			}else{
				$data->jml = $this->tdr_model->count_cari_data_tdr($value);
				$data->page = 'tdr';
				$data->vendor = $this->get_vendor();
				$this->load->view('header', $data);
				$this->load->view('cari_tdr');

			}
		
		}else{
		
			$this->load->view('login');
		}

	}



}
