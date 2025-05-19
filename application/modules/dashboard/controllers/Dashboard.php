<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	function __construct(){
		parent::__construct();		
		$this->load->model('m_dashboard');
	}


	public function index()
	{
		$bulan = date('m');
		$tahun = date('Y');
		$data['wa_belum'] = $this->wa_belum();
		$data['outbox_status'] = $this->outbox_status($bulan,$tahun);
		$data['jumlah_kirim'] = $this->jumlah_kirim($bulan,$tahun);
		$data['bulan_ini'] = $this->get_rekap($bulan,$tahun);
		$bulan_ = $bulan-1;
		$data['bulan_kemaren'] = $this->get_rekap($bulan_,$tahun);
		//NEW
		$data['rekap_layanan_last'] = $this->rekap_layanan_last($bulan,$tahun);
		$data['prediksi'] = $this->prediksi($bulan,$tahun);
		$data['rata2_kwitansi'] = $this->rata2_kwitansi($bulan,$tahun);
		$data['rata2_kwitansi_kemaren'] = $this->rata2_kwitansi($bulan_,$tahun);
		// echo "<pre>";
		// print_r($data['outbox_status']);
		// echo "</pre>";
		$this->load->view('template',$data);



	}
	function wa_belum() {
		$data = $this->m_dashboard->wa_belum_()->result();
		return $data[0];
	}

	function outbox_status($bulan,$tahun){
		$data = $this->m_dashboard->outbox_status($bulan,$tahun)->result();
		return $data;
	}

	function jumlah_kirim($bulan,$tahun){
		$data = $this->m_dashboard->jumlah_kirim($bulan,$tahun)->result();
		return $data;
	}

	function get_rekap($bulan,$tahun){
		$data = $this->m_dashboard->get_rekap($bulan,$tahun)->result();
		return $data;
	}

	function rekap_layanan_last($bulan,$tahun){
		$data = $this->m_dashboard->prediksi_full($bulan,$tahun)->result();
		return $data;
	}

	function prediksi($bulan,$tahun){
		$data = $this->m_dashboard->prediksi($bulan,$tahun)->result();
		return $data;
	}
	function rata2_kwitansi($bulan,$tahun){
		$data = $this->m_dashboard->rata2_kwitansi($bulan,$tahun)->result();
		return $data;
	}
	
}
