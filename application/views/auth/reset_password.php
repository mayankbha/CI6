<div class="container">
    <div class="login-box">
        <div class="clearfix">&nbsp;</div>
        <div class="clearfix hide-xs">&nbsp;</div>    
        <div class="clearfix hide-xs">&nbsp;</div>
        <div class="clearfix hide-xs">&nbsp;</div>
        <div class="row">
            <div class="login-title-txt">CHANGE PASSWORD</div>
        </div>
        <div class="clearfix">&nbsp;</div>
        <div class="row login-box2" style="margin-top: -14px !important;">
            <div class="span5 log-in">CHANGE PASSWORD</div>
            <div class="login-form-area" style="padding-top: 34px !important;">
            
                <?php echo form_open('auth/reset_password/' . $code);?>
                
                    <div id="control-group"><?php echo $message; ?></div>
                    
                    <div class="control-group login-grp">
                        <label class="control-label cus-login-control-label" for="inputEmail" style="width: 70% !important; font-size: 14px !important;"><?php echo sprintf(lang('reset_password_new_password_label'), $min_password_length);?></label>
                        <?php echo form_input($new_password);?>
                    </div>
                    
                    <div class="control-group login-grp">
                    	<label class="control-label cus-login-control-label" for="inputEmail" style="width: 70% !important;"><?php echo lang('reset_password_new_password_confirm_label', 'new_password_confirm'); ?></label>
						<?php echo form_input($new_password_confirm); ?>
        			</div>
                
                    <div class="control-group login-grp">
                        <div class="controls cus-control forgot">
                            <a href="<?php echo c_site_url('home/login'); ?>">BACK</a>
                            <span class="login-submit">
                                <?php echo form_submit('submit', lang('reset_password_submit_btn'));?>
                            </span>
                        </div>
                    </div>
                    
                    <?php echo form_input($user_id); ?>
					<?php echo form_hidden($csrf); ?>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>




	<p>
		<label for="new_password"></label> <br />
		
	</p>

	<p>
		
	</p>

	

	<p></p>

