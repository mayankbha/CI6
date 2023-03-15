<style>
	body {
		line-height: 14px !important;
	}
</style>

<div class="container">
    <div class="login-box " >
        <div class="clearfix">&nbsp;</div>
        <div class="clearfix hide-xs">&nbsp;</div>    
        <div class="clearfix hide-xs">&nbsp;</div>
        <div class="clearfix hide-xs">&nbsp;</div>
        <div class="row">
            <div class="login-title-txt">LOGIN</div>
        </div>
        <div class="clearfix">&nbsp;</div>
        <div class="row login-box2">
            <div class="span5 log-in"  >LOGIN</div>
            <div class="login-form-area">
                <form action="" method="post" id="loginForm">
                
                    <div id="control-group"><?php echo $message; ?></div>
                    <div class="control-group login-grp">
                        <label class="control-label cus-login-control-label " for="inputEmail">USERNAME<i style="color:#FF0000;">*</i></label>
                        <div class="controls cus-control">
                            <?php echo form_input($identity);?>
                        </div>
                    </div>
                    <div class="control-group login-grp">
                        <label class="control-label cus-login-control-label" for="inputPassword">PASSWORD<i style="color:#FF0000;">*</i></label>
                        <div class="controls cus-control">
                            <?php echo form_input($password);?>
                        </div>
                    </div>
                    <div class="control-group login-grp">
                        <div class="controls cus-control forgot">
                            <a href="<?php echo c_site_url('home/forgot_password'); ?>">FORGOT PASSWORD ?</a>
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
<script type="text/javascript">
    $(document).ready(function(){
        $('#loginForm').validationEngine();
    });
</script>