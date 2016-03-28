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
        <th width=20% > Nama Layanan 
        <th width=20% > Tanggal Transaksi
        <th width=20% > No Tiket

<?php 
$no=1;
foreach($data_master as $data_master_result):
    print"<tr>
            <td align=center width=5% >$no
            <td align=center  >".$data_master_result['lokets_name']."
            <td align=center  >".$data_master_result['lay_nama_layanan']."
            <td align=center >".$data_master_result['own_tanggal']."
            <td align=center >".$data_master_result['no_ticket']."
            ";
$no++;
endforeach;
?>