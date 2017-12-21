<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="apple-touch-icon" sizes="57x57" href="common/images/favicons/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="common/images/favicons/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="common/images/favicons/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="common/images/favicons/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="common/images/favicons/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="common/images/favicons/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="common/images/favicons/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="common/images/favicons/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="common/images/favicons/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="common/images/favicons/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="common/images/favicons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="common/images/favicons/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="common/images/favicons/favicon-16x16.png">
	<!-- <link rel="manifest" href="common/images/favicons/manifest.json"> -->
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<meta charset="UTF-8">
	<?php if ($pageTitle): ?>
	<title><?php echo $pageTitle ?> | Fitness Ration</title>
	<?php else: ?>
	<title>Fitness Ration</title>
	<?php endif ?>
	<meta name="viewport" content="width=320, user-scalable=no"/>
	<link rel="stylesheet" href="common/fonts/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" type="text/css" href="css/welcome-back.css">
	<link rel="stylesheet" type="text/css" href="css/header.css">
	<link rel="stylesheet" type="text/css" href="css/background-image.css">
	<link rel="stylesheet" type="text/css" href="css/login-popup.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
	<script type="text/javascript" src="js/config.js"></script>
	<script type="text/javascript" src="common/scripts/background-image.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
	<script type="text/javascript">
		function initWebsiteHeader() {
			var selector = '#togglembnav, header nav > ul > li'
			if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
				$(selector).find('*').click(function(e) {
					e.stopPropagation();
				});
				$(selector).click(function(e) {
					$(this).toggleClass('show');
					// $(e).stop();
					return false;
				});				
			}
			else {
				$(selector).hover(function() {
					$(this).toggleClass('show');
				});
			}
		}
		$(function() {
			initWebsiteHeader();
			$('a[href^="#"]').each(function() {
				var ref = $(this).attr('href').substr(1);
				if (ref) {
					$(this).click(function() {
						$('html, body').animate({scrollTop:$('[data-ref=' + ref + ']').offset().top - $('header').height()});
						return false;
					})
				}
			});
			if (location.hash && $('[data-ref=' + location.hash.substr(1) + ']').length) {
				$('html, body').scrollTop($('[data-ref=' + location.hash.substr(1) + ']').offset().top - $('header').height());
			}
			<?php if ($user): ?>
			$('header .order, footer .order a').click(function() {
				orderNow();
				return false;
			});			
			<?php else: ?>
			$('header nav .login a').click(function() {
				showPopup({
					type: 'basic-popup-with-title',
					content: $('#loginPopupTmpl').html(),
					title: 'Log In',
					id: 'login-popup',
					init: function(popup) {
						popup.el.find('.facebook').click(function() {
							FB.login(function(response) {
								$.get('<?php echo $config['userDashboardUrl'] ?>api/facebook-login', {accessToken:response.authResponse.accessToken, expiresIn:response.authResponse.expiresIn}, function(response) {
									var expires = new Date(new Date().getTime() + 60*60*24*30*2 * 1000)
									document.cookie = 'auth=' + encodeURIComponent(JSON.stringify(response)) + '; domain=fitnessration.com.sg; path=/; expires=' + expires;
									document.location.reload();
								});
							}, {scope:'email'});
						});
						popup.el.find('form').submit(function() {
							popup.clientEl.removeClass('invalid-auth');
							popup.clientEl.removeClass('unknown-error');
							$.post('<?php echo $config['userDashboardUrl'] ?>api/login', {username:popup.el.find('[name=email]').val().toLowerCase(), password:popup.el.find('[name=password]').val()}, function(response) {
								// console.log(response);
								var expires = new Date(new Date().getTime() + 60*60*24*30*2 * 1000)
								if (response.status == 'success') {
									document.cookie = 'auth=' + encodeURIComponent(JSON.stringify(response.data)) + '; domain=fitnessration.com.sg; path=/; expires=' + expires;
									document.location.reload();
								}
							}).fail(function(response) {
								if (response.responseJSON.message == 'Unauthorized') {
									popup.clientEl.addClass('invalid-auth');
								}
								else {
									popup.clientEl.addClass('unknown-error');
								}
							});
							return false;
						});
						popup.el.find('.forgot-your-password').click(function() {
							popup.close();
							showPopup({
								type: 'basic-popup-with-title',
								content: $('#forgotPassword1Tmpl').html(),
								title: 'Trouble signing in?',
								id: 'forgot-password1-popup',
								init: function(popup) {
									popup.el.find('form').submit(function() {
										$.get('<?php echo $config['userDashboardUrl'] ?>api/users/reset-password', {email:popup.el.find('[name=email]').val().toLowerCase()}, function(response) {
											if (response) {
												popup.close();
												showPopup({
													type: 'basic-popup-with-title',
													content: $('#forgotPassword2Tmpl').html(),
													title: 'Forgot Password',
													id: 'forgot-password2-popup',
													init: function(popup) {
														popup.el.find('input[type="button"]').click(function() {
															popup.close();
														})
													}
												});
											}
											else {
												popup.close();
												showPopup({
													type: 'basic-popup-with-title',
													content: $('#emailNotFoundTmpl').html(),
													title: 'Email Not Found',
													id: 'email-not-found-popup',
													init: function(popup) {
														popup.el.find('input[type="button"]').click(function() {
															popup.close();
														})
													}
												});
											}
										});
										return false;
									});
								}
							});
							return false;
						});
					}
				});
				return false;
			});
			<?php endif ?>
		});
	</script>
	