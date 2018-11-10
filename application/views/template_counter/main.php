<!DOCTYPE html> 
<html  lang="en">
<head>

    <style>
        /* Loading Spinner */
        .spinner{margin:0;width:70px;height:18px;margin:-35px 0 0 -9px;position:absolute;top:50%;left:50%;text-align:center}.spinner > div{width:18px;height:18px;background-color:#333;border-radius:100%;display:inline-block;-webkit-animation:bouncedelay 1.4s infinite ease-in-out;animation:bouncedelay 1.4s infinite ease-in-out;-webkit-animation-fill-mode:both;animation-fill-mode:both}.spinner .bounce1{-webkit-animation-delay:-.32s;animation-delay:-.32s}.spinner .bounce2{-webkit-animation-delay:-.16s;animation-delay:-.16s}@-webkit-keyframes bouncedelay{0%,80%,100%{-webkit-transform:scale(0.0)}40%{-webkit-transform:scale(1.0)}}@keyframes bouncedelay{0%,80%,100%{transform:scale(0.0);-webkit-transform:scale(0.0)}40%{transform:scale(1.0);-webkit-transform:scale(1.0)}}
    </style>


    <meta charset="UTF-8">
<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
<title><?php echo $title; ?></title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<!-- Favicons -->

<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $assets; ?>/images/icons/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $assets; ?>/images/icons/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $assets; ?>/images/icons/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="<?php echo $assets; ?>/images/icons/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="<?php echo $assets; ?>/images/icons/favicon.png">



    <!-- HELPERS -->

<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/helpers/animate.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/helpers/backgrounds.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/helpers/boilerplate.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/helpers/border-radius.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/helpers/grid.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/helpers/page-transitions.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/helpers/spacing.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/helpers/typography.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/helpers/utils.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/helpers/colors.css">

<!-- ELEMENTS -->

<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/elements/badges.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/elements/buttons.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/elements/content-box.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/elements/dashboard-box.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/elements/forms.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/elements/images.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/elements/info-box.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/elements/invoice.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/elements/loading-indicators.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/elements/menus.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/elements/panel-box.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/elements/response-messages.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/elements/responsive-tables.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/elements/ribbon.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/elements/social-box.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/elements/tables.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/elements/tile-box.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/elements/timeline.css">

<!-- ICONS -->

<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/icons/fontawesome/fontawesome.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/icons/linecons/linecons.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/icons/spinnericon/spinnericon.css">


<!-- WIDGETS -->

<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/accordion-ui/accordion.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/calendar/calendar.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/carousel/carousel.css">

<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/charts/justgage/justgage.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/charts/morris/morris.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/charts/piegage/piegage.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/charts/xcharts/xcharts.css">

<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/chosen/chosen.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/colorpicker/colorpicker.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/datatable/datatable.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/datepicker/datepicker.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/datepicker-ui/datepicker.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/daterangepicker/daterangepicker.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/dialog/dialog.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/dropdown/dropdown.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/dropzone/dropzone.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/file-input/fileinput.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/input-switch/inputswitch.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/input-switch/inputswitch-alt.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/ionrangeslider/ionrangeslider.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/jcrop/jcrop.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/jgrowl-notifications/jgrowl.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/loading-bar/loadingbar.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/maps/vector-maps/vectormaps.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/markdown/markdown.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/modal/modal.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/multi-select/multiselect.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/multi-upload/fileupload.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/nestable/nestable.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/noty-notifications/noty.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/popover/popover.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/pretty-photo/prettyphoto.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/progressbar/progressbar.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/range-slider/rangeslider.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/slidebars/slidebars.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/slider-ui/slider.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/summernote-wysiwyg/summernote-wysiwyg.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/tabs-ui/tabs.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/theme-switcher/themeswitcher.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/timepicker/timepicker.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/tocify/tocify.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/tooltip/tooltip.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/touchspin/touchspin.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/uniform/uniform.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/wizard/wizard.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/xeditable/xeditable.css">

<!-- SNIPPETS -->

<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/snippets/chat.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/snippets/files-box.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/snippets/login-box.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/snippets/notification-box.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/snippets/progress-box.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/snippets/todo.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/snippets/user-profile.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/snippets/mobile-navigation.css">

<!-- APPLICATIONS -->

<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/applications/mailbox.css">

<!-- Admin theme -->

<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/themes/admin/layout.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/themes/admin/color-schemes/default.css">

<!-- Components theme -->

<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/themes/components/default.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/themes/components/border-radius.css">

<!-- Admin responsive -->

<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/helpers/responsive-elements.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/helpers/admin-responsive.css">

<!-- webcamera start -->
<link href="<?php echo $assets; ?>/node_modules/video.js/dist/video-js.min.css" rel="stylesheet">
<link href="<?php echo $assets; ?>/dist/css/videojs.record.css" rel="stylesheet">

<script src="<?php echo $assets; ?>/node_modules/video.js/dist/video.min.js"></script>
<script src="<?php echo $assets; ?>/node_modules/recordrtc/RecordRTC.js"></script>
<script src="<?php echo $assets; ?>/node_modules/webrtc-adapter/out/adapter.js"></script>
<script src="<?php echo $assets; ?>/dist/videojs.record.js"></script>
<!-- webcamera end -->

    <!-- JS Core -->

    <script type="text/javascript" src="<?php echo $assets; ?>/js-core/jquery-core.js"></script>
    <script type="text/javascript" src="<?php echo $assets; ?>/js-core/jquery-ui-core.js"></script>
    <script type="text/javascript" src="<?php echo $assets; ?>/js-core/jquery-ui-widget.js"></script>
    <script type="text/javascript" src="<?php echo $assets; ?>/js-core/jquery-ui-mouse.js"></script>
    <script type="text/javascript" src="<?php echo $assets; ?>/js-core/jquery-ui-position.js"></script>
    <script type="text/javascript" src="<?php echo $assets; ?>/js-core/transition.js"></script>
    <script type="text/javascript" src="<?php echo $assets; ?>/js-core/modernizr.js"></script>
    <script type="text/javascript" src="<?php echo $assets; ?>/js-core/jquery-cookie.js"></script>

    <script type="text/javascript">
        $(window).load(function(){
            setTimeout(function() {
                $('#loading').fadeOut( 400, "linear" );
            }, 300);
        });
    </script>

    <style>
  /* change player background color */
  #myVideo {
      background-color: #9ab87a;
  }

  #myModalWebCamera{
    top: 20%;
  }
  </style>

</head>

<body style="background:gainsboro;">
    <div id="page-wrapper">
        <div class="top-bar bg-topbar" style="overflow:hidden;background:black;">
            <div class="col-sm-6">
                &nbsp;
            </div>
            <div class="col-sm-6">
                &nbsp;
            </div>
        </div>
        <div style="overflow:hidden;background: darkgrey;">
            <div class="col-sm-2" style="background: gainsboro;" id="panelSidebar">
                <div class="example-box-wrapper">
                    <div style="padding:5px 0 0;">
                        <a href="#" title="Example tile shortcut" class="tile-box tile-box-alt btn-danger">
                            <div class="tile-header" style="padding:2px;">
                                <?php echo $login_name; ?>
                            </div>
                            <div class="tile-content-wrapper" style="font-size:30px;padding:5px;">
                                <?php echo $loket_name; ?>
                            </div>
                        </a>
                    </div>
                    <div>
                        <div style="margin:auto;width:160px;">
                            <img class="img-circle" id="transaksi_image" style="width:160px;height:160px;" src="<?php echo $blank_image; ?>">
                        </div>
                    </div>
                    <div style="padding:5px 0 0;">
                        <a href="#" title="Example tile shortcut" class="tile-box tile-box-alt btn-success" style="margin-bottom:10px;">
                            <div class="tile-content-wrapper" style="font-size:30px;padding:0;">
                                <span id="tiket">-</span>
                            </div>
                        </a>
                    </div>
                    <div class="list-group" style="margin-bottom:10px;">
                        <a href="javascript:void(0)" id="btnnext" class="list-group-item" style="padding:5px;border-color: cornflowerblue;">
                            <button id="clickBtnNext" class="btn btn-alt btn-hover btn-blue-alt btn-block" onclick="fnNext()">
                                <span>NEXT</span>
                                <i class="glyph-icon icon-arrow-right"></i>
                            </button>
                        </a>
                        <a href="javascript:void(0)" id="btnnext" class="list-group-item" style="padding:5px;border-color: cornflowerblue;">
                            <button class="btn btn-alt btn-hover btn-blue-alt btn-block" onclick="fnRecall()">
                                <span>RECALL</span>
                                <i class="glyph-icon icon-arrow-right"></i>
                            </button>
                        </a>
                        <a href="javascript:void(0)" id="btnnext" class="list-group-item" style="padding:5px;border-color: cornflowerblue;">
                            <button id="clickBtnSkip" class="btn btn-alt btn-hover btn-blue-alt btn-block" onclick="fnSkip()">
                                <span>SKIP</span>
                                <i class="glyph-icon icon-arrow-right"></i>
                            </button>
                        </a>
                        <a href="javascript:void(0)" id="btnnext" class="list-group-item" style="padding:5px;border-color: cornflowerblue;">
                            <button class="btn btn-alt btn-hover btn-blue-alt btn-block" onclick="fnGotonext()">
                                <span>GO TO NEXT</span>
                                <i class="glyph-icon icon-arrow-right"></i>
                            </button>
                        </a>
                        <a href="javascript:void(0)" id="btnnext" class="list-group-item" style="padding:5px;border-color: cornflowerblue;">
                            <button class="btn btn-alt btn-hover btn-blue-alt btn-block" onclick="fnFinish()">
                                <span>FINISH</span>
                                <i class="glyph-icon icon-arrow-right"></i>
                            </button>
                        </a>
                    </div>
                    <div class="dropup btn-block" style="margin-bottom:10px;">
                        <a href="#" class="btn btn-default btn-block" title="" data-toggle="dropdown" aria-expanded="false">
                            Forward Layanan
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <?php foreach($layanan_forward AS $key => $val) : ?>
                            <li>
                                <a href="javascript:void(0)" onclick='fnForward(<?php echo $val['lay_id_layanan']; ?>, <?php echo $val['lay_id_group_layanan']; ?>)'>
                                    <?php echo $val['lay_nama_layanan']; ?>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="button-pane button-pane-alt text-center" style="padding:0;">
                        <a href="<?php echo $url_logout; ?>" class="btn display-block font-normal btn-danger" id="logout_link">
                            <i class="glyph-icon icon-power-off"></i>
                            Logout
                        </a>
                    </div>
                    <!--<div class="list-group">
                        <a href="#" class="list-group-item active">
                            <i class="glyph-icon icon-dashboard"></i>
                            Layanan Forward
                            <i class="glyph-icon icon-chevron-right"></i>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="glyph-icon icon-dashboard"></i>
                            Poli MTBS
                            <i class="glyph-icon icon-chevron-right"></i>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="glyph-icon font-red icon-bullhorn"></i>
                            Poli Gigi
                            <i class="glyph-icon font-green icon-chevron-right"></i>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="glyph-icon font-primary icon-camera"></i>
                            Poli KIA
                            <i class="glyph-icon icon-chevron-right"></i>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="glyph-icon font-azure icon-gears"></i>
                            Poli KB
                            <i class="glyph-icon icon-chevron-right"></i>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="glyph-icon font-azure icon-gears"></i>
                            Poli Lansia
                            <i class="glyph-icon icon-chevron-right"></i>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="glyph-icon font-azure icon-gears"></i>
                            Poli PKPR
                            <i class="glyph-icon icon-chevron-right"></i>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="glyph-icon font-azure icon-gears"></i>
                            Poli RB
                            <i class="glyph-icon icon-chevron-right"></i>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="glyph-icon font-azure icon-gears"></i>
                            UGD
                            <i class="glyph-icon icon-chevron-right"></i>
                        </a>
                    </div>-->
                </div>
            </div>
            <div class="col-sm-10">
                <div class="row" style="padding:5px 0;margin-bottom:10px;background: gainsboro;" id="panelHeader">
                    <div class="col-sm-2">
                        <a href="#" title="Example tile shortcut" class="tile-box tile-box-alt btn-black">
                            <div class="tile-header" style="padding:2px;">
                                SERVICE TIME
                            </div>
                            <div class="timer" class="tile-content-wrapper" style="font-size:30px;padding:18px 5px;color:green;">
                                <span class="hour">00</span>:<span class="minute">00</span>:<span class="second">00</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-8" style="font-size:16px;">
                        <div class="row" style="margin-bottom:5px;background: black;color: white;">
                            <div class="col-sm-4">
                                Transaction
                            </div>
                            <div class="col-sm-1">
                                :
                            </div>
                            <div class="col-sm-7">
                                <span id="transaction"></span>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom:5px;background: black;color: white;">
                            <div class="col-sm-4">
                                Start
                            </div>
                            <div class="col-sm-1">
                                :
                            </div>
                            <div class="col-sm-7">
                                <span id="start"></span>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom:5px;background: black;color: white;">
                            <div class="col-sm-4">
                                Forward Layanan
                            </div>
                            <div class="col-sm-1">
                                :
                            </div>
                            <div class="col-sm-7">
                                <span id="forward_layanan"></span>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom:5px;background: black;color: white;">
                            <div class="col-sm-4">
                                Nama Visitor
                            </div>
                            <div class="col-sm-1">
                                :
                            </div>
                            <div class="col-sm-7">
                                <a data-toggle="modal" href="#myModal" style="color: #ffffff;" id="linkVisitorNama"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
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
                <div class="panel" id="panel_list">
                    <h3 class="content-box-header bg-blue">
                        <i class="glyph-icon icon-cog"></i>
                        Daftar Antrian Loket
                        <div class="header-buttons-separator">
                            <a href="#tab1" class="icon-separator" data-toggle="tab">
                                <i class="glyph-icon tooltip-button icon-smile-o" title="Antrian">
                                    <!--<span class="bs-badge badge-warning float-right badge-absolute">89</span>-->
                                </i>
                            </a>
                            <a href="#tab2" class="icon-separator" data-toggle="tab">
                                <i class="glyph-icon tooltip-button icon-rotate-left" title="Skip">
                                    <!--<span class="bs-badge badge-warning float-right badge-absolute">89</span>-->
                                </i>
                            </a>
                            <a href="#tab3" class="icon-separator" data-toggle="tab">
                                <i class="glyph-icon tooltip-button icon-graduation-cap" title="Finish">
                                    <!--<span class="bs-badge badge-warning float-right badge-absolute">89</span>-->
                                </i>
                            </a>
                        </div>
                    </h3>
                    <div class="panel-body" style="min-height: 500px;">
                        <?php echo $contents; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Data Visitor</h4>
                </div>
                <div class="modal-body">
                    <div class="example-box-wrapper">
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <td>Nomor</td>
                                <td>:</td>
                                <td><span id="visitorNomor">-</span></td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td><span id="visitorNama">-</span></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td><span id="visitorAlamat">-</span></td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>:</td>
                                <td><span id="visitorPhone">-</span></td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td><span id="visitorSex">-</span></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td><span id="visitorEmail">-</span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <a style="display: none;" data-toggle="modal" href="#myModalWebCamera" id="linkShowWebCamera" data-keyboard="false" data-backdrop="static"></a>

    <div class="modal fade" id="myModalWebCamera">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Data Visitor</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <form id="frmModal" method="post" class="form-horizontal bordered-row">
                            <input type="hidden" name="trans_id_transaksi" id="trans_id_transaksi">
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="nik_nuptk">NIK/NUPTK (User Request):</label>
                                <div class="col-sm-8">
                                    <input name="nik_nuptk" class="form-control inputdel" id="nik_nuptk">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="nuptk">NUPTK:</label>
                                    <div class="col-sm-8">
                                    <input name="nuptk" class="form-control inputdel" id="nuptk">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="nama">Nama:</label>
                                <div class="col-sm-8">
                                    <input name="nama" class="form-control inputdel" id="nama">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="nama_sekolah">Nama Sekolah:</label>
                                <div class="col-sm-8">
                                    <input name="nama_sekolah" class="form-control inputdel" id="nama_sekolah">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="permasalahan">Permasalahan:</label>
                                <div class="col-sm-8">
                                    <input name="permasalahan" class="form-control inputdel" id="permasalahan">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="tanggapan">Tanggapan:</label>
                                <div class="col-sm-8">
                                    <input name="tanggapan" class="form-control inputdel" id="tanggapan">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btnCloseNew" style="display: none;" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="btnSkipNew" type="button" class="btn btn-default">CLOSE</button>
                    <!-- <button id="btnNextNew" type="button" class="btn btn-default">NEXT</button> -->
                    <button id="btnFinishNew" type="button" class="btn btn-default">FINISH</button>
                </div>
            </div>
        </div>
    </div>

    <span style="display: none;" id="valueModalSkipNext"></span>

    <?php $this->load->view('template_counter/footer.php'); ?>

<script type="text/javascript">
    $(function(){
        var validationForm = function() {
            var nik_nuptk = $('#nik_nuptk').val();
            var nuptk = $('#nuptk').val();
            var nama = $('#nama').val();
            var nama_sekolah = $('#nama_sekolah').val();
            var permasalahan = $('#permasalahan').val();
            var tanggapan = $('#tanggapan').val();

            if(nik_nuptk == '' || nuptk == '' || nama == '' || nama_sekolah == '' || permasalahan == '' || tanggapan == '') {
                return false;
            }

            return true;
        };

        $('#btnNextNew').click(function(e){
            e.preventDefault();
            if(validationForm()) {
                //script here
            } else {
                alert('Oops.. form harus diisi!');
            }
        })

        $('#btnSkipNew').click(function(e){
            e.preventDefault();
            $('#btnCloseNew').trigger('click');
        })

        $('#btnFinishNew').click(function(e){
            e.preventDefault();
            if(validationForm()) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo $ajaxVisitor; ?>',
                    dataType: 'json',
                    data: $('#frmModal').serialize(),
                    success: function (data) {
                        console.log(data);
                        $('#btnCloseNew').trigger('click');
                        $('.inputdel').val('');
                    }
                });
            } else {
                alert('Oops.. form harus diisi!');
            }
        })
    })
</script>
</body>
</html>