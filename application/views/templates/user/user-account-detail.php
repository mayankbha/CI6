<div class="sub-container">
 
  <div id="box-bg">
	<div class="col-xs-12 bg-line">
	<h2>PASSWORD RESET</h2>
	</div>
	  <div class="col-xs-12 col-sm-12 col-lg-12">

		<form class="form-horizontal" id="change_password_form" style="padding-top: 20px;" method="post" action="<?php echo c_site_url('user/change_password'); ?>">

			<span style="color: red;"><?php echo @$change_password_validation_error_message; ?></span>

			<span style="color: red;"><?php echo @$change_password_error_message['change_password_error_message']; ?></span>

			<span style="color: green;"><?php echo @$change_password_success_message['change_password_success_message']; ?></span>

    		<input type="hidden" name="user_id" id="user_id" class="form-control" value="<?php echo @$user_details->id; ?>">

		   <div class="form-group">
            <label class="col-xs-10 col-sm-4 col-lg-3 l-padding">Old Password<i style="color:#FF0000;">*</i></label>
            <div class="col-xs-12 col-sm-6 col-lg-6">
              <input type="password" name="old" id="old" class="form-control validate[required]">
            </div>
          </div>
		   <div class="form-group">
            <label class="col-xs-10 col-sm-4 col-lg-3 l-padding">New Password<i style="color:#FF0000;">*</i></label>
            <div class="col-xs-12 col-sm-6 col-lg-6">
               <input type="password" name="new" id="new" class="form-control validate[required]">
            </div>
          </div>
		   <div class="form-group">
            <label class="col-xs-10 col-sm-4 col-lg-3 l-padding">Confirm New Password<i style="color:#FF0000;">*</i></label>
            <div class="col-xs-12 col-sm-6 col-lg-6">
               <input type="password" name="new_confirm" id="new_confirm" class="form-control validate[required]">
            </div>
          </div>
		  <div class="form-group">
            <label class="col-xs-10 col-sm-4 col-lg-3 l-padding"></label>
            <div class="col-xs-12 col-sm-6 col-lg-6">
              <button type="submit" class="btn btn-yellow">UPDATE</button>
            </div>
          </div>
		  
        </form>

    </div>
	<div class="clearfix"></div>
  </div>
  
  
  <div id="box-bg">
	<div class="col-xs-12 bg-line">
	<h2>My Account</h2>
	</div>
	  <div class="col-xs-12 col-sm-12 col-lg-12">

        <form method="post" name="edit_account_form" id="edit_account_form" class="form-horizontal" style="padding-top: 20px;" enctype="multipart/form-data" action="<?php echo c_site_url('user/edit_profile'); ?>">

          <span style="color: red;"><?php echo @$update_error_profile_message['update_error_profile_message']; ?></span>
          
          <span style="color: green;"><?php echo @$update_success_profile_message['update_success_profile_message']; ?></span>
          
		   <div class="form-group">
            <label class="col-xs-10 col-sm-6 col-lg-5 l-padding"><span class="red">*</span>First</label>
            <div class="col-xs-12 col-sm-6 col-lg-6">
              <input type="text" name="fname" class="form-control" value="<?php echo @$user_details->first_name; ?>" />
            </div>
          </div>
		  <div class="form-group">
            <label class="col-xs-10 col-sm-6 col-lg-5 l-padding"><span class="red">*</span>Last</label>
            <div class="col-xs-12 col-sm-6 col-lg-6">
              <input type="text" name="lname" class="form-control" value="<?php echo @$user_details->last_name; ?>" />
            </div>
          </div>
		  <div class="form-group">
            <label class="col-xs-10 col-sm-6 col-lg-5 l-padding"><span class="red">*</span>Email</label>
            <div class="col-xs-12 col-sm-6 col-lg-6">
              <input type="text" name="email" class="form-control" value="<?php echo @$user_details->email; ?>" />
            </div>
          </div>
		  <div class="form-group">
            <label class="col-xs-10 col-sm-6 col-lg-5 l-padding">Phone</label>
            <div class="col-xs-12 col-sm-6 col-lg-6">
              <input type="text" name="phone" class="form-control" value="<?php echo @$user_details->phone; ?>" />
            </div>
          </div>
		  <div class="form-group">
            <label class="col-xs-10 col-sm-6 col-lg-5 l-padding">Address</label>
            <div class="col-xs-12 col-sm-6 col-lg-6">
              <input type="text" name="address" class="form-control" value="<?php echo @$user_details->address; ?>" />
            </div>
          </div>
		  <div class="form-group">
            <label class="col-xs-10 col-sm-6 col-lg-5 l-padding">City</label>
            <div class="col-xs-12 col-sm-6 col-lg-6">
              <input type="text" name="city" class="form-control" value="<?php echo @$user_details->city; ?>" />
            </div>
          </div>
		  <div class="form-group">
            <label class="col-xs-10 col-sm-6 col-lg-5 l-padding">State</label>
            <div class="col-xs-12 col-sm-6 col-lg-6">
              <input type="text" name="state" class="form-control" value="<?php echo @$user_details->state; ?>" />
            </div>
          </div>
		  <div class="form-group">
            <label class="col-xs-10 col-sm-6 col-lg-5 l-padding">Zip</label>
            <div class="col-xs-12 col-sm-6 col-lg-6">
              <input type="text" name="zip" class="form-control" value="<?php echo @$user_details->zip; ?>" />
            </div>
          </div>
		  <div class="form-group">
            <label class="col-xs-10 col-sm-6 col-lg-5 l-padding">Type Of Diet</label>
            <div class="col-xs-12 col-sm-6 col-lg-6">
              <input type="text" name="diet" class="form-control" value="<?php echo @$user_details->diet; ?>" />
            </div>
          </div>
		  <div class="form-group">
            <label class="col-xs-10 col-sm-6 col-lg-5 l-padding"><span class="red">*</span>Nickname (Shown On Your Public Profile)</label>
            <div class="col-xs-12 col-sm-6 col-lg-6">
              <input type="text" name="nickname" class="form-control" value="<?php echo @$user_details->nickname; ?>" />
            </div>
          </div>
		  <div class="form-group">
            <label class="col-xs-10 col-sm-6 col-lg-5 l-padding">Goals</label>
            <div class="col-xs-12 col-sm-6 col-lg-6">
              <input type="text" name="goals" class="form-control" value="<?php echo @$user_details->goals; ?>" />
            </div>
          </div>
		  <div class="form-group">
            <label class="col-xs-10 col-sm-6 col-lg-5 l-padding">Upload A Profile Pic</label>
            <div class="col-xs-12 col-sm-6 col-lg-6">
             <input type="file" name="photo" id="browse" style="display: none;" onChange="CopyMe(this, 'file');">                                                 
			<input type="text" name="file" id="file"  class="textbox" size="30" maxlength="255" />
			<input type="button" onClick="browse.click(); file.value = browse.value;" value="Browse" class="btn-browe">
            </div>
          </div>
          
		  <div id="images" class="form-group">
         	<input type="hidden" value="" name="crooperdata" id="crooperdata" />
            <img id="img" src="" alt="" class="cropper" />
          </div>
                    
		  <div class="form-group">
            <label class="col-xs-10 col-sm-6 col-lg-5 l-padding"></label>
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

<script type="text/javascript">
	var browser_type = jQuery.browser.mobile;
	//alert(browser_type);

	$(document).ready(function() {
		$("#change_password_form").validationEngine();
	});

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