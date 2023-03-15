<?php //print_r($user_selfie_photos); ?>

<script type="text/javascript" language="javascript">

	$(document).ready(function(){

		loadData(1, 9, 'asc');  // For first time page load default results

		$(document).on('click', '.selfphoto_container .custom_pagination li a', function() {
			var page = $(this).attr('p');
			loadData(page, 9);
		});

	});

	function loadData(page, per_page, sort_order){
		$(".selfphoto_container").html('<center><h3 style="color: green;">loading photos, please wait...</h3></center>');

		$.ajax({
			type: "POST",
			url: "<?php echo site_url('selfiephoto/ajax_function'); ?>",
			data: "page="+page+'&per_page='+per_page+'&sort_order='+sort_order,
			success: function(msg) {
				$(".selfphoto_container").html(msg);
			}
		});
	}

	function sortRecord(order) {
		loadData(1, 9, order);
	}

</script>

<div class="fluid_container">

	<div class="camera_wrap camera_magenta_skin" id="camera_wrap_1">
    
		<div id="tab-bg4">
        
			<div id="box-bg">
				
                <div style="border: 0px solid;">
                	<div class="col-xs-12 bg-line">
                    	<div style="border: 0px solid; float: left; width: 160px;">
                        	<h2>Selfie Photos</h2>
                        </div>
                        <div style="border: 0px solid; float: left; margin-top: 18px;">
                        	<select onchange="sortRecord(this.value);">
                            	<option value="">-- Sort By --</option>
                                <option value="asc">Earliest to Latest</option>
                                <option value="desc">Latest to Earliest</option>
                            </select>
                        </div>
                     </div>
                 </div>
                
                <div style="border: 0px solid;" class="selfphoto_container"></div>
                
			</div>
            
		</div>
        
	</div>
    
</div>