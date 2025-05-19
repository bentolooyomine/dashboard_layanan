<?php 
 
class M_kwitansi extends CI_Model{
	
    function get_data_by_tgl($tgl_awal,$tgl_akhir) {

        return $this->db->query("SELECT user.nama, count(*) as jumlah FROM kwitansi
LEFT JOIN user ON kwitansi.id_user = user.id
WHERE tanggal_permohonan BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."'
GROUP BY user.nama ");
        
    }
	
}