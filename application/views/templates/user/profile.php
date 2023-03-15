<div class="sub-container">
    <!--tabbed pannel-->
    <!--<div class="col-xs-12">
		<div class="col-xs-12 banner">Create Your Own Health Freaks Profile For Free Right Now & Track Your Life!</div>
	</div>-->

	<!--<div class="col-xs-12">
		<div class="col-xs-12 box-sha">
			<div class="col-xs-12 col-sm-3 col-lg-2 pad-le2">
				<div class="name"><?php echo $user_details->first_name; ?> <?php echo $user_details->last_name; ?></div>
				<img src="<?php echo c_site_url(); ?>uploads/<?php echo $user_details->id; ?>/profile/<?php echo $user_details->profile_pic; ?>" class="img-responsive">
			</div>

			<div class="col-xs-12 col-sm-9 col-lg-10 pad-le3">
				<p><span>Diet:</span> <?php echo $user_details->diet; ?></p>
				<p><span>Goals:</span> <?php echo $user_details->goals; ?></p>
			</div>
		</div>
	</div>-->

		<div class="col-xs-12">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="active tab-full"><a href="#fitness-schedule" data-toggle="tab" onclick="get_user_fitness_schedule();">Fitness Schedule</a></li>
                <li class="tab-full"><a href="#meal-schedule" data-toggle="tab" onClick="get_user_meal_schedule();">Meal Schedule</a></li>
                <li class="tab-full"><a href="#meal-photos" data-toggle="tab" onClick="get_user_meal_photos();">Meal Photos</a></li>
                <li class="tab-full"><a href="#selfie-photos" data-toggle="tab" onClick="get_user_self_photos();">Selfie Photos</a></li>
                <li class="tab-full"><a href="#tips" data-toggle="tab" onClick="get_user_tips();">Tips</a></li>
                <li class="tab-full"><a href="#videos" data-toggle="tab" onClick="get_user_videos();">Videos</a></li>
            </ul>
    
            <!-- Tab panes -->
            <div class="tab-content">
    
                <!-------------Fitness Schedule------------->
                <div class="tab-pane active" id="fitness-schedule">
                    
                </div>
                <!-------------Fitness Schedule End------------->
    
                <!-------------Meal Schedule------------->
                <div class="tab-pane" id="meal-schedule">
    
                </div>
                <!-------------Meal Schedule End------------->
    
                <!-------------Meal Photos------------->
                <div class="tab-pane" id="meal-photos">
                    
                </div>
                <!-------------Meal Photos End------------->
    
                <!-------------Selfie Photos------------->
                <div class="tab-pane" id="selfie-photos">
                    
                </div>
                <!-------------Selfie Photos End------------->
    
                <!-------------Tips------------->
                <div class="tab-pane" id="tips">
    
                </div>
                <!-------------Tips End------------->
    
                <!-------------Videos------------->
                <div class="tab-pane" id="videos">
                    
                </div>
                <!-------------Videos End------------->
    
    
            </div>
        </div>

</div>

<script>

	$(document).ready(function() {
		$("#fitness-schedule").load("<?php echo c_site_url('fitness/get_user_fitness_schedule') ?>");
	});

	function get_user_fitness_schedule() {
		$("#fitness-schedule").load("<?php echo c_site_url('fitness/get_user_fitness_schedule') ?>");
	}

	function get_user_meal_schedule() {
		$("#meal-schedule").load("<?php echo c_site_url('meal_planner/get_user_meal_schedule') ?>");
	}
	
	function get_user_meal_photos() {
		$("#meal-photos").load("<?php echo c_site_url('mealphoto/get_user_meal_photos') ?>");
	}
	
	function get_user_self_photos() {
		$("#selfie-photos").load("<?php echo c_site_url('selfiephoto/get_user_self_photos') ?>");
	}

	function get_user_tips() {
		$("#tips").load("<?php echo c_site_url('tips/get_user_tips') ?>");
	}

	function get_user_videos() {
		$("#videos").load("<?php echo c_site_url('video/get_user_videos') ?>");
	}

</script>

<style>
    body {background:#FFF;}
</style>