<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class Perusahaan_model extends CI_Model {

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
	
	public function list_perusahaan($limit, $start, $sort_by) {
		
		$sort_by = ($sort_by == 'default') ? 'vendor_id' : $sort_by;
		$this->db->select('vendor_id, nama_vendor, alamat, kota, kode_pos, telp_1, telp_2, fax, email, bidang_usaha, npwp, keterangan, unit');
		$this->db->from('perusahaan');
		$this->db->order_by("$sort_by ASC");
		$this->db->limit($limit, $start);
		return $this->db->get();
		
	}

	public function get_id_perusahaan($id){

		$this->db->select('vendor_id');
		$this->db->from('perusahaan');
		$this->db->like('vendor_id', $id, 'after');
		$this->db->order_by('vendor_id', 'DESC');
		$this->db->limit(1);
		return $this->db->get()->row();
		
	}

	public function count_all($id){
		$this->db->select('vendor_id');
		$this->db->from('perusahaan');
		$this->db->like('vendor_id', $id, 'after');
		
		return $this->db->get()->num_rows();
	}

	public function insert_new_perusahaan($id,$nama,$alamat,$kota,$zip,$phone1,$phone2,$fax,$email,$bidang,$npwp,$keterangan, $unit){
		$data = array (
				'vendor_id'=>$id, 
				'nama_vendor'=>$nama,
				'alamat'=>$alamat,
				'kota'=>$kota,
				'kode_pos'=>$zip,
				'telp_1'=>$phone1,
				'telp_2'=>$phone2,
				'fax'=>$fax,
				'email'=>$email,
				'bidang_usaha'=>$bidang,
				'npwp'=>$npwp,
				'keterangan'=>$keterangan,
				'unit'=>$unit
				);
		$this->db->insert('perusahaan', $data);
	}

	public function update_perusahaan($id,$nama,$alamat,$kota,$zip,$phone1,$phone2,$fax,$email,$bidang,$npwp,$keterangan,$unit){
		$data = array(
			'nama_vendor'=>$nama,
			'alamat'=>$alamat,
			'kota'=>$kota,
			'kode_pos'=>$zip,
			'telp_1'=>$phone1,
			'telp_2'=>$phone2,
			'fax'=>$fax,
			'email'=>$email,
			'bidang_usaha'=>$bidang,
			'npwp'=>$npwp,
			'keterangan'=>$keterangan,
			'unit'=>$unit,
		);

		$this->db->where('vendor_id', $id);
		$this->db->update('perusahaan', $data);

	}

	public function hapus_perusahaan($id){

		$this->db->delete('perusahaan', array('vendor_id' => $id));

	}

	public function cari_data_perusahaan($value){

		$this->db->select('vendor_id, nama_vendor, alamat, kota, kode_pos, telp_1, telp_2, fax, email, bidang_usaha, npwp, keterangan, unit');
		$this->db->from('perusahaan');
		$this->db->like('vendor_id', $value);
		$this->db->or_like('nama_vendor', $value);
		$this->db->or_like('alamat', $value);
		$this->db->or_like('kota', $value);
		$this->db->or_like('kode_pos', $value);
		$this->db->or_like('telp_1', $value);
		$this->db->or_like('telp_2', $value);
		$this->db->or_like('fax', $value);
		$this->db->or_like('email', $value);
		$this->db->or_like('bidang_usaha', $value);
		$this->db->or_like('npwp', $value);
		$this->db->or_like('keterangan', $value);
		$this->db->or_like('unit', $value);

		return $this->db->get();
	}

	public function count_cari_data_perusahaan($value){
		$this->db->select('vendor_id');
		$this->db->from('perusahaan');
		$this->db->like('vendor_id', $value);
		$this->db->or_like('nama_vendor', $value);
		$this->db->or_like('alamat', $value);
		$this->db->or_like('kota', $value);
		$this->db->or_like('kode_pos', $value);
		$this->db->or_like('telp_1', $value);
		$this->db->or_like('telp_2', $value);
		$this->db->or_like('fax', $value);
		$this->db->or_like('email', $value);
		$this->db->or_like('bidang_usaha', $value);
		$this->db->or_like('npwp', $value);
		$this->db->or_like('keterangan', $value);
		$this->db->or_like('unit', $value);
		return $this->db->get()->num_rows();

	}

	
	
}
