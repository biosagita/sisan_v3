<script type="text/javascript">
    $(function(){
       var result_layanan = [<?php echo implode(',', $result['list_x']); ?>];
        var datasets_layanan = [
        {
                fillColor : "<?php echo $result['listwarna'][0][0]; ?>",
                strokeColor : "<?php echo $result['listwarna'][0][1]; ?>",
                highlightFill : "<?php echo $result['listwarna'][0][2]; ?>",
                highlightStroke : "<?php echo $result['listwarna'][0][3]; ?>",
                data : [<?php echo implode(',', $result['list_y']); ?>]
            }
        ];

        var barChartData_waktu_layanan = {
            labels : result_layanan,
            datasets : datasets_layanan
        }

        var ctx_2 = document.getElementById("canvas-2").getContext("2d");
        myBar_2 = new Chart(ctx_2).Bar(barChartData_waktu_layanan, {
            //responsive : true
        });

    });
</script>

<script type="text/javascript">
    myowndatatable = '';
    $(document).ready(function() {
        myowndatatable = $('#datatable-wl').dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": '<?php echo $ajax_lists; ?>',
                "data": function ( d ) {
                    d.extraFilterData = {
                        'trans_id_layanan'          : '<?php echo $trans_id_layanan; ?>',
                        'trans_id_loket'            : '<?php echo $trans_id_loket; ?>',
                        'trans_id_user'             : '<?php echo $trans_id_user; ?>',
                        'trans_tanggal_transaksi'   : '<?php echo $trans_tanggal_transaksi; ?>'
                    };
                    d.groupData = '<?php echo $group_data; ?>';
                }
            },
            "columnDefs": [ 
                {
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                }
            ],
            "order": [[ 1, 'asc' ]]
        });
    });

    $(document).ready(function() {
        $('.dataTables_filter input').attr("placeholder", "Search...");
    });
</script>

<div class="col-sm-5">
    <canvas id="canvas-2" height="300" width="400"></canvas>
</div>
<div class="col-sm-1"></div>
<div class="col-sm-6">
    <div class="example-box-wrapper">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="datatable-wl">
        <thead>
        <tr>
            <?php foreach($column_list as $val) : ?>
                <th><?php echo $val['title_header_column']; ?></th>
            <?php endforeach; ?>
        </tr>
        </thead>
        </table>
    </div>
</div>