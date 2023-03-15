<?php //print_r($user_selfie_photos); ?>

<script type="text/javascript" language="javascript">

	$(document).ready(function(){

		function loadData(page, per_page){
			$(".selfphoto_container").html('<center><h3 style="color: green;">loading photos, please wait...</h3></center>');

			$.ajax({
				type: "POST",
				url: "<?php echo site_url('user_public_profile/selfphoto_ajax_function/'.$uid); ?>",
				data: "page="+page+'&per_page='+per_page,
				success: function(msg) {
					$(".selfphoto_container").html(msg);
				}
			});
		}

		loadData(1, 9);  // For first time page load default results

		$(document).on('click', '.selfphoto_container .custom_pagination li a', function() {
			var page = $(this).attr('p');
			loadData(page, 9);
		});

	});

</script>

<div class="fluid_container">

	<div class="camera_wrap camera_magenta_skin" id="camera_wrap_1">
    
		<div id="tab-bg4">
        
			<div id="box-bg" class="selfphoto_container">
				
			</div>
            
		</div>
        
	</div>
    
</div>