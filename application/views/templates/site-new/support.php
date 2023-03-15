<div class="sub-container">
    <div class="space"></div>
    <div class="top-back">
        <h1>SUPPORT</h1>

        <div class="to-sp row">
            <form class="form-horizontal" name="support_form" id="support" action="" method="post">
                <span style="color: red;"><?php echo validation_errors(); ?></span>
                <?php show_flash_message(); ?>

                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="col-sm-2 l-padding">First Name*</label>
                        <div class="col-sm-4">
                            <input class="form-control text-box validate[required]" name="fname" value="<?php echo set_value('fname'); ?>">
                        </div>
                        <label class="col-sm-2 l-padding">Last Name*</label>
                        <div class="col-sm-4">
                            <input class="form-control text-box validate[required]" name="lname" value="<?php echo set_value('lname'); ?>">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="col-sm-2 l-padding">Email*</label>
                        <div class="col-sm-4">
                            <input class="form-control text-box validate[required]" name="email" value="<?php echo set_value('email'); ?>">
                        </div>
                        <label class="col-sm-2 l-padding">Username*</label>
                        <div class="col-sm-4">
                            <input class="form-control text-box validate[required]" name="phone" value="<?php echo set_value('phone'); ?>">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="col-sm-2 l-padding">Message*</label>
                        <div class="col-sm-4">
                            <textarea class="form-control text-box validate[required]" rows="4" name="message"><?php echo set_value('message'); ?></textarea>
                        </div>
                        <label class="col-sm-2 l-padding">Captcha*</label>
                        <div class="col-sm-4">
                            <input type="text" id="captcha_code" class="form-control text-box support-captcha" disabled />
                            <a href="javascript: void(0);" onClick="DrawCaptcha();"><img src="<?php echo base_url('assets/user') ?>/images/refresh.png" height="30" width="30" title="refresh captcha" /></a>
                        </div>

                        <label class="col-sm-2 l-padding"></label>
                        <div class="col-sm-4 l-padding2">
                            <input class="form-control text-box validate[required]" name="" >
                        </div>
                        <label class="col-sm-2 l-padding"></label>

                        <div class="col-sm-4 l-padding2">
                            <button type="submit" class="btn btn-blue">Submit</button>
                            <button type="submit" class="btn btn-blue">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<style>
    .support-captcha{
        text-align: center;
        border: 1px solid #C8D8E1;
        width: 80%;
        margin: 0px 13px 0 0;
        font-weight: bold;
        font-family: verdana;
        background-color: #FFF;
        float: left;
    }
</style>
<script>
    $(document).ready(function() {
        $("#support").validationEngine();
    });
</script>
<script>
    jQuery(document).ready(function() {
        DrawCaptcha();
    });

    function DrawCaptcha()
    {
        var a = Math.ceil(Math.random() * 10) + '';
        var b = Math.ceil(Math.random() * 10) + '';
        var c = Math.ceil(Math.random() * 10) + '';
        var d = Math.ceil(Math.random() * 10) + '';
        var e = Math.ceil(Math.random() * 10) + '';
        var f = Math.ceil(Math.random() * 10) + '';
        var g = Math.ceil(Math.random() * 10) + '';
        var code = a + ' ' + b + ' ' + ' ' + c + ' ' + d + ' ' + e + ' ' + f + ' ' + g;

        //alert(code);
        document.getElementById("captcha_code").value = code;

        code = removeSpaces(document.getElementById('captcha_code').value);
        $.post('<?php echo c_site_url("support/set_captcha_session"); ?>', {'code': code}, function(r) {
            //alert(r);
        })
    }

    //Validate the Entered input aganist the generated security code function
    function ValidCaptcha() {
        var str1 = removeSpaces(document.getElementById('captcha_code').value);
        var str2 = removeSpaces(document.getElementById('captcha').value);

        if (str2 == '') {
            alert('Please enter captcha code');
        } else if (str1 == str2) {
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