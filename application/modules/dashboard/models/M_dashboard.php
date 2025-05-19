<?php 
 
class M_dashboard extends CI_Model{
	function wa_belum_(){
		return $this->db->query('SELECT COUNT(*) as jumlah FROM outbox_wa WHERE outbox_wa.status = "proses kirim"');
	}

    function outbox_status($bulan,$tahun){
		return $this->db->query('SELECT is_wa, COUNT(*) as jumlah FROM kwitansi 
WHERE MONTH(kwitansi.tanggal_permohonan) = '.$bulan.'
AND YEAR(tanggal_permohonan) = '.$tahun.'
AND is_wa is not NULL
GROUP BY is_wa
');
	}

    function jumlah_kirim($bulan,$tahun){
		return $this->db->query('
       SELECT  COUNT(*) as jumlah FROM outbox_wa WHERE MONTH(outbox_wa.tgl_create) = '.$bulan.'
        AND YEAR(outbox_wa.tgl_create) = '.$tahun.'
');
	}

    function get_rekap($bulan,$tahun){
		return $this->db->query('SELECT nama_layanan, COUNT(nama_layanan) as jumlah_semua_layanan FROM permohonan
LEFT JOIN layanan ON layanan.id_layanan = permohonan.id_layanan
WHERE 
MONTH(tgl_pengajuan) = '.$bulan.'
AND YEAR(tgl_pengajuan) = '.$tahun.'
AND permohonan.status = 8
GROUP BY nama_layanan');
	}
 
    function rekap_layanan_last($bulan, $tahun) {
        $bulan_lalu = $bulan-1;
        return $this->db->query("SELECT 
    COALESCE(bulan_ini.nama_layanan, bulan_lalu.nama_layanan) AS nama_layanan,
    IFNULL(bulan_lalu.jumlah, 0) AS jumlah_bulan_lalu,
    IFNULL(bulan_ini.jumlah, 0) AS jumlah_bulan_ini,
    (IFNULL(bulan_ini.jumlah, 0) - IFNULL(bulan_lalu.jumlah, 0)) AS selisih,
    CASE
        WHEN (IFNULL(bulan_ini.jumlah, 0) - IFNULL(bulan_lalu.jumlah, 0)) > 0 THEN 'Meningkat'
        WHEN (IFNULL(bulan_ini.jumlah, 0) - IFNULL(bulan_lalu.jumlah, 0)) < 0 THEN 'Menurun'
        ELSE 'Tetap'
    END AS status_perubahan
FROM
    
    (
        SELECT 
            layanan.nama_layanan,
            COUNT(*) AS jumlah
        FROM permohonan
        LEFT JOIN layanan ON layanan.id_layanan = permohonan.id_layanan
        WHERE 
            MONTH(tgl_pengajuan) = ".$bulan."
            AND YEAR(tgl_pengajuan) = ".$tahun."
            AND permohonan.status = 8
        GROUP BY layanan.nama_layanan
    ) AS bulan_ini


LEFT JOIN 
    (
        SELECT 
            layanan.nama_layanan,
            COUNT(*) AS jumlah
        FROM permohonan
        LEFT JOIN layanan ON layanan.id_layanan = permohonan.id_layanan
        WHERE 
            MONTH(tgl_pengajuan) = ".$bulan_lalu."
            AND YEAR(tgl_pengajuan) = ".$tahun."
            AND permohonan.status = 8
        GROUP BY layanan.nama_layanan
    ) AS bulan_lalu
ON bulan_ini.nama_layanan = bulan_lalu.nama_layanan


UNION

SELECT 
    COALESCE(bulan_ini.nama_layanan, bulan_lalu.nama_layanan) AS nama_layanan,
    IFNULL(bulan_lalu.jumlah, 0) AS jumlah_bulan_lalu,
    IFNULL(bulan_ini.jumlah, 0) AS jumlah_bulan_ini,
    (IFNULL(bulan_ini.jumlah, 0) - IFNULL(bulan_lalu.jumlah, 0)) AS selisih,
    CASE
        WHEN (IFNULL(bulan_ini.jumlah, 0) - IFNULL(bulan_lalu.jumlah, 0)) > 0 THEN 'Meningkat'
        WHEN (IFNULL(bulan_ini.jumlah, 0) - IFNULL(bulan_lalu.jumlah, 0)) < 0 THEN 'Menurun'
        ELSE 'Tetap'
    END AS status_perubahan
FROM
    (
        SELECT 
            layanan.nama_layanan,
            COUNT(*) AS jumlah
        FROM permohonan
        LEFT JOIN layanan ON layanan.id_layanan = permohonan.id_layanan
        WHERE 
            MONTH(tgl_pengajuan) = ".$bulan."
            AND YEAR(tgl_pengajuan) = ".$tahun."
            AND permohonan.status = 8
        GROUP BY layanan.nama_layanan
    ) AS bulan_ini
RIGHT JOIN 
    (
        SELECT 
            layanan.nama_layanan,
            COUNT(*) AS jumlah
        FROM permohonan
        LEFT JOIN layanan ON layanan.id_layanan = permohonan.id_layanan
        WHERE 
            MONTH(tgl_pengajuan) = ".$bulan_lalu."
            AND YEAR(tgl_pengajuan) = ".$tahun."
            AND permohonan.status = 8
        GROUP BY layanan.nama_layanan
    ) AS bulan_lalu
ON bulan_ini.nama_layanan = bulan_lalu.nama_layanan;
");
    }


    function prediksi($bulan,$tahun){
          $bulan_lalu = $bulan-1;

   return     $this->db->query("SELECT COALESCE(bulan_ini.nama_layanan, bulan_lalu.nama_layanan) AS nama_layanan,
    IFNULL(bulan_lalu.jumlah, 0) AS jumlah_bulan_lalu, IFNULL(bulan_ini.jumlah, 0) AS jumlah_bulan_ini,
    (IFNULL(bulan_ini.jumlah, 0) - IFNULL(bulan_lalu.jumlah, 0)) AS selisih,
    CASE
        WHEN (IFNULL(bulan_ini.jumlah, 0) - IFNULL(bulan_lalu.jumlah, 0)) > 0 THEN 'Meningkat'
        WHEN (IFNULL(bulan_ini.jumlah, 0) - IFNULL(bulan_lalu.jumlah, 0)) < 0 THEN 'Menurun'
        ELSE 'Tetap'
    END AS status_perubahan,
    ROUND(
        IFNULL(bulan_ini.jumlah, 0) * 
        (1 + 
            CASE 
                WHEN IFNULL(bulan_lalu.jumlah, 0) = 0 THEN 0 
                ELSE (IFNULL(bulan_ini.jumlah, 0) - IFNULL(bulan_lalu.jumlah, 0)) / IFNULL(bulan_lalu.jumlah, 1)
            END
        )
    ) AS prediksi_bulan_depan
FROM
    (
        SELECT 
            layanan.nama_layanan,
            COUNT(*) AS jumlah
        FROM permohonan
        LEFT JOIN layanan ON layanan.id_layanan = permohonan.id_layanan
        WHERE 
            MONTH(tgl_pengajuan) = ".$bulan."
            AND YEAR(tgl_pengajuan) = ".$tahun."
            AND permohonan.status = 8
        GROUP BY layanan.nama_layanan
    ) AS bulan_ini
LEFT JOIN 
    (
        SELECT 
            layanan.nama_layanan,
            COUNT(*) AS jumlah
        FROM permohonan
        LEFT JOIN layanan ON layanan.id_layanan = permohonan.id_layanan
        WHERE 
            MONTH(tgl_pengajuan) = ".$bulan_lalu."
            AND YEAR(tgl_pengajuan) = ".$tahun."
            AND permohonan.status = 8
        GROUP BY layanan.nama_layanan
    ) AS bulan_lalu
ON bulan_ini.nama_layanan = bulan_lalu.nama_layanan

UNION

SELECT 
    COALESCE(bulan_ini.nama_layanan, bulan_lalu.nama_layanan) AS nama_layanan,
    IFNULL(bulan_lalu.jumlah, 0) AS jumlah_bulan_lalu,
    IFNULL(bulan_ini.jumlah, 0) AS jumlah_bulan_ini,
    (IFNULL(bulan_ini.jumlah, 0) - IFNULL(bulan_lalu.jumlah, 0)) AS selisih,
    CASE
        WHEN (IFNULL(bulan_ini.jumlah, 0) - IFNULL(bulan_lalu.jumlah, 0)) > 0 THEN 'Meningkat'
        WHEN (IFNULL(bulan_ini.jumlah, 0) - IFNULL(bulan_lalu.jumlah, 0)) < 0 THEN 'Menurun'
        ELSE 'Tetap'
    END AS status_perubahan,
    ROUND(
        IFNULL(bulan_ini.jumlah, 0) * 
        (1 + 
            CASE 
                WHEN IFNULL(bulan_lalu.jumlah, 0) = 0 THEN 0 
                ELSE (IFNULL(bulan_ini.jumlah, 0) - IFNULL(bulan_lalu.jumlah, 0)) / IFNULL(bulan_lalu.jumlah, 1)
            END
        )
    ) AS prediksi_bulan_depan
FROM
    (
        SELECT 
            layanan.nama_layanan,
            COUNT(*) AS jumlah
        FROM permohonan
        LEFT JOIN layanan ON layanan.id_layanan = permohonan.id_layanan
        WHERE 
            MONTH(tgl_pengajuan) = ".$bulan."
            AND YEAR(tgl_pengajuan) = ".$tahun."
            AND permohonan.status = 8
        GROUP BY layanan.nama_layanan
    ) AS bulan_ini
RIGHT JOIN 
    (
        SELECT 
            layanan.nama_layanan,
            COUNT(*) AS jumlah
        FROM permohonan
        LEFT JOIN layanan ON layanan.id_layanan = permohonan.id_layanan
        WHERE 
            MONTH(tgl_pengajuan) = ".$bulan_lalu."
            AND YEAR(tgl_pengajuan) = ".$tahun."
            AND permohonan.status = 8
        GROUP BY layanan.nama_layanan
    ) AS bulan_lalu
ON bulan_ini.nama_layanan = bulan_lalu.nama_layanan LIMIT 4");
        
    }

    function rata2_kwitansi($bulan,$tahun) {
        return $this->db->query("SELECT 
    COUNT(*) AS jumlah_pelayanan,
    SEC_TO_TIME(AVG(TIMESTAMPDIFF(SECOND, waktu_diterima, waktu_selesai))) AS rata_rata_pelayanan
FROM 
    kwitansi
WHERE 
    MONTH(tanggal_permohonan) = ".$bulan."
    AND YEAR(tanggal_permohonan) = ".$tahun."
    AND waktu_selesai IS NOT NULL;");
    }



    function prediksi_full($bulan,$tahun){
        $bulan_lalu = $bulan-1;

 return     $this->db->query("SELECT COALESCE(bulan_ini.nama_layanan, bulan_lalu.nama_layanan) AS nama_layanan,
  IFNULL(bulan_lalu.jumlah, 0) AS jumlah_bulan_lalu, IFNULL(bulan_ini.jumlah, 0) AS jumlah_bulan_ini,
  (IFNULL(bulan_ini.jumlah, 0) - IFNULL(bulan_lalu.jumlah, 0)) AS selisih,
  CASE
      WHEN (IFNULL(bulan_ini.jumlah, 0) - IFNULL(bulan_lalu.jumlah, 0)) > 0 THEN 'Meningkat'
      WHEN (IFNULL(bulan_ini.jumlah, 0) - IFNULL(bulan_lalu.jumlah, 0)) < 0 THEN 'Menurun'
      ELSE 'Tetap'
  END AS status_perubahan,
  ROUND(
      IFNULL(bulan_ini.jumlah, 0) * 
      (1 + 
          CASE 
              WHEN IFNULL(bulan_lalu.jumlah, 0) = 0 THEN 0 
              ELSE (IFNULL(bulan_ini.jumlah, 0) - IFNULL(bulan_lalu.jumlah, 0)) / IFNULL(bulan_lalu.jumlah, 1)
          END
      )
  ) AS prediksi_bulan_depan
FROM
  (
      SELECT 
          layanan.nama_layanan,
          COUNT(*) AS jumlah
      FROM permohonan
      LEFT JOIN layanan ON layanan.id_layanan = permohonan.id_layanan
      WHERE 
          MONTH(tgl_pengajuan) = ".$bulan."
          AND YEAR(tgl_pengajuan) = ".$tahun."
          AND permohonan.status = 8
      GROUP BY layanan.nama_layanan
  ) AS bulan_ini
LEFT JOIN 
  (
      SELECT 
          layanan.nama_layanan,
          COUNT(*) AS jumlah
      FROM permohonan
      LEFT JOIN layanan ON layanan.id_layanan = permohonan.id_layanan
      WHERE 
          MONTH(tgl_pengajuan) = ".$bulan_lalu."
          AND YEAR(tgl_pengajuan) = ".$tahun."
          AND permohonan.status = 8
      GROUP BY layanan.nama_layanan
  ) AS bulan_lalu
ON bulan_ini.nama_layanan = bulan_lalu.nama_layanan

UNION

SELECT 
  COALESCE(bulan_ini.nama_layanan, bulan_lalu.nama_layanan) AS nama_layanan,
  IFNULL(bulan_lalu.jumlah, 0) AS jumlah_bulan_lalu,
  IFNULL(bulan_ini.jumlah, 0) AS jumlah_bulan_ini,
  (IFNULL(bulan_ini.jumlah, 0) - IFNULL(bulan_lalu.jumlah, 0)) AS selisih,
  CASE
      WHEN (IFNULL(bulan_ini.jumlah, 0) - IFNULL(bulan_lalu.jumlah, 0)) > 0 THEN 'Meningkat'
      WHEN (IFNULL(bulan_ini.jumlah, 0) - IFNULL(bulan_lalu.jumlah, 0)) < 0 THEN 'Menurun'
      ELSE 'Tetap'
  END AS status_perubahan,
  ROUND(
      IFNULL(bulan_ini.jumlah, 0) * 
      (1 + 
          CASE 
              WHEN IFNULL(bulan_lalu.jumlah, 0) = 0 THEN 0 
              ELSE (IFNULL(bulan_ini.jumlah, 0) - IFNULL(bulan_lalu.jumlah, 0)) / IFNULL(bulan_lalu.jumlah, 1)
          END
      )
  ) AS prediksi_bulan_depan
FROM
  (
      SELECT 
          layanan.nama_layanan,
          COUNT(*) AS jumlah
      FROM permohonan
      LEFT JOIN layanan ON layanan.id_layanan = permohonan.id_layanan
      WHERE 
          MONTH(tgl_pengajuan) = ".$bulan."
          AND YEAR(tgl_pengajuan) = ".$tahun."
          AND permohonan.status = 8
      GROUP BY layanan.nama_layanan
  ) AS bulan_ini
RIGHT JOIN 
  (
      SELECT 
          layanan.nama_layanan,
          COUNT(*) AS jumlah
      FROM permohonan
      LEFT JOIN layanan ON layanan.id_layanan = permohonan.id_layanan
      WHERE 
          MONTH(tgl_pengajuan) = ".$bulan_lalu."
          AND YEAR(tgl_pengajuan) = ".$tahun."
          AND permohonan.status = 8
      GROUP BY layanan.nama_layanan
  ) AS bulan_lalu
ON bulan_ini.nama_layanan = bulan_lalu.nama_layanan");
      
  }
	
}