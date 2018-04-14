<!-- <script type="text/javascript" src="<?php echo $assets_counter; ?>/js/timer_ie6.js"></script> -->
<div class="col">
    <div class="cell panel">
        <div class="header">
            Header
        </div>
        <div class="body">
            <div class="cell">
                <!-- <div class="col" style="background:black;margin-bottom:20px;">
                    <div class="col width-1of2">
                        <div class="cell" style="text-align:center;">
                            <a href="#" title="Example tile shortcut" class="tile-box tile-box-alt btn-black">
                                <div class="tile-header" style="padding:2px;">
                                    SERVICE TIME
                                </div>
                                <div class="timer" class="tile-content-wrapper" style="font-size:30px;padding:18px 5px;color:green;">
                                    <span class="hour">00</span>:<span class="minute">00</span>:<span class="second">00</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col width-fill">
                        <div class="cell" style="text-align:center;">
                            <a href="#" title="Example tile shortcut" class="tile-box tile-box-alt btn-black">
                                <div class="tile-header" style="padding:2px;">
                                    IDLE TIME
                                </div>
                                <div id="timer_2" class="tile-content-wrapper" style="font-size:30px;padding:18px 5px;color:green;">
                                    <span class="hour">00</span>:<span class="minute">00</span>:<span class="second">00</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div> -->
                <div class="col" style="background: whitesmoke;">
                    <div class="cell">
                        <div class="col" style="font-size:20px;padding: 10px 0;">
                            <div class="col width-1of3">
                                Transaction:
                            </div>
                            <div class="col width-fill">
                                <span id="transaction"></span>
                            </div>
                        </div>
                        <div class="col" style="font-size:20px;padding: 10px 0;">
                            <div class="col width-1of3">
                                Start:
                            </div>
                            <div class="col width-fill">
                                <span id="start"></span>
                            </div>
                        </div>
                        <div class="col" style="font-size:20px;padding: 10px 0;">
                            <div class="col width-1of3">
                                Nama Visitor:
                            </div>
                            <div class="col width-fill">
                                <a data-toggle="modal" href="#myModal" style="color: #ffffff;" id="linkVisitorNama"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="cell">
                        <div class="col">
                            <div class="col width-1of2">
                                <div class="cell" style="text-align:center;">
                                    <button class="button" style="display:initial;float: none;font-size:35px;">NEXT</button>
                                </div>
                            </div>
                            <div class="col width-fill">
                                <div class="cell" style="text-align:center;">
                                <button class="button" style="display:initial;float: none;font-size:35px;">RECALL</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script>
    var timer;
    var timer_2;
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
</script> -->