<style type="text/css">
    .datasheet td, .datasheet th {
        padding: 6px 8px;
    }
</style>

<div class="col">
    <div class="cell panel">
        <div class="header">
            <p style="text-align: right;">Total Data : <?php echo $rows['recordsTotal']; ?></p>
        </div>
        <div class="body">
            <div class="cell">
                <div class="panel datasheet">
                    <div class="header">
                        List Skip
                    </div>
                    <table class="body">
                        <thead>
                            <tr>
                                <th style="width: 2%;">#</th>
                                <th style="width: 10%;" nowrap="nowrap">No Ticket</th>
                                <th style="width: 20%;" nowrap="nowrap">Layanan</th>
                                <th style="width: 22%;" nowrap="nowrap">Time In</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $cnt = 1; foreach ($rows['data'] as $key => $value) : ?>
                            <tr>
                                <td><?php echo $cnt; ?></td>
                                <td><?php echo $value[1]; ?></td>
                                <td><?php echo $value[2]; ?></td>
                                <td><?php echo $value[3]; ?></td>
                            </tr>
                            <?php $cnt++; endforeach; ?>
                        </tbody>
                    </table>
                    <div class="footer pagination">
                        <ul class="nav">
                            <li><a href="#">Prev</a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">Next</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>