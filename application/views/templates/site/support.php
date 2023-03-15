<script>
	jQuery(document).ready(function(){
		 DrawCaptcha();
	});

	function DrawCaptcha()
	{
		var a = Math.ceil(Math.random() * 10)+ '';
		var b = Math.ceil(Math.random() * 10)+ '';
		var c = Math.ceil(Math.random() * 10)+ '';
		var d = Math.ceil(Math.random() * 10)+ '';
		var e = Math.ceil(Math.random() * 10)+ '';
		var f = Math.ceil(Math.random() * 10)+ '';
		var g = Math.ceil(Math.random() * 10)+ '';
		var code = a + ' ' + b + ' ' + ' ' + c + ' ' + d + ' ' + e + ' '+ f + ' ' + g;

		//alert(code);
		document.getElementById("captcha_code").value = code;

		code = removeSpaces(document.getElementById('captcha_code').value);
		$.post('<?php echo c_site_url("support/set_captcha_session"); ?>', {'code' : code}, function(r) {
			//alert(r);
		})
	}

	//Validate the Entered input aganist the generated security code function
	function ValidCaptcha() {
		var str1 = removeSpaces(document.getElementById('captcha_code').value);
		var str2 = removeSpaces(document.getElementById('captcha').value);

		if(str2 == '') {
			alert('Please enter captcha code');
		} else if(str1 == str2) {
			return true;
		} else {
			alert('Invalid captcha code');
			DrawCaptcha();
			return false;
		}
	}

	//Remove the spaces from the entered and generated code
	function removeSpaces(string)
	{
		return string.split(' ').join('');
	}

</script>

<div class="support-white-space-top"> </div>
<div class="container">
    <div class="support-box">
        <div class="clearfix">&nbsp;</div>
        <div class="clearfix">&nbsp;</div>    
        <div class="clearfix hide-xs">&nbsp;</div>
        <div class="clearfix hide-xs">&nbsp;</div>
        <div class="row support-inner-box">

			<noscript>
				<span style="color: #FF0000; font-size: 20px;">This page needs JavaScript activated to work.</span>
			</noscript>

            <div class="span4">
                <div class="support-title-txt">SUPPORT</div>
                <div class="support-form-area">
                    <form name="support_form" id="support" action="" method="post">
                    	
                    	<span style="color: red;"><?php echo validation_errors(); ?></span>
						<?php show_flash_message(); ?>
                
                        <div class="control-group supt-grp">
                            <label for="inputEmail" class="control-label cus-supt-control-label ">FIRST NAME<i style="color:#FF0000;">*</i></label>
                            <div class="controls cus-control">
                                <input type="text" name="fname" class="cus-input-front validate[required]" value="<?php echo set_value('fname'); ?>" />
                            </div>
                        </div>
                        <div class="control-group supt-grp">
                            <label for="inputPassword" class="control-label cus-supt-control-label">LAST NAME<i style="color:#FF0000;">*</i></label>
                            <div class="controls cus-control">
                                <input type="text" name="lname" class="cus-input-front validate[required]" value="<?php echo set_value('lname'); ?>" />
                            </div>
                        </div>
                        <div class="control-group supt-grp">
                            <label for="inputPassword" class="control-label cus-supt-control-label">EMAIL<i style="color:#FF0000;">*</i></label>
                            <div class="controls cus-control">
                                <input type="text" name="email" class="cus-input-front validate[required]" value="<?php echo set_value('email'); ?>" />
                            </div>
                        </div>
                        <div class="control-group supt-grp">
                            <label for="inputPassword" class="control-label cus-supt-control-label">USERNAME<i style="color:#FF0000;">*</i></label>
                            <div class="controls cus-control">
                                <input type="text" name="username" class="cus-input-front validate[required]" id="inputPhone" value="<?php echo set_value('phone'); ?>" />
                            </div>
                        </div>
                        <!--<div class="control-group supt-grp">
                            <label for="inputPassword" class="control-label cus-supt-control-label">USERNAME<i style="color:#FF0000;">*</i></label>
                            <div class="controls cus-control">
                                <input type="text" name="username" class="cus-input-front validate[required]">
                            </div>
                        </div>-->
                </div>
            </div>
            <div class="span4 supt-box">
                <div class="clearfix hide-xs">&nbsp;</div>
                <div class="clearfix hide-xs">&nbsp;</div>

                <div class="control-group supt-grp">
                    <label for="inputPassword" class="control-label cus-supt-control-label">MESSAGE<i style="color:#FF0000;">*</i></label>
                    <div class="controls cus-control">
						<textarea rows="6" name="message" class="cus-input-front validate[required]"><?php echo set_value('message'); ?></textarea>
                    </div>
                </div>

                <div class="control-group supt-grp">
               		<label for="inputPassword" class="control-label cus-supt-control-label">CAPTCHA<i style="color:#FF0000;">*</i></label>
                    <div class="controls cus-control">
                    	<input type="text" name="captcha" id="captcha" class="cus-input-front validate[required]" />
                    	<input type="text" id="captcha_code" class="span4" style="height: 20px; width: 180px; text-align: center; border: none; font-weight: bold; font-family: verdana;" disabled />
                        <a href="javascript: void(0);" onClick="DrawCaptcha();"><img src="<?php echo base_url('assets/user') ?>/images/refresh.png" height="30" width="30" title="refresh captcha" /></a>
          				<!--<input type="button" id="btnrefresh" value="Refresh" onClick="DrawCaptcha();" />-->
                        <!--<img src="<?php echo c_site_url('support/create_captcha'); ?>" id="captcha" />-->
                        <!--<a href="javascript: void(0);" onClick="document.getElementById('captcha').src='<?php echo c_site_url('support/create_captcha'); ?>'" id="change-image">Refresh Text.</a>-->
                        
                        	<div class="subt-btn">
                            	<input type="image" src="<?php echo base_url('assets/site') ?>/img/supt-submit-btn.png" name="submit" id="submit">

                            	<input type="image" src="<?php echo base_url('assets/site') ?>/img/supt-cancel-btn.png" name="clear" id="clear" onclick="window.history.go(-1);">
                       	 	</div>
						</form>
                    </div>
                </div>

                <div class="supt-msg-txt"></div>
            </div>
            <div class="span2"><div class="clearfix">&nbsp;</div>
                <div class="support-pic"><img src="<?php echo base_url('assets/site') ?>/img/supt-pic.png" class="img-responsive" style="max-width: none ! important; margin-top: 11px;"></div>
            </div>
            </div>
    </div>
</div>

<script>
	$(document).ready(function() {
		$("#support").validationEngine();
	});
</script>