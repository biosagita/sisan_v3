<form method="post" action="<?php echo $url_login; ?>" id="login_form" data-parsley-validate>
    <input type="hidden" name="hd_login" id="hd_login" value="1">
    <div class="content-box wow bounceInDown modal-content">
        <h3 class="content-box-header content-box-header-alt bg-default">
            <span class="icon-separator">
                <i class="glyph-icon icon-lock"></i>
            </span>
            <span class="header-wrapper">
                Admin area
                <small>Login to your account.</small>
            </span>
            <!--<span class="header-buttons">
                <a href="#" class="btn btn-sm btn-primary" title="">Sign Up</a>
            </span>-->
        </h3>

        <?php if(!empty($login_errmsg)) : ?>
            <div class="alert alert-danger">
                <p><?php echo $login_errmsg; ?></p>
            </div>
        <?php endif; ?>

        <div id="login_errmsg" class="alert alert-danger" style="display:none"></div>

        <div class="content-box-wrapper">
            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control" name="txt_username" id="txt_username" placeholder="Username" required>
                    <span class="input-group-addon bg-blue">
                        <i class="glyph-icon icon-user"></i>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <input type="password" class="form-control" name="psw_password" id="psw_password" placeholder="Password" required>
                    <span class="input-group-addon bg-blue">
                        <i class="glyph-icon icon-unlock-alt"></i>
                    </span>
                </div>
            </div>
            <button class="btn btn-success btn-block" id="login_btn_signin">Sign In</button>
        </div>
    </div>
</form>