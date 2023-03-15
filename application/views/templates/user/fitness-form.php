<script type="text/javascript" src="<?php echo c_site_url('assets/ckeditor'); ?>/ckeditor.js"></script>

<div class="sub-container">
    <div id="box-bg">
        <div class="col-xs-12 bg-line"><h2>CREATE YOUR FITNESS SCHEDULE</h2></div>
        
        <?php if(isset($id) && $id != '') { ?>
			<div style="border: 0px solid; margin-left: 700px; margin-top: 8px; position: absolute; width: 100px;">
				<a href="javascript: void(0);" onclick="delete_record(<?php echo $id; ?>);" class="btn btn-primary"><i class="glyphicon glyphicon-trash"></i></a>
                &nbsp;
                <a href="<?php echo c_site_url('fitness/print_record/'.$id); ?>" target="_blank" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i></a>
                <br />
				&nbsp;&nbsp;<font style="font-size: 10px !important;">Trash</font>&nbsp;&nbsp;
				<font style="font-size: 10px !important;">View/Print</font>
			</div>
		<?php } ?>
            
        <div class="col-xs-12 col-sm-12 col-lg-12">

            <form class="form-horizontal" id="fitness" method="post" action="" style="padding-top:20px;">
            
            	<?php
                    echo validation_errors();
                    echo isset($file_error) ? $file_error : NULL;
                    show_flash_message();
                ?>

                <div class="form-group">
                    <label class="col-xs-10 col-sm-4 col-lg-4 l-padding">Date<i style="color:#FF0000;">*</i></label>
                    <div class="col-xs-12 col-sm-6 col-lg-6">
                        <input id="date_time" class="form-control validate[required]" value="<?php echo isset($form->dtime) ? date('Y/m/d H:i', strtotime($form->dtime)) : '' ; ?>" name="dtime">
                    </div>
                </div>
                
                <div class="form-group">
                
                    <label class="col-xs-10 col-sm-4 col-lg-4 l-padding" style="width: 34% !important;">Privacy Status</label>
                    
                    <div class="col-xs-12 col-sm-6 col-lg-6">

                        <div  class="col-xs-1 col-sm-1 col-lg-1 l-space">
                            <div class="checkbox-green">
                                <input type="checkbox" name="privacy_status" id="privacy_status_public" value="0" <?php if(@$form->privacy_status == '0') { ?>checked="checked"<?php } else if(@$form->privacy_status != '1') { ?>checked="checked"<?php } ?> />
                                <label for="privacy_status_public"></label>
                            </div>
                        </div>
                        <label class="col-xs-12 col-sm-2 col-lg-2 l-space" style="width: 30% !important;">Make Public</label>

                        <div  class="col-xs-11 col-sm-1 col-lg-1 l-space">
                            <div class="checkbox-green">
                                <input type="checkbox" name="privacy_status" id="privacy_status_private" value="1" <?php if(@$form->privacy_status == '1') { ?>checked="checked"<?php } ?> />
                                <label for="privacy_status_private"></label>
                            </div>
                        </div>
                        <label class="col-xs-12 col-sm-3 col-lg-3 l-space">Make Private</label>

                    </div>
                    
                </div>
                
                <div class="form-group">
                    <label class="col-xs-10 col-sm-4 col-lg-4 l-padding">Title<i style="color:#FF0000;">*</i></label>
                    <div class="col-xs-12 col-sm-6 col-lg-6">
                        <input class="form-control validate[required]" value="<?php echo isset($form->title) ? $form->title : '' ; ?>" name="title">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-xs-10 col-sm-4 col-lg-4 l-padding">Type details of workout here</label>
                    <div class="col-xs-12 col-sm-6 col-lg-6">
                        <textarea class="ckeditor" name="description" rows="6"><?php echo isset($form->description) ? $form->description : '' ; ?></textarea>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-xs-10 col-sm-4 col-lg-4 l-padding">Calories Burned</label>
                    <div class="col-xs-12 col-sm-6 col-lg-6">
                        <input class="form-control" value="<?php echo isset($form->calories) ? $form->calories : '' ; ?>" name="calories">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-xs-10 col-sm-4 col-lg-4 l-padding">Cardio Minutes</label>
                    <div class="col-xs-12 col-sm-6 col-lg-6">
                        <input class="form-control" value="<?php echo isset($form->cardio) ? $form->cardio : '' ; ?>" name="cardio">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-xs-10 col-sm-4 col-lg-4 l-padding">Supplements</label>
                    <div class="col-xs-12 col-sm-6 col-lg-6">
                        <input class="form-control" value="<?php echo isset($form->supplements) ? $form->supplements : '' ; ?>" name="supplements">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-xs-10 col-sm-4 col-lg-4 l-padding">Notes</label>
                    <div class="col-xs-12 col-sm-6 col-lg-6">
                        <textarea class="form-control" name="notes" rows="6"><?php echo isset($form->notes) ? $form->notes : '' ; ?></textarea>
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
        <div class="col-xs-12 bg-line"><h2>FITNESS HISTORY</h2></div>
        <div class="col-xs-12">&nbsp;</div>
        <div id='calendar'></div> <!--------calendar------>
        <div class="col-xs-12">&nbsp;</div>
        <div class="clearfix"></div>
    </div>

</div>
<style>
    body {background: url(<?php echo base_url('assets/user/') ?>/images/history-bg.jpg) center top no-repeat;}
</style>
<script>

	function delete_record(id) {
		var con = confirm('Are you sure you want to delete this record?');
		
		if(con) {
			$.post("<?php echo c_site_url('fitness/delete_record/'); ?>", {'id' : id}, function(r){
				//alert(r);
				window.location = '<?php echo c_site_url('fitness'); ?>';
			})
		}
	}

    $(document).ready(function() {

		$("input:checkbox").click(function() {
			if($(this).is(":checked")) {
				var group = "input:checkbox[name='privacy_status']";
				$(group).prop("checked", false);
				$(this).prop("checked", true);
			} else {
				$(this).prop("checked", false);
			}
		});

		$("#fitness").validationEngine();

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
                jQuery.post("<?php echo site_url('fitness/ajax') ?>",{changed:dayDelta,eventId:event.id},function(r){
                    <?php if($id){ ?>
                        if(event.id==<?php echo $id ?>){
                            jQuery('#date_time').val(r);
                        }
                    <?php } ?>
                    alert(event.title+"\'s date changed successfully");
                });
            },
            eventClick: function(calEvent, jsEvent, view) {
                window.top.location='<?php echo c_site_url("fitness/index/") ?>/'+calEvent.id;
            },
            events: [
                
                <?php 
                    if($events){ $i=1;
                        foreach ($events as $event) {
                ?>
                    {
                        title: '<?php echo $event->title ?>',
                        start: new Date(<?php echo date('Y',strtotime($event->dtime)) ?>,<?php echo date('m',strtotime($event->dtime))-1 ?>,<?php echo date('d',strtotime($event->dtime)) ?>),
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
        $('#date_time').datetimepicker({
            /*mask:'9999/19/39 29:59',*/
        });
    });
</script>