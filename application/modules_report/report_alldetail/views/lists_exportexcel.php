<table width=100%>
    <tr><td><b><?php echo $data_company['f_comp_name']; ?></b> 
    <tr><td>

    <tr><th><font size=12px>Data Laporan All Detail</font><BR> 
</table>
<p></p>
<table width=100%>
    <tr><td width=10%>Tanggal Cetak:<td> : <?php echo date('d-m-Y'); ?>      
</table>
<table width=100% border=1 cellpadding=3 cellspacing=0 >
    <tr>
        <th width=5%  > NO
        <th width=20% > Nama Loket
        <th width=20% > Tanggal Transaksi
        <th width=20% > No Ticket
        <th width=20% > Waktu Ambil
        <th width=20% > Waktu Tunggu
        <th width=20% > Waktu Panggil
        <th width=20% > Waktu Layanan
        <th width=20% > Selesai
        <th width=20% > Nama Layanan
        <th width=20% > User
        <th width=20% > Tipe Antrian
        <th width=20% > Nama
        <th width=20% > Nama Sekolah
        <th width=20% > NUPTK
        <th width=20% > Permasalahan
        <th width=20% > Tanggapan
        <th width=20% > Propinsi
        <th width=20% > Kabupaten
        <th width=20% > Kecamatan
        <th width=20% > Kelurahan

<?php 
$no=1;
foreach($data_master as $data_master_result):
    if(!empty($data_master_result['trans_tipe_antrian'])) {
        if($data_master_result['trans_tipe_antrian'] == 1) {
            $data_master_result['trans_tipe_antrian'] = 'ONLINE';
            // $data_master_result['jenis_kelamin'] = $data_master_result['ol_jenis_kelamin'];
        }
        if($data_master_result['trans_tipe_antrian'] == 2) {
            $data_master_result['trans_tipe_antrian'] = 'OFFLINE';
        }
    }
    
    if(!empty($data_master_result['trans_waktu_panggil']) AND $data_master_result['trans_waktu_ambil'] != '00:00:00' AND $data_master_result['trans_waktu_panggil'] != '00:00:00') {
        $time1 = strtotime($data_master_result['trans_waktu_ambil']);
        $time2 = strtotime($data_master_result['trans_waktu_panggil']);
        $diff = $time2 - $time1;
        $waktu_tunggu = date('H:i:s', $diff);
        $tmp = explode(':', $waktu_tunggu);
        $tmp2 = ((int) $tmp[0]) - 7;
        $tmp[0] = '0' . $tmp2;
        $data_master_result['waktu_tunggu'] = join(':', $tmp);
    }
    if(!empty($data_master_result['trans_waktu_finish']) AND $data_master_result['trans_waktu_panggil'] != '00:00:00' AND $data_master_result['trans_waktu_finish'] != '00:00:00') {
        $time1 = strtotime($data_master_result['trans_waktu_panggil']);
        $time2 = strtotime($data_master_result['trans_waktu_finish']);
        $diff = $time2 - $time1;
        $waktu_layanan = date('H:i:s', $diff);
        $tmp = explode(':', $waktu_layanan);
        $tmp2 = ((int) $tmp[0]) - 7;
        $tmp[0] = '0' . $tmp2;
        $data_master_result['waktu_layanan'] = join(':', $tmp);
    }
    print"<tr>
            <td align=center width=5% >$no
            <td align=center  >".$data_master_result['lokets_name']."
            <td align=center  >".$data_master_result['own_tanggal']."
            <td align=center >".$data_master_result['no_ticket']."
            <td align=center >".$data_master_result['trans_waktu_ambil']."
            <td align=center >".$data_master_result['waktu_tunggu']."
            <td align=center >".$data_master_result['trans_waktu_panggil']."
            <td align=center >".$data_master_result['waktu_layanan']."
            <td align=center >".$data_master_result['trans_waktu_finish']."
            <td align=center >".$data_master_result['lay_nama_layanan']."
            <td align=center >".$data_master_result['admusr_username']."
            <td align=center >".$data_master_result['trans_tipe_antrian']."
            <td align=center >".$data_master_result['nama']."
            <td align=center >".$data_master_result['nama_sekolah']."
            <td align=center >".$data_master_result['nuptk']."
            <td align=center >".$data_master_result['trans_permasalahan']."
            <td align=center >".$data_master_result['trans_tanggapan']."
            <td align=center >".$data_master_result['Propinsi']."
            <td align=center >".$data_master_result['kabupaten']."
            <td align=center >".$data_master_result['kecamatan']."
            <td align=center >".$data_master_result['kelurahan']."
            ";
$no++;
endforeach;
?>