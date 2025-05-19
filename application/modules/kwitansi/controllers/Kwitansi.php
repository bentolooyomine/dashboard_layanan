<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kwitansi extends MY_Controller {
	function __construct(){
		parent::__construct();		
		$this->load->model('m_kwitansi');
	}


	public function index()
	{
			$this->load->view('template');
	}
	
	function tabel($tgl_awal,$tgl_akhir)  {

		$data['data'] = $this->m_kwitansi->get_data_by_tgl($tgl_awal,$tgl_akhir)->result();
		$this->load->view('tabel',$data);
		
	}

	function top_menu($tgl_awal,$tgl_akhir)  {
		$this->load->view('top_menu');
		
	}

	function graph($tgl_awal,$tgl_akhir)  {

		$data['data'] = $this->m_kwitansi->get_data_by_tgl($tgl_awal,$tgl_akhir)->result();
	
		$this->load->view('graph',$data);
		
	}
}

