<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>::.HealthFreaks.::</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?php echo base_url('assets/site/css/custom-css.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/site/css/bootstrap.css') ?>" rel="stylesheet">
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="<?php echo base_url('assets/site/') ?>/js/bootstrap.min.js"></script>
        <!-- validation picker -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/lib/') ?>/validation-engine/css/validationEngine.jquery.css" />
        <script src="<?php echo base_url('assets/lib/') ?>/validation-engine/js/languages/jquery.validationEngine-en.js"></script>      
        <script src="<?php echo base_url('assets/lib/') ?>/validation-engine/js/jquery.validationEngine.js"></script>      
    </head>
    <body>
        <div class="container">
            <div class="visi-center">
                <a class="brand" href="<?php echo base_url() ?>">
                    <img src="<?php echo base_url('assets/site/') ?>/img/logo.png" class="img-responsive logo" alt="Healthfreaks" />
                </a>
            </div>
        </div>

        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="nav-collapse collapse">
                        <ul class=" nav nav-pills pull-right">
                            <li class="active"><a href="<?php echo c_site_url() ?>">HOME</a></li>
                            <li><a href="<?php echo c_site_url('support') ?>">SUPPORT</a></li>
                            <li>
                                <?php if($this->ion_auth->logged_in()): ?>
                                    <a href="<?php echo c_site_url('user/logout') ?>">LOGOUT</a>
                                <?php else: ?>
                                    <a href="<?php echo c_site_url('home/login') ?>">LOGIN</a>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="top-blue-line"></div>
        <div class="top-blue-ribion "> 
            <div class="container">
                <img src="<?php echo base_url('assets/site/') ?>/img/head-down.png" align="right" class="visible">
            </div>
        </div>
         <div id="top-space"></div>
         