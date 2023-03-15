<div class="container">
    <div class="login-box " >
        <div class="clearfix">&nbsp;</div>
        <div class="clearfix hide-xs">&nbsp;</div>    
        <div class="clearfix hide-xs">&nbsp;</div>
        <div class="clearfix hide-xs">&nbsp;</div>
        <div class="row">
            <div class="login-title-txt">FORGOT PASSWORD</div>
        </div>
        <div class="clearfix">&nbsp;</div>
        <div class="row login-box2" style="">
            <div class="span5 log-in"  >FORGOT PASSWORD</div>
            <div class="login-form-area" style="padding-top: 34px !important;">
                <form action="" method="post">
                    <div id="control-group" style="color: red;"><?php echo $message; ?></div>
                    <div class="control-group login-grp">
                        <label class="control-label cus-login-control-label" for="inputEmail" style="width: 50% !important;"><?php echo sprintf( $identity_label); ?></label>
                        <?php echo form_input($email); ?>
                    </div>
                    <div class="control-group login-grp">
                        <div class="controls cus-control forgot">
                            <a href="<?php echo c_site_url('home/login'); ?>">BACK</a>
                            <span class="login-submit">
                                <input type="image" src="<?php echo base_url('/assets/site/') ?>/img/login.png">
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>