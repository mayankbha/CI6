<?php $photo_id = isset($photo['id']) ? $photo['id'] : ''; ?>

<div class="sub-container">
    <div id="box-bg">
        <div class="col-xs-12 bg-line">
        	<h2>UPLOAD SELFIE PHOTOS TO YOUR GALLERY</h2>
            <?php if(isset($id) && $id != '') { ?>
				<div style="border: 0px solid; margin-left: 720px; margin-top: -54px; position: absolute; width: 100px; z-index: 99999;">
					<a href="<?php echo c_site_url('selfiephoto/print_record/'.$id); ?>" target="_blank" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i></a>
                    <br />
                    <font style="font-size: 10px !important;">View/Print</font>
				</div>
			<?php } ?>
        </div>
        <div class="col-xs-12 col-sm-12 col-lg-12">
        
            <form class="form-horizontal" style="padding-top:20px;" method="post" id="selfform" action="<?php echo c_site_url('selfiephoto/index/'.$photo_id) ?>" enctype="multipart/form-data">
            
                <?php 
                    echo validation_errors(); 
                    echo isset($file_error) ? $file_error : NULL;
                    show_flash_message();
                ?>
                
                <div class="form-group">
                    <label class="col-xs-10 col-sm-4 col-lg-3 l-padding">Upload Selfie Photo<i style="color:#FF0000;">*</i></label>
                    <div class="col-xs-12 col-sm-6 col-lg-6">
                        <input type="file" name="photo" id="browse" style="display: none;" onchange="CopyMe(this, 'file');" >
                        <input name="file" type="text" id="file"  class="textbox validate[required]" size="30" maxlength="255" readonly="" >
                        <input type="button" onclick="browse.click();   " value="Browse" class="btn-browe" id="go">
                    </div>
                </div>
                
                <div id="images" class="form-group">
                    <input type="hidden" value="" name="crooperdata" id="crooperdata" />
					<img id="img" src="" alt="" class="cropper" />
                </div>
                
                <div class="form-group">
                
                    <label class="col-xs-10 col-sm-5 col-lg-5 l-padding" style="width: 25.667% !important;">Privacy Status</label>
                    
                    <div class="col-xs-12 col-sm-6 col-lg-6">

                        <div  class="col-xs-1 col-sm-1 col-lg-1 l-space">
                            <div class="checkbox-green">
                                <input type="checkbox" name="privacy_status" id="privacy_status_public" value="0" <?php if(@$photo['privacy_status'] == '0') { ?>checked="checked"<?php } else if(@$photo['privacy_status'] != '1') { ?>checked="checked"<?php } ?> />
                                <label for="privacy_status_public"></label>
                            </div>
                        </div>
                        <label class="col-xs-12 col-sm-2 col-lg-2 l-space" style="width: 30% !important;">Make Public</label>

                        <div  class="col-xs-11 col-sm-1 col-lg-1 l-space">
                            <div class="checkbox-green">
                                <input type="checkbox" name="privacy_status" id="privacy_status_private" value="1" <?php if(@$photo['privacy_status'] == '1') { ?>checked="checked"<?php } ?> />
                                <label for="privacy_status_private"></label>
                            </div>
                        </div>
                        <label class="col-xs-12 col-sm-3 col-lg-3 l-space">Make Private</label>

                    </div>
                    
                </div>
                
                <div class="form-group">
                    <label class="col-xs-10 col-sm-4 col-lg-3 l-padding" for="title">Title<i style="color:#FF0000;">*</i></label>
                    <div class="col-xs-12 col-sm-6 col-lg-6">
                        <input class="form-control validate[required]" name="photo_title" id="photo_title" value="<?php echo set_value('photo_title', isset($photo['photo_title']) ? $photo['photo_title'] : '') ?>" />
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-xs-10 col-sm-4 col-lg-3 l-padding" for="date_time">Date / time<i style="color:#FF0000;">*</i></label>
                    <div class="col-xs-12 col-sm-6 col-lg-6">
                            <input class="form-control validate[required]" name="date_time" id="date_time" value="<?php echo set_value('date_time', isset($photo['date_time']) ? date('Y/m/d H:i', strtotime($photo['date_time'])) : '') ?>" />
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-xs-10 col-sm-4 col-lg-3 l-padding" for="description">Description of photo</label>
                    <div class="col-xs-12 col-sm-6 col-lg-6">
                        <textarea class="form-control" name="photo_description" id="photo_description" rows="6"><?php echo set_value('photo_description', isset($photo['photo_description']) ? $photo['photo_description'] : '') ?></textarea>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-xs-10 col-sm-4 col-lg-3 l-padding" for="weight">Weight</label>
                    <div class="col-xs-12 col-sm-6 col-lg-6">
                        <input class="form-control validate" name="photo_weight" id="photo_weight" value="<?php echo set_value('photo_weight', isset($photo['photo_weight']) ? $photo['photo_weight'] : '') ?>" />
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-xs-10 col-sm-4 col-lg-3 l-padding">BMI</label>
                    <div class="col-xs-12 col-sm-6 col-lg-6">
                        <input class="form-control" name="photo_bmi" id="photo_bmi" value="<?php echo set_value('photo_bmi', isset($photo['photo_bmi']) ? $photo['photo_bmi'] : '') ?>" >
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-10 col-sm-4 col-lg-3 l-padding"></label>
                    <div class="col-xs-1 col-sm-1 col-lg-1 l-padding1"></div>
                    <div class="col-xs-12 col-sm-6 col-lg-6">
                        <button type="submit" class="btn btn-yellow" id="submit_btn">UPLOAD</button>
                        <button type="button" class="btn btn-yellow" id="process_btn" style="display: none;"></button>
                    </div>
                </div>

            </form>

        </div>
        <div class="clearfix"></div>
    </div>

    <?php if(isset($photo_list) && !empty($photo_list)): ?>
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
                        foreach ($photo_list as $key => $photos) : //echo "<pre>";print_r($photos);die; 
                        $closed = false;
                        if($count==1) :
                    ?>
        			<div class="item <?php echo $active ?>">
                        <div class="row-fluid">
                    <?php endif; ?>
                            <div class="span3 col-sm-3 l-space" style="padding:5px;">
                				<a href="<?php echo c_site_url('selfiephoto/remove/'.$photos->id) ?>" class="remove-img" onclick="return confirm_delete();" title="Trash"><i class="glyphicon glyphicon-trash"></i></a>
                            	<a href="<?php echo c_site_url('selfiephoto/index/'.$photos->id) ?>" class="thumbnail">
                                	<?php echo $photos->photo_title; ?>
                            		<img src="<?php echo base_url('uploads/'.$photos->uid.'/self/'.$photos->photo_img) ?>" alt="<?php echo $photos->photo_title ?>" class="img-responsive">
                        		</a>
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
    
    <?php endif; ?>

</div>
<style>
    body {background: url(<?php echo base_url('assets/user/') ?>/images/selfiephoto-bg.jpg) center top no-repeat; background-attachment: fixed;}
</style>
<script type="text/javascript">

	var browser_type = jQuery.browser.mobile;
	//alert(browser_type);

	function sortRecord(order) {
		$('#myCarousel').html('<center><h3>LOADING PHOTOS, PLEASE WAIT...</h3></center>');

		$.post('<?php echo c_site_url('selfiephoto/selfie_ajax_cp'); ?>', {'order' : order}, function(r){
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
			/*mask:'9999/19/39 29:59',*/
		});

		$("#selfform").validationEngine('attach', {
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
    if (input.files && input.files[0]) {
        var FR = new FileReader();
        FR.onload = function(e) {
		
            $('#img').css("width", '100%');
            $('#img').attr("src", e.target.result);
			
             //$('#base').text( e.target.result ); //this is the base64 encoded image
             var img = e.target.result;
        };

        FR.readAsDataURL(input.files[0]);
        
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