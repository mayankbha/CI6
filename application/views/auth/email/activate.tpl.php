<?php /*?>
<html>
	<body>
		<p>Hello <?php echo sprintf(lang('email_activate_heading'), $identity); ?>,<p>
		<p>Thank you for registering with Health Freaks</p>
		<p><?php echo sprintf(lang('email_activate_subheading'), anchor('auth/activate/'. $id .'/'. $activation, lang('email_activate_link'))); ?></p>
		<p>Track Your Life</p>
	</body>
</html>
<?php */?>

<html>

	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
		<title>Health Freaks</title>
	</head>

	<body style='font-family: Verdana; font-size: 13px;'>
		<p>&nbsp;</p>
		<p>&nbsp;</p>

		<p>Hello, <?php //echo sprintf(lang('email_activate_heading'), $identity); ?></p>

		<p>Welcome to Health Freaks!</p>

		<p>You are now ready to track your life.</p>

		<p><span class='confirm' style='color:#000'>To confirm your email address click on the link below or copy & paste the link into the address bar within your browser.</span></p>

		<p>
			<div style='height: 49px;'>
				<br>
				<center>
					<span style='text-align: end;margin-bottom:15px;'>
						<i><?php echo sprintf(lang('email_activate_heading'), $identity); ?></i><br />
						<?php //echo sprintf(lang('email_activate_subheading')); ?>						
					</span>
					
				</center>
				</br>
			</div>
		</p>

		<p><b style="margin-left:60px;" >Please click this link to <span style='color: #1155CC;' ><?php echo sprintf(anchor('auth/activate/'. $id .'/'. $activation, lang('email_activate_link'))); ?></span></b></p>

		<p>If you have any questions, inquries, suggestions or want to report an issue, please visit out support page at at http://healthfreakslive.com/support</p>

	</body>

</html>