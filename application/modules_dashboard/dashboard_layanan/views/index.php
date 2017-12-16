<style type="text/css">
    .box_layanan{border:solid 1px;text-align: center;margin-bottom: 10px;min-height: 80px;padding-top:5px;}
    .info_number{font-size: 40px;}
    .satu{background: <?php echo (!empty($warna_box[0]['sett_nilai']) ? $warna_box[0]['sett_nilai'] : 'forestgreen'); ?>;color: #fff;}
    .dua{background: <?php echo (!empty($warna_box[1]['sett_nilai']) ? $warna_box[1]['sett_nilai'] : 'darkblue'); ?>;color: #fff;}
    .tiga{background: <?php echo (!empty($warna_box[2]['sett_nilai']) ? $warna_box[2]['sett_nilai'] : 'darkred'); ?>;color: #fff;}
    .empat{background: <?php echo (!empty($warna_box[3]['sett_nilai']) ? $warna_box[3]['sett_nilai'] : 'purple'); ?>;color: #fff;}
</style>

<div class="panel" id="content_dashboard">
    <ul class="nav nav-tabs" style="padding-left:0;">
        <li><a href="<?php echo site_url('backend'); ?>">Admin</a></li>
        <li><a href="<?php echo site_url('dashboard/loket'); ?>">Loket</a></li>
        <li class="active"><a href="<?php echo site_url('dashboard/layanan'); ?>">Layanan</a></li>
    </ul>

    <div class="panel-body">
        <h3 class="title-hero">
            Dashboard Layanan
        </h3>

        <?php $cnt = 1; ?>
        <?php $status = false; ?>
        <?php foreach($layanan['layanan_info'] as $key => $val) : ?>
            <?php if(empty($val)) continue; ?>
            <?php $status = true; ?>
            <?php if($cnt == 1 OR ($cnt % 3) == 1) : ?>
            <div class="example-box-wrapper">
            <?php endif; ?>
                <div class="col-md-4">
                    <div class="dashboard-box dashboard-box-chart bg-white content-box">
                        <div class="content-wrapper">
                            <div class="row list-grade" style="text-align:left;margin-top:0;">
                                <div class="col-md-4">
                                    <div class="box_layanan satu">
                                        <span>Jumlah Dilayani</span><br />
                                        <span class="info_number"><?php echo (!empty($layanan['num_status'][$key][5]) ? $layanan['num_status'][$key][5] : 0); ?></span><br />
                                        <span>&nbsp;</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="box_layanan empat">
                                        <span>Total Layanan<!-- (menit)--></span><br />
                                        <span class="info_number">
                                        <?php echo (!empty($layanan['waktu_layanan'][$key]) ? (ceil(array_sum($layanan['waktu_layanan'][$key]) / count($layanan['waktu_layanan'][$key]))) : 0); ?>
                                    </span><br />
                                        <span>(menit)</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="box_layanan dua">
                                        <span>Total Tunggu<!-- (menit)--></span><br />
                                        <span class="info_number">
                                        <?php echo (!empty($layanan['waktu_tunggu'][$key]) ? (ceil(array_sum($layanan['waktu_tunggu'][$key]) / count($layanan['waktu_tunggu'][$key]))) : 0); ?>
                                    </span><br />
                                        <span>(menit)</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="box_layanan tiga">
                                        <span>Sisa Layanan</span><br />
                                        <span class="info_number"><?php echo (!empty($layanan['num_status'][$key][0]) ? $layanan['num_status'][$key][0] : 0); ?></span><br />
                                        <span>&nbsp;</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="box_layanan tiga">
                                        <span>Panjang Antrian</span><br />
                                        <span class="info_number"><?php echo (!empty($layanan['num_status'][$key][0]) ? $layanan['num_status'][$key][0] : 0); ?></span><br />
                                        <span>(menit)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row list-grade" style="margin-top:0;">
                                <span>Loket Info</span><br />
                                <hr />
                                <p><?php echo (!empty($layanan['loket_info'][$key]) ? join(', ', $layanan['loket_info'][$key]) : ''); ?></p>
                            </div>
                        </div>
                        <div class="button-pane">
                            <div class="size-md float-left">
                                <a href="#" title="">
                                    <?php echo $val; ?>
                                </a>
                            </div>
                            <a href="#" class="btn btn-info float-right tooltip-button" data-placement="top" title="">
                                <i class="glyph-icon icon-check"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php if(($cnt % 3) == 0) : ?>
            </div>
            <?php endif; ?>

            <?php $cnt++; ?>
        <?php endforeach; ?>

        <?php if($status AND ($cnt % 3) > 0) : ?>
            </div>
        <?php endif; ?>

    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        //Increment the idle time counter every minute.
        var loopingdashboard = setInterval(timerIncrement, 60000); // 1 minute

        function timerIncrement() {
            var url_action = '<?php echo $ajax_load_dashboard; ?>';
            $( "#content_dashboard" ).load(url_action, function(){
                console.log('update');
            });
        }
    })
</script>