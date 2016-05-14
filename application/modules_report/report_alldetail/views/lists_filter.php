<!-- Data tables -->
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/datatable/datatable.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/datatable/datatable-bootstrap.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/datatable/datatable-tabletools.js"></script>
<script type="text/javascript">
    myowndatatable = '';
    $(document).ready(function() {
        myowndatatable = $('#datatable-example').dataTable({
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
    <div class="example-box-wrapper">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="datatable-example">
        <thead>
        <tr>
            <?php foreach($column_list as $val) : ?>
                <th><?php echo $val['title_header_column']; ?></th>
            <?php endforeach; ?>
        </tr>
        </thead>
        </table>
    </div>
    <div class="row">
        <div class="form-group">
            <div class="col-sm-6 col-md-offset-6 text-right">
                <a target="_blank" href="<?php echo site_url('report_alldetail/alldetail/page_export_text'); ?>" class="btn btn-blue-alt">Print Text</a>
                <a href="<?php echo site_url('report_alldetail/alldetail/page_export_excel'); ?>" class="btn btn-blue-alt">Excel</a>
            </div>
        </div>
    </div>
</div>