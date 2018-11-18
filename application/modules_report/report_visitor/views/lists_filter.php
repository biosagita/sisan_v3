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
                        'id_tipe'          : '<?php echo $id_tipe; ?>',
                        'jenis_antrian'            : '<?php echo $jenis_antrian; ?>',
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

        $('#print_text').click(function(e){
            e.preventDefault();

            var href = $(this).attr('href') + '/?df=1';

            var periode = $('#daterangepicker-example').val();

            if(periode != '') {
                periode = periode.replace(' - ', '_');
                href += '&periode='+periode;
            }

            var id_tipe = $('#id_tipe').val();
            if(id_tipe != '') {
                href += '&id_tipe='+id_tipe;
            }

            var jenis_antrian = $('#jenis_antrian').val();
            if(jenis_antrian != '') {
                href += '&jenis_antrian='+jenis_antrian;
            }

            window.open(href,'_blank');
        });

        $('#print_excel').click(function(e){
            e.preventDefault();

            var href = $(this).attr('href') + '/?df=1';

            var periode = $('#daterangepicker-example').val();

            if(periode != '') {
                periode = periode.replace(' - ', '_');
                href += '&periode='+periode;
            }

            var id_tipe = $('#id_tipe').val();
            if(id_tipe != '') {
                href += '&id_tipe='+id_tipe;
            }

            var jenis_antrian = $('#jenis_antrian').val();
            if(jenis_antrian != '') {
                href += '&jenis_antrian='+jenis_antrian;
            }

            window.open(href,'_blank');
        });
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
                <a target="_blank" href="<?php echo site_url('report_visitor/visitor/page_export_text'); ?>" class="btn btn-blue-alt" id="print_text">Print Text</a>
                <a href="<?php echo site_url('report_visitor/visitor/page_export_excel'); ?>" class="btn btn-blue-alt" id="print_excel">Excel</a>
            </div>
        </div>
    </div>
</div>