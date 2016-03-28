<table width=100%>
    <tr><td><b><?php echo $data_company['f_comp_name']; ?></b> 
    <tr><td>

    <tr><th><font size=12px>Data Laporan Jumlah Customer Layanan</font><BR> 
</table>
<p></p>
<table width=100%>
    <tr><td width=10%>Tanggal Cetak:<td> : <?php echo date('d-m-Y'); ?>      
</table>
<table width=100% border=1 cellpadding=3 cellspacing=0 >
    <tr>
        <th width=5%  > NO
        <th width=20% > Tanggal Transaksi
        <th width=15% > Terlayani
        <th width=15% > Sedang Dilayani
        <th width=15% > Skip
        <th width=15% > Tidak Dilayani

<?php 
$no=1;
foreach($data_master as $data_master_result):
    $CI =& get_instance();
    $CI->load->database();
    $CI->load->model('transaksi_model', 'transaksix');
    
    $res = $this->transaksix->where(array('trans_tanggal_transaksi' => $data_master_result['trans_tanggal_transaksi']))->group_by('trans_tanggal_transaksi')->get_customer_terlayani();
    $data_master_result['customer_terlayani'] = !empty($res['jumlah']) ? $res['jumlah'] : 0;

    $res = $this->transaksix->where(array('trans_tanggal_transaksi' => $data_master_result['trans_tanggal_transaksi']))->group_by('trans_tanggal_transaksi')->get_customer_sedangdilayani();
    $data_master_result['customer_sedangdilayani'] = !empty($res['jumlah']) ? $res['jumlah'] : 0;

    $res = $this->transaksix->where(array('trans_tanggal_transaksi' => $data_master_result['trans_tanggal_transaksi']))->group_by('trans_tanggal_transaksi')->get_customer_skip();
    $data_master_result['customer_skip'] = !empty($res['jumlah']) ? $res['jumlah'] : 0;

    $res = $this->transaksix->where(array('trans_tanggal_transaksi' => $data_master_result['trans_tanggal_transaksi']))->group_by('trans_tanggal_transaksi')->get_customer_tidakterlayani();
    $data_master_result['customer_tak_terlayani'] = !empty($res['jumlah']) ? $res['jumlah'] : 0;

    print"<tr>
            <td align=center width=5% >$no
            <td align=center  >".$data_master_result['own_tanggal']."
            <td align=center  >".$data_master_result['customer_terlayani']."
            <td align=center  >".$data_master_result['customer_sedangdilayani']."
            <td align=center  >".$data_master_result['customer_skip']."
            <td align=center  >".$data_master_result['customer_tak_terlayani']."
            ";
$no++;
endforeach;
?>