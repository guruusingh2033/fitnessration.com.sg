<?php

if ($_POST['email']) {
	require_once('vendor/autoload.php');

	$mail = new PHPMailer;

	//$mail->SMTPDebug = 3;                               // Enable verbose debug output

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.mandrillapp.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'Fitness Ration';                 // SMTP username
	$mail->Password = 'mCuHYZK_ZDZp3SWytrelsg';                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                    // TCP port to connect to

	$mail->setFrom('enquiries@fitnessration.com.sg', 'Business/Events Form');
	$mail->addAddress('enquiries@fitnessration.com.sg', 'Enquiries');     // Add a recipient
	$mail->addReplyTo($_POST['email'], $_POST['person']);

	if ($_FILES['file']['tmp_name']) {
		$mail->addAttachment($_FILES['file']['tmp_name'], $_FILES['file']['name']);         // Add attachments			
	}

	$body = "$_POST[description]\n\n$_POST[contactnumber]";

	$mail->Subject = $_POST['enquiry'];
	$mail->Body    = nl2br($body);
	$mail->AltBody = $body;

	if(!$mail->send()) {
	    // echo 'Message could not be sent.';
	    // echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
	    // echo 'Message has been sent';
	}


	$mail = new PHPMailer;

	//$mail->SMTPDebug = 3;                               // Enable verbose debug output

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.mandrillapp.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'Fitness Ration';                 // SMTP username
	$mail->Password = 'mCuHYZK_ZDZp3SWytrelsg';                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                    // TCP port to connect to

	$mail->setFrom('enquiries@fitnessration.com.sg', 'Fitness Ration');
	$mail->addAddress($_POST['email'], $_POST['person']);     // Add a recipient
	$mail->addReplyTo('enquiries@fitnessration.com.sg', 'Fitness Ration');


	$mail->Subject = 'Thank you for reaching out to Fitness Ration';
	$mail->Body    = nl2br("Hi $_POST[person],

Your request for a partnership / collaboration has been received. 
The team will process your proposal and will respond as soon as we can. 

Meanwhile, feel free to learn more about what we do and the food we provide on our <a href='http://www.facebook.com/fitnessration'>Facebook page</a> or click on the FAQs (http://www.fitnessration.com.sg/faq.php) for answers to commonly asked questions. 

Cheers,
Team Fitness Ration");

	$mail->AltBody = "Hi $_POST[person],

Your request for a partnership / collaboration has been received. 
The team will process your proposal and will respond as soon as we can. 

Meanwhile, feel free to learn more about what we do and the food we provide on our Facebook page (http://www.facebook.com/fitnessration) or click on the FAQs (http://www.fitnessration.com.sg/faq.php) for answers to commonly asked questions. 

Cheers,
Team Fitness Ration";

	if(!$mail->send()) {
	    // echo 'Message could not be sent.';
	    // echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
	    // echo 'Message has been sent';
	}

}

?>
<?php require 'includes/header.php' ?>
<?php tmpl_init([
	'pageName' => 'businesspage',
	'pageTitle' => 'Business/Events',
]) ?>
<?php tmpl_fullTop() ?>
	<!-- Main -->
	<main>
		<section id="business" class="title">
			<div class="intro">
				<h1>Business/Events</h1>
			</div>
		</section>
		<section id="businessform">
			<form enctype="multipart/form-data" class="contact-form" method="POST">
				<input type="hidden" name="MAX_FILE_SIZE" value="26214400" />
				<select name="enquiry">
					<option value="type">Enquiry Type</option>
					<option value="Stocking our meals">Stocking our meals</option>
					<option value="Long-term collaborations">Long-term collaborations</option>
					<option value="Ad hoc events">Ad hoc events</option>
					<option value="Others">Others</option>
				</select>
				<label for="person">Person in Charge</label>
				<input type="text" name="person" required>
				<label for="email">Email</label>
				<input type="email" name="email" required>
				<label for="contactnumber">Contact Number</label>
				<input type="tel" name="contactnumber" required>
				<label for="description">Brief Description (200 words)</label>
				<textarea name="description" required></textarea>
				<label for="upload">Attach any proposals or reference here</label>
				<input type="file" name="file">
				<button type="submit" name="submit">Send</button>
			</form>
			<?php if ($_POST['email']): ?>
			<p>Your message has been sent.</p>
			<?php endif ?>
		</section>
	</main>
<?php tmpl_bottom() ?>
