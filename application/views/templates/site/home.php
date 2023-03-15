<div class="container">
    <div class="top-wrap">

    </div>
    <div class="row-fluid ">
        <div class="span6 lft-box">
            <div  class=" center-img-front ">
                <div  class="center-white-space-top"></div>
                <div>&nbsp;</div>
                <div class="row-fluid show-grid " id="box-margin">
                    <div class="span6 opacity-block">
                        <div id="right" class="small-box-front1" >
                            <span  class="blue-box-title">SELFIE PHOTOS</span>
                            <div class="front-icon-1"></div>
                        </div>
                        <div id="clear" class="small-box-front2">
                            You can upload your photos daily, weekly
                            or monthly.  Track your progression
                            through your photos.  If you can notice it,
                            imagine how many other people notice
                            you too.  Keep it up!
                        </div>
                    </div>
                    <div class="span6 opacity-block">
                        <div id="right" class="small-box-front1" >
                            <span class="blue-box-title">MEAL PLANNER</span>
                            <div class="front-icon-2"></div>
                        </div>
                        <div id="clear" class="small-box-front2">
                            Document your meals, calories, carbs, fat
                            grams, etc.  Provide recipes.  Plan your
                            meal schedules, print your meal plan for
                            the day, week and month!  Create a
                            gallery of your meals. 
                        </div>
                    </div>
                    <div class="span6 opacity-block">
                        <div id="right" class="small-box-front1" >
                            <span class="blue-box-title">FITNESS SCHEDULE</span>
                            <div class="front-icon-3"></div>
                        </div>
                        <div id="clear" class="small-box-front2">
                            Plan your fitness schedule and then print
                            your workouts for the day, week 
                            and month!
                        </div>
                    </div>
                </div>
                <div class="row-fluid show-grid" id="box-margin">
                    <div class="span6 opacity-block">
                        <div id="right" class="small-box-front1" >
                            <span class="blue-box-title">MOTIVATIONAL</span>
                            <div class="front-icon-4"></div>
                        </div>
                        <div id="clear" class="small-box-front2">
                            Post tips, motivational and inspirational
                            statements, etc. 
                        </div>
                    </div>
                    <div class="span6 opacity-block">
                        <div id="right" class="small-box-front1" >
                            <span class="blue-box-title">JOURNAL</span>
                            <div class="front-icon-5"></div>
                        </div>
                        <div id="clear" class="small-box-front2">
                            Keep a daily journal safe online,
                            password protected.  
                        </div>
                    </div>


                    <div class="span6 opacity-block">
                        <div id="right" class="small-box-front1" >
                            <span class="blue-box-title">VIDEO GALLERY</span>
                            <div class="front-icon-6"></div>
                        </div>
                        <div id="clear" class="small-box-front2">
                            Upload videos and create a video gallery
                            and access the videos anytime 24/7. 
                        </div>
                    </div>
                </div>
                <div style="" class="font-center-btmspace"></div>
            </div>
        </div>
        <div class="span6 rgt-box">
            <div class="right-wrap">
            </div>
            <div class="right-black-box">
                <div class="black-box-text">  IT'S 100% FREE, NO CREDIT CARD EVER REQUIRED! </div>	
            </div>
            <div align="center">
                <form class="form-horizontal cus-frontpage-form" method="post" action="" id="registerForm">
                
                    <div id="control-group">
						<span style="color: red;"><?php echo $message; ?></span>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label cus-control-label " for="inputEmail">NAME<i style="color:#FF0000;">*</i></label>
                        <div class="controls cus-control">
                            <?php echo form_input($name);?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label cus-control-label" for="inputPassword">EMAIL<i style="color:#FF0000;">*</i></label>
                        <div class="controls cus-control">
                            <?php echo form_input($email);?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label cus-control-label" for="username">USERNAME<i style="color:#FF0000;">*</i></label>
                        <div class="controls cus-control">
                            <?php echo form_input($username);?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label cus-control-label" for="password">PASSWORD<i style="color:#FF0000;">*</i></label>
                        <div class="controls cus-control">
                            <?php echo form_input($password);?>
                        </div>
                    </div>

                    <div class="control-group">
                        <div>&nbsp;</div>
                        <div class="controls cus-control">
                            <span class="agree">AGREE TO TERMS & CONDITIONS<i style="color:#FF0000;">*</i></span>&nbsp;&nbsp;
                            <?php echo form_checkbox('agree', '1', FALSE, 'id="agree"');?>
                            <div>&nbsp;</div>
                            <input type="image" src="<?php echo base_url('assets/site') ?>/img/signup.png" id="signup" name="signup" />
                            <div>&nbsp;</div><div>&nbsp;</div>

                        </div>
                    </div>
                </form>
            </div> 

        </div>
    </div> 
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#registerForm').validationEngine();
    });
</script>