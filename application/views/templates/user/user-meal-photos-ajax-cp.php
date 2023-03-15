<?php //print_r($photo_list); ?>

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
								<a href="<?php echo c_site_url('mealphoto/remove/'.$photos->id) ?>" class="remove-img" onclick="return confirm_delete();" title="Trash"><i class="glyphicon glyphicon-trash"></i></a>
								<a href="<?php echo c_site_url('mealphoto/index/'.$photos->id) ?>" class="thumbnail">
									<?php echo $photos->title; ?>
									<img src="<?php echo base_url('uploads/'.$photos->uid.'/meal/'.$photos->meal_photo) ?>" alt="<?php echo $photos->title ?>" class="img-responsive">
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