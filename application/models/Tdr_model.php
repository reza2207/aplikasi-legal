<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class Tdr_model extends CI_Model {

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		
	}
	
	public function list_tdr($limit, $start) {
		
		$this->db->select('tdr_id, tdr.vendor_id, no_tdr, tgl_tdr, start_date, end_date, tdr.keterangan, perusahaan.nama_vendor');
		$this->db->from('tdr');
		$this->db->join('perusahaan', 'perusahaan.vendor_id = tdr.vendor_id', 'left');

		//$this->db->order_by("$sort_by ASC");
		$this->db->limit($limit, $start);
		//$this->db->order_by('tgl_akhir DESC', 'nm_vendor ASC');
		return $this->db->get();
		
	}

	public function list_perusahaan() {
		
		$this->db->select('vendor_id, nama_vendor');
		$this->db->from('perusahaan');
		$this->db->order_by('nama_vendor', 'ASC');
		return $this->db->get();
		
	}

	public function list_perusahaan_exc($v) {
		
		$this->db->select('vendor_id, nama_vendor');
		$this->db->from('perusahaan');
		$this->db->where('vendor_id !=', $v);
		$this->db->order_by('nama_vendor', 'ASC');
		return $this->db->get();
		
	}

	public function get_id_tdr($id){

		$this->db->select('tdr_id');
		$this->db->from('tdr');
		$this->db->like('tdr_id', $id, 'after');
		$this->db->order_by('tdr_id', 'DESC');
		$this->db->limit(1);
		return $this->db->get()->row();
		
	}
	public function count_all($id){
		$this->db->select('vendor_id');
		$this->db->from('perusahaan');
		$this->db->like('vendor_id', $id, 'after');
		
		return $this->db->get()->num_rows();
	}

	public function count_all_tdr($id){
		$this->db->select('tdr_id');
		$this->db->from('tdr');
		$this->db->like('tdr_id', $id, 'after');

		return $this->db->get()->num_rows();	
	}

	public function submit_tdr($id_tdr, $id_vendor, $no_tdr, $tgl_tdr, $start_date, $end_date, $keterangan){

		$data = array('tdr_id'=>$id_tdr,
					  'vendor_id'=>$id_vendor,
					  'no_tdr'=>$no_tdr,
						'tgl_tdr'=>$tgl_tdr,
						'start_date'=>$start_date, 
						'end_date'=>$end_date, 
						'keterangan'=>$keterangan
					);
		
		$this->db->insert('tdr', $data);

	}

	public function get_tdr($id) {

		$this->db->select('tdr_id, tdr.vendor_id, no_tdr, tgl_tdr, start_date, end_date, tdr.keterangan, perusahaan.nama_vendor');
		$this->db->from('tdr');
		$this->db->join('perusahaan', 'perusahaan.vendor_id = tdr.vendor_id', 'left');
		$this->db->where('tdr_id', $id);

		return $this->db->get()->row();
	}

	public function update_tdr($idtdr, $idvendor, $notdr, $tgltdr, $startdate, $enddate, $keterangan){

		$data = array(
				'vendor_id'=>$idvendor,
				'no_tdr'=>$notdr,
				'tgl_tdr'=>$tgltdr,
				'start_date'=>$startdate,
				'end_date'=>$enddate,
				'keterangan'=>$keterangan);
		$this->db->where('tdr_id', $idtdr);
		return $this->db->update('tdr', $data);
	}

	public function hapus_tdr($id){

		return $this->db->delete('tdr', array('tdr_id'=>$id));
	}

	public function count_cari_data_tdr($value){
		$this->db->select('tdr_id');
		$this->db->from('tdr');
		$this->db->join('perusahaan', 'perusahaan.vendor_id = tdr.vendor_id', 'left');
		$this->db->like('tdr_id', $value);
		$this->db->or_like('tdr.vendor_id', $value);
		$this->db->or_like('no_tdr', $value);
		$this->db->or_like('tgl_tdr', $value);
		$this->db->or_like('start_date', $value);
		$this->db->or_like('end_date', $value);
		$this->db->or_like('tdr.keterangan', $value);
		$this->db->or_like('nama_vendor', $value);
		return $this->db->get()->num_rows();

	}

	public function cari_data_tdr($value){
		$this->db->select('tdr_id, tdr.vendor_id, no_tdr, tgl_tdr, start_date, end_date, tdr.keterangan, perusahaan.nama_vendor');
		$this->db->from('tdr');
		$this->db->join('perusahaan', 'perusahaan.vendor_id = tdr.vendor_id', 'left');
		$this->db->like('tdr_id', $value);
		$this->db->or_like('tdr.vendor_id', $value);
		$this->db->or_like('no_tdr', $value);
		$this->db->or_like('tgl_tdr', $value);
		$this->db->or_like('start_date', $value);
		$this->db->or_like('end_date', $value);
		$this->db->or_like('tdr.keterangan', $value);
		$this->db->or_like('nama_vendor', $value);
		return $this->db->get();
	}
	
}
