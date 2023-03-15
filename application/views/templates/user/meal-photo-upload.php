<?php $photo_id = isset($user_meal_details->id) ? $user_meal_details->id : 0; ?>

<link href="<?php echo base_url('assets/user/') ?>/css/style2.css" rel="stylesheet">

<div class="sub-container">

<?php if(isset($id) && $id != '') { ?>

    <div id="box-bg">

		<div class="col-xs-12 bg-line">
			<h2>PHOTOS TO YOUR MEALS</h2>
			<?php if(isset($id) && $id != '') { ?>
				<!--<div style="border: 0px solid; margin-left: 720px; margin-top: -54px; position: absolute; width: 100px; z-index: 99999;">
					<a href="<?php //echo c_site_url('mealphoto/print_record/'.$id); ?>" target="_blank" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i></a>
                    <br />
                    <font style="font-size: 10px !important;">View/Print</font>
				</div>-->
			<?php } ?>
		</div>

        <div class="col-xs-12 col-sm-12 col-lg-12">

            <form class="form-horizontal" style="padding-top:20px;" method="post" id="mealform" action="<?php echo c_site_url('mealphoto/index/'.$photo_id); ?>" enctype="multipart/form-data">

            	<?php echo validation_errors(); ?>
				<?php show_flash_message(); ?>

                	<div class="form-group v-form-group">
						<label class="col-sm-2 col-xs-8 control-label form-horizontal-cus-label" for="inputEmail3">Image</label>
						<div class="col-sm-8 col-xs-8">
							<img src="<?php echo c_site_url(); ?>/uploads/<?php echo $uid; ?>/meal/<?php echo $meal_photo->meal_photo; ?>" alt="<?php echo $meal_photo->meal_photo; ?>" class="img-responsive">
						</div>
					</div>

                    <div class="form-group v-form-group">
                        <label class="col-sm-2 col-xs-8 control-label form-horizontal-cus-label" for="inputEmail3">Upload Meal Photo<i style="color:#FF0000;">*</i></label>
                        <div class="col-sm-8 col-xs-4 col-md-5">
                            <input type="hidden" name="id" value="<?php echo $photo_id; ?>" />
                            <input type="file" name="photo" id="browse" style="display: none;" onchange="CopyMe(this, 'file');" />
                            <input type="text" name="file" id="file" class="form-control m-form-horizontal-input validate[required]" size="30" maxlength="255" readonly="" />
                        </div>
                            <div class=" col-xs-3 col-md-3"> <input type="button" id="btn" onclick="browse.click(); file.value = browse.value;" value="Browse" class="btn btn-primary" value="Browse" /></div>
                    </div>
    
                    <div id="images" class="form-group">
                        <input type="hidden" value="" name="crooperdata" id="crooperdata" />
                        <img id="img" src="" alt="" class="cropper" />
                    </div>

				<!--<div class="form-group v-form-group">
                
                    <label class="col-sm-2 col-xs-8 control-label form-horizontal-cus-label" style="width: 30% !important;">Privacy Status</label>
                    
                    <div class="col-xs-12 col-sm-6 col-lg-6">

                        <div  class="col-xs-1 col-sm-1 col-lg-1 l-space">
                            <div class="checkbox-green">
                                <input type="checkbox" name="privacy_status" id="privacy_status_public" value="0" <?php if(@$user_meal_details->privacy_status == '0') { ?>checked="checked"<?php } else if(@$user_meal_details->privacy_status != '1') { ?>checked="checked"<?php } ?> />
                                <label for="privacy_status_public"></label>
                            </div>
                        </div>
                        <label class="col-xs-12 col-sm-2 col-lg-2 l-space" style="width: 30% !important;">Make Public</label>

                        <div  class="col-xs-11 col-sm-1 col-lg-1 l-space">
                            <div class="checkbox-green">
                                <input type="checkbox" name="privacy_status" id="privacy_status_private" value="1" <?php if(@$user_meal_details->privacy_status == '1') { ?>checked="checked"<?php } ?> />
                                <label for="privacy_status_private"></label>
                            </div>
                        </div>
                        <label class="col-xs-12 col-sm-3 col-lg-3 l-space">Make Private</label>

                    </div>
                    
                </div>

				<div class="form-group v-form-group">
					<label class="col-sm-2 col-xs-8 control-label form-horizontal-cus-label" for="inputEmail3">Title<i style="color:#FF0000;">*</i></label>
					<div class="col-sm-8 col-xs-8">
						<input class="form-control form-horizontal-input validate[required]" name="title" id="title" value="<?php echo set_value('title', isset($user_meal_details->title) ? $user_meal_details->title : $this->input->post('title')); ?>" />
					</div>
				</div>

				<!--<div class="form-group v-form-group">
					<label class="col-sm-2 col-xs-8 control-label form-horizontal-cus-label" for="inputPassword3">Date / time<i style="color:#FF0000;">*</i></label>
					<div class="col-sm-8 col-xs-8">
						<input class="form-control form-horizontal-input" name="date_time" id="date_time" />
					</div>
				</div>

                <?php //if(isset($user_meal_details->meal_kind)) { $meal_kind = explode(',', $user_meal_details->meal_kind); } ?>

				<div class="form-group v-form-group">
                    <label class="col-sm-2 col-xs-8 control-label form-horizontal-cus-label" for="inputPassword3">What kind of meal is this?<div class="pull-right"></div>
                    (please check one below)<i style="color:#FF0000;">*</i></label>
                    <div class="col-sm-8 col-xs-8">
                    <div id="font-pt">
                    <label class="checkbox-inline v-check-inline">
                      <input type="checkbox" name="meal_kind[]" id="breakfast" value="BreakFast" <?php if(isset($user_meal_details->meal_kind) && in_array('BreakFast', $meal_kind)) { ?> checked="checked" <?php } ?> class="validate[minCheckbox[1]]" /> BreakFast
                    </label>
                    <label class="checkbox-inline v-check-inline">
                      <input type="checkbox" name="meal_kind[]" id="lunch" value="Lunch" <?php if(isset($user_meal_details->meal_kind) && in_array('Lunch', $meal_kind)) { ?> checked="checked" <?php } ?> class="validate[minCheckbox[1]]" /> Lunch
                    </label>
                    <label class="checkbox-inline v-check-inline">
                      <input type="checkbox" name="meal_kind[]" id="dinner" value="Dinner" <?php if(isset($user_meal_details->meal_kind) && in_array('Dinner', $meal_kind)) { ?> checked="checked" <?php } ?> class="validate[minCheckbox[1]]" /> Dinner
                    </label><br>
                        
                    <label class="checkbox-inline v-check-inline">
                      <input type="checkbox" name="meal_kind[]" id="snacks" value="Snacks" <?php if(isset($user_meal_details->meal_kind) && in_array('Snacks', $meal_kind)) { ?> checked="checked" <?php } ?> class="validate[minCheckbox[1]]" /> Snacks
                    </label>
                    &nbsp;&nbsp;&nbsp;
                    <label class="checkbox-inline v-check-inline">
                    <input type="checkbox" name="meal_kind[]" id="other" value="Other" <?php if(isset($user_meal_details->meal_kind) && in_array('Other', $meal_kind)) { ?> checked="checked" <?php } ?> class="validate[minCheckbox[1]]" /> Other
                    </label>
                    </div>                    
                    </div>
				</div>

				<div class="form-group v-form-group">
					<label class="col-sm-2 col-xs-8 control-label form-horizontal-cus-label" for="inputPassword3">Description of meal</label>
					<div class="col-sm-8 col-xs-8">
						<textarea class="form-control form-horizontal-input" name="description" id="description" rows="3"><?php echo set_value('description', isset($user_meal_details->description) ? $user_meal_details->description : '') ?></textarea>
					</div>
				</div>

				<div class="form-group v-form-group">
					<label class="col-sm-2 col-xs-8 control-label form-horizontal-cus-label" for="inputPassword3">Recipe</label>
					<div class="col-sm-8 col-xs-8">
						<textarea class="form-control form-horizontal-input" name="recipe" id="recipe" rows="3"><?php echo set_value('recipe', isset($user_meal_details->recipe) ? $user_meal_details->recipe : '') ?></textarea>
					</div>
				</div>

				<div class="form-group v-form-group">
                    <label class="col-sm-2 col-xs-8 control-label form-horizontal-cus-label" for="inputPassword3">Nutritional facts(cal, carbs, fat, etc)</label>
                    <div class="col-sm-8 col-xs-8">
						<input class="form-control form-horizontal-input" name="nutritional_facts" id="nutritional_facts" value="<?php echo set_value('nutritional_facts', isset($user_meal_details->nutritional_facts) ? $user_meal_details->nutritional_facts : '') ?>" />
					</div>
                </div>-->

                <div class="form-group v-form-group">
					<label class="col-sm-2 col-xs-6 control-label form-horizontal-cus-label" for="inputPassword3"></label>
					<div class="col-sm-8 col-xs-8">
						<button type="submit" name="upload" id="submit_btn" class="btn btn-default v-upload-btn">UPLOAD</button>
                        <button type="button" class="btn btn-yellow" id="process_btn" style="display: none;"></button>
					</div>
				</div>

            </form>

        </div>
        <div class="clearfix"></div>
    </div>
<?php } ?>

	<?php if($meal_photos) { ?>
        <div id="box-bg">
            <div class="col-xs-12 bg-line">
                <div style="border: 0px solid; float: left; width: 310px;">
                    <h2>HISTORY OF PHOTOS UPLOADED</h2>
                </div>
                <div style="border: 0px solid; float: left; margin-top: 14px;">
                    <select onchange="sortRecord(this.value);">
                        <option value="">-- Sort By --</option>
                        <option value="asc">Earliest to Latest</option>
                        <option value="desc">Latest to Earliest</option>
                    </select>
                </div>
            </div>
    
            <div class="col-xs-11">
            
                <div id="myCarousel" class="carousel slide">
    
                    <!-- Carousel items -->
                    <div class="carousel-inner">
 
 						<?php 
                        $count = 1;
                        $active = 'active';
                        $closed = false;
                        foreach ($meal_photos as $key => $meal_photo) :
                        $closed = false;
                        if($count==1) :
                    ?>
        			<div class="item <?php echo $active ?>">
                        <div class="row-fluid">
                    <?php endif; ?>
									<div class="span3 col-sm-3 l-space" style="padding: 5px;">
										<a href="<?php echo c_site_url('mealphoto/remove/'.$meal_photo->id) ?>" class="remove-img" onclick="return confirm_delete();" title="Trash"><i class="glyphicon glyphicon-trash"></i></a>
										<a href="<?php echo c_site_url('mealphoto/index/'.$meal_photo->id);?>" class="thumbnail"><?php echo $meal_photo->title; ?><img src="<?php echo c_site_url(); ?>/uploads/<?php echo $uid; ?>/meal/<?php echo $meal_photo->meal_photo; ?>" alt="<?php echo $meal_photo->meal_photo; ?>" class="img-responsive"></a>
									</div>
					<?php if($count==4) : ?>
                        </div><!--/row-fluid-->
                    </div><!--/item-->
            		<?php 
                        $closed = true;
                        $count = 0;
                        endif;
                        $active = null;
                        $count++;
                        endforeach; 
                    ?>
                    <?php if($closed == false) { ?>
                        </div><!--/row-fluid-->
                    </div><!--/item-->
                    <?php } ?>
    
                    </div><!--/carousel-inner-->
    
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev"><img src="<?php echo base_url('assets/user/') ?>/images/prev.png" class="p-icon"></a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next"><img src="<?php echo base_url('assets/user/') ?>/images/next.png" class="p-icon"></a>
                </div><!--/myCarousel-->
    
            </div>
            <div class="clearfix"></div>
        </div>
	<?php } ?>
    
</div>

<style>
    body {background: url(<?php echo base_url('assets/user/') ?>/img/bg-meal.jpg) center top no-repeat; background-attachment: fixed;}
</style>

<script type="text/javascript" >
	var browser_type = jQuery.browser.mobile;
	//alert(browser_type);

	function sortRecord(order) {
		$('#myCarousel').html('<center><h3>LOADING PHOTOS, PLEASE WAIT...</h3></center>');

		$.post('<?php echo c_site_url('mealphoto/mealphoto_ajax_cp'); ?>', {'order' : order}, function(r){
			if(r != '') {
				//alert(r);
				$('#myCarousel').html(r);
			}
		});
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
		
        $('#myCarousel').carousel({
            interval: false
        });

        $('#date_time').datetimepicker({
            <?php if(isset($user_meal_details->date_time) && !empty($user_meal_details->date_time)): ?>
                value:'<?php echo date('Y/m/d H:i:s', strtotime($user_meal_details->date_time) ) ?>',
            <?php endif;  ?>
        });

        $("#mealform").validationEngine('attach', {
			onValidationComplete: function(form, status){
				if(status == true) {
					processing();
					return true;
				}
			}
		});
    });

	function processing() {
		$('#submit_btn').hide();
		$('#process_btn').show();
		$('#process_btn').attr('disabled', 'disabled');
		$('#process_btn').html('<h3>PROCESSING UPLOAD</h3>');
	}

    function CopyMe(oFileInput, sTargetID) {
        document.getElementById(sTargetID).value = oFileInput.value;

		if(browser_type == false) {
			readImage(oFileInput);
		}
    }
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