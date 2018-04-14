<style>
    a:hover{
        text-decoration:none;
    }
</style>

<?php foreach($data_loket as $val) : ?>
    <!-- <div class="col-md-3" style="margin-bottom:20px;">
        <a href="<?php echo $val['loket_url_action']; ?>" title="Example box" class="dashboard-box btn-primary">
            <span class="content-wrapper" style="font-size:55px;line-height:120px;">
                <?php echo $val['loket_name']; ?>
            </span>
            <span class="button-pane" style="text-align: left;text-transform: none;">
                Group Layanan : <?php echo (!empty($val['loket_layanan']) ? implode(', ', $val['loket_layanan']) : '-'); ?>
            </span>
        </a>
    </div> -->

    <div class="col width-1of4">
        <a href="<?php echo $val['loket_url_action']; ?>">
            <div class="cell panel">
                <div class="header" style="text-align:center;">
                    LOKET
                </div>
                <div class="body">
                    <div class="cell" style="text-align:center;">
                        <span class="content-wrapper" style="font-size:55px;line-height:120px;">
                            <?php echo $val['loket_name']; ?>
                        </span>
                    </div>
                </div>
                <div class="footer">
                    Group Layanan : <?php echo (!empty($val['loket_layanan']) ? implode(', ', $val['loket_layanan']) : '-'); ?>
                </div>
            </div>
        </a>
    </div>
<?php endforeach; ?>