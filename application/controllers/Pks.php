<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pks extends CI_Controller {

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
		$this->load->model('pks_model');
		$this->load->helper('form');
		$this->load->model('tdr_model');

	}	
	public function index()
	{
		if ($this->uri->segment(2) === FALSE){
			$sort_by = 'default';
		}elseif($this->uri->segment(4) == 'sort_by'){

			if ($this->db->field_exists($this->uri->segment(4), 'pks'))
			{
			    $sort_by = $this->uri->segment(6);
			}else{
				$sort_by = 'default';
			}

			
		}elseif($this->uri->segment(4) == 'sort_by'){
			if ($this->db->field_exists($this->uri->segment(4), 'pks')){

				$sort_by = $this->uri->segment(4);
			}else{
				$sort_by = 'default';
			}
		}else{
			$sort_by = 'default';
		}
		//$sort_by = ($this->uri->segment(5) == 'sort_by') ? $this->uri->segment(6) : 'default';
		$this->load->helper('form');
		
		if(isset($_SESSION['username'])){
			$this->load->library('pagination');
			
			$data = new stdClass();
			$data->sort_by = $sort_by;
			$data->role = $_SESSION['role'];
			 //konfigurasi pagination
	        $config['base_url'] = base_url('pks/page/'); //site url
	        $config['total_rows'] = $this->db->count_all('pks'); //total row
	        $config['per_page'] = 50;  //show record per halaman
	        $config["uri_segment"] = 3;  // uri parameter
	        $choice = $config["total_rows"] / $config["per_page"];
	        $config["num_links"] = floor($choice);
	 		$config['use_page_numbers'] = TRUE;
	 		$config['attributes']['rel'] = FALSE;
	 		$config['reuse_query_string'] = TRUE;
	 		//$config['suffix'] = '/sort_by/'.$sort_by;
	 		$config['first_url'] = base_url('pks');;
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
	        $data->data = $this->pks_model->list_pks($config["per_page"], $data->page, $sort_by);           
	 
	        $data->pagination = $this->pagination->create_links();
			
			$data->title = 'Welcome '.$_SESSION['nama'].'!';

			//get vendor id
			

			if($this->pks_model->count_all(date('Ymd')) > 0){
				
				$lastid = $this->pks_model->get_id_pks(date('Ymd'));
				$codeunix = explode('.', $lastid);
				$newid = date('Ymd').'.'.str_pad($codeunix[1]+1, 3, '00', STR_PAD_LEFT);
				$data->id = $newid;
			}else{

				$data->id = date('Ymd').'.001';
			}
			$data->vendor = $this->get_vendor();
			$data->page = 'pks';
			$this->load->view('header', $data);
			$this->load->view('pks', $data);

		}else{
			$data = new stdClass();
			$data->title = 'Login';
			$this->load->view('login', $data);
		}

	}

	public function get_vendor(){
		return $this->tdr_model->list_perusahaan();
	}

	public function submit_pks(){
		$pks_id = $this->input->post('id', TRUE);
		$vendor_id = $this->input->post('idvendor', TRUE);
		$nopks = $this->input->post('nopks', TRUE);
		$tglpks = $this->input->post('tglpks', TRUE);
		$jenis = $this->input->post('jenis', TRUE);
		$start = $this->input->post('start', TRUE);
		$end = $this->input->post('end', TRUE);
		$nilai = $this->input->post('nilai', TRUE);
		$unit = $this->input->post('unit', TRUE);

		if($this->pks_model->submit_pks($pks_id,$vendor_id,$nopks,$tglpks,$jenis,$start,$end,$nilai,$unit)){
		
			if($this->pks_model->count_all(date('Ymd')) > 0){

				$lastid = $this->pks_model->get_id_pks(date('Ymd'));
				$codeunix = explode('.', $lastid);
				$newid = date('Ymd').'.'.str_pad($codeunix[1]+1, 3, '00', STR_PAD_LEFT);
				$id = $newid;
			}else{

				$id = date('Ymd').'.001';
			}
			$data = array('status'=>'success', 'pesan'=>'Berhasil!', 'idbaru'=>$id);
			echo json_encode($data);

		}else{
			$data = array('status'=>'error', 'pesan'=>'Gagal!', 'idbaru'=>$id);
			echo json_encode($data);
		}
		
		
	}
	public function hapus_pks(){
		$id = $this->input->post('id');

		if($this->pks_model->hapus_pks($id)){
			$data = array('status'=>'success', 'pesan'=>'Berhasil!', 'id'=>$id);
			echo json_encode($data);
		}else{
			$data = array('status'=>'error', 'pesan'=>'Gagal!');
			echo json_encode($data);
		}
	}
	public function modal_edit(){
		$this->load->helper('form');
		$data = new stdClass();
		$data->id = $this->input->post('id');
		$data->row = $this->pks_model->get_pks($data->id);
		$data->vendor = $this->get_vendor_exc($data->row->vendor_id);
		$this->load->view('modal_edit_pks', $data);

	}

	public function get_vendor_exc($v){
		return $this->tdr_model->list_perusahaan_exc($v);
	}

	public function submit_modal_edit(){
		$pks_id = $this->input->post('id', TRUE);
		$vendor_id = $this->input->post('idvendor', TRUE);
		$nopks = $this->input->post('nopks', TRUE);
		$tglpks = $this->input->post('tglpks', TRUE);
		$jenis = $this->input->post('jenis', TRUE);
		$start = $this->input->post('start', TRUE);
		$end = $this->input->post('end', TRUE);
		$nilai = $this->input->post('nilai', TRUE);
		$unit = $this->input->post('unit', TRUE);
		
		if($this->pks_model->update_pks($pks_id,$vendor_id,$nopks,$tglpks,$jenis,$start,$end,$nilai,$unit)){
			$data = array('status'=>'success', 'pesan'=>'Berhasil!');
			echo json_encode($data);
		}else{
			$data = array('status'=>'error', 'pesan'=>'Gagal!');
			echo json_encode($data);
		}
	}

	public function cari_pks(){

		
		if(isset($_SESSION['username'])){
			$data = new stdClass();
			//$value = $this->uri->segment(3, 0);
			$url_1 = $this->uri->slash_segment(1);
			$url_2 = $this->uri->slash_segment(2);
			$full_url = uri_string();
			//$value = uri_string();
			$value =  get_value_url($url_1, $url_2, $full_url);
			$data->value = $value;
			$data->title = 'Search PKS';
			$data->role = $_SESSION['role'];

			if($this->pks_model->count_all(date('Ymd')) > 0){
				$lastid = $this->pks_model->get_id_pks(date('Ymd'));
				
				$codeunix = explode('.', $lastid);
				$newid = date('Ymd').'.'.str_pad($codeunix[1]+1, 3, '00', STR_PAD_LEFT);
				$data->id = $newid;
			}else{

				$data->id = date('Ymd').'.001';
			}
				
			if($this->pks_model->count_cari_data($value) > 0){
				
				
				$data->jml = $this->pks_model->count_cari_data($value);
				$data->data = $this->pks_model->cari_data_pks($value);
				$data->page = 'pks';
				$data->vendor = $this->get_vendor();
				$this->load->view('header', $data);
				$this->load->view('cari_pks');

			}else{

				$data->jml = $this->pks_model->count_cari_data($value);
				$data->page = 'pks';
				$data->vendor = $this->get_vendor();
				$this->load->view('header', $data);
				$this->load->view('cari_pks',$data);

			}
		}else{
		
			$this->load->view('login');

		}
		
	}
}