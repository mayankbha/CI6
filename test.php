<?php /*?><html>
	<body>
		<p>Hello <?php echo sprintf(lang('email_activate_heading'), $identity); ?>,<p>
		<p>Thank you for registering with Health Freaks</p>
		<p><?php echo sprintf(lang('email_activate_subheading'), anchor('auth/activate/'. $id .'/'. $activation, lang('email_activate_link'))); ?></p>
		<p>Track Your Life</p>
	</body>
</html><?php */?>

<html>

	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
		<title>Health Freaks</title>
	</head>

	<body style='font-family:Verdana;font-size:13px;'>
		<p>&nbsp;</p>
		<p>&nbsp;</p>

		<p>Hello <?php //echo sprintf(lang('email_activate_heading'), $identity); ?>,</p>

		<p>Welcome to health freaks</p>

		<p>You are now ready to track your life with <a href='http://healthfreakslive.com' style='color:#1155CC'><span class='enq'>healthfreakslive.com</span></a>, a huge network of healthy minded individuals.</p>

		<p><span class='confirm' style='color:#0000FF'>To confirm your email address click on the link below or copy & paste the link into the address bar within your browser. </span></p>

		<p><div style='border: 1.8px solid #808080; height: 49px;'>
			<br><center><span style='color: #1155CC;text-align: end;font-weight:bold;'>
            <a href='http://healthfreakslive.com' style='color:#1155CC'>healthfreakslive.com</a>
			<?php //echo sprintf(lang('email_activate_subheading'), anchor('auth/activate/'. $id .'/'. $activation, lang('email_activate_link'))); ?></span></center></br></div>
		</p>

		<p>Wishing You Success!</p>

		<p>If you have any questions, inquries, suggestions or want to report an issue, please visit out support page at at http://healthfreakslive.com/support</p>

	</body>

</html>