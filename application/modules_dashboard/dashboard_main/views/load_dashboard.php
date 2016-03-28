<ul class="nav nav-tabs" style="padding-left:0;">
    <li><a href="<?php echo site_url('backend'); ?>">Admin</a></li>
    <li class="active"><a href="<?php echo site_url('dashboard/loket'); ?>">Loket</a></li>
    <li><a href="<?php echo site_url('dashboard/layanan'); ?>">Layanan</a></li>
</ul>

<div class="panel-body">
    <h3 class="title-hero">
        Dashboard
    </h3>

    <?php $cnt = 1; ?>
    <?php $status = false; ?>
    <?php foreach($lokets['loket_info'] as $key => $val) : ?>
        <?php if(empty($val)) continue; ?>
        <?php $status = true; ?>
        <?php if($cnt == 1 OR ($cnt % 3) == 1) : ?>
        <div class="example-box-wrapper">
        <?php endif; ?>
            <div class="col-md-4">
                <div class="dashboard-box dashboard-box-chart bg-white content-box">
                    <div class="content-wrapper">
                        <div class="header">
                            <span id="loket_jumlahselesai" style="text-align:left;line-height: 0;font-size:14px;">Total : <?php echo (!empty($lokets['num_status'][$key][5]) ? $lokets['num_status'][$key][5] : 0); ?></span>
                        </div>
                        <div class="bs-label bg-green"><?php echo (!empty($lokets['user_info'][$key]) ? $lokets['user_info'][$key] : 0); ?></div>
                        <div class="center-div sparkline-big-alt" style="margin-bottom:10px;overflow:hidden;">
                            <div class="col-md-6">
                                <div class="box_loket satu">
                                    <span>PERFORMANCE</span><br />
                                    <span class="info_number"><?php echo (!empty($lokets['waktu_performance'][$key]) ? array_sum($lokets['waktu_performance'][$key]) : '0'); ?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box_loket dua">
                                    <span>WAKTU (menit)</span><br />
                                    <span class="info_number">
                                        <?php echo (!empty($lokets['waktu_melayani_second'][$key]) ? $lokets['waktu_melayani_second'][$key] : 0); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <?php $cnt_layanan = 1; ?>
                        <?php $jml_layanan = count($lokets['loket_num_status'][$key]); ?>
                        <?php foreach($lokets['loket_num_status'][$key] as $kLayanan => $vLayanan) : ?>
                            <?php if($cnt_layanan == 1 OR ($cnt_layanan % 2) == 1) : ?>
                            <div class="row list-grade" style="text-align:left;">
                            <?php endif; ?>
                                <?php if($jml_layanan == 1) : ?>
                                <div class="col-md-12">
                                <?php else : ?>
                                <div class="col-md-6">
                                <?php endif; ?>

                                    <span><b><?php echo (!empty($lokets['layanan_info'][$kLayanan]) ? $lokets['layanan_info'][$kLayanan] : '-'); ?></b></span><br />
                                    <div class="row">
                                        <div class="col-md-6">
                                            Skip
                                        </div>
                                        <div class="col-md-2">
                                            :
                                        </div>
                                        <div class="col-md-4">
                                            <span id="layanan_skip_<?php echo $key; ?>_<?php echo $kLayanan; ?>"><?php echo (!empty($vLayanan[3]) ? $vLayanan[3] : 0); ?></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            Selesai
                                        </div>
                                        <div class="col-md-2">
                                            :
                                        </div>
                                        <div class="col-md-4">
                                            <span id="layanan_selesai_<?php echo $key; ?>_<?php echo $kLayanan; ?>"><?php echo (!empty($vLayanan[5]) ? $vLayanan[5] : 0); ?></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            Antrian
                                        </div>
                                        <div class="col-md-2">
                                            :
                                        </div>
                                        <div class="col-md-4">
                                            <span id="layanan_antrian_<?php echo $key; ?>_<?php echo $kLayanan; ?>"><?php echo (!empty($lokets['loket_num_status'][0][$kLayanan][0]) ? $lokets['loket_num_status'][0][$kLayanan][0] : 0); ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php if($jml_layanan == 1 OR (($cnt_layanan % 2) == 0) OR ($cnt_layanan == $jml_layanan)) : ?>
                            </div>
                            <?php endif; ?>
                        <?php $cnt_layanan++; ?>
                        <?php endforeach; ?>

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