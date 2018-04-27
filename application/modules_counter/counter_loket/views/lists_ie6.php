<!-- <script type="text/javascript" src="<?php echo $assets_counter; ?>/js/timer_ie6.js"></script> -->
<?php foreach($listLayanan as $key => $value) : ?>
<div class="col width-1of2">
    <div class="cell panel">
        <div class="header">
            Loket Name: <?php echo $loket_name; ?>, Layanan: <?php echo $namaLayanan[$value]; ?>
        </div>
        <div class="body" style="background: #106c78;">
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
                <div class="col">
                    <div class="cell" style="margin-right: 0;">
                        <div class="col" style="text-align:right;color:#fff;">
                            Jumlah Antrian: <span id="jumlahAntrian_<?php echo $value; ?>">-</span>
                        </div>
                    </div>
                </div>
                <div class="col" style="background: whitesmoke;">
                    <div class="cell">
                        <div class="col" style="font-size:20px;padding: 10px 0;">
                            <div class="col width-1of3">
                                Tiket:
                            </div>
                            <div class="col width-fill">
                                <span id="tiket_<?php echo $value; ?>"></span>
                            </div>
                        </div>
                        <div class="col" style="font-size:20px;padding: 10px 0;">
                            <div class="col width-1of3">
                                Start:
                            </div>
                            <div class="col width-fill">
                                <span id="start_<?php echo $value; ?>"></span>
                            </div>
                        </div>
                        <div class="col" style="font-size:20px;padding: 10px 0;">
                            <div class="col width-1of3">
                                Nama Visitor:
                            </div>
                            <div class="col width-fill">
                                <span id="visitorNama_<?php echo $value; ?>"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="cell">
                        <div class="col">
                            <div class="col width-1of3">
                                <div class="cell" style="text-align:center;">
                                    <button class="button" style="display:initial;float: none;font-size:15px;" onclick="do_next_<?php echo $value; ?>()">NEXT</button>
                                </div>
                            </div>
                            <div class="col width-1of3">
                                <div class="cell" style="text-align:center;">
                                    <button class="button" style="display:initial;float: none;font-size:15px;" onclick="do_skip_<?php echo $value; ?>()">SKIP</button>
                                </div>
                            </div>
                            <div class="col width-fill">
                                <div class="cell" style="text-align:center;">
                                <button class="button" style="display:initial;float: none;font-size:15px;" onclick="do_recall_<?php echo $value; ?>()">RECALL</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

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

<script>
    var cntTimer = 20000;
    var cntTimerTimeout = 1000;
    <?php foreach($listLayanan as $value) : ?>

    function do_next_<?php echo $value; ?>(){
        if (window.XMLHttpRequest) {
            http = new XMLHttpRequest();
        } else if (window.ActiveXObject) {
            http = new ActiveXObject("Microsoft.XMLHTTP");
        }
        var url = '<?php echo $fnNext; ?>/<?php echo $value; ?>/<?php echo $grouplokets; ?>';
        http.open("POST", url, true);
        http.send(null);
        http.onreadystatechange = statechange_panggil_<?php echo $value; ?>;
    }

    function statechange_panggil_<?php echo $value; ?>() {
        if (http.readyState == 4) {
            var xmlObj = http.responseXML;
            var no_tiket_awal = xmlObj.getElementsByTagName('NO_TIKET_AWAL')[0].childNodes[0].nodeValue;
            var no_tiket = xmlObj.getElementsByTagName('NO_TIKET')[0].childNodes[0].nodeValue;
            var vst_nama = xmlObj.getElementsByTagName('VST_NAMA')[0].childNodes[0].nodeValue;
            var start = xmlObj.getElementsByTagName('START')[0].childNodes[0].nodeValue;

            document.getElementById('tiket_<?php echo $value; ?>').innerHTML = no_tiket_awal + no_tiket;
            document.getElementById('start_<?php echo $value; ?>').innerHTML = start;
            document.getElementById('visitorNama_<?php echo $value; ?>').innerHTML = vst_nama;

            show_antrian_<?php echo $value; ?>();
        }	
    }

    function do_skip_<?php echo $value; ?>(){
        if (window.XMLHttpRequest) {
            http = new XMLHttpRequest();
        } else if (window.ActiveXObject) {
            http = new ActiveXObject("Microsoft.XMLHTTP");
        }
        var url = '<?php echo $fnSkip; ?>/<?php echo $value; ?>/<?php echo $grouplokets; ?>';
        http.open("POST", url, true);
        http.send(null);
        http.onreadystatechange = statechange_skip_<?php echo $value; ?>;
    }

    function statechange_skip_<?php echo $value; ?>() {
        if (http.readyState == 4) {
            var xmlObj = http.responseXML;
            var no_tiket_awal = '';
            var no_tiket = '';
            var vst_nama = '';
            var start = '';

            document.getElementById('tiket_<?php echo $value; ?>').innerHTML = no_tiket_awal + no_tiket;
            document.getElementById('start_<?php echo $value; ?>').innerHTML = start;
            document.getElementById('visitorNama_<?php echo $value; ?>').innerHTML = vst_nama;

            // show_antrian_<?php echo $value; ?>();
        }   
    }

    function do_recall_<?php echo $value; ?>(){
        if (window.XMLHttpRequest) {
            http = new XMLHttpRequest();
        } else if (window.ActiveXObject) {
            http = new ActiveXObject("Microsoft.XMLHTTP");
        }
        var url = '<?php echo $fnRecall; ?>/<?php echo $value; ?>/<?php echo $grouplokets; ?>';
        http.open("POST", url, true);
        http.send(null);
        http.onreadystatechange = statechange_recall_<?php echo $value; ?>;
    }

    function statechange_recall_<?php echo $value; ?>() {
        if (http.readyState == 4) {
            var xmlObj = http.responseXML;
            console.log(xmlObj);

            show_antrian_<?php echo $value; ?>();
        }	
    }

    function show_antrian_<?php echo $value; ?>(){
        if (window.XMLHttpRequest) {
            http = new XMLHttpRequest();
        } else if (window.ActiveXObject) {
            http = new ActiveXObject("Microsoft.XMLHTTP");
        }
        var url = '<?php echo $totalAntrian; ?>/<?php echo $value; ?>/<?php echo $grouplokets; ?>';
        http.open("POST", url, true);
        http.send(null);
        http.onreadystatechange = statechange_show_antrian_<?php echo $value; ?>;
    }

    function statechange_show_antrian_<?php echo $value; ?>() {
        if (http.readyState == 4) {
            var xmlObj = http.responseXML;
            // console.log(xmlObj);
            var jumlahAntrian = xmlObj.getElementsByTagName('JUMLAH_ANTRIAN')[0].childNodes[0].nodeValue;

            document.getElementById('jumlahAntrian_<?php echo $value; ?>').innerHTML = jumlahAntrian;
        }	
    }
    
        //show_antrian_<?php echo $value; ?>();
        setTimeout(function(){ show_antrian_<?php echo $value; ?>(); }, cntTimerTimeout);
        setInterval(function(){ show_antrian_<?php echo $value; ?>(); }, cntTimer);
        cntTimer = cntTimer + 10000;
        cntTimerTimeout = cntTimerTimeout + 500;
    <?php endforeach; ?>
</script>