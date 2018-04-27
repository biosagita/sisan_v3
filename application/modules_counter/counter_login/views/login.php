<div class="col">
    <div class="cell panel">
        <div class="body">
            <div class="cell">
                <div class="col">
                        <div style="padding: 0 10px 10px 10px;text-align: center;">
                            <a style="font-size:20px;" href="<?php echo $url_changeloket; ?>">LOGIN ROOM: <strong><?php echo $loket_name; ?></strong></a>
                        </div>
                        <?php if(!empty($login_errmsg)) : ?>
                            <div class="alert alert-danger">
                                <p><?php echo $login_errmsg; ?></p>
                            </div>
                        <?php endif; ?>
                        <form method="post" action="<?php echo $url_login; ?>" id="login_form" data-parsley-validate>
                        <input type="hidden" name="hd_login" id="hd_login" value="1">
                            <div class="col">
                                <div class="col width-1of4">
                                    <div class="cell">
                                        <label for="txt_username">Username<span class="color-red"> *</span></label>
                                    </div>
                                </div>
                                <div class="col width-1of2">
                                    <div class="cell">
                                        <input type="text" name="txt_username" id="txt_username" placeholder="Your username" data-required="true" data-error-message="Username is required" class="text parsley-validated">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="col width-1of4">
                                    <div class="cell">
                                        <label for="psw_password">Pasword<span class="color-red"> *</span></label>
                                    </div>
                                </div>
                                <div class="col width-1of2">
                                    <div class="cell">
                                        <input type="password" name="psw_password" id="psw_password" placeholder="Your password" data-required="true" data-error-message="Password is required" class="text parsley-validated">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="col width-1of4">
                                </div>
                                <div class="col width-fill">
                                    <div class="cell">
                                        <button class="button" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>