<?php //print_r($user_videos); ?>

<script type="text/javascript" language="javascript">

	$(document).ready(function(){

		function loadData(page, per_page){
			$(".video_container").html('<center><h3 style="color: green;">loading videos, please wait...</h3></center>');

			$.ajax ({
				type: "POST",
				url: "<?php echo site_url('video/ajax_function'); ?>",
				data: "page="+page+'&per_page='+per_page,
				success: function(msg) {
					$(".video_container").html(msg);
				}
			});
		}

		loadData(1, 9);  // For first time page load default results

		$(document).on('click', '.video_container .custom_pagination li a', function() {
			var page = $(this).attr('p');
			loadData(page, 9);
		});

	});

</script>


<div class="fluid_container">

	<div class="camera_wrap camera_magenta_skin" id="camera_wrap_1">
    
		<div id="tab-bg6">
        
			<div id="box-bg" class="video_container">

				

			</div>
            
		</div>
        
	</div>
    
</div>