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

</head>

<body>
    <div id="sb-site">
        <div id="loading">
            <div class="spinner">
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
            </div>
        </div>

        <div id="page-wrapper">
            <div id="page-header" class="bg-gradient-9">
                <?php $this->load->view('template_admin/header'); ?>
            </div>

            <div id="page-sidebar">
            	<?php $this->load->view('template_admin/sidebar'); ?>
            </div>

            <div id="page-content-wrapper">
                <div id="page-content">
                    <?php echo $contents; ?>
                </div>
            </div>
        </div>
        <?php $this->load->view('template_admin/footer.php'); ?>
    </div>
</body>
</html>