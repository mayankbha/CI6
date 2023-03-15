<?php //print_r($user_fitness_schedules); ?>

<div class="fluid_container">
	<div class="camera_wrap camera_magenta_skin" id="camera_wrap_1">
		<div id="tab-bg1">
			<div id="box-bg">
				<div class="col-xs-12 bg-line"><h2>Fitness Schedule</h2></div>
				<div class="col-xs-12">&nbsp;</div>
				<div id='calendar'></div> <!--------calendar------>
				<div class="col-xs-12">&nbsp;</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>

<style>
	.fc-event-inner {
		cursor: pointer !important;
	}
</style>

<script>

    $(document).ready(function() {

        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        $('#calendar').fullCalendar({
            theme: true,
            header: {
                left: 'prev,next',
                center: 'title',
                right: ''
            },
            editable: false,
            eventDurationEditable: false,
            eventDrop: false,
            eventClick: function(calEvent, jsEvent, view) {
                window.top.location='<?php echo c_site_url("fitness/index/") ?>/'+calEvent.id;
            },
            events: [
                
                <?php 
                    if($user_fitness_schedules){ $i=1;
                        foreach ($user_fitness_schedules as $user_fitness_schedule) {
                ?>
                    {
                        title: '<?php echo $user_fitness_schedule->title ?>',
                        start: new Date(<?php echo date('Y', strtotime($user_fitness_schedule->dtime)) ?>,<?php echo date('m',strtotime($user_fitness_schedule->dtime))-1 ?>,<?php echo date('d',strtotime($user_fitness_schedule->dtime)) ?>),
                        id: '<?php echo $user_fitness_schedule->id ?>'
                    }<?php if($i!=count($user_fitness_schedules)){ ?>,<?php } ?>
                <?php
                     $i++;   }
                    }
                ?>
            ]
        });

    });
</script>