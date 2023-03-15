<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Health Freeks</title>

        <!-- Core CSS - Include with every page -->
        <link href="<?php echo base_url('assets/admin') ?>/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url('assets/admin') ?>/font-awesome/css/font-awesome.css" rel="stylesheet">

        <!-- Page-Level Plugin CSS - Dashboard -->
        <link href="<?php echo base_url('assets/admin') ?>/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
        <link href="<?php echo base_url('assets/admin') ?>/css/plugins/timeline/timeline.css" rel="stylesheet">

        <!-- SB Admin CSS - Include with every page -->
        <link href="<?php echo base_url('assets/admin') ?>/css/sb-admin.css" rel="stylesheet">

        <!-- Core Scripts - Include with every page -->
        <script src="<?php echo base_url('assets/admin') ?>/js/jquery-1.10.2.js"></script>
        <script src="<?php echo base_url('assets/admin') ?>/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url('assets/admin') ?>/js/plugins/metisMenu/jquery.metisMenu.js"></script>

        <!-- Page-Level Plugin Scripts - Dashboard -->
        <script src="<?php echo base_url('assets/admin') ?>/js/plugins/morris/raphael-2.1.0.min.js"></script>
        <script src="<?php echo base_url('assets/admin') ?>/js/plugins/morris/morris.js"></script>

        <!-- SB Admin Scripts - Include with every page -->
        <script src="<?php echo base_url('assets/admin') ?>/js/sb-admin.js"></script>

    </head>

    <body>
        <div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sign In</h3>
                </div>
                <div class="panel-body">
                    <?php if(isset($message) && !empty($message)): ?>
                        <div id="infoMessage" class="alert alert-warning"><?php echo $message;?></div>
                    <?php endif; ?>
                    <?php
                    $attributes = array('role' => 'role', 'id' => 'myform');
                    echo form_open(c_site_url("admin/auth/login"), $attributes);
                    ?>
                        <fieldset>
                            <div class="form-group">
                                <?php echo form_input($identity);?>
                            </div>
                            <div class="form-group">
                                <?php echo form_input($password);?>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <?php echo form_checkbox('remember', 'Remember Me', FALSE, 'id="remember"');?> Remember Me
                                </label>
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <input type="submit" class="btn btn-lg btn-success btn-block" value="Login" name="login"/>
                        </fieldset>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
</div>
    </body>

</html>
