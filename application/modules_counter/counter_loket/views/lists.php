<script type="text/javascript" src="<?php echo $assets; ?>/widgets/modal/modal.js"></script>

<script type="text/javascript" src="<?php echo $assets; ?>/widgets/jgrowl-notifications/jgrowl.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/jgrowl-notifications/jgrowl-demo.js"></script>

<!-- Data tables -->

<!--<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/datatable/datatable.css">-->
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/datatable/datatable.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/datatable/datatable-bootstrap.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/datatable/datatable-tabletools.js"></script>

<script type="text/javascript" src="<?php echo $assets_counter; ?>/js/timer.js"></script>

<script type="text/javascript">
    var timer;

    var timer_2;

    /*setInterval(function() {
       refreshTable();
       //refreshTableSkip();
       //refreshTableFinish();
   }, 10000);*/

    function intervalQueue() {
        return window.setInterval(function () {
            refreshTable();
        }, 10000);
    }

    function intervalSkip() {
        return window.setInterval(function () {
            refreshTableSkip();
        }, 10000);
    }

    function intervalFinish() {
        return window.setInterval(function () {
            refreshTableFinish();
        }, 10000);
    }

    var runningInterval = intervalQueue();

    function clearRunningInterval() {
        window.clearInterval(runningInterval);
    }

    function autoScrolling(panel_id) {
        $('html, body').animate({
            scrollTop: $(panel_id).offset().top
        }, 700);
    }

    myowndatatable = '';
    myowndatatable2 = '';
    myowndatatable3 = '';
    $(document).ready(function () {
        myowndatatable = $('#datatable-example').dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": '<?php echo $ajax_lists; ?>',
                error: function (jq, status, message) {
                    window.location.href = "<?php site_url('counter_logout/logout'); ?>";
                }
            },
            "columnDefs": [
                {
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                },
                {
                    "searchable": false,
                    "orderable": false,
                    "targets": 1
                },
                {
                    "searchable": false,
                    "orderable": false,
                    "targets": 2
                },
                {
                    "searchable": false,
                    "orderable": false,
                    "targets": 3
                },
                {
                    "searchable": false,
                    "orderable": false,
                    "targets": <?php echo(count($column_list) - 1); ?>
                }
            ]
        });

        myowndatatable2 = $('#datatable-example-2').dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": '<?php echo $ajax_lists_skip; ?>',
                error: function (jq, status, message) {
                    window.location.href = "<?php site_url('counter_logout/logout'); ?>";
                }
            },
            "columnDefs": [
                {
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                },
                {
                    "searchable": false,
                    "orderable": false,
                    "targets": 1
                },
                {
                    "searchable": false,
                    "orderable": false,
                    "targets": 2
                },
                {
                    "searchable": false,
                    "orderable": false,
                    "targets": 3
                },
                {
                    "searchable": false,
                    "orderable": false,
                    "targets": <?php echo(count($column_list_skip) - 1); ?>
                }
            ]
        });

        myowndatatable3 = $('#datatable-example-3').dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": '<?php echo $ajax_lists_finish; ?>',
                error: function (jq, status, message) {
                    window.location.href = "<?php site_url('counter_logout/logout'); ?>";
                }
            },
            "columnDefs": [
                {
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                },
                {
                    "searchable": false,
                    "orderable": false,
                    "targets": 1
                },
                {
                    "searchable": false,
                    "orderable": false,
                    "targets": 2
                },
                {
                    "searchable": false,
                    "orderable": false,
                    "targets": <?php echo(count($column_list_finish) - 1); ?>
                }
            ]
        });
    });

    $(document).ready(function () {
        $('.dataTables_filter input').attr("placeholder", "Search...");
    });

    function refreshTable() {
        myowndatatable.fnClearTable(0);
        myowndatatable.fnDraw();

        /*myowndatatable2.fnClearTable(0);
        myowndatatable2.fnDraw();

        myowndatatable3.fnClearTable(0);
        myowndatatable3.fnDraw();*/
    }

    function refreshTableSkip() {
        myowndatatable2.fnClearTable(0);
        myowndatatable2.fnDraw();
    }

    function refreshTableFinish() {
        myowndatatable3.fnClearTable(0);
        myowndatatable3.fnDraw();
    }

    function fnGotonext() {
        $('#hd_modalboxgotonext').trigger('click');
    }

    function fnFinish() {
        $.ajax({
            type: 'POST',
            url: '<?php echo $fnFinish; ?>',
            dataType: 'json',
            data: {},
            success: function (data) {
                load_image_transaksi();

                refreshTable();

                $('#tiket, #transaction, #start, #forward_layanan').text('');
                $('#tiket').text('-');

                timer_2.stop();
                timer_2.reset(0);
                timer_2.start(1000);

                timer.stop();
                timer.reset(0);

            }
        });
    }

    function fnForward(id_layanan, id_group_layanan) {
        $.ajax({
            type: 'POST',
            url: '<?php echo $fnForward; ?>',
            dataType: 'json',
            data: {'id_layanan': id_layanan, 'id_group_layanan': id_group_layanan},
            success: function (data) {
                refreshTable();

                $('#tiket, #transaction, #start, #forward_layanan').text('');
                $('#tiket').text('-');

                timer_2.stop();
                timer_2.reset(0);
                timer_2.start(1000);

                timer.stop();
                timer.reset(0);
            }
        });
    }

    function load_image_transaksi(nama_file) {
        nama_file = nama_file || '';

        if(nama_file === '-') nama_file = 'blank_user.jpg';

        var img_src = '<?php echo $blank_image; ?>';

        if (nama_file != '') {
            img_src = "<?php echo site_url('images'); ?>/" + nama_file;
        }

        $('#transaksi_image').attr('src', img_src);
    }

    var enableNext = true;

    var activateEnableNext = function () {
      setTimeout(function () {
          enableNext = true;
      }, 3000);
    };

    function fnNext(id) {
        if(!enableNext) return 0;

        console.log('masuk ni');

        enableNext = false;

        activateEnableNext();

        var id = id || '';
        $.ajax({
            type: 'POST',
            url: '<?php echo $fnNext; ?>',
            dataType: 'json',
            data: {id: id},
            success: function (data) {
                data.nama_file = data.nama_file || '';
                load_image_transaksi(data.nama_file);

                data.no_tiket = data.no_tiket || '';

                document.getElementById('tiket').innerHTML = data.no_tiket_awal + data.no_tiket;
                document.getElementById('transaction').innerHTML = data.transaction;
                document.getElementById('start').innerHTML = data.start;
                document.getElementById('forward_layanan').innerHTML = data.layanan_forward;

                refreshTable();

                timer_2.stop();
                timer_2.reset(0);

                timer.stop();
                timer.reset(0);

                if (data.no_tiket != '') {
                    timer.estimation_time(data.estimasi); //dalam second
                    timer.get_limit_time();
                    timer.start(1000);
                } else {
                    timer_2.start(1000);
                    $('#tiket').text('-');
                }

            }
        });

    }

    function fnRecall() {
        $.post('<?php echo $fnRecall; ?>', {}, function (result) {
            //load_image_transaksi();

            if (result.success) {
            } else {
                $.messager.show({title: 'Error', msg: result.msg});
            }
        }, 'json');
    }

    function fnSkip() {
        $.post('<?php echo $fnSkip; ?>', {}, function (result) {
            load_image_transaksi();

            if (result.success) {
                refreshTable();
                $('#tiket, #transaction, #start, #forward_layanan').text('');
                $('#tiket').text('-');

                timer_2.stop();
                timer_2.reset(0);
                timer_2.start(1000);

                timer.stop();
                timer.reset(0);
            } else {
                $.messager.show({title: 'Error', msg: result.msg});
            }
        }, 'json');
    }

    function fnUndo(id) {
        if (id) {
            /*
            var cfm = confirm('Are you sure you want to Undo this data?');
            if(!cfm) return false;
            */

            $.post('<?php echo $fnUndo; ?>', {id: id}, function (result) {

                if (result.success) {
                    refreshTable();
                } else {
                    $.messager.show({title: 'Error', msg: result.msg});
                }
            }, 'json');

        } else {
            alert('Select the data that you want to Undo.');
        }
    }

    (function ($) {
        $(document).ready(function (e) {
            timer = new _timer
            (
                function (time) {
                    if (time == 0) {
                        timer.stop();
                        alert('time out');
                    }
                }
            );

            timer.persen_limit_time(30);
            timer.mode(1);

            timer_2 = new _timer
            (
                function (time) {
                    if (time == 0) {
                        timer_2.stop();
                        alert('time out');
                    }
                }
            );
            timer_2.place('#timer_2');
            timer_2.start(1000);
            timer_2.mode(1);

            $('#ownbtnprocess').click(function (e) {
                e.preventDefault();
                var ticket_number = $('#own_ticket_number').val();

                $.ajax({
                    type: 'POST',
                    url: '<?php echo $fnGoToNext; ?>',
                    dataType: 'json',
                    data: {'ticket_number': ticket_number},
                    success: function (data) {
                        data.nama_file = data.nama_file || '';
                        load_image_transaksi(data.nama_file);

                        data.no_tiket = data.no_tiket || '';

                        document.getElementById('tiket').innerHTML = data.no_tiket_awal + data.no_tiket;
                        document.getElementById('transaction').innerHTML = data.transaction;
                        document.getElementById('start').innerHTML = data.start;
                        document.getElementById('forward_layanan').innerHTML = data.layanan_forward;

                        refreshTable();

                        $('#own_ticket_number').val('');

                        timer_2.stop();
                        timer_2.reset(0);

                        timer.stop();
                        timer.reset(0);

                        if (data.no_tiket != '') {
                            timer.estimation_time(data.estimasi); //dalam second
                            timer.get_limit_time();
                            timer.start(1000);
                        } else {
                            timer_2.start(1000);
                        }

                        $('#smallModal').modal('hide');
                    }
                });

            })

            $('[data-toggle^="tab"]').on('click', function () {
                clearRunningInterval();
                var id = $(this).attr('href');
                if (id === '#tab2') {
                    refreshTableSkip();
                    runningInterval = intervalSkip();
                } else if (id === '#tab3') {
                    refreshTableFinish();
                    runningInterval = intervalFinish();
                } else if (id === '#tab1') {
                    refreshTable();
                    runningInterval = intervalQueue();
                }
            });

            var calculateHeight = function () {
                var docHeight = parseInt($(window).height());
                var panelHeaderHeight = parseInt($('#panelHeader').outerHeight());
                var newHeightPanelList = docHeight - (panelHeaderHeight + 25);
                var newHeightPanelSidebar = docHeight - 10;
                $('#panel_list').css('min-height', newHeightPanelList);
                $('#panelSidebar').css('min-height', newHeightPanelSidebar);
            };

            calculateHeight();

        });
    })(jQuery);

</script>

<div class="tab-content">
    <div class="tab-pane active" id="tab1">
        <h3>Queue List</h3>
        <hr/>
        <div class="example-box-wrapper">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered"
                   id="datatable-example">
                <thead>
                <tr>
                    <?php foreach ($column_list as $val) : ?>
                        <th><?php echo $val['title_header_column']; ?></th>
                    <?php endforeach; ?>
                </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="tab-pane" id="tab2">
        <h3>Skip List</h3>
        <hr/>

        <div class="example-box-wrapper">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered"
                   id="datatable-example-2">
                <thead>
                <tr>
                    <?php foreach ($column_list_skip as $val) : ?>
                        <th><?php echo $val['title_header_column']; ?></th>
                    <?php endforeach; ?>
                </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="tab-pane" id="tab3">
        <h3>Finish List</h3>
        <hr/>

        <div class="example-box-wrapper">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered"
                   id="datatable-example-3">
                <thead>
                <tr>
                    <?php foreach ($column_list_finish as $val) : ?>
                        <th><?php echo $val['title_header_column']; ?></th>
                    <?php endforeach; ?>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Below script for modal box -->

<div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModal" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">GO TO NEXT</h4>
            </div>
            <div class="modal-body">
                <input style="width: 100%;height: 90px;font-size: 60px;" name="own_ticket_number" id="own_ticket_number"
                       placeholder="TICKET"/>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-block" name="ownbtnprocess" id="ownbtnprocess">Process</button>
            </div>
        </div>
    </div>
</div>

<a id="hd_modalboxgotonext" style="display:none;" href="#" class="btn btn-lg btn-danger" data-toggle="modal"
   data-target="#smallModal">Click to open Modal</a>