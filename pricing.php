<?php require 'includes/header.php' ?>
<?php
$fulfillmentSettings = $db->fulfillmentSettings->findOne();
$deliveryFee = $fulfillmentSettings['deliveryFee'];
foreach ($db->portions->find() as $portion) {
	$portions[] = $portion;
}
foreach ($db->mealPlans->find() as $mealPlan) {
	$mealPlans[] = $mealPlan;
}
foreach ($db->bundleTypes->find()->sort(['price' => 1]) as $bundleType) {
	$bundleTypesByPortion[(string)$bundleType['portion']][(string)$bundleType['mealPlan']][] = $bundleType;
}
function bundleTypeSummary($bundleType) {
	if ($bundleType['basicMeals']) {
		$plural = $bundleType['basicMeals'] == 1 ? '' : 's';
		$summary[] = "$bundleType[basicMeals] Basic Meal$plural";
	}
	if ($bundleType['premiumMeals']) {
		$plural = $bundleType['premiumMeals'] == 1 ? '' : 's';
		$summary[] = "$bundleType[premiumMeals] Premium Meal$plural";
	}
	return implode(', ', (array)$summary);
}
?>
<?php  tmpl_init([
	'pageName' => 'pricingpage',
	'pageTitle' => 'Pricing',
]) ?>
<?php tmpl_top() ?>
	<script type="text/javascript">
		$(function() {
			var selectedPortion = '<?php echo $portions[0]['_id'] ?>';
			var selectedMealPlan = '<?php echo $mealPlans[0]['_id'] ?>';

			function update() {
				$('.tabs h3.active').removeClass('active');
				$('.tabs h3[data-meal-plan="' + selectedMealPlan + '"]').addClass('active');
				$('.tabs h3[data-portion="' + selectedPortion + '"]').addClass('active');
				$('section[data-portion][data-meal-plan]').hide();
				$('section[data-portion="' + selectedPortion + '"][data-meal-plan="' + selectedMealPlan + '"]').show();
			}

			$('.tabs h3').click(function() {
				if ($(this).attr('data-meal-plan')) {
					selectedMealPlan = $(this).attr('data-meal-plan');
				}
				else if ($(this).attr('data-portion')) {
					selectedPortion = $(this).attr('data-portion');
				}
				update();
			});
			update();
		});
	</script>
<?php tmpl_middle() ?>
	<!-- Main -->
	<main>
		<section id="pricing" class="title">
			<div class="intro">
				<h1>Pricing</h1>
			</div>
			<a href="#" class="scroll">Scroll</a>
		</section>
		<div class="banner">
			Free delivery for purchases over <?php echo $fulfillmentSettings['freeDeliveryThreshold'] ?> meals.
		</div>
		<section>
			<?php portionTabs($portions) ?>
			<?php mealPlanTabs($mealPlans) ?>
			<?php foreach ($bundleTypesByPortion as $portionId => $bundleTypesByMealPlan): ?>
			<?php foreach ($bundleTypesByMealPlan as $mealPlanId => $bundleTypes): ?>
			<section data-portion="<?php echo $portionId ?>" data-meal-plan="<?php echo $mealPlanId ?>">
				<?php foreach ($bundleTypes as $bundleType): ?>
				<div class="card-4col" data-background-image="<?php echo $bundleType['icon'] ?>">
					<h4><?php echo $bundleType['name'] ?></h4>
					<div class="pricebundle"><span class="usd">$</span><span><?php echo formatCurrency($bundleType['price'], false) ?></span>/bundle</div>
					<div><?php echo $bundleType['description'] ?></div>
					<?php if ($bundleType['deliveryFee']): ?>
					<div><?php echo formatCurrency($deliveryFee) ?> Delivery Charge</div>
					<?php else: ?>
					<div>Free Delivery</div>
					<?php endif ?>
					<a href="<?php echo $config['orderWizardUrl'] ?>?bundle=<?php echo $bundleType[_id] ?>">Order now</a>
				</div>
				<?php endforeach ?>
			</section>
			<?php endforeach ?>
			<?php endforeach ?>
		</section>
	</main>
<?php tmpl_bottom() ?>
