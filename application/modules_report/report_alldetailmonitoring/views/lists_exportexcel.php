<table width=100%>
    <tr><td><b><?php echo $data_company['f_comp_name']; ?></b> 
    <tr><td>

    <tr><th><font size=12px>Data Laporan All Detail Monitoring</font><BR>
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
        <th width=20% > No Antrian
        <th width=20% > Status
        <th width=20% > Loket
        <th width=20% > User Process
        <th width=20% > User Request
        <th width=20% > ID Tipe
        <th width=20% > ID Perihal
        <th width=20% > Jenis Antrian
        <th width=20% > Request Date
        <th width=20% > Periode
        <th width=20% > Updated Date
        <th width=20% > Ref ID
        <th width=20% > ID Reg
        <th width=20% > Jenis Kelamin
        <th width=20% > No Telp
        <th width=20% > Email
        <th width=20% > Domain Email
        <th width=20% > Alamat
        <th width=20% > Alamat Sekolah
        <th width=20% > ID Wilayah Sekolah
        <th width=20% > Bentuk Pendidikan
        <th width=20% > ID Pekerjaan
        <th width=20% > Pekerjaan Lainnya
        <th width=20% > ID Tipe
        <th width=20% > Status
        <th width=20% > Foto
        <th width=20% > Pendidikan Terakhir

<?php 
$no=1;
foreach($data_master as $data_master_result):
    if(!empty($data_master_result['trans_tipe_antrian'])) {
        if($data_master_result['trans_tipe_antrian'] == 1) $data_master_result['trans_tipe_antrian'] = 'ONLINE';
        if($data_master_result['trans_tipe_antrian'] == 2) $data_master_result['trans_tipe_antrian'] = 'OFFLINE';
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
            <td align=center >".$data_master_result['trans_nama']."
            <td align=center >".$data_master_result['trans_nama_sekolah']."
            <td align=center >".$data_master_result['trans_nuptk']."
            <td align=center >".$data_master_result['trans_permasalahan']."
            <td align=center >".$data_master_result['trans_tanggapan']."
            <td align=center >".$data_master_result['Propinsi']."
            <td align=center >".$data_master_result['kabupaten']."
            <td align=center >".$data_master_result['kecamatan']."
            <td align=center >".$data_master_result['kelurahan']."
            <td align=center >".$data_master_result['ol_no_antrian']."
            <td align=center >".$data_master_result['ol_status']."
            <td align=center >".$data_master_result['ol_loket']."
            <td align=center >".$data_master_result['ol_user_process']."
            <td align=center >".$data_master_result['ol_user_request']."
            <td align=center >".$data_master_result['ol_id_tipe']."
            <td align=center >".$data_master_result['ol_id_perihal']."
            <td align=center >".$data_master_result['ol_jenis_antrian']."
            <td align=center >".$data_master_result['ol_request_date']."
            <td align=center >".$data_master_result['ol_periode']."
            <td align=center >".$data_master_result['ol_updated_date']."
            <td align=center >".$data_master_result['ol_ref_id']."
            <td align=center >".$data_master_result['ol_id_reg']."
            <td align=center >".$data_master_result['ol_jenis_kelamin']."
            <td align=center >".$data_master_result['no_telp']."
            <td align=center >".$data_master_result['email']."
            <td align=center >".$data_master_result['domain_email']."
            <td align=center >".$data_master_result['alamat']."
            <td align=center >".$data_master_result['alamat_sekolah']."
            <td align=center >".$data_master_result['id_wilayah_sekolah']."
            <td align=center >".$data_master_result['bentuk_pendidikan']."
            <td align=center >".$data_master_result['id_pekerjaan']."
            <td align=center >".$data_master_result['pekerjaan_lainnya']."
            <td align=center >".$data_master_result['id_tipe']."
            <td align=center >".$data_master_result['status']."
            <td align=center >".$data_master_result['foto']."
            <td align=center >".$data_master_result['pendidikan_terakhir']."
            ";
$no++;
endforeach;
?>