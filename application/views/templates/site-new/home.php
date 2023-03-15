<div class="container">
    <div class="space2"></div>
    <div class="left-part">
        <table border="0" cellspacing="0" cellpadding="0" class="cent">
            <tr>
                <td><h1>Holidays Are Here,</h1></td>
            </tr>
        </table>
        <table border="0" cellspacing="0" cellpadding="0" class="cent">
            <tr>
                <td><h2>Time To Stay In Shape!</h2></td>
            </tr>
        </table>
    </div>
    <div class="right-part">
        <div class="fo-top">
            IT'S 100% FREE,
            <p>NO CREDIT CARD EVER REQUIRED!</p>
        </div>
        <div class="fo-boto">

            <form class="form-horizontal" method="post" action="" id="registerForm" autocomplete="off">
                <div id="control-group">
                    <span style="color: red;"><?php echo $message; ?></span>
                </div>
                <div class="col-xs-12 top-pad">
                    <label class="col-sm-4 l-padding">NAME*</label>
                    <div class="col-sm-8 pad-left">
                        <?php echo form_input($name); ?>
                    </div>
                </div>

                <div class="col-xs-12 top-pad">
                    <label class="col-sm-4 l-padding">EMAIL*</label>
                    <div class="col-sm-8 pad-left">
                        <?php echo form_input($email); ?>
                    </div>
                </div>

                <div class="col-xs-12 top-pad">
                    <label class="col-sm-4 l-padding">USERNAME*</label>
                    <div class="col-sm-8 pad-left">
                        <?php echo form_input($username); ?>
                    </div>
                </div>

                <div class="col-xs-12 top-pad">
                    <label class="col-sm-4 l-padding">PASSWORD*</label>
                    <div class="col-sm-8 pad-left">
                        <?php echo form_input($password); ?>
                    </div>
                </div>

                <div class="col-xs-12 top-pad">
                    <label class="col-sm-4 l-padding">CAPTCHA*</label>
                    <div class="col-sm-8 pad-left">
                        <div class="cap">
                            <input type="text" id="captcha_code" class="form-control" style="width: 110px" disabled />
                        </div>
                        <div class="cap">
                            <input type="text" name="captcha" id="captcha" class="form-control validate[required]" />
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 top-pad">
                    <label class="col-sm-10 l-padding">AGREE TO TERMS &amp; CONDITIONS*</label>
                    <div class="col-sm-1 pad-left">
                        <div class="checkbox">
                            <?php echo form_checkbox('agree', '1', FALSE, 'id="checkbox"'); ?>
                            <label for="checkbox"></label>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12" align="center">
                    <button type="submit" class="btn btn-sign">Sign up now!</button>
                </div>

                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#registerForm').validationEngine();
    });
</script>
<script>
    jQuery(document).ready(function() {
        DrawCaptcha();
    });

    function DrawCaptcha()
    {
        var a = Math.ceil(Math.random() * 9) + '';
        var b = Math.ceil(Math.random() * 9) + '';
        var c = Math.ceil(Math.random() * 9) + '';
        var d = Math.ceil(Math.random() * 9) + '';
        var e = Math.ceil(Math.random() * 10) + '';
        var f = Math.ceil(Math.random() * 10) + '';
        //var g = Math.ceil(Math.random() * 10) + '';
        //var code = a + ' ' + b + ' ' + ' ' + c + ' ' + d + ' ' + e + ' ' + f + ' ' + g;
        var code = a + ' ' + b + ' ' + ' ' + c + ' ' + d + ' ' + e + ' ' + f;
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