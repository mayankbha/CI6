<?php //print_r($user_meal_photos); ?>

<script type="text/javascript" language="javascript">

	$(document).ready(function(){

		function loadData(page, per_page){
			$(".meal_container").html('<center><h3 style="color: green;">loading photos, please wait...</h3></center>');

			$.ajax({
				type: "POST",
				url: "<?php echo site_url('user_public_profile/ajax_function/'.$uid); ?>",
				data: "page="+page+'&per_page='+per_page,
				success: function(msg) {
					$(".meal_container").html(msg);
				}
			});
		}

		loadData(1, 9);  // For first time page load default results

		$(document).on('click', '.meal_container .custom_pagination li a', function() {
			var page = $(this).attr('p');
			loadData(page, 9);
		});

	});

</script>

<div class="fluid_container">

	<div class="camera_wrap camera_magenta_skin" id="camera_wrap_1">

		<div id="tab-bg3">

			<div id="box-bg" class="meal_container">
				
			</div>

		</div>

	</div>

</div>