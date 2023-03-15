

<div class="fluid_container">
    <div class="camera_wrap camera_magenta_skin" id="camera_wrap_1">

        <div id="tab-bg5">
            <div id="box-bg">
                <div class="col-xs-12 bg-line"><h2>Tips</h2></div>
                <div class="col-xs-12">&nbsp;</div>
                <div id='calendar2'></div> <!--------calendar------>
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

        $('#calendar2').fullCalendar({
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
                window.top.location='<?php echo c_site_url("tips/index/") ?>/'+calEvent.id;
            },
            events: [
                
                <?php 
                    if($user_tips){ $i=1;
                        foreach ($user_tips as $user_tip) {
                ?>
                    {
                        title: '<?php echo $user_tip->title ?>',
                        start: new Date(<?php echo date('Y', strtotime($user_tip->create_date)) ?>,<?php echo date('m',strtotime($user_tip->create_date))-1 ?>,<?php echo date('d',strtotime($user_tip->create_date)) ?>),
                        id: '<?php echo $user_tip->id ?>'
                    }<?php if($i!=count($user_tips)){ ?>,<?php } ?>
                <?php
                     $i++;   }
                    }
                ?>
            ]
        });

    });
</script>