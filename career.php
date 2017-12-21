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

	$mail->setFrom('enquiries@fitnessration.com.sg', 'Career Form');
	$mail->addAddress('enquiries@fitnessration.com.sg', 'Enquiries');     // Add a recipient
	$mail->addReplyTo($_POST['email'], $_POST['name']);

	if ($_FILES['file']['tmp_name']) {
		$mail->addAttachment($_FILES['file']['tmp_name'], $_FILES['file']['name']);         // Add attachments		
	}

	$body = "$_POST[message]\n\n$_POST[contactnumber]";

	$mail->Subject = 'Career';
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
	$mail->addAddress($_POST['email'], $_POST['name']);     // Add a recipient
	$mail->addReplyTo('enquiries@fitnessration.com.sg', 'Fitness Ration');


	$mail->Subject = 'Almost there! We look forward to welcoming you to Fitness Ration';
	$mail->Body    = nl2br("Hi $_POST[name],

Your application to join Team Fitness Ration has been received.
We will respond to you via email or a call as soon as we can. 

Meanwhile, feel free to learn more about what we do and the food we provide on our <a href='http://www.facebook.com/fitnessration'>Facebook page</a>

Good luck!
Team Fitness Ration");

	$mail->AltBody = "Hi $_POST[name],

Your application to join Team Fitness Ration has been received.
We will respond to you via email or a call as soon as we can. 

Meanwhile, feel free to learn more about what we do and the food we provide on our Facebook page (http://www.facebook.com/fitnessration)

Good luck!
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
	'pageName' => 'careerpage',
	'pageTitle' => 'Career',
]) ?>
<?php tmpl_fullTop() ?>
	<!-- Main -->
	<main>
		<section id="career" class="title">
			<div class="intro">
				<h1>Jumpstart Your Career</h1>
			</div>
		</section>
		<section id="positions">
			<h2>Positions Open</h2>
			<p>The underlying Fitness Ration family’s culture has always been self-motivated, passion-driven, hardcore tenacity at all costs. We welcome anyone and everyone who love what they do, and love what we stand for.</p>
			<p>If you feel you can contribute in a role not specified here, you may email us at enquiries@fitnessration.com.sg</p>
			<section>
				<h3>Marketing &amp; Communications</h3>
				<div class="position">
					<h4>Head Designer / Art Director</h4>
					<p>A specialized role suited for highly unorthodox creatives with a knack for solving everyday problems through beautiful designs. We could really use one in the team.</p>
				</div>
			</section>
			<section>
				<h3>Culinary</h3>
				<div class="position">
					<h4>Commis Chef</h4>
					<p>A rewarding career with a path to putting your own creations on the table. Start here to develop a unique skillset you can’t find in any restaurant or manufacturing facility.</p>
				</div>
				<div class="position">
					<h4>Portioning Master</h4>
					<p>A shift work with weekly wages and incredibly vital in our assembly line. You’ll need patience and a detailed eye for weighing each ingredient, and be prepared for some physical activity when a big fresh tray of potatoes needs lifting.</p>
				</div>
			</section>
		</section>
		<section id="careerform">
			<form enctype="multipart/form-data" class="contact-form" method="POST">
				<input type="hidden" name="MAX_FILE_SIZE" value="26214400" />
				<label for="name">Name</label>
				<input type="text" name="name" required>
				<label for="email">Email</label>
				<input type="email" name="email" required>
				<label for="contactnumber">Contact Number</label>
				<input type="tel" name="contactnumber" required>
				<label for="message">Message</label>
				<textarea name="message" required></textarea>
				<label for="upload">Attach your CV here</label>
				<input type="file" name="file">
				<button type="submit" name="submit">Send</button>
			</form>
			<?php if ($_POST['email']): ?>
			<p>Your message has been sent.</p>
			<?php endif ?>
		</section>
	</main>
<?php tmpl_bottom() ?>
