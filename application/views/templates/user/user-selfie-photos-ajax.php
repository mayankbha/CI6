<?php //print_r($user_selfie_photos); ?>

<div class="fluid_container">
	<div class="camera_wrap camera_magenta_skin" id="camera_wrap_1">
		<div id="tab-bg4">
			<div id="box-bg">
				<div class="col-xs-12 bg-line"><h2>Selfie Photos</h2></div>
                <?php foreach($user_selfie_photos as $user_selfie_photo) { ?>
					<div class="col-xs-12 col-sm-4 col-lg-4"><img src="<?php echo c_site_url(); ?>/uploads/<?php echo $uid; ?>/meal/<?php echo $user_selfie_photo->photo_img; ?>" alt="<?php echo $user_selfie_photo->photo_img; ?>" class="img-responsive pho-border"></div>
				<?php } ?>
				<div class="clearfix"></div>

				<!---pagination-->
				<div class="custom_pagination">
					<?php echo $pagination; ?>
					<ul class="pager">
						<li><a href="#" class="btn-blue1 test">PREVIOUS</a></li>
						<li class="active"><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#" class="btn-blue1">NEXT</a></li>
					</ul>
				</div>
				<!---pagination ends-->
			</div>
		</div>
	</div>
</div>