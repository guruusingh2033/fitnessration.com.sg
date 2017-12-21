<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-83973118-1', 'auto');
  ga('send', 'pageview');
</script>
</head>
<body class="<?php echo $pageName ?>">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=1029120713823087";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
	<?php if ($user): ?>
	<script type="text/template" id="orderTmpl">
		<?php
			$mealPlan = $db->mealPlans->findOne(['_id' => $user['profile']['preferences']['mealPlan']]);
			$portion = $db->portions->findOne(['_id' => $user['profile']['preferences']['portion']]);
			echo replaceVariables(file_get_contents(__DIR__.'/../common/templates/welcome-back.html'), [
				'profilePicture' => $user['profile']['picture'] ? $user['profile']['picture'] : 'common/images/profile-picture-placeholder.149.png',
				'firstName' => $user['profile']['firstName'] ? $user['profile']['firstName'] : $user['username'],
				'preferences.mealPlan.name' => $mealPlan['name'],
				'preferences.mealPlan.icon' => $mealPlan['icon'],
				'preferences.portion.name' => $portion['name'],
				'preferences.portion.icon' => $portion['icon'],
				'orderWizardUrl' => $config['orderWizardUrl'],
				'userDashboardUrl' => $config['userDashboardUrl'],
			], [
				'display' => displayValue,
			]);
		?>
	</script>
	<?php endif ?>
	<script id="popupTemplate" type="text/template">
    <div class="popup-wrapper">
      <div class="popup">
        <span class="popup__title"></span>
        <a href="#" class="popup__close">Close</a>
        <div class="popup__content">
        </div>
      </div>
    </div>
	</script>
	<script type="text/template" id="loginPopupTmpl">
		<form>
			<a href="#" class="facebook">Facebook</a>
			<div class="field">
				<label>Email</label>
				<input type="text" name="email" required>
			</div>
			<div class="field">
				<label>Password</label>
				<input type="password" name="password" required>
				<!-- <div class="show-characters"><input type="checkbox"> <label>Show characters</label></div> -->
			</div>
			<p class="error invalid-auth">Invalid email or password.</p>
			<p class="error unknown-error">Failed to login.</p>
			<input type="submit" value="Log In">
			<a href="#" class="forgot-your-password">Forgot your password?</a>
		</form>
	</script>
	<script type="text/template" id="forgotPassword1Tmpl">
		<form>
			<p>Not to worry. Enter your email address and we'll send a new password over.</p>
			<div class="field">
				<label>Email</label>
				<input type="text" name="email" required>
			</div>
			<input type="submit" value="Next">
		</form>
	</script>
	<script type="text/template" id="forgotPassword2Tmpl">
		<form>
			<p>We've sent a new password to your email. Please log in and change it immediately under your profile settings.</p>
			<input type="button" value="Got it!">
		</form>
	</script>
	<script type="text/template" id="emailNotFoundTmpl">
		<form>
			<p>We're sorry, but we couldn't find an account with that email address.</p>
			<input type="button" value="Close">
		</form>
	</script>
	<!-- Header -->
	<?php
		$headerTemplate = replaceVariables(file_get_contents(__DIR__.'/../common/templates/header.html'), [
			'username' => $user['profile']['firstName'] ? $user['profile']['firstName'] : $user['username'],
			'userDashboardUrl' => $config['userDashboardUrl'],
			'orderWizardUrl' => $config['orderWizardUrl'],
			'websiteUrl' => $config['websiteUrl'],
		]);
		$doc = new DOMDocument();
		@$doc->loadHTML($headerTemplate, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
		$xpath = new DOMXPath($doc);
		if ($user) {
			$el = $xpath->query('//li[@class="login"]')->item(0);
		}
		else {
			$el = $xpath->query('//li[@class="user"]')->item(0);
		}
		$el->parentNode->removeChild($el);
		echo $doc->saveHTML();
	?>
