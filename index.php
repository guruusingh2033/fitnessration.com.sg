<?php require 'includes/header.php' ?>
<?php tmpl_init([
	'pageName' => 'landingpage-new',
]) ?>
<?php tmpl_top() ?>
	<link rel="stylesheet" type="text/css" href="css/home.css">
	<script src="http://www.youtube.com/player_api"></script>
	<style type="text/css">
		.smart-food { position: relative; }
		#videoObj {
			position: absolute;
			left: 0;
			right: 0;
			top: 0;
			bottom: 0;
			width: 100%;
			height: 100%;
		}
	</style>
	<script type="text/javascript">
		$(function() {
			<?php if ($user): ?>
			$('.smart-food .order').click(function() {
				orderNow();
				return false;
			});
			<?php endif ?>

			$('.smart-food .scroll-down').click(function() {
				$('html, body').animate({scrollTop:$(window).height() - $('header').height()});

				return false;
			});

			$('.smart-food .play-video').click(function() {
				$('#videoObj').show();

				// autoplay video
				function onPlayerReady(event) {

				}
				// when video ends
				function onPlayerStateChange(event) {   
					if(event.data === 0) {          
						setTimeout(function() {
							$('#top').removeClass('playing');
							$('#top video.header').get(0).play();
							$('#video').html('<div id="videoObj" />')
						}, 500);
					}
				}

				var player = new YT.Player('videoObj', {
					videoId: 'PN2wMCTqK5I',
					playerVars: {rel: 0, autoplay: 1, controls:0, showinfo:0, modestbranding:1, autohide:1},
					events: {
						'onReady': onPlayerReady,
						'onStateChange': onPlayerStateChange
					}
				});
			});

			function updateSectionHeight() {
				$('.smart-food').height($(window).height() - $('header').height());
			}

			updateSectionHeight();
			$(window).resize(updateSectionHeight);
		});
	</script>
<?php tmpl_middle() ?>
	<main>
		<section class="smart-food">
			<video muted autoplay loop webkit-playsinline>
				<source src="videos/home.mp4" type="video/mp4">
			</video>
			<h1><strong>Smart Food Makes</strong> Sharp Minds and Steady Bodies</h1>
			<a href="#" class="play-video">Play Video</a>
			<a href="<?php echo $config['orderWizardUrl'] ?>" class="order">Order Now</a>
			<div id="videoObj" style="display:none"></div>
			<a href="#" class="scroll-down"></a>
		</section>
		<section class="aspirations">
			<h2>When was the last time we thought about our aspirations?</h2>
			<p>With fully calibrated meals delivered anywhere, you'll have the time and strength to go for it</p>
			<span class="feature super-shelf-life">
				Super Shelf Life
				<a href="#frozen-is-the-new-fresh">Learn More</a>
			</span>
			<span class="feature complete-meals">
				Complete Meals
				<a href="menu.php">See Menu</a>
			</span>
		</section>
		<section data-ref="frozen-is-the-new-fresh" class="frozen-is-the-new-fresh">
			<h2>Frozen is the new fresh</h2>
			<p>Like having a reliable stash in your freezer, snap freezing your meals is genius because it locks in all the nutrients and texture.</p>
			<p>Enjoy a month-long shelf life at 100% natural, no artificial preservatives or additives.</p>
			<a href="food.php#science" class="learn-more">Learn More</a>
		</section>
		<section class="full-stacked-benefits">
			<h2>Full stacked benefits</h2>
			<p>From sourcing to prep, washing to cooking, portioning to delivery islandwide, we process everything by hand so you never have to.</p>
			<p>With our economies of scale, get healthy food at the daily price it should be and made by the people you can trust.</p>
			<a href="food.php#diverse-cuisine" class="learn-more">Learn more</a>
		</section>
		<section class="perfect-portions">
			<h2>Perfect portions</h2>
			<p>It's not just about the calories. You body is unique and everyone has different goals. For instance, you’re definitely going to need a whole lot more food if you’re a marathoner.</p>
			<p>Check out how our nutritional calibrations help your body become what you need it to.</p>
			<a href="food.php#meal-type" class="meal-type">Meal Type</a>
			<a href="food.php#gender-specific" class="portion-sizes">Portion Sizes</a>
		</section>
		<section class="community-series">
			<h2>#FRCommunitySeries</h2>
			<p class="be-inspired">Be Inspired</p>
			<ul class="people">
				<li>
					<img src="images/landing/raghavan.jpg">
					<span class="name">Raghavan K, Safety Officer</span>
					<span class="question">Next Goal?</span>
					<p>Be a manager at the site. Seeing a building form before me is quite an experience. And it’s great having Fitness Ration with me all the time because I need all the energy I can get.</p>
				</li>
				<li>
					<img src="images/landing/theresa.jpg">
					<span class="name">Theresa T, Primary School Educator </span>
					<span class="question">Life Values?</span>
					<p>Some people might look at my life and say wow, I’ve gone on a detour. But nevermind the detours. Life is not a straight road. And these meals saves me alot of prep time in making that journey.</p>
				</li>
				<li>
					<img src="images/landing/stephen.jpg">
					<span class="name">Stephen B, Entrepreneur</span>
					<span class="question">Greatest Achievement?</span>
					<p>Being brave enough to leave stability behind in pursuit of passion, growth and progress. I can't say I love all the sacrifice and pressure, but at least Fitness Ration takes away the headache of eating well.</p>
				</li>
			</ul>
		</section>
	</main>
<?php tmpl_bottom() ?>
