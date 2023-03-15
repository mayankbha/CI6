<div class="sub-container">
    <div class="space"></div>
    <div class="top-back loginfo">
        <h3>Login</h3>

        <div class="to-sp row">
            <div id="control-group"><?php echo $message; ?></div>
            <form class="form-horizontal" action="" method="post" id="loginForm">

                <div class="col-xs-12 row">
                    <label class="col-sm-3 l-padding">Username*</label>
                    <div class="col-sm-9">
                        <?php echo form_input($identity);?>
                    </div>
                </div>
                <div class="col-xs-12 row l-padding2">
                    <label class="col-sm-3 l-padding">Password*</label>
                    <div class="col-sm-9">
                        <?php echo form_input($password);?>
                    </div>
                </div>

                <div class="col-xs-12 row l-padding2">
                    <label class="col-sm-3 l-padding"></label>
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-blue">Login</button>
                        <a href="<?php echo c_site_url('home/forgot_password'); ?>" class="fo-pass">Forgot Password?</a>
                    </div>
                </div>

                <div class="clearfix"></div>
            </form>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#loginForm').validationEngine();
    });
</script>