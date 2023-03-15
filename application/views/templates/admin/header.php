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
        <script type="text/javascript">
            var BASEURL = '<?php echo base_url() ?>';
            var SITEURL = '<?php echo base_url() ?>';
        </script>
        <script src="<?php echo base_url('assets/admin') ?>/js/jquery-1.10.2.js"></script>
        <script src="<?php echo base_url('assets/admin') ?>/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url('assets/admin') ?>/js/plugins/metisMenu/jquery.metisMenu.js"></script>
       
        <?php if(current_url() == site_url('users') ) :?>
        <!-- Page-Level Plugin Scripts - Dashboard -->
        <script src="<?php echo base_url('assets/admin') ?>/js/plugins/morris/raphael-2.1.0.min.js"></script>
        <script src="<?php echo base_url('assets/admin') ?>/js/plugins/morris/morris.js"></script>
        <!-- Page-Level Demo Scripts - Dashboard - Use for reference -->
        <script src="<?php echo base_url('assets/admin') ?>/js/demo/dashboard-demo.js"></script>
        <?php endif; ?>
        
        <!--DatA Table-->
        <script type="text/javascript" src="<?php echo base_url('assets/lib/bootstrap-data-table/bootstrap-datatable.js'); ?>"></script>
            
        <!--Validation-->
        <link href="<?php echo base_url('assets/lib/validation-engine/css/validationEngine.jquery.css'); ?>" rel="stylesheet">
        <script type="text/javascript" src="<?php echo base_url('assets/lib/validation-engine/js/languages/jquery.validationEngine-en.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/lib/validation-engine/js/jquery.validationEngine.js'); ?>"></script>
        
        <!-- SB Admin Scripts - Include with every page -->
        <script src="<?php echo base_url('assets/admin') ?>/js/sb-admin.js"></script>
    </head>

    <body>

        <div id="wrapper">

            <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php c_site_url('users') ?>">HealthFreeks Admin</a>
                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a href="<?php echo c_site_url('admin/auth/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default navbar-static-side" role="navigation">
                    <div class="sidebar-collapse">
                        <ul class="nav" id="side-menu">
                            <li>
                                <a href="<?php c_site_url('admin') ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                            </li>
                            <li>
                                <a href="<?php echo c_site_url('admin/users') ?>"><i class="fa fa-users fa-fw"></i> Users <span class="fa arrow"></span></a>
                            </li>
                            
                        </ul>
                        <!-- /#side-menu -->
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>

            <div id="page-wrapper">