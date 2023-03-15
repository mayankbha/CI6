<div class="sub-container">

    <div id="box-bg">
        <div class="col-xs-12 bg-line"><h2>SUBMIT YOUR TIPS, SUGGESTIONS AND MOTIVATIONAL / INSPIRATIONAL COMMENTS HERE</h2></div>
        
        <?php if(isset($id) && $id != '') { ?>
			<div style="border: 0px solid; margin-left: 708px; margin-top: 66px; position: absolute; width: 100px; z-index: 99999;">
				<a href="javascript: void(0);" onclick="delete_record(<?php echo $id; ?>);" class="btn btn-primary"><i class="glyphicon glyphicon-trash"></i></a>&nbsp;
                <a href="<?php echo c_site_url('tips/print_record/'.$id); ?>" target="_blank" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i></a>
                <br />
				&nbsp;&nbsp;<font style="font-size: 10px !important;">Trash</font>&nbsp;&nbsp;
				<font style="font-size: 10px !important;">View/Print</font>
			</div>
		<?php } ?>
        
        <div class="col-xs-12 col-sm-12 col-lg-12">

			<?php if(isset($form->tip_type)) { $tip_type = explode(',', $form->tip_type); } ?>

            <form class="form-horizontal" id="tips" style="padding-top:20px;" method="post" action="">
            
            	<?php
                    echo validation_errors();
                    echo isset($file_error) ? $file_error : NULL;
                    show_flash_message();
                ?>
                
                <div class="form-group">
                    <label class="col-xs-10 col-sm-5 col-lg-5 l-padding">What is this? (please check one below)<i style="color:#FF0000;">*</i></label>
                    <div class="col-xs-12 col-sm-6 col-lg-6">

                        <div  class="col-xs-1 col-sm-1 col-lg-1 l-space">
                            <div class="checkbox-green">
                                <input type="checkbox" name="tip_type[]" id="tip" value="Tip" <?php if(isset($form->tip_type) && in_array('Tip', $tip_type)) { ?> checked="checked" <?php } ?> class="validate[minCheckbox[1]]" />
                                <label for="tip"></label>
                            </div>
                        </div>
                        <label class="col-xs-12 col-sm-2 col-lg-2 l-space">Tip</label>

                        <div  class="col-xs-11 col-sm-1 col-lg-1 l-space">
                            <div class="checkbox-green">
                                <input type="checkbox" name="tip_type[]" id="advice" value="Advice" <?php if(isset($form->tip_type) && in_array('Advice', $tip_type)) { ?> checked="checked" <?php } ?> class="validate[minCheckbox[1]]" />
                                <label for="advice"></label>
                            </div>
                        </div>
                        <label class="col-xs-12 col-sm-3 col-lg-3 l-space">Advice</label>

                        <div  class="col-xs-12 col-sm-1 col-lg-1 l-space">
                            <div class="checkbox-green">
                                <input type="checkbox" name="tip_type[]" id="suggestion" value="Suggestion" <?php if(isset($form->tip_type) && in_array('Suggestion', $tip_type)) { ?> checked="checked" <?php } ?> class="validate[minCheckbox[1]]" />
                                <label for="suggestion"></label>
                            </div>
                        </div>
                        <label class="col-xs-12 col-sm-2 col-lg-2 l-space">Suggestion</label>
                        <div class="clearfix"></div>
                        <div  class="col-xs-12 col-sm-1 col-lg-1 l-space">
                            <div class="checkbox-green">
                                <input type="checkbox" name="tip_type[]" id="motivational" value="Motivational" <?php if(isset($form->tip_type) && in_array('Motivational', $tip_type)) { ?> checked="checked" <?php } ?> class="validate[minCheckbox[1]]" />
                                <label for="motivational"></label>
                            </div>
                        </div>
                        <label class="col-xs-12 col-sm-10 col-lg-10 l-space">Motivational / Inspirational stuff</label>

                    </div>
                </div>

				<div class="form-group">
                
                    <label class="col-xs-10 col-sm-5 col-lg-5 l-padding" style="width: 42% !important;">Privacy Status</label>
                    
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
                    <label class="col-xs-10 col-sm-5 col-lg-5 l-padding">Title<i style="color:#FF0000;">*</i></label>
                    <div class="col-xs-12 col-sm-6 col-lg-6">
                        <input class="form-control validate[required]" name="title" value="<?php echo isset($form->title) ? $form->title : '' ; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-10 col-sm-5 col-lg-5 l-padding">Description</label>
                    <div class="col-xs-12 col-sm-6 col-lg-6">
                        <textarea class="form-control" name="description" rows="6"><?php echo isset($form->description) ? $form->description : '' ; ?></textarea>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-xs-10 col-sm-5 col-lg-5 l-padding"></label>
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
    body {background:#ecf8f6 url(<?php echo base_url('assets/user/') ?>/images/tips-bg.jpg) center bottom no-repeat;}
</style>

<script>

	function delete_record(id) {
		var con = confirm('Are you sure you want to delete this record?');
		
		if(con) {
			$.post("<?php echo c_site_url('tips/delete_record/'); ?>", {'id' : id}, function(r){
				//alert(r);
				window.location = '<?php echo c_site_url('tips'); ?>';
			})
		}
	}

   $(document).ready(function() {

		$("input:checkbox[name='privacy_status']").click(function() {
			if($(this).is(":checked")) {
				var group = "input:checkbox[name='privacy_status']";
				$(group).prop("checked", false);
				$(this).prop("checked", true);
			} else {
				$(this).prop("checked", false);
			}
		});

		$("#tips").validationEngine();

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
                jQuery.post("<?php echo site_url('tips/ajax') ?>",{changed:dayDelta,eventId:event.id},function(r){
                    <?php if($id) { ?>
                        /*if(event.id==<?php echo $id ?>){
                            jQuery('#date_time').val(r);
                        }*/
                    <?php } ?>
                    alert(event.title+"\'s date changed successfully");
                });
            },
            eventClick: function(calEvent, jsEvent, view) {
                window.top.location='<?php echo c_site_url("tips/index/") ?>/'+calEvent.id;
            },
            events: [
                
                <?php 
                    if($events){ $i=1;
                        foreach ($events as $event) {
                ?>
                    {
                        title: '<?php echo $event->title ?>',
                        start: new Date(<?php echo date('Y', strtotime($event->create_date)) ?>,<?php echo date('m',strtotime($event->create_date))-1 ?>,<?php echo date('d',strtotime($event->create_date)) ?>),
                        id: '<?php echo $event->id ?>'
                    }<?php if($i!=count($events)){ ?>,<?php } ?>
                <?php
                     $i++;   }
                    }
                ?>
            ]
        });

    });

</script>