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
                                    <span>Total Dilayani</span><br />
                                    <span class="info_number"><?php echo (!empty($layanan['num_status'][$key][5]) ? $layanan['num_status'][$key][5] : 0); ?></span><br />
                                    <span>&nbsp;</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="box_layanan empat">
                                    <span>Total Layanan<!-- (menit)--></span><br />
                                    <span class="info_number">
                                    <?php echo (!empty($layanan['waktu_layanan'][$key]) ? $layanan['waktu_layanan'][$key] : 0); ?>
                                </span><br />
                                    <span>(menit)</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="box_layanan dua">
                                    <span>Total Tunggu<!-- (menit)--></span><br />
                                    <span class="info_number">
                                    <?php echo (!empty($layanan['waktu_tunggu'][$key]) ? $layanan['waktu_tunggu'][$key] : 0); ?>
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
                                    <span class="info_number"><?php echo (!empty($layanan['info_list_antrian'][$key]) ? $layanan['info_list_antrian'][$key]['waktu_antri'] : 0); ?></span><br />
                                    <span>(menit)</span>
                                </div>
                            </div>
                        </div>
                        <div class="row list-grade" style="margin-top:0;">
                            <span>Loket Info</span><br />
                            <hr />
                            <p><?php echo (!empty($layanan['loket_info'][$key]) ? join(', ', $layanan['loket_info'][$key]) : 0); ?></p>
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