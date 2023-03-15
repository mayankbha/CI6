<?php //print_r($print_record_details); ?>

<div class="sub-container">
    <div id="box-bg">
        <div class="col-xs-12 bg-line">
        	<h2><?php echo $heading; ?></h2>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-lg-12">
                
                <form class="form-horizontal" style="padding-top: 20px;">
                
                <?php foreach($show_record_details as $key => $show_record_detail) { ?>

                    <div class="form-group">
                        <label class="col-xs-10 col-sm-4 col-lg-4 l-padding"><?php echo $key; ?></label>
                        <div class="col-xs-1 col-sm-1 col-lg-1 l-padding1">:</div>
                        <div class="col-xs-12 col-sm-6 col-lg-6"><?php echo $show_record_detail; ?></div>
                    </div>
                <?php } ?>
                
                <div class="form-group">
                    <label class="col-xs-10 col-sm-4 col-lg-4 l-padding"></label>
                    <div class="col-xs-1 col-sm-1 col-lg-1 l-padding1"></div>
                    <div class="col-xs-12 col-sm-6 col-lg-6"></div>
                </div>
                
                </form>
                
        </div>
        
        <div class="clearfix"></div>
        
    </div>

</div>