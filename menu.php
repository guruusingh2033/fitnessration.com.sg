<?php require 'includes/header.php' ?>
<?php

foreach ($db->sides->find() as $side) {
	$sidesById[(string)$side['_id']] = $side;
}
foreach ($db->ingredients->find() as $ingredient) {
	$ingredientsById[(string)$ingredient['_id']] = $ingredient;
}
foreach ($db->meals->find() as $meal) {
	$meals[] = $meal;
	$mealsByMealPlan[(string)$meal['mealPlan']][$meal['grade']][] = $meal;
}
foreach ($db->mealPlans->find() as $mealPlan) {
	$mealPlans[(string)$mealPlan['_id']] = $mealPlan;
}

function ingredients($meal) {
	global $ingredientsById;
	$ingredientIds = array_merge([$meal['mainIngredient']], $meal['allergens']);
	foreach ($ingredientIds as $ingredientId) {
		$ingredients[] = $ingredientsById[(string)$ingredientId];
	}
	return $ingredients;
}

function ingredientString($meal) {
	$ingredients = ingredients($meal);
	foreach ($ingredients as $ingredient) {
		$name = strtolower($ingredient['name']);
		$list[] = "<span>$name</span>";
	}
	return implode(', ', $list);
}

function ingredientIcons($meal) {
	$ingredients = ingredients($meal);
	$icons = '';
	foreach ($ingredients as $ingredient) {
		$icons .= "<picture data-background-image='$ingredient[icon]'></picture>";
	}
	return $icons;
}

?>
<?php tmpl_init([
	'pageName' => 'menupage',
	'pageTitle' => 'Menu',
]) ?>
<?php tmpl_top() ?>
	<script type="text/javascript">
		$(function() {
			var tab = '<?php echo array_keys($mealPlans)[0] ?>';
			function updateTab() {
				$('.tabs h3').removeClass('active');
				$('.tabs h3[data-meal-plan="' + tab + '"]').addClass('active');
				$('section[data-meal-plan]').hide();
				$('section[data-meal-plan="' + tab + '"]').show();
			}
			$('.tabs h3').click(function() {
				tab = $(this).attr('data-meal-plan');
				updateTab();
			});
			updateTab();

			$('.popup-wrapper .popup__close').click(function() {
				$(this).parents('.popup-wrapper').hide();
				return false;
			});

			$('.meal-details .prev, .meal-details .next').click(function() {
				var mealDetails = $(this).parents('.meal-details');
				var currenetPicture = mealDetails.find('.picture.current');
				var otherPicture = mealDetails.find('.picture:not(.current)');
				otherPicture.addClass('current');
				currenetPicture.removeClass('current');
			});

			$('.meal .details').click(function() {
				var mealId = $(this).parents('.meal').attr('data-meal');
				$('.popup-wrapper[data-meal="' + mealId + '"]').show();
				return false;
			})
		});
	</script>
	<link rel="stylesheet" type="text/css" href="css/menu.css">
<?php tmpl_middle() ?>
	<!-- Main -->
	<?php foreach ($meals as $meal): ?>
		<div class="popup-wrapper fullscreen popup" style="display:none" data-meal="<?php echo $meal['_id'] ?>">
			<div class="popup">
				<a href="#" class="popup__close">Close</a>
				<div class="popup__content">
					<div class="meal-details <?php if (!$meal['secondaryImage']) echo 'no-secondary-image' ?>">
						<div class="pictures">
							<a class="prev">Previous</a>
							<a class="next">Next</a>
							<ul>
								<li class="picture current" style="background-image: url(<?php echo $meal['primaryImage'] ?>)"></li>
								<li class="picture" style="background-image: url(<?php echo $meal['secondaryImage'] ?>)"></li>
							</ul>
						</div>

						<span class="name"><?php echo $meal['name'] ?></span>
						<ul class="sides">
							<?php foreach ($meal['sides'] as $side): ?>
							<li><?php echo $sidesById[(string)$side]['name'] ?></li>
							<?php endforeach ?>
						</ul>
						<p class="description"><?php echo $meal['description'] ?></p>
						<div class="facts">
							<div class="group">
								<span class="fact"><label>Calories (kcal)</label> <span class="value"><?php echo $meal['nutritionFacts']['calories'] ?></span></span>
								<span class="fact"><label>Carbohydrates (g)</label> <span class="value"><?php echo $meal['nutritionFacts']['carbohydrates'] ?></span></span>
								<span class="fact"><label>Fat (g)</label> <span class="value"><?php echo $meal['nutritionFacts']['fat'] ?></span></span>
								<span class="fact"><label>Protein (g)</label> <span class="value"><?php echo $meal['nutritionFacts']['protein'] ?></span></span>
							</div>
							<div class="group">
								<span class="fact"><label>Fibre (g)</label> <span class="value"><?php echo $meal['nutritionFacts']['fiber'] ?></span></span>
								<span class="fact"><label>Sodium (g)</label> <span class="value"><?php echo $meal['nutritionFacts']['sodium'] ?></span></span>
								<span class="fact"><label>Sugar (g)</label> <span class="value"><?php echo $meal['nutritionFacts']['sugar'] ?></span></span>
							</div>
						</div>
						<div class="contains">
							<label>Contains:</label> <span class="contents"><?php echo ingredientString($meal) ?>.</span>
							<div class="icons">
								<?php echo ingredientIcons($meal) ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach ?>
	<!-- </script> -->
	<main>
		<section id="menu" class="title">
			<div class="intro">
				<h1>Menu</h1>
			</div>
			<a href="#" class="scroll">Scroll</a>
		</section>
		<section>
			<?php mealPlanTabs($mealPlans) ?>
			<?php foreach ($mealPlans as $mealPlanId => $mealPlan): ?>
			<?php $shownMeals = [] ?>
			<?php foreach (['basic', 'premium'] as $grade): ?>
			<?php if ($mealsByMealPlan[$mealPlanId][$grade]): ?>
			<section id="<?php echo $grade ?>" data-meal-plan="<?php echo $mealPlanId ?>">
				<h2><?php echo ucfirst($grade) ?></h2>
				<?php foreach ((array)$mealsByMealPlan[$mealPlanId][$grade] as $meal): ?>
				<?php
					if ($shownMeals[$meal['name']]) continue;
					$shownMeals[$meal['name']] = true;
				?>
				<div class="card-4col meal" data-meal="<?php echo $meal['_id'] ?>">
					<picture style="background-image: url('<?php echo $meal['primaryImage'] ?>')"></picture>
					<h4><?php echo $meal['name'] ?></h4>
					<ul>
						<?php foreach ($meal['sides'] as $side): ?>
						<li><?php echo $sidesById[(string)$side]['name'] ?></li>
						<?php endforeach ?>
					</ul>
					<a href="#" class="details">Details</a>
				</div>
				<?php endforeach ?>
			</section>
			<?php endif ?>
			<?php endforeach ?>
			<?php endforeach ?>
		</section>
	</main>
<?php tmpl_bottom() ?>
