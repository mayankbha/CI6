</div>
<div class="mibg">
    <div class="container">

        <div id="myCarousel" class="carousel slide">

            <!-- Carousel items -->
            <div class="carousel-inner">

                <div class="item active">
                    <div class="row-fluid">
                        <div class="col-sm-2 l-space">
                            <a href="#" data-toggle="modal" data-target="#myModal2"><div class="blue-arrow"></div><img src="<?php echo base_url('assets/site-new/') ?>/images/selfie-photos.jpg" alt="SELFIE PHOTOS" class="img-responsive"></a>
                            <div class="sl-bg">SELFIE PHOTOS</div>
                        </div>
                        <div class="col-sm-2 l-space">
                            <a href="#" data-toggle="modal" data-target="#myModal2"><div class="blue-arrow"></div><img src="<?php echo base_url('assets/site-new/') ?>/images/meal-planner.jpg" alt="MEAL PLANNER" class="img-responsive"></a>
                            <div class="sl-bg">MEAL PLANNER</div>
                        </div>
                        <div class="col-sm-2 l-space">
                            <a href="#" data-toggle="modal" data-target="#myModal2"><div class="blue-arrow"></div><img src="<?php echo base_url('assets/site-new/') ?>/images/fitness-schedule.jpg" alt="FITNESS SCHEDULE" class="img-responsive"></a>
                            <div class="sl-bg">FITNESS SCHEDULE</div>
                        </div>
                        <div class="col-sm-2 l-space">
                            <a href="#" data-toggle="modal" data-target="#myModal2"><div class="blue-arrow"></div><img src="<?php echo base_url('assets/site-new/') ?>/images/motivational.jpg" alt="MOTIVATIONAL" class="img-responsive"></a>
                            <div class="sl-bg">MOTIVATIONAL</div>
                        </div>
                        <div class="col-sm-2 l-space">
                            <a href="#" data-toggle="modal" data-target="#myModal2"><div class="blue-arrow"></div><img src="<?php echo base_url('assets/site-new/') ?>/images/journal.jpg" alt="JOURNAL" class="img-responsive"></a>
                            <div class="sl-bg">JOURNAL</div>
                        </div>
                        <div class="col-sm-2 l-space">
                            <a href="#" data-toggle="modal" data-target="#myModal2"><div class="blue-arrow"></div><img src="<?php echo base_url('assets/site-new/') ?>/images/video-gallery.jpg" alt="VIDEO GALLERY" class="img-responsive"></a>
                            <div class="sl-bg">VIDEO GALLERY</div>
                        </div>
                    </div><!--/row-fluid-->
                </div><!--/item-->

                <div class="item">
                    <div class="row-fluid">
                        <div class="col-sm-2 l-space">
                            <a href="#" data-toggle="modal" data-target="#myModal2"><div class="blue-arrow"></div><img src="<?php echo base_url('assets/site-new/') ?>/images/test.jpg" alt="Image" class="img-responsive"></a>
                            <div class="sl-bg">SELFIE PHOTOS</div>
                        </div>
                        <div class="col-sm-2 l-space">
                            <a href="#" data-toggle="modal" data-target="#myModal2"><div class="blue-arrow"></div><img src="<?php echo base_url('assets/site-new/') ?>/images/test.jpg" alt="Image" class="img-responsive"></a>
                            <div class="sl-bg">MEAL PLANNER</div>
                        </div>
                        <div class="col-sm-2 l-space">
                            <a href="#" data-toggle="modal" data-target="#myModal2"><div class="blue-arrow"></div><img src="<?php echo base_url('assets/site-new/') ?>/images/test.jpg" alt="Image" class="img-responsive"></a>
                            <div class="sl-bg">COMING SOON</div>
                        </div>
                        <div class="col-sm-2 l-space">
                            <a href="#" data-toggle="modal" data-target="#myModal2"><div class="blue-arrow"></div><img src="<?php echo base_url('assets/site-new/') ?>/images/test.jpg" alt="Image" class="img-responsive"></a>
                            <div class="sl-bg">COMING SOON</div>
                        </div>
                        <div class="col-sm-2 l-space">
                            <a href="#" data-toggle="modal" data-target="#myModal2"><div class="blue-arrow"></div><img src="<?php echo base_url('assets/site-new/') ?>/images/test.jpg" alt="Image" class="img-responsive"></a>
                            <div class="sl-bg">COMING SOON</div>
                        </div>
                        <div class="col-sm-2 l-space">
                            <a href="#" data-toggle="modal" data-target="#myModal2"><div class="blue-arrow"></div><img src="<?php echo base_url('assets/site-new/') ?>/images/test.jpg" alt="Image" class="img-responsive"></a>
                            <div class="sl-bg">COMING SOON</div>
                        </div>
                    </div><!--/row-fluid-->
                </div><!--/item-->


            </div><!--/carousel-inner-->

            <a class="left carousel-control" href="#myCarousel" data-slide="prev"><img src="<?php echo base_url('assets/site-new/') ?>/images/prev.png" class="p-icon"></a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next"><img src="<?php echo base_url('assets/site-new/') ?>/images/next.png" class="p-icon"></a>
        </div><!--/myCarousel-->   

    </div>
</div>
<div id="footer">HEALTHFREAKSLIVE.COM</div>

<!--Login Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content mo-back2">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div><img src="<?php echo base_url('assets/site-new/') ?>/images/test2.jpg" alt="Image" class="img-responsive border-img"></div>
                <div><h4>MEAL PLANNER</h4></div>
                <div class="text">Document your meals, calories, carbs, fat grams, etc. Provide recipes. Plan your meal schedules, print your meal plan for the day, week and month! Create a gallery of your meals. </div>

            </div>

        </div>
    </div>
</div>
<!--End Login Modal -->

<script>
    $(document).ready(function() {
        $('#myCarousel').carousel({
            interval: 10000
        })
    });
</script>

</body>
</html>