<div class="sub-container">
    <div id="box-bg">
        <div class="col-xs-12 bg-line"><h2>CREATE YOUR MEAL SCHEDULE</h2></div>

        <?php if(isset($id) && $id != '') { ?>
			<div style="border: 0px solid; margin-left: 708px; margin-top: 8px; position: absolute; width: 100px; z-index: 99999;">
				<a href="javascript: void(0);" onclick="delete_record(<?php echo $id; ?>);" class="btn btn-primary"><i class="glyphicon glyphicon-trash"></i></a>
                &nbsp;
                <a href="<?php echo c_site_url('meal_planner/print_record/'.$id); ?>" target="_blank" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i></a>
                <br />
				&nbsp;&nbsp;<font style="font-size: 10px !important;">Trash</font>&nbsp;&nbsp;
				<font style="font-size: 10px !important;">View/Print</font>
			</div>
		<?php } ?>
        
        <div class="col-xs-12 col-sm-12 col-lg-12">

            <form class="form-horizontal" id="meal_planner" method="post" action="" style="padding-top:20px;" enctype="multipart/form-data">

            	<?php
                    echo validation_errors();
                    echo isset($file_error) ? $file_error : NULL;
                    show_flash_message();
                ?>
                
                <div class="form-group">
					<label class="col-xs-10 col-sm-4 col-lg-4 l-padding">Upload Photos</label>
					<div class="col-sm-8 col-xs-4 col-md-5">
                        <input type="file" name="photo" id="browse" style="display: none;" onchange="CopyMe(this, 'file');" />
                        <input type="text" name="file" id="file" class="form-control m-form-horizontal-input" size="30" maxlength="255" readonly="" />
					</div>
						<div class=" col-xs-3 col-md-3"> <input type="button" id="btn" onclick="browse.click(); file.value = browse.value;" value="Browse" class="btn btn-primary" value="Browse" /></div>
				</div>
                
				<div id="images" class="form-group">
					<input type="hidden" value="" name="crooperdata" id="crooperdata" />
					<img id="img" src="" alt="" class="cropper" />
				</div>

                <div class="form-group">
                    <label class="col-xs-10 col-sm-4 col-lg-4 l-padding">Date</label>
                    <div class="col-xs-12 col-sm-6 col-lg-6">
                        <input id="date_time" class="form-control" value="<?php echo isset($form->dtime) ? date('Y/m/d H:i', strtotime($form->dtime)) : '' ; ?>" name="dtime">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-xs-10 col-sm-4 col-lg-4 l-padding">Title<i style="color:#FF0000;">*</i></label>
                    <div class="col-xs-12 col-sm-6 col-lg-6">
                        <input class="form-control validate[required]" value="<?php echo isset($form->title) ? stripslashes($form->title) : '' ; ?>" name="title">
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
                
                <?php if(isset($form->meal_kind)) { $meal_kind = explode(',', $form->meal_kind); } ?>
                
                <div class="form-group">
                    <label class="col-xs-10 col-sm-4 col-lg-4 l-padding">What kind of meal is this?<div class="pull-right"></div>
                    (please check all the apply)<i style="color:#FF0000;">*</i></label>
                    <div class="col-sm-8 col-xs-8">
                    <div id="font-pt">
                    <label class="checkbox-inline v-check-inline">
                      <input type="checkbox" name="meal_kind[]" id="breakfast" value="BreakFast" <?php if(isset($form->meal_kind) && in_array('BreakFast', $meal_kind)) { ?> checked="checked" <?php } ?> class="validate[minCheckbox[1]]" /> BreakFast
                    </label>
                    <label class="checkbox-inline v-check-inline">
                      <input type="checkbox" name="meal_kind[]" id="lunch" value="Lunch" <?php if(isset($form->meal_kind) && in_array('Lunch', $meal_kind)) { ?> checked="checked" <?php } ?> class="validate[minCheckbox[1]]" /> Lunch
                    </label>
                    <label class="checkbox-inline v-check-inline">
                      <input type="checkbox" name="meal_kind[]" id="dinner" value="Dinner" <?php if(isset($form->meal_kind) && in_array('Dinner', $meal_kind)) { ?> checked="checked" <?php } ?> class="validate[minCheckbox[1]]" /> Dinner
                    </label><br>
                        
                    <label class="checkbox-inline v-check-inline">
                      <input type="checkbox" name="meal_kind[]" id="snacks" value="Snacks" <?php if(isset($form->meal_kind) && in_array('Snacks', $meal_kind)) { ?> checked="checked" <?php } ?> class="validate[minCheckbox[1]]" /> Snacks
                    </label>
                    &nbsp;&nbsp;&nbsp;
                    <label class="checkbox-inline v-check-inline">
                    <input type="checkbox" name="meal_kind[]" id="other" value="Other" <?php if(isset($form->meal_kind) && in_array('Other', $meal_kind)) { ?> checked="checked" <?php } ?> class="validate[minCheckbox[1]]" /> Other
                    </label>
                    </div>                    
                    </div>
				</div>
                
                <div class="form-group">
                    <label class="col-xs-10 col-sm-4 col-lg-4 l-padding">Recipe Info</label>
                    <div class="col-xs-12 col-sm-6 col-lg-6">
                        <textarea class="form-control" name="details" rows="6"><?php echo isset($form->details) ? $form->details : '' ; ?></textarea>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-xs-10 col-sm-4 col-lg-4 l-padding">Cal, Carbs, Fat, Etc.</label>
                    <div class="col-xs-12 col-sm-6 col-lg-6">
                        <input class="form-control" value="<?php echo isset($form->extra) ? $form->extra : '' ; ?>" name="extra">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-xs-10 col-sm-4 col-lg-4 l-padding">Notes</label>
                    <div class="col-xs-12 col-sm-6 col-lg-6">
                    	<textarea class="form-control" name="notes" rows="4"><?php echo isset($form->notes) ? $form->notes : '' ; ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-10 col-sm-4 col-lg-4 l-padding"></label>
                    <div class="col-xs-1 col-sm-1 col-lg-1 l-padding1"></div>
                    <div class="col-xs-12 col-sm-6 col-lg-6">
                        <button type="submit" name="submit" value="1" class="btn btn-yellow" id="submit_btn"><?php if($id){ echo 'UPDATE'; } else { echo 'SUBMIT'; } ?></button>
                        <button type="button" class="btn btn-yellow" id="process_btn" style="display: none;"></button>
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
    body {background: url(<?php echo base_url('assets/user/') ?>/images/history-bg.jpg) center top no-repeat;}
</style>
<script>

	var browser_type = jQuery.browser.mobile;
	//alert(browser_type);

	function CopyMe(oFileInput, sTargetID) {
        document.getElementById(sTargetID).value = oFileInput.value;

		if(browser_type == false) {
			readImage(oFileInput);
		}
    }
	
	function delete_record(id) {
		var con = confirm('Are you sure you want to delete this record?');
		
		if(con) {
			$.post("<?php echo c_site_url('meal_planner/delete_record/'); ?>", {'id' : id}, function(r){
				//alert(r);
				window.location = '<?php echo c_site_url('meal_planner'); ?>';
			})
		}
	}

	function processing() {
		$('#submit_btn').hide();
		$('#process_btn').show();
		$('#process_btn').attr('disabled', 'disabled');
		$('#process_btn').html('<h3>PROCESSING UPLOAD</h3>');
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
                jQuery.post("<?php echo site_url('meal_planner/ajax') ?>",{changed:dayDelta,eventId:event.id},function(r){
                    <?php if($id){ ?>
                        if(event.id==<?php echo $id ?>){
                            jQuery('#date_time').val(r);
                        }
                    <?php } ?>
                    alert(event.title+"\'s date changed successfully");
                });
            },
            eventClick: function(calEvent, jsEvent, view) {
                window.top.location='<?php echo c_site_url("meal_planner/index/") ?>/'+calEvent.id;
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
    
    $(document).ready(function() {
		$("#meal_planner").validationEngine('attach', {
			onValidationComplete: function(form, status){
				if(status == true) {
					processing();
					return true;
				}
			}
		});
		
        $('#date_time').datetimepicker({
            /*mask:'9999/19/39 29:59',*/
        });
    });
</script>

<link  href="<?php echo base_url('assets/') ?>/lib/cropper/cropper.css" rel="stylesheet">
<script src="<?php echo base_url('assets/') ?>/lib/cropper/cropper.js"></script>

<script type="text/javascript" >
function readImage(input) {
    if ( input.files && input.files[0] ) {
        var FR= new FileReader();
        FR.onload = function(e) {
            $('#img').css( "width", '100%' );
             $('#img').attr( "src", e.target.result );
             //$('#base').text( e.target.result ); //this is the base64 encoded image
             var img = e.target.result;
        };       
        FR.readAsDataURL( input.files[0] );
        
        //Start Cropper
        var $image = $(".cropper");

        $image.cropper({
            aspectRatio: 'auto',
            preview: ".extra-preview",
            done: function(data) {
                var imgData = $image.cropper("getData"),
                val = "";
                try {
                    val = JSON.stringify(imgData);
                } catch (e) {
                    console.log('Crop error');
                }
                $('#crooperdata').val(val);
            }
        });
    }
}
</script>