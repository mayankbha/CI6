<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Health Freaks</title>
        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url('assets/user/') ?>/dist/css/bootstrap.css" rel="stylesheet">
        <!-- Custom styles for this template -->
    <!--    <link href="<?php echo base_url('assets/user/') ?>/css/style.css" rel="stylesheet">-->
        <link href="<?php echo base_url('assets/user/') ?>/css/main.css" rel="stylesheet">
        
        <!-- Custom styles for calendar -->
        <link rel='stylesheet' href='<?php echo base_url('assets/user/') ?>/fullcalendar/jquery-ui.min.css' />
        <link href='<?php echo base_url('assets/user/') ?>/fullcalendar/fullcalendar.css' rel='stylesheet' />
        <link href='<?php echo base_url('assets/user/') ?>/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />

        <script src="<?php echo base_url('assets/user/') ?>/lib/jquery.min.js"></script>
        
        <!--<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
		<script src="http://code.jquery.com/ui/1.8.21/jquery-ui.min.js"></script>-->
        
        <script src="<?php echo base_url('assets/') ?>/lib/cropper/jquery.ui.touch-punch.min.js"></script>

        <script src="<?php echo base_url('assets/user/') ?>/dist/js/bootstrap.min.js"></script>
        <script src='<?php echo base_url('assets/user/') ?>/lib/jquery-ui.custom.min.js'></script>
        <script src='<?php echo base_url('assets/user/') ?>/fullcalendar/fullcalendar.min.js'></script>

		<!--Browser detect script -->
		<script src='<?php echo base_url('assets/user/') ?>/lib/detectmobilebrowser.js'></script>

        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src="<?php echo base_url('assets/user/') ?>/docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        
        <!-- datetime picker -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/lib/') ?>/datetime/jquery.datetimepicker.css" />
        <script src="<?php echo base_url('assets/lib') ?>/datetime/jquery.datetimepicker.js"></script>      
        
        <!-- validation picker -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/lib/') ?>/validation-engine/css/validationEngine.jquery.css" />
        <script src="<?php echo base_url('assets/lib/') ?>/validation-engine/js/languages/jquery.validationEngine-en.js"></script>      
        <script src="<?php echo base_url('assets/lib/') ?>/validation-engine/js/jquery.validationEngine.js"></script>    

        <!-- Share This -->
        <!--<script type="text/javascript">var switchTo5x=true;</script>
        <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
        <script type="text/javascript">stLight.options({publisher: "6c759df6-a019-475c-b0e9-c317a7482e33", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>-->  
    </head>
    <body>
	<div style="border: 0px solid; bottom: 0;
    left: 880px;
    float: right;
    position: fixed;
    right: 0;
    text-align: right;
    width: 28%;
    z-index: 9999;">
	<?php if($this->uri->total_segments() != 3 && $this->uri->segment(1) != 'user_public_profile' && !$this->ion_auth->is_admin()) { ?>
		<a href="<?php echo c_site_url('support/request_feature'); ?>"><img src="<?php echo base_url('assets/user/') ?>/images/req_fea.png"/></a>
		<a href="<?php echo c_site_url('support/report_problem'); ?>"><img src="<?php echo base_url('assets/user/') ?>/images/req_pro.png"/></a>
	<?php } ?>
    </div>

		<?php //echo $this->uri->total_segments(); ?>

        <?php if($this->uri->total_segments() == 1 && $this->uri->segment(1) == 'user' && !$this->ion_auth->is_admin()) : ?>
            <div class="header">
                <div class="container">
                
                <div class="col-xs-12 col-sm-5 col-lg-4">
                	<a href="<?php echo c_site_url('support') ?>" class="support">SUPPORT</a> 
                    <a href="<?php echo c_site_url('user/my_account') ?>" class="support">MY ACCOUNT</a>
                </div>
   				<div class="col-xs-12 col-sm-5 col-lg-6 ple-cho">Please Choose An Option Below To Start</div>
   				<div class="col-xs-12 col-sm-2 col-lg-2 log-btn3"><a href="<?php echo c_site_url('user/logout') ?>" class="log-btn">Logout</a></div>                
                
                
                	<!--<div class="top-tab1"><a href="<?php echo c_site_url('support') ?>" class="support">SUPPORT</a></div>
                    <div class="top-tab2">Please Choose An Option Below To Start</div>
                    <div class="top-tab3"><a href="<?php echo c_site_url('user/logout') ?>" class="log-btn">Logout</a></div>-->
                    <div class="clearfix"></div>
                </div>
            </div>
        <?php elseif($this->uri->total_segments() == 3 && $this->uri->segment(1) == 'user_public_profile' && !$this->ion_auth->is_admin()) : ?>
            <div class="header1">
                <div class="container">
                    <div class="top-tab1"><a href="<?php echo c_site_url('support') ?>" class="support1">SUPPORT</a></div>
                    <div class="top-tab2"><a href="javascript: void(0);">&nbsp;</a></div>
                    <div class="top-tab3"><a href="<?php echo c_site_url('user/logout') ?>" class="log-btn1">Logout</a></div>
                    <div class="clearfix"></div>
                </div>
            </div>
        <?php elseif($this->uri->total_segments() == 1 && $this->uri->segment(1) == 'profile' && !$this->ion_auth->is_admin()) : ?>
            <div class="header1">
                <div class="container">
                    <div class="top-tab1"><a href="<?php echo c_site_url('support') ?>" class="support1">SUPPORT</a></div>
                    <div class="top-tab2"><a href="<?php echo c_site_url('user') ?>" class="back-btn">Go Back To Main Control Panel</a></div>
                    <div class="top-tab3"><a href="<?php echo c_site_url('user/logout') ?>" class="log-btn1">Logout</a></div>
                    <div class="clearfix"></div>
                </div>
            </div>
        <?php elseif($this->ion_auth->get_user_id() && !$this->ion_auth->is_admin()): ?>
        	<div class="header1">
                <div class="container">
                    <div class="top-tab1"><a href="<?php echo c_site_url('support') ?>" class="support1">SUPPORT</a></div>
                    <div class="top-tab2"><a href="<?php echo c_site_url('user') ?>" class="back-btn">Go Back To Main Control Panel</a></div>
                    <div class="top-tab3"><a href="<?php echo c_site_url('user/logout') ?>" class="log-btn1">Logout</a></div>
                    <div class="clearfix"></div>
                </div>
            </div>
		<?php else: ?>
        	<div class="header1">
                <div class="container">
                    <div class="top-tab1"><a href="<?php echo c_site_url('support') ?>" class="support1">SUPPORT</a></div>
                    <div class="top-tab2">&nbsp;</div>
                    <div class="top-tab3"><a href="<?php echo c_site_url('home/login') ?>" class="log-btn">Login</a></div>
                    <div class="clearfix"></div>
                </div>
            </div>
        <?php endif; ?>
        