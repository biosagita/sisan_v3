<script type="text/javascript" src="<?php echo $assets; ?>/widgets/modal/modal.js"></script>

<script type="text/javascript" src="<?php echo $assets; ?>/widgets/jgrowl-notifications/jgrowl.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/jgrowl-notifications/jgrowl-demo.js"></script>

<!-- Data tables -->

<!--<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/datatable/datatable.css">-->
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/datatable/datatable.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/datatable/datatable-bootstrap.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/datatable/datatable-tabletools.js"></script>

<script type="text/javascript">

    function doFormEdit(rowid) {
        var param_list = {
            'formid'            : '#dynamic_form',
            'panel_form'        : '#panel_form',
            'url_ajax_action'   : '<?php echo $ajax_form_edit; ?>',
            'parameter'         : {'data_id' : rowid},
            'data_type'         : 'html',
            'callback'          : function(data) {
                $(param_list.panel_form).append(data);
                $(param_list.formid).find(':input:eq(1)').focus();
                autoScrolling(param_list.panel_form);
            }
        };
        $(param_list.panel_form).empty();
        MYAPP.doAjax.process(param_list.url_ajax_action, param_list.parameter, param_list.callback, param_list.data_type);
    }

    function showModalBoxDelete(rowid) {
        $('#hd_delete_id').text(rowid);
        //$('#hd_modalboxdelete').trigger('click');
        var cfm = confirm('delete this data?');
        if(!cfm) return false;
        doFormDelete();        
    }

    function doFormDelete() {
        var param = {
            'url_ajax_action'   : '<?php echo $ajax_action_delete; ?>',
            'parameter'         : {'data_id' : $('#hd_delete_id').text()},
            'data_type'         : 'json',
            'callback'          : function(data) {
                if(data.err_msg == '') {
                    $.jGrowl(data.success_msg, {
                        sticky: false,
                        position: 'top-right',
                        theme: 'bg-red'
                    });
                    refreshTable();
                } else {
                    $.jGrowl(data.err_msg, {
                        sticky: false,
                        position: 'top-right',
                        theme: 'bg-red'
                    });
                }
                $('#smallModal').modal('hide');
            }
        };
        MYAPP.doAjax.process(param.url_ajax_action, param.parameter, param.callback, param.data_type);
    }

    function autoScrolling(panel_id) {
        $('html, body').animate({
            scrollTop: $(panel_id).offset().top
        }, 700);
    }

    myowndatatable = '';
    $(document).ready(function() {
        myowndatatable = $('#datatable-example').dataTable({
        	"processing": true,
	        "serverSide": true,
	        "ajax": '<?php echo $ajax_lists; ?>',
            "columnDefs": [ 
                {
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                },
                {
                    "searchable": false,
                    "orderable": false,
                    "targets": <?php echo (count($column_list) - 1); ?>
                }
            ],
            "order": [[ 1, 'asc' ]]
        });
    });

    $(document).ready(function() {
        $('.dataTables_filter input').attr("placeholder", "Search...");
    });

    function refreshTable() {
        //$('#datatable-example_wrapper ul.pagination li:eq(1)>a').trigger('click');
        myowndatatable.fnClearTable(0);
        myowndatatable.fnDraw();
    }

    $(function() { "use strict";
        var param_list = {
            'formid'            : '#dynamic_form',
            'panel_form'        : '#panel_form',
            'add_data'          : '#add_data',
            'panel_list'        : '#panel_list',
        };

        $(param_list.add_data).click(function() {
            $(param_list.panel_form).empty();
            var param = {
                'url_ajax_action'   : '<?php echo $ajax_form_add; ?>',
                'parameter'         : {},
                'data_type'         : 'html',
                'callback'          : function(data) {
                    $(param_list.panel_form).append(data);
                    $(param_list.formid).find(':input:first').focus();
                    autoScrolling(param_list.panel_form);
                }
            };
            MYAPP.doAjax.process(param.url_ajax_action, param.parameter, param.callback, param.data_type);
        });

        /*
        $('#datatable-example_wrapper ul.pagination li>a').click(function() {
            autoScrolling(param_list.panel_list);
        })
        */
    });

</script>

<div id="page-title">
    <h2><?php echo $info_page['title']; ?></h2>
    <p><?php echo $info_page['desc']; ?></p>
</div>

<div class="panel" id="panel_list">
	<div class="panel-body">
        <div class="row">
            <div class="col-sm-6 col-md-offset-6 text-right">
                <button type="button" class="btn btn-info mrg20B" id="add_data">
                    Add Data &nbsp;
                    <i class="glyph-icon icon-plus-square"></i>
                </button>
            </div>
        </div>
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
	</div>
</div>

<div class="panel" id="panel_form"></div>

<!-- Below script for modal box -->

<div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModal" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Confirm</h4>
            </div>
            <div class="modal-body">
                Delete this data?
            </div>
            <div style="display:none;" id="hd_delete_id"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" onclick="doFormDelete();return false;">Yes</button>
            </div>
        </div>
    </div>
</div>

<a id="hd_modalboxdelete" style="display:none;" href="#" class="btn btn-lg btn-danger" data-toggle="modal" data-target="#smallModal">Click to open Modal</a>