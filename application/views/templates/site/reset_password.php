<div class="container">
    <div class="login-box " >
        <div class="clearfix">&nbsp;</div>
        <div class="clearfix hide-xs">&nbsp;</div>    
        <div class="clearfix hide-xs">&nbsp;</div>
        <div class="clearfix hide-xs">&nbsp;</div>
        <div class="row">
            <div class="login-title-txt">RESET PASSWORD</div>
        </div>
        <div class="clearfix">&nbsp;</div>
        <div class="row login-box2" style="">
            <div class="span5 log-in"  >RESET PASSWORD</div>
            <div class="login-form-area">
                <form action="<?php echo c_site_url('home/reset_password/'.$code) ?>" method="post" >
                    <div id="control-group"><?php echo $message;?></div>
                    <div class="control-group login-grp">
                        <label class="control-label cus-login-control-label " for="new_password">NEW PASSWORD</label>
                        <?php echo form_input($new_password);?>
                    </div>
                    <div class="control-group login-grp">
                        <label class="control-label cus-login-control-label " for="new_password">CONFIRM PASSWORD</label>
                        <?php echo form_input($new_password_confirm);?>
                    </div>
                    <div class="control-group login-grp">
                        <div class="controls cus-control forgot">
                            <span class="login-submit">
                                <?php echo form_input($user_id);?>
                                <?php echo form_hidden($csrf); ?>
                                <input type="image" src="<?php echo base_url('/assets/site/') ?>/img/login.png">
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>