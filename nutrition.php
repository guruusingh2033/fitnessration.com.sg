<?php require 'includes/header.php' ?>
<?php
foreach ($db->portions->find() as $portion) {
	$portions[] = $portion;
}
foreach ($db->mealPlans->find() as $mealPlan) {
	$mealPlans[] = $mealPlan;
}
foreach ($db->ingredients->find() as $ingredient) {
	$ingredientsById[(string)$ingredient['_id']] = $ingredient;
}
foreach ($db->meals->find() as $meal) {
	$mealsByPortion[(string)$meal['portion']][(string)$meal['mealPlan']][(string)$meal['mainIngredient']][] = $meal;
}
?>
<?php tmpl_init([
	'pageName' => 'nutritionpage',
	'pageTitle' => 'Nutrition',
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
				$('.tablewrapper').hide();
				$('.tablewrapper[data-portion="' + selectedPortion + '"][data-meal-plan="' + selectedMealPlan + '"]').show();
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
		<section id="nutrition" class="title">
			<div class="intro">
				<h1>Nutrition</h1>
			</div>
			<a href="#" class="scroll">Scroll</a>
		</section>
		<section>
			<?php portionTabs($portions) ?>
			<?php mealPlanTabs($mealPlans) ?>
			<?php foreach ($mealsByPortion as $portionId => $mealsByMealPlan): ?>
			<?php foreach ($mealsByMealPlan as $mealPlanId => $mealsByIngredient): ?>
			<div data-portion="<?php echo $portionId ?>" data-meal-plan="<?php echo $mealPlanId ?>" class="tablewrapper">
				<table class="large">
					<?php  $i = 0; foreach ($mealsByIngredient as $ingredientId => $meals): ?>
					<?php if ($i == 0): ?>
					<tr>
						<th class="icon" data-background-image="<?php echo $ingredientsById[$ingredientId]['icon'] ?>"><?php echo $ingredientsById[$ingredientId]['name'] ?></th>
						<th>Calories (Kcal)</th>
						<th>Carbohydrates (g)</th>
						<th>Fat (g)</th>
						<th>Protein (g)</th>
						<th>Fibre (g)</th>
						<th>Sodium (g)</th>
						<th>Sugar (mg)</th>
					</tr>
					<?php else: ?>
					<tr>
						<td class="icon" data-background-image="<?php echo $ingredientsById[$ingredientId]['icon'] ?>"><?php echo $ingredientsById[$ingredientId]['name'] ?></td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<?php endif ?>
					<?php foreach ($meals as $meal): ?>
					<tr>
						<td><?php echo $meal['name'] ?></td>
						<td><?php echo $meal['nutritionFacts']['calories'] ?></td>
						<td><?php echo $meal['nutritionFacts']['carbohydrates'] ?></td>
						<td><?php echo $meal['nutritionFacts']['fat'] ?></td>
						<td><?php echo $meal['nutritionFacts']['protein'] ?></td>
						<td><?php echo $meal['nutritionFacts']['fiber'] ?></td>
						<td><?php echo $meal['nutritionFacts']['sodium'] ?></td>
						<td><?php echo $meal['nutritionFacts']['sugar'] ?></td>
					</tr>
					<?php endforeach ?>
					<?php ++$i ?>
					<?php endforeach ?>
				</table>
			</div>
			<?php endforeach ?>
			<?php endforeach ?>
		</section>
	</main>
<?php tmpl_bottom() ?>
