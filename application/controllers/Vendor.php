<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller {

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

	}	
	public function index()
	{
		if(isset($_SESSION['username'])){
		$data = new stdClass();
		$data->title = 'Vendor';
		$this->load->view('header', $data);
		$this->load->view('index');
		
		}else{
		
		$this->load->view('login');
		
		}

	}

	public function perusahaan(){
		if ($this->uri->segment(3) === FALSE){
			$sort_by = 'default';
		}elseif($this->uri->segment(5) == 'sort_by'){

			if ($this->db->field_exists($this->uri->segment(6), 'perusahaan'))
			{
			    $sort_by = $this->uri->segment(6);
			}else{
				$sort_by = 'default';
			}

			
		}elseif($this->uri->segment(4) == 'sort_by'){
			if ($this->db->field_exists($this->uri->segment(5), 'perusahaan')){

				$sort_by = $this->uri->segment(5);
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
			$this->load->model('perusahaan_model');
			$data = new stdClass();
			$data->sort_by = $sort_by;
			$data->role = $_SESSION['role'];
			 //konfigurasi pagination
	        $config['base_url'] = base_url('vendor/perusahaan/page/'); //site url
	        $config['total_rows'] = $this->db->count_all('perusahaan'); //total row
	        $config['per_page'] = 50;  //show record per halaman
	        $config["uri_segment"] = 4;  // uri parameter
	        $choice = $config["total_rows"] / $config["per_page"];
	        $config["num_links"] = floor($choice);
	 		$config['use_page_numbers'] = TRUE;
	 		$config['attributes']['rel'] = FALSE;
	 		$config['reuse_query_string'] = TRUE;
	 		$config['suffix'] = '/sort_by/'.$sort_by;
	 		$config['first_url'] = $config['base_url'].$config['suffix'];
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
	        $data->page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
	 
	        //panggil function list_perusahaan di model. 
	        $data->data = $this->perusahaan_model->list_perusahaan($config["per_page"], $data->page, $sort_by);           
	 
	        $data->pagination = $this->pagination->create_links();
			
			$data->title = 'Welcome '.$_SESSION['nama'].'!';

			//get vendor id
			

			if($this->perusahaan_model->count_all(date('Ymd')) > 0){

				$lastid = $this->perusahaan_model->get_id_perusahaan(date('Ymd'));
				$lastid = $lastid->vendor_id;
				$codeunix = explode('.', $lastid);
				$newid = date('Ymd').'.'.str_pad($codeunix[1]+1, 3, '00', STR_PAD_LEFT);
				$data->id = $newid;
			}else{

				$data->id = date('Ymd').'.001';
			}
			$data->page = 'perusahaan';
			$this->load->view('header', $data);
			$this->load->view('perusahaan', $data);

		}else{
			$data = new stdClass();
			$data->title = 'Login';
			$this->load->view('login', $data);
		}

	}

	public function submit_perusahaan(){
		$this->load->model('perusahaan_model');
		$id = $this->input->post('id', TRUE);
		$nama = $this->input->post('nama', TRUE);
		$alamat = $this->input->post('alamat', TRUE);
		$kota = $this->input->post('kota', TRUE);
		$zip = $this->input->post('zip', TRUE);
		$phone1 = $this->input->post('phone1', TRUE);
		$phone2 = $this->input->post('phone2', TRUE);
		$fax = $this->input->post('fax', TRUE);
		$email = $this->input->post('email', TRUE);
		$bidang = $this->input->post('bidang', TRUE);
		$npwp = $this->input->post('npwp', TRUE);
		$keterangan = $this->input->post('keterangan', TRUE);
		$unit = $this->input->post('unit', TRUE);

		$this->perusahaan_model->insert_new_perusahaan($id, $nama, $alamat, $kota, $zip, $phone1, $phone2, $fax, $email, $bidang, $npwp, $keterangan, $unit);
		if($this->perusahaan_model->count_all(date('Ymd')) > 0){

			$lastid = $this->perusahaan_model->get_id_perusahaan(date('Ymd'));
			$lastid = $lastid->vendor_id;
			$codeunix = explode('.', $lastid);
			$newid = date('Ymd').'.'.str_pad($codeunix[1]+1, 3, '00', STR_PAD_LEFT);
			$id = $newid;
		}else{

			$id = date('Ymd').'.001';
		}
		$respons_ajax['idbaru'] = $id;
		$respons_ajax['status'] = 'success';
		$respons_ajax['pesan'] = 'Adding data '.$nama.' success!';
		echo json_encode($respons_ajax);
		
	}

	public function update_perusahaan(){
		$data = new stdClass();
		$this->load->model('perusahaan_model');
		$id = $this->input->post('id', TRUE);
		$nama = $this->input->post('nama', TRUE);
		$alamat = $this->input->post('alamat', TRUE);
		$kota = $this->input->post('kota', TRUE);
		$zip = $this->input->post('zip', TRUE);
		$phone1 = $this->input->post('phone1', TRUE);
		$phone2 = $this->input->post('phone2', TRUE);
		$fax = $this->input->post('fax', TRUE);
		$email = $this->input->post('email', TRUE);
		$bidang = $this->input->post('bidang', TRUE);
		$npwp = $this->input->post('npwp', TRUE);
		$keterangan = $this->input->post('keterangan', TRUE);
		$unit = $this->input->post('unit', TRUE);

		$this->perusahaan_model->update_perusahaan($id, $nama, $alamat, $kota, $zip, $phone1, $phone2, $fax, $email, $bidang, $npwp, $keterangan, $unit);
		/*if($this->perusahaan_model->update_perusahaan($id, $nama, $alamat, $kota, $zip, $phone1, $phone2, $fax, $email, $bidang, $npwp, $keterangan)){
			$data->message = 'Success!';
			$data->type = 'success';
		}else{
			//$data->message = 'Failed!';
			$data->message = $id.$nama.$alamat.$kota.$zip.$phone1.$phone2.$fax.$email.$bidang.$npwp.$keterangan;
			$data->type = 'error';

		}*/
		$data->message = 'Success!';
		$data->type = 'success';

		echo json_encode($data);

	}

	public function hapus_perusahaan(){
		$data = new stdClass();

		$id = $this->uri->segment(5, 0);
		
		$this->load->model('perusahaan_model');
		if($this->perusahaan_model->hapus_perusahaan($id)){
			$data->pesan = 'berhasil';
			echo json_encode($data);
			//$this->session->set_flashdata('pesan', 'Berhasil');
			//redirect('vendor/perusahaan');
		}else{
			$data->pesan = 'Gagal';
			echo json_encode($data);
			//$pesan = $id;
			//$this->session->set_flashdata('pesan', $pesan);
			//redirect('vendor/perusahaan');
		}

		
	}

	public function cari_perusahaan(){
		$data = new stdClass();
		$this->load->helper('form');
		$this->load->model('perusahaan_model');
		if(isset($_SESSION['username'])){

			$url_1 = $this->uri->slash_segment(1);
			$url_2 = $this->uri->slash_segment(2);
			$url_3 = $this->uri->slash_segment(3);
			$full_url = uri_string();
			//$value = uri_string();
			$value =  get_value_url_vendor($url_1, $url_2, $url_3, $full_url);
			$data->value = $value;
			$data->title = 'Search Vendor';
			$data->role = $_SESSION['role'];
			
			if($this->perusahaan_model->count_all(date('Ymd')) > 0){

				$lastid = $this->perusahaan_model->get_id_perusahaan(date('Ymd'));
				$lastid = $lastid->vendor_id;
				$codeunix = explode('.', $lastid);
				$newid = date('Ymd').'.'.str_pad($codeunix[1]+1, 3, '00', STR_PAD_LEFT);
				$data->id = $newid;
			}else{
				
				$data->id = date('Ymd').'.001';
			}
			if($this->perusahaan_model->count_cari_data_perusahaan($value) > 0){

				
				$data->jml = $this->perusahaan_model->count_cari_data_perusahaan($value);
				$data->data = $this->perusahaan_model->cari_data_perusahaan($value);
				$data->page = 'perusahaan';
				$this->load->view('header', $data);
				$this->load->view('cari_perusahaan');

			}else{
				$data->jml = $this->perusahaan_model->count_cari_data_perusahaan($value);
				$data->page = 'perusahaan';
				$this->load->view('header', $data);
				$this->load->view('cari_perusahaan');

			}
		
		}else{
		
			$this->load->view('login');
		}

	}

}
