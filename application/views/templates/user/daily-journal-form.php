<div class="sub-container">
    <div id="box-bg">
        <div class="col-xs-12 bg-line">
        	<h2>A DAILY JOURNAL FOR YOUR HEALTHY LIFESTYLE</h2>

            <?php if(isset($id) && $id != '') { ?>
				<div style="border: 0px solid; margin-left: 690px; margin-top: -54px; position: absolute; width: 100px;">
					<a href="javascript: void(0);" onclick="delete_record(<?php echo $id; ?>);" class="btn btn-primary"><i class="glyphicon glyphicon-trash"></i></a>
                    &nbsp;
                    <a href="<?php echo c_site_url('daily_journal/print_record/'.$id); ?>" target="_blank" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i></a>
                    <br />
					&nbsp;&nbsp;<font style="font-size: 10px !important;">Trash</font>&nbsp;&nbsp;
					<font style="font-size: 10px !important;">View/Print</font>
				</div>
			<?php } ?>

        </div>
        
        <div class="col-xs-12 col-sm-12 col-lg-12">

            <form class="form-horizontal" id="daily_journal" method="post" action="" style="padding-top:20px;">
            
            	<?php 
                    echo validation_errors(); 
                    echo isset($file_error) ? $file_error : NULL;
                    show_flash_message();
                ?>
                
                <div class="form-group">
                    <label class="col-xs-10 col-sm-4 col-lg-4 l-padding">Date<i style="color:#FF0000;">*</i></label>
                    <div class="col-xs-12 col-sm-6 col-lg-6">
                        <input id="date_time" class="form-control validate[required]" value="<?php echo isset($form->dtime) ? date('Y/m/d H:i',strtotime($form->dtime)) : '' ; ?>" name="dtime">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-10 col-sm-4 col-lg-4 l-padding">Title<i style="color:#FF0000;">*</i></label>
                    <div class="col-xs-12 col-sm-6 col-lg-6">
                        <input class="form-control validate[required]" value="<?php echo isset($form->title) ? $form->title : '' ; ?>" name="title">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-10 col-sm-4 col-lg-4 l-padding">Type details of your day here</label>
                    <div class="col-xs-12 col-sm-6 col-lg-6">
                        <textarea class="form-control" name="details" rows="6"><?php echo isset($form->details) ? $form->details : '' ; ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-10 col-sm-4 col-lg-4 l-padding"></label>
                    <div class="col-xs-1 col-sm-1 col-lg-1 l-padding1"></div>
                    <div class="col-xs-12 col-sm-6 col-lg-6">
                        <button type="submit" name="submit" value="1" class="btn btn-yellow"><?php if($id){ echo 'UPDATE'; } else { echo 'SUBMIT'; } ?></button>
                    </div>
                </div>

            </form>

        </div>
        <div class="clearfix"></div>
    </div>

    <div id="box-bg">
        <div class="col-xs-12 bg-line"><h2>HISTORY</h2></div>
        <div class="col-xs-12">&nbsp;</div>
        <div id='calendar'></div> <!--------calendar------>
        <div class="col-xs-12">&nbsp;</div>
        <div class="clearfix"></div>
    </div>

</div>

<style>
    body {background: url(<?php echo base_url('assets/user/') ?>/img/bg-journal.jpg) center top no-repeat; background-attachment: fixed;}
</style>

<script>

	function delete_record(id) {
		var con = confirm('Are you sure you want to delete this record?');
		
		if(con) {
			$.post("<?php echo c_site_url('daily_journal/delete_record/'); ?>", {'id' : id}, function(r){
				//alert(r);
				window.location = '<?php echo c_site_url('daily_journal'); ?>';
			})
		}
	}
	
    $(document).ready(function() {

        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        $('#calendar').fullCalendar({
            theme: true,
            header: {
                left: 'prev,next',
                center: 'title',
                right: ''
            },
            editable: true,
            eventDurationEditable: false,
            eventDrop: function(event,dayDelta,minuteDelta,allDay,revertFunc) {
                jQuery.post("<?php echo site_url('daily_journal/ajax') ?>",{changed:dayDelta,eventId:event.id},function(r){
                    <?php if($id){ ?>
                        if(event.id==<?php echo $id ?>){
                            jQuery('#date_time').val(r);
                        }
                    <?php } ?>
                    alert(event.title+"\'s date changed successfully");
                });
            },
            eventClick: function(calEvent, jsEvent, view) {
                window.top.location='<?php echo c_site_url("daily_journal/index/") ?>/'+calEvent.id;
            },
            events: [
                
                <?php 
                    if($events){ $i=1;
                        foreach ($events as $event) {
                ?>
                    {
                        title: '<?php echo $event->title ?>',
                        start: new Date(<?php echo date('Y', strtotime($event->dtime)) ?>,<?php echo date('m', strtotime($event->dtime))-1 ?>,<?php echo date('d',strtotime($event->dtime)) ?>),
                        id: '<?php echo $event->id ?>'
                    }<?php if($i!=count($events)){ ?>,<?php } ?>
                <?php
                     $i++;   }
                    }
                ?>
            ]
        });

    });
    
    $(document).ready(function(){
		$("#daily_journal").validationEngine();
		
        $('#date_time').datetimepicker({
            /*mask:'9999/19/39 29:59',*/
        });
    });
</script>