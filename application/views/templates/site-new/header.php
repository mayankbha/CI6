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
        <link href="<?php echo base_url('assets/site-new/') ?>/dist/css/bootstrap.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="<?php echo base_url('assets/site-new/') ?>/css/style2.css" rel="stylesheet">
        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src="docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <script src="<?php echo base_url('assets/site-new/') ?>/js/jquery-1.10.2.min.js"></script>
        <script src="<?php echo base_url('assets/site-new/') ?>/dist/js/bootstrap.min.js"></script>
        
        <!-- validation picker -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/lib/') ?>/validation-engine/css/validationEngine.jquery.css" />
        <script src="<?php echo base_url('assets/lib/') ?>/validation-engine/js/languages/jquery.validationEngine-en.js"></script>      
        <script src="<?php echo base_url('assets/lib/') ?>/validation-engine/js/jquery.validationEngine.js"></script>
    </head>
    <body>
        <div class="top-border"></div>
        <div class="container">
            <div class="logo"><a href="<?php echo c_site_url() ?>"><img src="<?php echo base_url('assets/site-new/') ?>/images/logo.png" alt="" border="0" /></a></div>
            <div class="navbar" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo c_site_url() ?>">Home</a></li>
                        <li><a href="<?php echo c_site_url('support') ?>">Support</a></li>
                        <li><a href="<?php echo c_site_url('mobile_apps') ?>">Mobile Apps</a></li>
                        <li><a href="<?php echo c_site_url('home/login') ?>">Login</a></li>
                    </ul>
                </div>
                <!--/.nav-collapse -->
                <div class="clearfix"></div>
            </div>