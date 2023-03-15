<style>
	.pager li {
		margin-left: 6px;
	}
</style>

<?php

if($_POST['page'])
{
	$result_pag_data = $query;

	$msg = '<div class="col-xs-12 bg-line"><h2>VIDEOS</h2></div>';

	if($result_pag_data) {

		foreach($result_pag_data  as $row) {
			$msg .= '<div class="col-xs-12 col-sm-4 col-lg-4">'.$row->title.'<iframe src="'.$row->video_embed_link.'" width="240"></iframe></div>';
		}

		$msg .= '<div class="clearfix"></div>';

		/*---------------------------------------------*/
		$count = $total;
		$no_of_paginations = ceil($count / $per_page);

		if($no_of_paginations > 1) {

			/*---------------Calculating the starting and endign values for the loop-----------------------------------*/
			if ($cur_page >= 7) {
				$start_loop = $cur_page - 3;
				if ($no_of_paginations > $cur_page + 3)
					$end_loop = $cur_page + 3;
				else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
					$start_loop = $no_of_paginations - 6;
					$end_loop = $no_of_paginations;
				} else {
					$end_loop = $no_of_paginations;
				}
			} else {
				$start_loop = 1;
				if ($no_of_paginations > 7)
					$end_loop = 7;
				else
					$end_loop = $no_of_paginations;
			}
	
			/* ----------------------------------------------------------------------------------------------------------- */
			$msg .= "<div class='custom_pagination'><ul class='pager'>";
	
			// FOR ENABLING THE FIRST BUTTON
			if ($first_btn && $cur_page > 1) {
				//$msg .= "<li p='1' class='active'>First</li>";
			} else if ($first_btn) {
				//$msg .= "<li p='1' class='inactive'>First</li>";
			}
	
			// FOR ENABLING THE PREVIOUS BUTTON
			if ($previous_btn && $cur_page > 1) {
				$pre = $cur_page - 1;
				$msg .= "<li><a href='javascript: void(0)' class='btn-blue1 test' p='$pre'>Previous</a></li>";
			} else if ($previous_btn) {
				$msg .= "<li><a href='javascript: void(0)' class='btn-blue1 test'>Previous</a></li>";
			}
	
			for($i = $start_loop; $i <= $end_loop; $i++) {
				if ($cur_page == $i) {
					$msg .= "<li class='active'><a href='javascript: void(0)' p='$i'>{$i}</a></li>";
				} else {
					$msg .= "<li><a href='javascript: void(0)' p='$i'>{$i}</a></li>";
				}
			}
	
			// TO ENABLE THE NEXT BUTTON
			if ($next_btn && $cur_page < $no_of_paginations) {
				$nex = $cur_page + 1;
				$msg .= "<li><a href='javascript: void(0)' class='btn-blue1' p='$nex'>Next</a></li>";
			} else if ($next_btn) {
				$msg .= "<li><a href='javascript: void(0)' class='btn-blue1'>Next</a></li>";
			}
	
			// TO ENABLE THE END BUTTON
			if ($last_btn && $cur_page < $no_of_paginations) {
				//$msg .= "<li p='$no_of_paginations' class='active'>Last</li>";
			} else if ($last_btn) {
				//$msg .= "<li p='$no_of_paginations' class='inactive'>Last</li>";
			}
	
			//$goto = "<input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:60px;'/><input type='button' id='go_btn' class='go_button' value='Go' />";
			//$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
			$msg .= "</ul></div>";  // Content for pagination
		}
	} else {
		$msg = 'No records found';
	}

	echo $msg;
}

?>