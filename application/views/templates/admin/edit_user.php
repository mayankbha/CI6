<h1>Edit User</h1>
<p><?php echo lang('edit_user_subheading');?></p>

<?php if(isset($message) && !empty($message)): ?>
	<div id="infoMessage" class="alert alert-warning"><?php echo $message; ?></div>
<?php endif; ?>

<?php echo form_open(uri_string());?>

      <p>
            <?php echo lang('edit_user_fname_label', 'first_name');?> <br />
            <?php echo form_input($first_name);?>
      </p>

      <p>
            <?php echo lang('edit_user_lname_label', 'last_name');?> <br />
            <?php echo form_input($last_name);?>
      </p>

      <p>
            <?php echo lang('edit_user_company_label', 'company');?> <br />
            <?php echo form_input($company);?>
      </p>

      <p>
            <?php echo lang('edit_user_phone_label', 'phone');?> <br />
            <?php echo form_input($phone);?>
      </p>

      <p>
            <?php echo lang('edit_user_email_label', 'email'); ?> <br />
            <?php echo form_input($email);?>
      </p>

      <?php echo form_hidden('id', $user->id);?>
      <?php echo form_hidden($csrf); ?>

      <p><input type="submit" class="btn btn-lg btn-success btn-block" value="Submit" name="submit" /></p>

<?php echo form_close();?>
