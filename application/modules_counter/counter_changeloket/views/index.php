<?php foreach($data_loket as $val) : ?>
    <div class="col-md-3" style="margin-bottom:20px;">
        <a href="<?php echo $val['loket_url_action']; ?>" title="Example box" class="dashboard-box btn-primary">
            <span class="content-wrapper" style="font-size:55px;line-height:120px;">
                <?php echo $val['loket_name']; ?>
            </span>
            <span class="button-pane" style="text-align: left;text-transform: none;">
                Group Layanan : <?php echo (!empty($val['loket_layanan']) ? implode(', ', $val['loket_layanan']) : '-'); ?>
            </span>
        </a>
    </div>
<?php endforeach; ?>