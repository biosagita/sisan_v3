<div id="mobile-navigation">
    <button id="nav-toggle" class="collapsed" data-toggle="collapse" data-target="#page-sidebar"><span></span></button>
    <a href="index.html" class="logo-content-small" title="MonarchUI"></a>
</div>
<div id="header-logo" class="logo-bg">
    <a href="index.html" class="logo-content-big" title="MonarchUI">
        Monarch <i>UI</i>
        <span>The perfect solution for user interfaces</span>
    </a>
    <a href="index.html" class="logo-content-small" title="MonarchUI">
        Monarch <i>UI</i>
        <span>The perfect solution for user interfaces</span>
    </a>
    <a id="close-sidebar" href="#" title="Close sidebar">
        <i class="glyph-icon icon-angle-left"></i>
    </a>
</div>
<div id="header-nav-left">
    <div class="user-account-btn dropdown">
        <a href="#" title="My Account" class="user-profile clearfix" data-toggle="dropdown">
            <img width="28" src="<?php echo $assets; ?>/image-resources/gravatar.jpg" alt="Profile image">
            <span><?php echo $admin_username; ?></span>
            <i class="glyph-icon icon-angle-down"></i>
        </a>
        <div class="dropdown-menu float-left">
            <div class="box-sm">
                <div class="login-box clearfix">
                    <div class="user-img">
                        <a href="#" title="" class="change-img">Change photo</a>
                        <img src="<?php echo $assets; ?>/image-resources/gravatar.jpg" alt="">
                    </div>
                    <div class="user-info">
                        <span>
                            <?php echo $admin_username; ?>
                            <i><?php echo $admin_userlevel; ?></i>
                        </span>
                        <a href="#" title="Edit profile">Edit profile</a>
                    </div>
                </div>
                <div class="pad5A button-pane button-pane-alt text-center">
                    <a id="logout_link" href="<?php echo $url_logout; ?>" class="btn display-block font-normal btn-danger">
                        <i class="glyph-icon icon-power-off"></i>
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</div><!-- #header-nav-left -->

<div id="header-nav-right">
    <a href="#" class="hdr-btn" id="fullscreen-btn" title="Fullscreen">
        <i class="glyph-icon icon-arrows-alt"></i>
    </a>
</div><!-- #header-nav-right -->