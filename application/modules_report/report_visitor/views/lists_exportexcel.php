<table width=100%>
    <tr><td><b><?php echo $data_company['f_comp_name']; ?></b> 
    <tr><td>

    <tr><th><font size=12px>Data Laporan Visitor</font><BR> 
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
        <th width=20% > NUPTK
        <th width=20% > Tipe Antrian

<?php 
$no=1;
foreach($data_master as $data_master_result):
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

    if($data_master_result['trans_tipe_antrian'] == 1) $data_master_result['trans_tipe_antrian'] = 'Online';
    if($data_master_result['trans_tipe_antrian'] == 2) $data_master_result['trans_tipe_antrian'] = 'Offline';

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
            <td align=center >".$data_master_result['nuptk']."
            <td align=center >".$data_master_result['trans_tipe_antrian']."
            ";
$no++;
endforeach;
?>