<?php

require_once('includes/config.php');

function displayValue($value) {
	switch ($value) {
		case 'for-her': return 'For Her';
		case 'for-him': return 'For Him';
		case 'heavy-duty': return 'Heavy Duty';
		case 'lean-on-me': return 'Lean On Me';
	}
}

function tmpl_init($opts) {
	global $pageName, $pageTitle;
	$pageName = $opts['pageName'];
	$pageTitle = $opts['pageTitle'];
}

function tmpl_fullTop() {
	tmpl_top();
	tmpl_middle();
}

function tmpl_top() {
	global $pageName, $pageTitle, $user, $config, $db;
	require __DIR__.'/top.php';
}

function tmpl_middle() {
	global $pageName, $pageTitle, $user, $config, $db;
	require __DIR__.'/middle.php';
}

function tmpl_bottom() {
	global $pageName, $pageTitle, $user, $config, $db;
	require __DIR__.'/bottom.php';
}

function replaceVariables($template, $variables, $filters=[]) {
	return preg_replace_callback('/\{\{(.*?)(?:\s*\|\s*(.*?))?\}\}/', function($matches) use ($variables, $filters) {
		if ($matches[2]) {
			return $filters[$matches[2]]($variables[$matches[1]]);
		}
		else {
			return $variables[$matches[1]];			
		}
	}, $template);
}

function formatCurrency($value, $dollarSign=true) {
	if ($dollarSign) {
		return '$' . number_format($value, 2);
	}
	else {
		return number_format($value, 2);
	}
}

function mealPlanTabs($mealPlans) {
	?>
		<div class="tabs">
			<?php foreach ($mealPlans as $mealPlan): ?>
			<h3 data-meal-plan="<?php echo $mealPlan['_id'] ?>"><?php echo $mealPlan['name'] ?></h3>
			<?php endforeach ?>
		</div>
	<?php
}

function portionTabs($portions) {
	?>
		<div class="tabs gender">
			<?php foreach ($portions as $portion): ?>
			<h3 data-background-image="<?php echo $portion['icon'] ?>" data-portion="<?php echo $portion['_id'] ?>"><?php echo $portion['name'] ?></h3>
			<?php endforeach ?>
		</div>
	<?php
}

if ($config['mongoUrl']) {
	$mongo = new MongoClient($config['mongoUrl']);
}
else {
	$mongo = new MongoClient();	
}
$db = $mongo->fitnessration;

$auth = $_COOKIE['auth'];
if ($auth) {
	$auth = json_decode($auth, true);
	$user = $db->users->findOne(['_id' => $auth['userId']]);
}
