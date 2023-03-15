<?php //echo $uid; ?>

<h1>Reset User Password</h1>

<div id="infoMessage">
	<span style="color: red;"><?php echo validation_errors(); ?></span>
    <?php show_flash_message(); ?>
</div>

<?php echo form_open("admin/users/change_password/".$uid); ?>

      <p>
            <label for="new_password"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length); ?></label> <br />
            <?php echo form_input($new_password); ?>
      </p>

      <p>
            <?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm');?> <br />
            <?php echo form_input($new_password_confirm); ?>
      </p>

      <?php echo form_input($user_id); ?>
      <p><input type="submit" class="btn btn-lg btn-success btn-block" value="Submit" name="submit" /></p>

<?php echo form_close();?>
