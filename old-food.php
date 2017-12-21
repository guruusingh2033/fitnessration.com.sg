<?php require('vendor/autoload.php') ?>
<?php require 'includes/header.php' ?>
<?php
use \Michelf\Markdown;
foreach ($db->mealPlans->find() as $mealPlan) {
	$mealPlans[] = $mealPlan;
}
?>
<?php tmpl_init([
	'pageName' => 'foodpage',
	'pageTitle' => 'Our Food',
]) ?>
<?php tmpl_top() ?>
	<script type="text/javascript">
		$(function() {
			var tab = '<?php echo $mealPlans[0]['_id'] ?>';
			function updateTab() {
				$('#mealplans .tabs h3').removeClass('active');
				$('#mealplans .tabs h3[data-meal-plan="' + tab + '"]').addClass('active');
				$('#mealplans div[data-meal-plan]').hide();
				$('#mealplans div[data-meal-plan="' + tab + '"]').show();
			}
			$('#mealplans .tabs h3').click(function() {
				tab = $(this).attr('data-meal-plan');
				updateTab();
			});
			updateTab();
		});
	</script>
<?php tmpl_middle() ?>
	<!-- Main -->
	<main>
		<section id="food" class="title">
			<div class="intro">
				<h1>Our Food</h1>
			</div>
			<a href="#" class="scroll">Scroll</a>
		</section>
		<section id="science" class="alternate2columns">
			<h2>Our Responsibility: Science</h2>
			<img src="images/our-food/our-responsibility.gif" alt="">
			<div class="content">
				<p>We use industrial standard snap freezing technology to ensure a fast, safe and optimal natural preservation.</p>
				<p>You’ll find that the full nutritional contents, quality, taste and texture of all ingredients are exactly the same, and even better when heated.</p>
				<p>Think of it as natural hibernation when it’s fresh out of the oven.</p>
			</div>
		</section>
		<section id="heating" class="alternate2columns">
			<h2>Healthy Eating in 4 Minutes</h2>
			<img src="images/our-food/healthy-eating.png" alt="">
			<div class="content">
				<p>Heating it up is easy. Our custom built trays are designed for even distribution of heat. Simply nuke it in the microwave for 4 minutes and you’re set.</p>
				<p>TIP: Heat at home and store in a bag for a quick lunch</p>
				<table>
					<tr>
						<th colspan="3">Alternative Heating</th>
					</tr>
					<tr>
						<td>Oven</td>
						<td>15 minutes</td>
						<td>180 degree Celcius</td>
					</tr>
					<tr>
						<td>Steamer</td>
						<td>20 minutes</td>
						<td>Boiling water</td>
					</tr>
					<tr>
						<th colspan="3">Specs</th>
					</tr>
					<tr>
						<td>Diameter</td>
						<td>22cm</td>
					</tr>
					<tr>
						<td>Height</td>
						<td>4cm</td>
					</tr>
					<tr>
						<td colspan="3">Food grade PP (Black)</td>
					</tr>
					<tr>
						<td colspan="3">Freezer &amp; microwave / heat safe</td>
					</tr>
				</table>
			</div>
		</section>
		<section id="choosewhen" class="alternate2columns">
			<h2>You Choose When You Want to Eat</h2>
			<img src="images/our-food/you-choose.png" alt="">
			<div class="content">
				<p>No subscription plans, no scheduled pick-ups. We’re all out to provide you a long term solution, easy to store in your home. It’s all in your freezer and it’s good to go within a month’s time.</p>
			</div>
		</section>
		<section id="chefs" class="alternate2columns">
			<h2>Our Chefs, a Dedicated Force to be Reckoned With</h2>
			<img src="images/our-food/our-chefs.png" alt="">
			<div class="content">
				<p>Meticulous hands, innovative minds.</p>
				<p>Every recipe, ingredients and process is screened under the watchful eyes of our chefs.</p>
				<p>You’ll find the occasional odd shaped fish and vegetables. That’s how you know we’re never about manufactured processes, but all about the process of creating bulk volume orders from scratch on a daily basis.</p>
				<a href="team.php#chefs" class="button-line-sec">Meet the chefs</a>
			</div>
		</section>
		<section id="tastebuds" class="alternate2columns">
			<h2>The World at Your Tastebuds</h2>
			<img src="images/our-food/the-world.png" alt="">
			<div class="content">
				<p>One of the greatest things about doing everything in house is that we can offer an international selection of dishes. Have a taste of everything from India to Spain to Korea within days.</p>
				<p>Look out for new menu items every month.</p>
			</div>
		</section>
		<section id="deliveries" class="alternate2columns">
			<h2>Deliveries to Your Doorstep Till Late</h2>
			<img src="images/our-food/deliveries.png" alt="">
			<div class="content">
				<p>Our very own fleet of freezer trucks keeps your food safe and cool all day long. This means you get to pick and choose exactly when you’d want your food to be delivered!</p>
				<p>Working late? Opt for a 9pm slot. Sleeping in today? Choose a 1pm slot.</p>
				<p>It’s never too late for us.</p>
				<a href="team.php#delivery" class="button-line-sec">Meet our delivery guy</a>
			</div>
		</section>
		<section id="mealplans" class="alternate2columns">
			<h2>Meal Plans</h2>
			<div class="tabs">
				<?php foreach ($mealPlans as $mealPlan): ?>
				<h3 data-meal-plan="<?php echo $mealPlan['_id'] ?>"><?php echo $mealPlan['name'] ?></h3>
				<?php endforeach ?>
			</div>
			<?php foreach ($mealPlans as $mealPlan): ?>
			<div data-meal-plan="<?php echo $mealPlan['_id'] ?>" class="tabcontent">
				<img src="#" alt="">
				<div class="content">
					<?php echo Markdown::defaultTransform($mealPlan['website']['description']) ?>
				</div>
			</div>
			<?php endforeach ?>
		</section>
		<section id="genderspecific" class="alternate2columns">
			<h2>Gender Specific? What’s That?</h2>
			<img src="#" alt="">
			<div class="content">
				<p>We’re the only ones around to provide calibrations according to the Health Promotion Board’s Recommended Dietary Allowance of each gender.</p>
				<p>This means you only pay for what you get. Less portions means you get to pay less.</p>
			</div>
		</section>
		<section id="portioning" class="alternate2columns">
			<h2>Team Portioning Masters</h2>
			<img src="#" alt="">
			<div class="content">
				<p>We’ve assembled our very own team of portioning masters to ensure each meal is weighed, portioned, and sealed safely.</p>
				<p class="footnote">&#42;Grammage are based on external nutrition consultants</p>
				<a href="career.php" class="button-line-sec">Be a portioning master</a>
			</div>
		</section>
	</main>
<?php tmpl_bottom() ?>
