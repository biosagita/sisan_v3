<script type="text/javascript" src="<?php echo $assets; ?>/widgets/modal/modal.js"></script>

<script type="text/javascript" src="<?php echo $assets; ?>/widgets/jgrowl-notifications/jgrowl.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/jgrowl-notifications/jgrowl-demo.js"></script>

<!-- Data tables -->
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/datatable/datatable.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/datatable/datatable-bootstrap.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/datatable/datatable-tabletools.js"></script>

<!-- Bootstrap Daterangepicker -->
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/daterangepicker/moment.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/daterangepicker/daterangepicker-demo.js"></script>

<!-- Chart.js -->

<script type="text/javascript" src="<?php echo $assets; ?>/widgets/charts/chart-js/chart-core.js"></script>

<script type="text/javascript" src="<?php echo $assets; ?>/widgets/charts/chart-js/chart-bar.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/charts/chart-js/chart-doughnut.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/charts/chart-js/chart-line.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/charts/chart-js/chart-polar.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/charts/chart-js/chart-radar.js"></script>

<!-- Data tables -->
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/datatable/datatable.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/datatable/datatable-bootstrap.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/datatable/datatable-tabletools.js"></script>

<script type="text/javascript">
    $(function(){
        var result = [<?php echo implode(',', $result['list_x']); ?>];
        var datasets = [
        {
                fillColor : "<?php echo $result['listwarna'][0][0]; ?>",
                strokeColor : "<?php echo $result['listwarna'][0][1]; ?>",
                highlightFill : "<?php echo $result['listwarna'][0][2]; ?>",
                highlightStroke : "<?php echo $result['listwarna'][0][3]; ?>",
                data : [<?php echo implode(',', $result['list_y']); ?>]
            }
        ];

        var barChartData = {
            labels : result,
            datasets : datasets
        }

        var ctx = document.getElementById("canvas-1").getContext("2d");
        window.myBar = new Chart(ctx).Bar(barChartData, {
            //responsive : true
        });

    });
</script>

<script type="text/javascript">
    myowndatatable = '';
    $(document).ready(function() {
        myowndatatable = $('#datatable-wtc').dataTable({
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

<div class="panel-body">
    <div class="row">
        <div class="col-sm-5">
            <canvas id="canvas-1" height="300" width="400"></canvas>
        </div>
        <div class="col-sm-1"></div>
        <div class="col-sm-6">
            <div class="example-box-wrapper">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="datatable-wtc">
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
    </div>
    <div class="row">
        <div class="form-group">
            <div class="col-sm-6 col-md-offset-6 text-right">
                <a target="_blank" href="<?php echo site_url('report_wtcsummary/wtcsummary/page_export_text'); ?>" class="btn btn-blue-alt">Print Text</a>
                <a href="<?php echo site_url('report_wtcsummary/wtcsummary/page_export_excel'); ?>" class="btn btn-blue-alt">Excel</a>
            </div>
        </div>
    </div>
</div>