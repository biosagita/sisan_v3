<!-- <script type="text/javascript" src="<?php echo $assets_counter; ?>/js/timer_ie6.js"></script> -->
<div class="col">
    <div class="cell panel">
        <div class="header">
            Loket Name: <?php echo $loket_name; ?>
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
                <div class="col">
                    <div class="cell">
                        <div class="col" style="text-align:right;">
                            Jumlah Antrian: <span id="jumlahAntrian">-</span>
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
                                <span id="tiket"></span>
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
                                <span id="visitorNama"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="cell">
                        <div class="col">
                            <div class="col width-1of2">
                                <div class="cell" style="text-align:center;">
                                    <button class="button" style="display:initial;float: none;font-size:35px;" onclick="do_next()">NEXT</button>
                                </div>
                            </div>
                            <div class="col width-fill">
                                <div class="cell" style="text-align:center;">
                                <button class="button" style="display:initial;float: none;font-size:35px;" onclick="do_recall()">RECALL</button>
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

<script>
    function do_next(){
        if (window.XMLHttpRequest) {
            http = new XMLHttpRequest();
        } else if (window.ActiveXObject) {
            http = new ActiveXObject("Microsoft.XMLHTTP");
        }
        var url = '<?php echo $fnNext; ?>';
        http.open("POST", url, true);
        http.send(null);
        http.onreadystatechange = statechange_panggil;
    }

    function statechange_panggil() {
        if (http.readyState == 4) {
            var xmlObj = http.responseXML;
            var no_tiket_awal = xmlObj.getElementsByTagName('NO_TIKET_AWAL')[0].childNodes[0].nodeValue;
            var no_tiket = xmlObj.getElementsByTagName('NO_TIKET')[0].childNodes[0].nodeValue;
            var vst_nama = xmlObj.getElementsByTagName('VST_NAMA')[0].childNodes[0].nodeValue;
            var start = xmlObj.getElementsByTagName('START')[0].childNodes[0].nodeValue;

            document.getElementById('tiket').innerHTML = no_tiket_awal + no_tiket;
            document.getElementById('start').innerHTML = start;
            document.getElementById('visitorNama').innerHTML = vst_nama;

            show_antrian();
        }	
    }

    function do_recall(){
        if (window.XMLHttpRequest) {
            http = new XMLHttpRequest();
        } else if (window.ActiveXObject) {
            http = new ActiveXObject("Microsoft.XMLHTTP");
        }
        var url = '<?php echo $fnRecall; ?>';
        http.open("POST", url, true);
        http.send(null);
        http.onreadystatechange = statechange_recall;
    }

    function statechange_recall() {
        if (http.readyState == 4) {
            var xmlObj = http.responseXML;
            console.log(xmlObj);

            show_antrian();
        }	
    }

    function show_antrian(){
        if (window.XMLHttpRequest) {
            http = new XMLHttpRequest();
        } else if (window.ActiveXObject) {
            http = new ActiveXObject("Microsoft.XMLHTTP");
        }
        var url = '<?php echo $totalAntrian; ?>';
        http.open("POST", url, true);
        http.send(null);
        http.onreadystatechange = statechange_show_antrian;
    }

    function statechange_show_antrian() {
        if (http.readyState == 4) {
            var xmlObj = http.responseXML;
            // console.log(xmlObj);
            var jumlahAntrian = xmlObj.getElementsByTagName('JUMLAH_ANTRIAN')[0].childNodes[0].nodeValue;

            document.getElementById('jumlahAntrian').innerHTML = jumlahAntrian;
        }	
    }

    show_antrian();

    setInterval(function(){ show_antrian(); }, 10000);
</script>