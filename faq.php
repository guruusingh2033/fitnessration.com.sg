<?php require 'includes/header.php' ?>
<?php tmpl_init([
	'pageTitle' => 'FAQ',
	'pageName' => 'faqpage',
]) ?>
<?php tmpl_fullTop() ?>
	<!-- Main -->
	<main>
		<section id="faq" class="title">
			<div class="intro">
				<h1>FAQ</h1>
			</div>
			<a href="#" class="scroll">Scroll</a>
		</section>
		<section class="filter-container">
			<select name="faqcategories">
				<option value="all">Browse All</option>
				<option value="purchase">Purchase Enquiries</option>
				<option value="food">Food Enquiries</option>
				<option value="delivery">Delivery Enquiries</option>
				<option value="aftersale">Aftersale Enquiries</option>
				<option value="general">General Enquiries</option>
			</select>
			<section data-category="purchase">
				<h2>Purchase Enquiries</h2>
				<div class="column">
					<div class="accordion">
						<p>Why are meals sold in bundles? </p>
						<div class="bellows">
							<p>We believe in optimal convenience and long term solutions. With our freshly frozen meals you can store them for weeks in the freezer. It works because you don’t have to reschedule dinner appointments, simply consume them whenever you need to!</p>
						</div>
					</div>
					<div class="accordion">
						<p>Why are your meals gender-specific? Can I consume a male-calibrated meal if I am a female?</p>
						<div class="bellows">
							<p>Our meals are calibrated according to the Health Promotion Board’s recommended dietary allowance. As males and females are biologically different, our bodies have varying capacity of calorie and protein intake too. Nevertheless, these are guidelines that we recommend, but we do not strictly enforce them.</p>
						</div>
					</div>
				</div>
				<div class="column">
					<div class="accordion">
						<p>Can I purchase this for a friend?</p>
						<div class="bellows">
							<p>Of course! As long as you have their mailing details, you may buy your friend a Fitness Ration meal bundle.</p>
						</div>
					</div>
					<div class="accordion">
						<p>Are the payments safe / secure?</p>
						<div class="bellows">
							<p>All payments go through secure gateways and we don’t save any of your personal informations or banking details. </p>
						</div>
					</div>
				</div>
				<div class="column">
					<div class="accordion">
						<p>I want to share a bundle with my friends and split the deliveries. Is this possible?</p>
						<div class="bellows">
							<p>Sure, we’re all out for social eating so go ahead to share your purchase. Simply let us know by leaving a comment of the next address. Each additional delivery is subjected to a delivery charge.</p>
						</div>
					</div>
				</div>
			</section>
			<section data-category="food">
				<h2>Food Enquiries</h2>
				<div class="column">
					<div class="accordion">
						<p>Do you have added preservatives, additives and are your meals gluten-free?</p>
						<div class="bellows">
							<p>We do not add any preservatives or additives to our meals. All ingredients are treated with natural products and go through the blast freezing process to maintain its original quality. However, our meals aren’t gluten free. If you have a special event that requires gluten free dishes, email us and we’ll see what we can do!</p>
						</div>
					</div>
					<div class="accordion">
						<p>Are your meals Halal?</p>
						<div class="bellows">
							<p>We are currently not Halal certified. However, our supplies of ingredients are halal certified and we do not use any pork, lard nor alcohol within our kitchen premises. </p>
						</div>
					</div>
				</div>
				<div class="column">
					<div class="accordion">
						<p>What is blast freezing?</p>
						<div class="bellows">
							<p>It’s basically a technology that allows us to reduce the freshly cooked food to freezing point (-18℃). This not only maintains optimum quality, shape, size and taste of each ingredient, but it prevents bacteria from entering the food (as compared to room temperature or chilled food) for extremely long periods of time – similar to hibernation!</p>
						</div>
					</div>
					<div class="accordion">
						<p>Will eating Fitness Ration meals make me lose weight?</p>
						<div class="bellows">
							<p>We cannot guarantee that eating Fitness Ration daily will make you lose weight as there are several factors to losing weight. Our meals are design to support and complement your fitness lifestyle, that’s why we’re certified by a nutritionist to ensure the right balance of nutrients for your body without the unhealthy oils, excess sodium and trans fat.</p>
						</div>
					</div>
				</div>
				<div class="column">
					<div class="accordion">
						<p>How do I reheat my meals?</p>
						<div class="bellows">
							<p>Reheating can be done via microwave oven, steamer or a convection oven. You will need to first defrost your meals for at least 12 hours in the chiller. Pop it into the microwave for 4-6 mins on medium high. Remember to check your microwave's label to know its Watts. It’s usaully at the back. And don’t worry if you get lost, all the instructions are printed at the back of the sleeve plus we’re available anytime to answer your questions.</p>
						</div>
					</div>
				</div>
			</section>
			<section data-category="delivery">
				<h2>Delivery Enquiries</h2>
				<div class="column">
					<div class="accordion">
						<p> Where do you deliver to?</p>
						<div class="bellows">
							<p>We deliver island-wide in Singapore! There is however, a slight surcharge for areas in Tuas and Sentosa. </p>
						</div>
					</div>
				</div>
				<div class="column">
					<div class="accordion">
						<p>What is the cut-off date to reschedule my meal or change my choice of meal?</p>
						<div class="bellows">
							<p>The cut-off time for next day delivery is usually 5pm the day before. However, this varies and we’ll always show you the earliest available delivery date upon ordering.</p>
						</div>
					</div>
				</div>
			</section>
			<section data-category="aftersale">
				<h2>Aftersale Enquiries</h2>
				<div class="column">
					<div class="accordion">
						<p>Can I get refunds for my meals?</p>
						<div class="bellows">
							<p>We do not normally refund should you decide to cancel your meals upon ordering as the meal would have been prepared already. But if you feel that you deserve a refund, feel free to drop us an email and we’ll do our best to serve you better.</p>
						</div>
					</div>
				</div>
				<div class="column">
					<div class="accordion">
						<p>What happens to my meal if I have an emergency, and am unable to collect it on the given day?</p>
						<div class="bellows">
							<p>Do call us ASAP if you’re unable to receive the meals. We’ll be more than happy to store your meals with us or make special arrangements.</p>
						</div>
					</div>
				</div>
			</section>
			<section data-category="general">
				<h2>General Enquiries</h2>
				<div class="column">
					<div class="accordion">
						<p>Will we see new items on the menu?</p>
						<div class="bellows">
							<p>We introduce new dishes frequently, so look out for featured items or leave us a Facebook comment on what we should have!</p>
						</div>
					</div>
					<div class="accordion">
						<p>Is Fitness Ration similar to a diet program?</p>
						<div class="bellows">
							<p>Nope. We are most definitely not a diet program. Our meals are healthy convenience food designed to give you proper sustained energy or simply a better meal option in your day.</p>
						</div>
					</div>
				</div>
				<div class="column">
					<div class="accordion">
						<p>Do you have a storefront?</p>
						<div class="bellows">
							<p>Sure! Although we don’t usually do dine-ins, you’re welcomed to drop by our kitchen to grab a couple of meals or just have a chat with us.</p>
						</div>
					</div>
				</div>
			</section>
		</section>
	</main>
<?php tmpl_bottom() ?>