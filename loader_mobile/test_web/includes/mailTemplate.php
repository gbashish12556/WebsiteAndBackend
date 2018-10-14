<?php 
$mailTemplate = array();
$mailTemplate['email_verification_subject'] = 'Please verify your email address';
$mailTemplate['email_verification_content'] = '<span style="font-size:15px; font-weight:bold;">Dear %%NAME%%,</span><br/><br/>
            Please click the following link to verify your email address:<br/>
            <a href="%%ACTIVELINK%%" style="color:#004586;">%%ACTIVELINK%%</a><br/><br/>
			Verification Code - %%VERIFICATIONCODE%%
            <br/>If you click the link and it appears to be broken, please copy and paste the link <br/>into a new browser window.';
$mailTemplate['forgotpassword_subject'] = 'Forgot Password';
$mailTemplate['forgotpassword_content'] = '<span style="font-size:15px; font-weight:bold;">Dear %%NAME%%</span><br/><br/>
            Please click on the link below to change your password:<br/>
            <a href="%%ACTIVELINK%%" style="color:#004586;">%%ACTIVELINK%%</a><br/><br/>
			<br/>If you click the link and it appears to be broken, please copy and paste the link <br/>into a new browser window.<br/><br/>
If you did not request to reset your password, you can ignore this mail, and  your password <br/>will remain unchanged.
';

$mailTemplate['changepassword_subject'] = 'Change Password';
$mailTemplate['changepassword_content'] = '<span style="font-size:15px; font-weight:bold;">Dear %%NAME%%</span><br/><br/>
            Your password has been changed succesfully<br/>';

$mailTemplate['contactus_subject'] = '%%NAME%%-%%SUBJECT%%';
$mailTemplate['contactus_content'] = '<span style="font-size:15px; font-weight:bold;">Message From:- %%NAME%%</span><br/>
									<span style="font-size:15px; font-weight:bold;">Mail From:- %%MAIL%%</span><br/> 
									<span style="font-size:15px; font-weight:bold;">Message:- %%MESSAGE%%</span><br/><br/>';
$mailTemplate['welcome_subject'] = 'Your account on loader has been created';
$mailTemplate['welcome_content'] = '<span style="font-size:15px; font-weight:bold;">Dear %%NAME%%,</span><br/><br/>
            Your account on loader has been created successfully. You can now start using your account. 
<br/>';		


$mailTemplate['reward_accepted'] = 'You have received a message from %%NAME%%';
$mailTemplate['reward_accepted_content'] = '<span style="font-size:15px; font-weight:bold;">Message From:- %%NAME%%</span><br/>
									<span style="font-size:15px; font-weight:bold;">Mail From:- %%MAIL%%</span><br/> 
									<span style="font-size:15px; font-weight:bold;">Message:- %%MESSAGE%%</span><br/><br/>';


							
$smsTemplate = array();


?>