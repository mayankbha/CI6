<div class="sub-container">
 
  <div id="box-bg">
	<div class="col-xs-12 bg-line">
	<h2>Submit The Problem You Are Experiencing Below</h2>
	<h3>Our Technical Team Will Review And Get Back To You By Email Soon!</h3>
	</div>
	  <div class="col-xs-12 col-sm-12 col-lg-12">

        <form name="report_problem_form" id="report_problem_form" class="form-horizontal" style="padding-top: 20px;" method="post" action="<?php echo c_site_url('support/report_problem'); ?>">

			<span style="color: red;"><?php echo validation_errors(); ?></span>
			<?php show_flash_message(); ?>
                      
		   <div class="form-group">
            <label class="col-xs-12 col-sm-6 col-lg-5 l-padding">Name<i style="color:#FF0000;">*</i></label>
            <div class="col-xs-12 col-sm-6 col-lg-6">
              <input type="text" name="name" class="form-control validate[required]" />
            </div>
          </div>
		   <div class="form-group">
            <label class="col-xs-12 col-sm-6 col-lg-5 l-padding">Email<i style="color:#FF0000;">*</i></label>
            <div class="col-xs-12 col-sm-6 col-lg-6">
               <input type="text" name="email" class="form-control validate[required]" />
            </div>
          </div>
		   <div class="form-group">
            <label class="col-xs-12 col-sm-6 col-lg-5 l-padding">Phone<i style="color:#FF0000;">*</i></label>
            <div class="col-xs-12 col-sm-6 col-lg-6">
               <input type="text" name="phone" class="form-control validate[required]" />
            </div>
          </div>
		   <div class="form-group">
           <label class="col-xs-12 col-sm-6 col-lg-5 l-padding">Username<i style="color:#FF0000;">*</i></label>
            <div class="col-xs-12 col-sm-6 col-lg-6">
              <input type="text" name="username" class="form-control validate[required]" />
            </div>
          </div>
		  <div class="form-group">
            <label class="col-xs-12 col-sm-6 col-lg-5 l-padding">Are You On A P.C. or a MAC Computer?<i style="color:#FF0000;">*</i></label>
            <div class="col-xs-12 col-sm-6 col-lg-6">
              <input type="text" name="computer_type" class="form-control validate[required]" />
            </div>
          </div>
		   <div class="form-group">
            <label class="col-xs-12 col-sm-6 col-lg-5 l-padding">Experiencing Problem On A Tablet or Smartphone?<i style="color:#FF0000;">*</i></label>
            <div class="col-xs-12 col-sm-6 col-lg-6">
               <input type="text" name="device_type" class="form-control validate[required]" />
            </div>
          </div>
		   <div class="form-group">
            <label class="col-xs-12 col-sm-6 col-lg-5 l-padding">Which Operating System Are You Running?<i style="color:#FF0000;">*</i></label>
            <div class="col-xs-12 col-sm-6 col-lg-6">
               <input type="text" name="os" class="form-control validate[required]" />
            </div>
          </div>
		   <div class="form-group">
           <label class="col-xs-12 col-sm-6 col-lg-5 l-padding">What Browser Were Your Using When Experiencing Problem?<i style="color:#FF0000;">*</i></label>
            <div class="col-xs-12 col-sm-6 col-lg-6">
              <input type="text" name="browser" class="form-control validate[required]" />
            </div>
          </div>
		   <div class="form-group">
            <label class="col-xs-12 col-sm-6 col-lg-5 l-padding">Details Of The Problem<i style="color:#FF0000;">*</i></label>
            <div class="col-xs-12 col-sm-6 col-lg-6">
              <textarea name="details" class="form-control validate[required]" rows="6"></textarea>
            </div>
          </div>
		  
		  <div class="form-group">
            <label class="col-xs-12 col-sm-6 col-lg-5 l-padding"></label>
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
		$("#report_problem_form").validationEngine();
	});
</script>