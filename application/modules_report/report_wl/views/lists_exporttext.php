<table width=100%>
    <tr><td><b><?php echo $data_company['f_comp_name']; ?></b> 
    <tr><td>

    <tr><th><font style="font-size: 20px;">Data Laporan Waktu Layanan (WL)</font><BR> 
</table>
<p></p>
<table width=100%>
    <tr><td width=10%>Tanggal Cetak:<td> : <?php echo date('d-m-Y'); ?>      
</table>
<table width=100% border=1 cellpadding=3 cellspacing=0 >
    <tr>
        <th width=5%  > NO
        <th width=20% > Tanggal Transaksi
        <th width=20% > No Ticket 
        <th width=20% > Wkt Panggil
        <th width=20% > Wkt Layanan
        <th width=15% > Wkt Selesai

<?php 
$no=1;
foreach($data_master as $data_master_result):
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
            <td align=center  >".$data_master_result['own_tanggal']."
            <td align=center  >".$data_master_result['no_ticket']."
            <td align=center >".$data_master_result['trans_waktu_panggil']."
            <td align=center >".$data_master_result['waktu_layanan']."
            <td align=center >".$data_master_result['trans_waktu_finish']."
            ";
$no++;
endforeach;
?>