<div class="sub-container">
 
  <div id="box-bg">
	<div class="col-xs-12 bg-line">
	<h2>Submit Your Request Below</h2>
	<h3>Our Technical Team Will Review And Get Back To You By Email Soon!</h3>
	</div>
	  <div class="col-xs-12 col-sm-12 col-lg-12">

        <form name="request_feature" id="request_feature" class="form-horizontal" style="padding-top: 20px;" method="post" action="<?php echo c_site_url('support/request_feature'); ?>">
          
          <span style="color: red;"><?php echo validation_errors(); ?></span>
			<?php show_flash_message(); ?>
                        
		   <div class="form-group">
            <label class="col-xs-10 col-sm-3 col-lg-2 l-padding">Name</label>
            <div class="col-xs-12 col-sm-6 col-lg-6">
              <input type="text" name="name" class="form-control" />
            </div>
          </div>
		   <div class="form-group">
            <label class="col-xs-10 col-sm-3 col-lg-2 l-padding">Email</label>
            <div class="col-xs-12 col-sm-6 col-lg-6">
               <input type="text" name="email" class="form-control" />
            </div>
          </div>
		   <div class="form-group">
            <label class="col-xs-10 col-sm-3 col-lg-2 l-padding">Phone</label>
            <div class="col-xs-12 col-sm-6 col-lg-6">
               <input type="text" name="phone" class="form-control" />
            </div>
          </div>
		   <div class="form-group">
            <label class="col-xs-10 col-sm-3 col-lg-2 l-padding">Username<i style="color:#FF0000;">*</i></label>
            <div class="col-xs-12 col-sm-6 col-lg-6">
              <input type="text" name="username" class="form-control validate[required]" />
            </div>
          </div>
		   <div class="form-group">
            <label class="col-xs-10 col-sm-3 col-lg-2 l-padding">Your Request<i style="color:#FF0000;">*</i></label>
            <div class="col-xs-12 col-sm-6 col-lg-6">
              <textarea name="request" class="form-control validate[required]" rows="6"></textarea>
            </div>
          </div>
		  
		  <div class="form-group">
            <label class="col-xs-10 col-sm-3 col-lg-2 l-padding"></label>
            <div class="col-xs-12 col-sm-6 col-lg-6">
              <button type="submit" class="btn btn-yellow">SUBMIT</button>
            </div>
          </div>
		  
        </form>

    </div>
	<div class="clearfix"></div>
  </div>
   </div>

<style>
    body {background: url(<?php echo base_url('assets/user/') ?>/img/request-bg.jpg) center top no-repeat; background-attachment: fixed;}
</style>

<script>
	$(document).ready(function() {
		$("#request_feature").validationEngine();
	});
</script>