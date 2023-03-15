<?php $video_id = isset($user_video_details->id) ? $user_video_details->id : 0; ?>

<link href="<?php echo base_url('assets/user/') ?>/css/style2.css" rel="stylesheet">

<div class="sub-container">
    <div id="box-bg">
    
        <div class="v-form-fether1">
<div class=" v-form-inner ">
<div class="v-form-title">UPLOAD VIDEOS TO YOUR GALLERY</div>
<div class="v-form-title">(MUST UPLOAD TO YOUTUBE.COM FIRST THEN SUPPLY US WITH THE SHARE LINK.)

<?php if(isset($id) && $id != '') { ?>
			<div style="border: 0px solid; margin-left: 746px; margin-top: -50px; position: absolute; width: 100px; z-index: 99999;">
                <a href="<?php echo c_site_url('video/print_record/'.$id); ?>" target="_blank" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i></a>
                <br />
				<font style="font-size: 10px !important;">View/Print</font>
			</div>
		<?php } ?>
        
</div></div>

</div>
        
        <div class="col-xs-12 col-sm-12 col-lg-12">

            <form class="form-horizontal" style="padding-top:20px;" method="post" id="video" action="<?php echo c_site_url('video/index/'.$video_id); ?>" enctype="multipart/form-data">

            	<?php
                    echo validation_errors();
                    echo isset($file_error) ? $file_error : NULL;
                    show_flash_message();
                ?>

                <div class="form-group v-form-group">
                    <label class="col-sm-2 col-xs-8 control-label form-horizontal-cus-label" for="inputEmail3">Title<i style="color:#FF0000;">*</i></label>
                    <div class="col-sm-8 col-xs-8">
                    <input class="form-control form-horizontal-input validate[required]" name="title" id="title" value="<?php echo set_value('title', isset($user_video_details->title) ? $user_video_details->title : '') ?>" />
                    </div>
                </div>
                
                <div class="form-group v-form-group">
                
                    <label class="col-xs-10 col-sm-4 col-lg-4 l-padding" style="width: 30% !important;">Privacy Status</label>
                    
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
                
                <div class="form-group v-form-group">
                    <label class="col-sm-2 col-xs-8 control-label form-horizontal-cus-label" for="inputPassword3">youtube.com link<i style="color:#FF0000;">*</i></label>
                    <div class="col-sm-8 col-xs-8">
                    <input class="form-control form-horizontal-input validate[required]" name="video_link" id="video_link" value="<?php echo set_value('video_link', isset($user_video_details->video_link) ? $user_video_details->video_link : '') ?>" />
                    </div>
				</div>
                    
				<div class="form-group v-form-group">
                    <label class="col-sm-2 col-xs-8 control-label form-horizontal-cus-label" for="inputPassword3">Description of video</label>
                    <div class="col-sm-8 col-xs-8">
                    <textarea class="form-control form-horizontal-input" name="description" id="description" rows="6"><?php echo set_value('description', isset($user_video_details->description) ? $user_video_details->description : '') ?></textarea>
                    </div>
				</div>
                
				<div class="form-group v-form-group">
                    <label class="col-sm-2 col-xs-6 control-label form-horizontal-cus-label" for="inputPassword3"></label>
                    <div class="col-sm-8 col-xs-8">
                    <button type="submit" class="btn btn-default v-upload-btn">UPLOAD</button>
                    </div>
				</div>

            </form>

        </div>
        <div class="clearfix"></div>
    </div>

	<?php if($user_videos) { ?>
        <div id="box-bg">
            <div class=" v-form-inner ">
                <div class="v-form-title">HISTORY OF VIDEOS UPLOADED</div>
            </div>
    
            <div class="col-xs-11">
                <div id="myCarousel" class="carousel slide">
    
                    <!-- Carousel items -->
                    <div class="carousel-inner">
    
    					<?php 
                       		$count = 1;
                        	$active = 'active';
                        	$closed = false;
                        	foreach ($user_videos as $key => $user_video) :
                        	$closed = false;
                        	if($count==1) :
                    	?>
                        
                        <div class="item <?php echo $active ?>">
                        	<div class="row-fluid">
                    	<?php endif; ?>
                                    <div class="span3 col-sm-3 l-space" style="padding: 5px;">
                                        <a href="<?php echo c_site_url('video/delete_record/'.$user_video->id) ?>" class="remove-img" onclick="return confirm_delete();" title="Trash"><i class="glyphicon glyphicon-trash"></i></a>
                                        <a href="<?php echo c_site_url('video/index/'.$user_video->id); ?>" class="thumbnail"><?php echo $user_video->title; ?><img src="<?php echo $user_video->video_image_link; ?>" class="img-responsive"></a>
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
    body {background: url(<?php echo base_url('assets/user/') ?>/img/bg.jpg) center top no-repeat; background-attachment: fixed;}
</style>


<script type="text/javascript" >

	function delete_record(id) {
		var con = confirm('Are you sure you want to delete this record?');
		
		if(con) {
			$.post("<?php echo c_site_url('video/delete_record/'); ?>", {'id' : id}, function(r){
				//alert(r);
				window.location = '<?php echo c_site_url('video'); ?>';
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

		$("#video").validationEngine();
		
        $('#myCarousel').carousel({
            interval: false
        });
        
        $('#date_time').datetimepicker({
            mask:'9999/19/39 29:59',
        });
        
        //$("#selfform").validationEngine();
    });
</script>