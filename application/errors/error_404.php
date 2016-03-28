<!DOCTYPE html>
<html lang ="en">
<head>
    <style>
        /* Loading Spinner */
        .spinner{margin:0;width:70px;height:18px;margin:-35px 0 0 -9px;position:absolute;top:50%;left:50%;text-align:center}.spinner > div{width:18px;height:18px;background-color:#333;border-radius:100%;display:inline-block;-webkit-animation:bouncedelay 1.4s infinite ease-in-out;animation:bouncedelay 1.4s infinite ease-in-out;-webkit-animation-fill-mode:both;animation-fill-mode:both}.spinner .bounce1{-webkit-animation-delay:-.32s;animation-delay:-.32s}.spinner .bounce2{-webkit-animation-delay:-.16s;animation-delay:-.16s}@-webkit-keyframes bouncedelay{0%,80%,100%{-webkit-transform:scale(0.0)}40%{-webkit-transform:scale(1.0)}}@keyframes bouncedelay{0%,80%,100%{transform:scale(0.0);-webkit-transform:scale(0.0)}40%{transform:scale(1.0);-webkit-transform:scale(1.0)}}
    </style>
    <meta charset="UTF-8">
<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
<title> Server page 1 </title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<!-- Favicons -->

<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo config_item('base_url'); ?>/assets/backstage/images/icons/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo config_item('base_url'); ?>/assets/backstage/images/icons/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo config_item('base_url'); ?>/assets/backstage/images/icons/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="<?php echo config_item('base_url'); ?>/assets/backstage/images/icons/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="<?php echo config_item('base_url'); ?>/assets/backstage/images/icons/favicon.png">



    <!-- HELPERS -->

<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/helpers/animate.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/helpers/backgrounds.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/helpers/boilerplate.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/helpers/border-radius.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/helpers/grid.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/helpers/page-transitions.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/helpers/spacing.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/helpers/typography.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/helpers/utils.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/helpers/colors.css">

<!-- ELEMENTS -->

<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/elements/badges.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/elements/buttons.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/elements/content-box.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/elements/dashboard-box.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/elements/forms.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/elements/images.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/elements/info-box.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/elements/invoice.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/elements/loading-indicators.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/elements/menus.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/elements/panel-box.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/elements/response-messages.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/elements/responsive-tables.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/elements/ribbon.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/elements/social-box.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/elements/tables.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/elements/tile-box.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/elements/timeline.css">

<!-- ICONS -->

<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/icons/fontawesome/fontawesome.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/icons/linecons/linecons.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/icons/spinnericon/spinnericon.css">


<!-- WIDGETS -->

<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/accordion-ui/accordion.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/calendar/calendar.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/carousel/carousel.css">

<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/charts/justgage/justgage.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/charts/morris/morris.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/charts/piegage/piegage.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/charts/xcharts/xcharts.css">

<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/chosen/chosen.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/colorpicker/colorpicker.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/datatable/datatable.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/datepicker/datepicker.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/datepicker-ui/datepicker.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/daterangepicker/daterangepicker.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/dialog/dialog.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/dropdown/dropdown.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/dropzone/dropzone.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/file-input/fileinput.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/input-switch/inputswitch.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/input-switch/inputswitch-alt.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/ionrangeslider/ionrangeslider.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/jcrop/jcrop.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/jgrowl-notifications/jgrowl.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/loading-bar/loadingbar.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/maps/vector-maps/vectormaps.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/markdown/markdown.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/modal/modal.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/multi-select/multiselect.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/multi-upload/fileupload.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/nestable/nestable.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/noty-notifications/noty.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/popover/popover.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/pretty-photo/prettyphoto.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/progressbar/progressbar.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/range-slider/rangeslider.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/slidebars/slidebars.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/slider-ui/slider.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/summernote-wysiwyg/summernote-wysiwyg.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/tabs-ui/tabs.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/theme-switcher/themeswitcher.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/timepicker/timepicker.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/tocify/tocify.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/tooltip/tooltip.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/touchspin/touchspin.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/uniform/uniform.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/wizard/wizard.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/xeditable/xeditable.css">

<!-- SNIPPETS -->

<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/snippets/chat.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/snippets/files-box.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/snippets/login-box.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/snippets/notification-box.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/snippets/progress-box.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/snippets/todo.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/snippets/user-profile.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/snippets/mobile-navigation.css">

<!-- APPLICATIONS -->

<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/applications/mailbox.css">

<!-- Admin theme -->

<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/themes/admin/layout.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/themes/admin/color-schemes/default.css">

<!-- Components theme -->

<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/themes/components/default.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/themes/components/border-radius.css">

<!-- Admin responsive -->

<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/helpers/responsive-elements.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url'); ?>/assets/backstage/helpers/admin-responsive.css">

    <!-- JS Core -->

    <script type="text/javascript" src="<?php echo config_item('base_url'); ?>/assets/backstage/js-core/jquery-core.js"></script>
    <script type="text/javascript" src="<?php echo config_item('base_url'); ?>/assets/backstage/js-core/jquery-ui-core.js"></script>
    <script type="text/javascript" src="<?php echo config_item('base_url'); ?>/assets/backstage/js-core/jquery-ui-widget.js"></script>
    <script type="text/javascript" src="<?php echo config_item('base_url'); ?>/assets/backstage/js-core/jquery-ui-mouse.js"></script>
    <script type="text/javascript" src="<?php echo config_item('base_url'); ?>/assets/backstage/js-core/jquery-ui-position.js"></script>
    <script type="text/javascript" src="<?php echo config_item('base_url'); ?>/assets/backstage/js-core/transition.js"></script>
    <script type="text/javascript" src="<?php echo config_item('base_url'); ?>/assets/backstage/js-core/modernizr.js"></script>
    <script type="text/javascript" src="<?php echo config_item('base_url'); ?>/assets/backstage/js-core/jquery-cookie.js"></script>





    <script type="text/javascript">
        $(window).load(function(){
            setTimeout(function() {
                $('#loading').fadeOut( 400, "linear" );
            }, 300);
        });
    </script>



</head>
<body>
<div id="loading">
    <div class="spinner">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>
</div>

<style type="text/css">
    html,body {
        height: 100%;
    }
    body {
        background: #fff;
        overflow: hidden;
    }

</style>

<script type="text/javascript" src="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/wow/wow.js"></script>
<script type="text/javascript">
    /* WOW animations */

    wow = new WOW({
        animateClass: 'animated',
        offset: 100
    });
    wow.init();
</script>

<img src="<?php echo config_item('base_url'); ?>/assets/backstage/image-resources/blurred-bg/blurred-bg-7.jpg" class="login-img wow fadeIn" alt="" />

<div class="center-vertical">
    <div class="center-content">

        <div class="col-md-6 center-margin">
            <div class="server-message wow bounceInDown inverse">
                <h1>Error 404</h1>
                <h2>Page not found</h2>
                <p>The page you are looking for has been moved or no longer exists. Use the search field below to locate the page you were looking for.</p>
                <br />
                <a href="#" onclick="window.history.back();return false;" class="btn btn-lg btn-success">Return to previous page</a>
            </div>
        </div>

    </div>
</div>


    <!-- WIDGETS -->

<!-- Bootstrap Dropdown -->

<script type="text/javascript" src="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/dropdown/dropdown.js"></script>

<!-- Bootstrap Tooltip -->

<script type="text/javascript" src="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/tooltip/tooltip.js"></script>

<!-- Bootstrap Popover -->

<script type="text/javascript" src="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/popover/popover.js"></script>

<!-- Bootstrap Progress Bar -->

<script type="text/javascript" src="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/progressbar/progressbar.js"></script>

<!-- Bootstrap Buttons -->

<script type="text/javascript" src="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/button/button.js"></script>

<!-- Bootstrap Collapse -->

<script type="text/javascript" src="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/collapse/collapse.js"></script>

<!-- Superclick -->

<script type="text/javascript" src="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/superclick/superclick.js"></script>

<!-- Input switch alternate -->

<script type="text/javascript" src="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/input-switch/inputswitch-alt.js"></script>

<!-- Slim scroll -->

<script type="text/javascript" src="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/slimscroll/slimscroll.js"></script>

<!-- Slidebars -->

<script type="text/javascript" src="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/slidebars/slidebars.js"></script>
<script type="text/javascript" src="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/slidebars/slidebars-demo.js"></script>

<!-- PieGage -->

<script type="text/javascript" src="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/charts/piegage/piegage.js"></script>
<script type="text/javascript" src="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/charts/piegage/piegage-demo.js"></script>

<!-- Screenfull -->

<script type="text/javascript" src="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/screenfull/screenfull.js"></script>

<!-- Content box -->

<script type="text/javascript" src="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/content-box/contentbox.js"></script>

<!-- Overlay -->

<script type="text/javascript" src="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/overlay/overlay.js"></script>

<!-- Widgets init for demo -->

<script type="text/javascript" src="<?php echo config_item('base_url'); ?>/assets/backstage/js-init/widgets-init.js"></script>

<!-- Theme layout -->

<script type="text/javascript" src="<?php echo config_item('base_url'); ?>/assets/backstage/themes/admin/layout.js"></script>

<!-- Theme switcher -->

<script type="text/javascript" src="<?php echo config_item('base_url'); ?>/assets/backstage/widgets/theme-switcher/themeswitcher.js"></script>

</body>
</html>