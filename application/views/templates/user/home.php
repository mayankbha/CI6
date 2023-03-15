<div class="container">

<div class="row top-back">
   <div class="col-xs-12 col-sm-7 col-lg-6 public">Your Public Profile URL To Share Is Below</div>
   
   	<div class="col-xs-12 col-sm-5 col-lg-6">
    
		<div class="col-xs-4 col-sm-4 col-lg-4 so-icon">
			<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(base_url('user_public_profile/index/'.$this->session->userdata('identity'))) ?>">
				<img src="<?php echo base_url('assets/user/') ?>/images/facebook.png" class="img-responsive cent fb-share-button" >
			</a>
		</div>
        
   		<div class="col-xs-4 col-sm-4 col-lg-4 so-icon">
			<a target="_blank" href="https://twitter.com/home?status=<?php echo urlencode(base_url('user_public_profile/index/'.$this->session->userdata('identity'))) ?>"><img src="<?php echo base_url('assets/user/') ?>/images/twitter.png" class="img-responsive cent"></a>
		</div>
        
   		<!--<div class="col-xs-4 col-sm-4 col-lg-4 so-icon"><a href="#"><img src="<?php echo base_url('assets/user/') ?>/images/instagram.png" class="img-responsive cent"></a></div>-->
        
   	</div>
    
   <div class="col-xs-12 uprofile">
		<?php //echo '<pre>'; print_r($this->session->all_userdata());die; ?>
   		<a target="_blank" href="<?php echo base_url('user_public_profile/index/'.$this->session->userdata('identity'))  ?>" class="pu-link">
   			<?php echo base_url('user_public_profile/index/'.$this->session->userdata('identity'))  ?>
		</a>
   </div>
 </div>



    <div class="row top-pa">
    
        <div class="col-xs-6 col-sm-3 img-6">
            <a href="<?php echo c_site_url('selfiephoto') ?>">
                <img src="<?php echo base_url('assets/user/') ?>/images/selfile-photos.png" class="img-responsive">
            </a>
        </div>
        
        <div class="col-xs-6 col-sm-3 img-6">
            <a href="<?php echo c_site_url('mealphoto') ?>">
                <img src="<?php echo base_url('assets/user/') ?>/images/meal-photos.png" class="img-responsive">
            </a>
        </div>
        
        <div class="col-xs-6 col-sm-3 img-6">
            <a href="<?php echo c_site_url('fitness') ?>">
                <img src="<?php echo base_url('assets/user/') ?>/images/fitness.png" class="img-responsive">
            </a>
        </div>
        
        <div class="col-xs-6 col-sm-3 img-6">
            <a href="<?php echo c_site_url('tips') ?>">
                <img src="<?php echo base_url('assets/user/') ?>/images/tips.png" class="img-responsive">
            </a>
        </div>
        
        <div class="col-xs-6 col-sm-3 img-6">
            <a href="<?php echo c_site_url('meal_planner') ?>">
                <img src="<?php echo base_url('assets/user/') ?>/images/meal-planner.png" class="img-responsive">
            </a>
        </div>
        
        <div class="col-xs-6 col-sm-3 img-6">
            <a href="<?php echo c_site_url('daily_journal') ?>">
                <img src="<?php echo base_url('assets/user/') ?>/images/daily-journal.png" class="img-responsive">
            </a>
        </div>
        
        <div class="col-xs-6 col-sm-3 img-6">
            <a href="<?php echo c_site_url('video') ?>">
                <img src="<?php echo base_url('assets/user/') ?>/images/video.png" class="img-responsive">
            </a>
        </div>
        
        <div class="col-xs-6 col-sm-3 img-6">
            <a href="<?php echo c_site_url('profile') ?>">
                <img src="<?php echo base_url('assets/user/') ?>/images/my-profile.png" class="img-responsive">
            </a>
        </div>

		<div class="col-xs-6 col-sm-3 img-6">
            <a href="#">
                <img src="<?php echo base_url('assets/user/') ?>/images/coming.png" class="img-responsive">
            </a>
        </div>
        
        <div class="col-xs-6 col-sm-3 img-6">
            <a href="#">
                <img src="<?php echo base_url('assets/user/') ?>/images/coming.png" class="img-responsive">
            </a>
        </div>
        
        <div class="col-xs-6 col-sm-3 img-6">
            <a href="#">
                <img src="<?php echo base_url('assets/user/') ?>/images/coming.png" class="img-responsive">
            </a>
        </div>
        
        <div class="col-xs-6 col-sm-3 img-6">
            <a href="#">
                <img src="<?php echo base_url('assets/user/') ?>/images/coming.png" class="img-responsive">
            </a>
        </div>
        
    </div>
</div>
<style>
    body {background: url(<?php echo base_url('assets/user/') ?>/images/main-bg.jpg) center top no-repeat; background-attachment: fixed;}
</style>
