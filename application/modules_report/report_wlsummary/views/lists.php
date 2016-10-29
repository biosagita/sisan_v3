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

<script type="text/javascript">
    $(document).ready(function() {
        $( "#datacontent_filter" ).load('<?php echo $ajax_lists_filter; ?>', function(){
            console.log('hai');
        });

        $('#btn_preview').click(function(e) {
            e.preventDefault();
            var param = {
                'url_ajax_action'   : '<?php echo $ajax_lists_filter; ?>',
                'parameter'         : $('#form_datacontent_filter').serialize(),
                'data_type'         : 'html',
                'callback'          : function(data) {
                    $('#datacontent_filter').empty().append(data);
                }
            };
            MYAPP.doAjax.process(param.url_ajax_action, param.parameter, param.callback, param.data_type);
        });

        $('#type_summary').change(function(){
            var me      = $(this);
            var type_id = me.val();
            $('.grouphidden').hide();
            if(type_id == 'all_summary') return;
            $('#'+type_id).show().val('');
        });
    });
</script>

<div id="page-title">
    <h2><?php echo $info_page['title']; ?></h2>
    <p><?php echo $info_page['desc']; ?></p>
</div>

<div class="panel" id="panel_list">
    <div class="panel-body">
        <form method="post" class="form-horizontal bordered-row" id="form_datacontent_filter">
            <div class="row">
                <div class="col-sm-10">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tipe Summary</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="type_summary" id="type_summary">
                                <option value="all_summary">-- All Summary --</option>
                                <option value="summary_layanan">Summary By Layanan</option>
                                <option value="summary_loket">Summary By Loket</option>
                                <option value="summary_user">Summary By User</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group grouphidden" id="summary_layanan" style="display:none;">
                        <label class="col-sm-3 control-label">Layanan</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="trans_id_layanan" id="trans_id_layanan">
                                <option value="">-- All Layanan --</option>
                                <?php foreach($option_layanan as $vOpt) : ?>
                                    <option value="<?php echo $vOpt['value']; ?>"><?php echo $vOpt['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group grouphidden" id="summary_loket" style="display:none;">
                        <label class="col-sm-3 control-label">Loket</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="trans_id_loket" id="trans_id_loket">
                                <option value="">-- All Loket --</option>
                                <?php foreach($option_loket as $vOpt) : ?>
                                    <option value="<?php echo $vOpt['value']; ?>"><?php echo $vOpt['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group grouphidden" id="summary_user" style="display:none;">
                        <label class="col-sm-3 control-label">User</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="trans_id_user" id="trans_id_user">
                                <option value="">-- All User --</option>
                                <?php foreach($option_user as $vOpt) : ?>
                                    <option value="<?php echo $vOpt['value']; ?>"><?php echo $vOpt['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tanggal</label>
                        <div class="col-sm-9">
                            <input type="text" name="trans_tanggal_transaksi" id="daterangepicker-example" class="form-control" value="">
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div style="width:100%;height:80px;">
                        <button style="width:100%;height:100%;font-size:26px;" class="btn btn-success" id="btn_preview">Preview</button>
                    </div>
                </div>
            </div>
        </form>

        <div id="datacontent_filter" class="example-box-wrapper"></div>
    </div>
</div>