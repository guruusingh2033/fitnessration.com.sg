<?php require 'includes/header.php' ?>
<?php tmpl_init([
	'pageName' => 'ourfood-new',
]) ?>
<?php tmpl_top() ?>
	<link rel="stylesheet" type="text/css" href="css/food.css">
	<script type="text/javascript">
		$(function() {
			$('.meal-type .nav li a').click(function() {
				var contEl = $(this).parents('.meal-type');
				contEl.removeClass('lean-on-me').removeClass('heavy-duty');
				contEl.addClass($(this).parent().attr('class'));
				return false;
			});

			function readMoreLink(contEl, contentSelector) {
				contEl.find(contentSelector).hide();
				contEl.find('.read-more').click(function() {
					var contentEl = contEl.find(contentSelector);
					contentEl.toggle();
					if (contentEl.is(':visible')) {
						$(this).html('Read Less <<');
					}
					else {
						$(this).html('Read More >>');
					}
					return false;
				});
			}

			readMoreLink($('.healthy-eating-in-minutes'), '.more');
			readMoreLink($('.meal-type'), '.specs');
		});
	</script>
<?php tmpl_middle() ?>
	<main>
		<section class="header">
			<h1>Our Food</h1>
		</section>
		<section data-ref="science" class="science-our-responsibility">
			<h2>Science, Our Responsibility</h2>
			<p>With industrial standard snap-freezing technology, you’ll find that the full nutritional contents, taste and texture of all ingredients are contained.</p>
		</section>
		<section class="healthy-eating-in-minutes">
			<h2>Healthy Eating In Minutes</h2>
			<p>Heating it up is easy. Our custom built trays are designed for even distribution of heat. Simply pop it in the microwave and you’re set for a piping hot meal.</p>
			<p>TIP: Heat at home and store in a bag for a quick lunch</p>
			<a href="#" class="read-more">Read More &gt;&gt;</a>
			<div class="more">
				<div class="alternative-heating">
					<h3>Alternative heating</h3>
					<div class="heating-method">
						<span class="container">Oven</span>
						<span class="duration">15 minutes</span>
						<span class="temperature">180 degree Celcius</span>
					</div>
					<div class="heating-method">
						<span class="container">Steamer</span>
						<span class="duration">20 minutes</span>
						<span class="temperature">Boiling water</span>
					</div>
				</div>
				<p>*Contents must be placed in oven proof tray before baking.</p>
				<div class="tray-specs">
					<h3>Tray specs</h3>
					<span class="spec">
						<span class="property">Diameter</span>
						<span class="value">22cm</span>
					</span>
					<span class="spec">
						<span class="property">Height</span>
						<span class="value">4cm</span>
					</span>
					<span class="spec">Food grade PP (Black)</span>
					<span class="spec">Freezer &amp; microwave / heat safe</span>
				</div>
			</div>
		</section>
		<section class="meal-time-is-anytime">
			<h2>Meal Time Is Anytime</h2>
			<p>We’re all out to provide you a sustainable easy solution for eating right. No subscription plans, no closing hours. Stash a bundle of meals in your freezer and you’re good to go.</p>
		</section>
		<section class="strong-culinary-focus">
			<h2>Strong Culinary Focus</h2>
			<p>Every recipe and process is drafted, approved and diligently screened by our Chefs. Every ingredient is hand chopped, tossed and tasted before it heads out.</p>
			<p>Simmered, roasted, poached or grilled; we do it the real way.</p>
			<a href="team.php#why">Meet Why, Our Head Chef</a>
		</section>
		<section data-ref="diverse-cuisine" class="taste-the-world">
			<h2>Taste The World</h2>
			<p>One of the greatest things about our culinary crew is that they come from an amazingly rich and diverse background.</p>
			<p>From numbing szechuan peppers to distinct Indian spices and authentic Thai herbs, eat the world in comfort of your own home.</p>
			<p>Look out for new releases and seasonal specials every quarter.</p>
		</section>
		<section class="delivered-even-at-night">
			<h2>Delivered, Even At Night</h2>
			<p>Our very own fleet of cold trucks keep your food at a safe -18 degree celcius all day long.</p>
			<p>Working late? Opt for a 10pm slot. Sleeping in today? Choose a 1pm slot. Perhaps you’re surprising a friend? Let us know to arrive at 7.23pm.</p>
			<p>Serving our meals directly to you is the least we could do.</p>
			<a href="team.php#fadzly">Meet Fadzly, Our Delivery Guy</a>
		</section>
		<section data-ref="meal-type" class="meal-type lean-on-me">
			<h2>Meal Type</h2>
			<ul class="nav">
				<li class="lean-on-me"><a href="#">Lean On Me</a></li>
				<li class="heavy-duty"><a href="#">Heavy Duty</a></li>
			</ul>
			<div class="lean-on-me">
				<p>Calibrated to help you reach satiety and get lean, this meal type presents low carbohydrates, a selection of fibrous greens plus, a proud serving of protein making it a worthy Fitness Ration meal. A couple of Lean On Me’s per week will encourage stronger digestive health and a resilient heart.</p>
				<p><strong>Balance and pace with generous fibre and protein servings.</strong></p>
				<a href="#" class="read-more">Read More &gt;&gt;</a>
				<div class="specs">
					<h3>Specs</h3>
					<ul>
						<li>Controlled carbohydrates at less than 50g</li>
						<li>Complex carbohydrate sources</li>
						<li>A hearty 42g serving of protein </li>
						<li>Innovative mix of fibrous greens</li>
						<li>Good source of vitamin C, calcium and iron</li>
						<li>High in good cholesterol</li>
					</ul>
				</div>
			</div>
			<div class="heavy-duty">
				<p>Calibrated for high energy release, this meal type includes ample amount of carbohydrates in recipes of all sorts, stimulating your taste buds and building your stamina. Matching that is a side of fresh fibre and a fistful of protein to achieve optimal health and strength.</p>
				<p>Elevate yourself from your active regime with this energy-rich combi.</p>
				<a href="#" class="read-more">Read More &gt;&gt;</a>
				<div class="specs">
					<h3>Specs</h3>
					<ul>
						<li>At least 70g of carbohydrates served</li>
						<li>Strong variation of carbohydrate sources</li>
						<li>A hearty 42g serving of protein</li>
						<li>Good source of vitamin C, calcium and iron</li>
						<li>High in good cholesterol</li>
					</ul>
				</div>
			</div>
		</section>
		<section data-ref="gender-specific" class="gender-specific">
			<h2>Gender Specific</h2>
			<p>Our calibrations are according to the Health Promotion Board’s Recommended Dietary Allowance of each gender.</p>
			<p>This gives you the option to choose a portion size and pay only for what you need.</p>
			<p>Less portions means you get to pay less.</p>
		</section>
	</main>
<?php tmpl_bottom() ?>
