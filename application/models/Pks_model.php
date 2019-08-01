<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class Pks_model extends CI_Model {

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
	
	public function list_pks($limit, $start) {
		
		
		$this->db->select('ppks_id, pks.vendor_id, perusahaan.nama_vendor, no_pks, tgl_pks, jenis_kerjasama, start_date, end_date, nilai_kerjasama, pks.unit');
		$this->db->from('pks');
		$this->db->join('perusahaan', 'pks.vendor_id = perusahaan.vendor_id', 'left');
		//$this->db->order_by("$sort_by ASC");
		$this->db->limit($limit, $start);
		return $this->db->get();
		
	}

	public function get_id_pks($id){

		$this->db->select('ppks_id');
		$this->db->from('pks');
		$this->db->like('ppks_id', $id, 'after');
		$this->db->order_by('ppks_id', 'DESC');
		$this->db->limit(1);
		return $this->db->get()->row()->ppks_id;
		
	}

	public function count_all($id){
		$this->db->select('ppks_id');
		$this->db->from('pks');
		$this->db->like('ppks_id', $id, 'after');
		
		return $this->db->get()->num_rows();
	}

	public function submit_pks($pks_id,$vendor_id,$nopks,$tglpks,$jenis,$start,$end,$nilai,$unit){
		$data = array (
				'ppks_id'=>$pks_id,
				'vendor_id'=>$vendor_id,
				'no_pks'=>$nopks,
				'tgl_pks'=>$tglpks,
				'jenis_kerjasama'=>$jenis,
				'start_date'=>$start,
				'end_date'=>$end,
				'nilai_kerjasama'=>$nilai,
				'unit'=>$unit
				);
		return $this->db->insert('pks', $data);
	}

	public function update_pks($pks_id,$vendor_id,$nopks,$tglpks,$jenis,$start,$end,$nilai,$unit){
		$data = array(
			'vendor_id'=>$vendor_id,
			'no_pks'=>$nopks,
			'tgl_pks'=>$tglpks,
			'jenis_kerjasama'=>$jenis,
			'start_date'=>$start,
			'end_date'=>$end,
			'nilai_kerjasama'=>$nilai,
			'unit'=>$unit
		);

		$this->db->where('ppks_id', $pks_id);
		return $this->db->update('pks', $data);

	}

	public function hapus_pks($id){

		return $this->db->delete('pks', array('ppks_id' => $id));

	}
	public function get_pks($id){
		$this->db->select('ppks_id, pks.vendor_id, perusahaan.nama_vendor, no_pks, tgl_pks, jenis_kerjasama, start_date, end_date, nilai_kerjasama, pks.unit');
		$this->db->from('pks');
		$this->db->join('perusahaan', 'pks.vendor_id = perusahaan.vendor_id', 'left');
		$this->db->where('ppks_id', $id);
		return $this->db->get()->row();
	}

	public function count_cari_data($value){
		$this->db->select('ppks_id');
		$this->db->from('pks');
		$this->db->join('perusahaan', 'pks.vendor_id = perusahaan.vendor_id', 'left');
		$this->db->like('ppks_id', $value);
		$this->db->or_like('pks.vendor_id', $value);
		$this->db->or_like('nama_vendor', $value);
		$this->db->or_like('no_pks', $value);
		$this->db->or_like('tgl_pks', $value);
		$this->db->or_like('jenis_kerjasama', $value);
		$this->db->or_like('start_date', $value);
		$this->db->or_like('end_date', $value);
		$this->db->or_like('nilai_kerjasama', $value);
		$this->db->or_like('pks.unit', $value);
		return $this->db->get()->num_rows();
	}

	public function cari_data_pks($value){
		$this->db->select('ppks_id, pks.vendor_id, perusahaan.nama_vendor, no_pks, tgl_pks, jenis_kerjasama, start_date, end_date, nilai_kerjasama, pks.unit');
		$this->db->from('pks');
		$this->db->join('perusahaan', 'pks.vendor_id = perusahaan.vendor_id', 'left');
		$this->db->like('ppks_id', $value);
		$this->db->or_like('pks.vendor_id', $value);
		$this->db->or_like('nama_vendor', $value);
		$this->db->or_like('no_pks', $value);
		$this->db->or_like('tgl_pks', $value);
		$this->db->or_like('jenis_kerjasama', $value);
		$this->db->or_like('start_date', $value);
		$this->db->or_like('end_date', $value);
		$this->db->or_like('nilai_kerjasama', $value);
		$this->db->or_like('pks.unit', $value);
		return $this->db->get();
	}

}
