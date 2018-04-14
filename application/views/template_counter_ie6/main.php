<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" media="all"  href="<?php echo $assets; ?>/ie6/assets/css/cascade/production/build-full.min.css" />
        <link rel="stylesheet" type="text/css" media="all"  href="<?php echo $assets; ?>/ie6/assets/css/site.css" />
        <!--[if lt IE 8]><link rel="stylesheet" href="<?php echo $assets; ?>/ie6/assets/css/cascade/production/icons-ie7.min.css"><![endif]-->
        <!--[if lt IE 9]><script src="<?php echo $assets; ?>/ie6/assets/js/shim/iehtmlshiv.js"></script><![endif]-->
        <title>Cascade Framework</title>
        <meta name="description" content="Professional Frontend framework that makes building websites easier than ever.">
        <link rel="shortcut icon" href="<?php echo $assets; ?>/ie6/assets/img/favicon.ico" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style type="text/css">
            .error, .alert {
                background: #fbe3e4;
                color: #8a1f11;
                border-color: #fbc2c4;
            }

            .error, .alert, .notice, .success, .info {
                padding: 0.8em;
                margin-bottom: 1em;
                border: 2px solid #ddd;
            }

            a:hover{
                text-decoration:none;
            }

            input {
                width: 100%;
            }

        </style>
    </head>
    <body>
        <div class="site-header">
            <div class="col width-fit mobile-width-fit">
                <div class="cell">
                    <a href="#" class="logo"></a>
                </div>
            </div>
            <div class="col width-fill mobile-width-fill">
                <div class="cell">
                    <ul class="col nav">
                        <li class="active"><a href="#">Imigrasi</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="site-body">
            <div class="site-center" style="width:600px;">
                <div class="cell">
                    <?php echo $contents; ?>
                </div>
            </div>
        </div>
        <div class="site-footer-fixture">
            <div class="site-center">
                <div class="site-footer">
                    <div class="col">
                        <div class="cell">
                            <p style="text-align:center;">&copy; Copyright 2018</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <script src="<?php echo $assets; ?>/ie6/assets/js/app.js"></script> -->
    </body>
</html>