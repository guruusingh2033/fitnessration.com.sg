<?php require 'includes/header.php' ?>
<?php
$addOns = [];
foreach ($db->addOns->find() as $addOn) {
	$addOns[] = $addOn;
	$addOnsByCategory[$addOn['category']][] = $addOn;
}
?>
<?php tmpl_init([
	'pageName' => 'addonspage',
	'pageTitle' => 'Add-ons',
]) ?>
<?php tmpl_top() ?>
	<script type="text/javascript">
		$(function() {
			$('.popup-wrapper .popup__close').click(function() {
				$(this).parents('.popup-wrapper').hide();
				return false;
			});

			$('.addon .details').click(function() {
				var popupWrapperEl = $('.popup-wrapper[data-addon="' + $(this).parents('.addon').attr('data-addon') + '"]');
				popupWrapperEl.show();
				var popupEl = popupWrapperEl.find('.popup');
        popupEl.css({left: Math.max(0, $(window).width()/2 - popupEl.width()/2), top: Math.max(0, $(window).height()/2 - popupEl.height()/2)});

				return false;
			});

			$('.add-on-details .next').click(function() {
				var addOnDetails = $(this).parents('.add-on-details');
				var currentPicture = addOnDetails.find('.picture.current');
				currentPicture.removeClass('current');
				if (currentPicture.next().length) {
					currentPicture.next().addClass('current');
				}
				else {
					addOnDetails.find('.picture:first').addClass('current');
				}
			});

			$('.add-on-details .prev').click(function() {
				var addOnDetails = $(this).parents('.add-on-details');
				var currentPicture = addOnDetails.find('.picture.current');
					currentPicture.removeClass('current');
				if (currentPicture.prev().length) {
					currentPicture.prev().addClass('current');
				}
				else {
					addOnDetails.find('.picture:last').addClass('current');
				}
			});

		});
	</script>
	<link rel="stylesheet" type="text/css" href="css/addons.css">
<?php tmpl_middle() ?>
<?php foreach ($addOns as $addOn): ?>
		<div class="popup-wrapper fullscreen popup" style="display:none" data-addon="<?php echo $addOn['_id'] ?>">
			<div class="popup">
				<a href="#" class="popup__close">Close</a>
				<div class="popup__content">
					<div class="add-on-details">
						<div class="pictures">
							<a class="prev">Previous</a>
							<a class="next">Next</a>
							<ul>
								<?php foreach ($addOn['images'] as $i => $image): ?>
								<li class="picture<?php if ($i == 0) echo ' current' ?>" style="background-image: url(<?php echo $image ?>)"></li>
								<?php endforeach ?>
							</ul>
						</div>
						<span class="name"><?php echo $addOn['name'] ?></span>
						<p class="description"><?php echo $addOn['description'] ?></p>
						<div class="specifications">
							<label>Specifications:</label> <span class="value"><?php echo $addOn['specifications'] ?></span>
						</div>
						<div class="flavors">
							<label>Flavours:</label>
							<div class="value"><?php echo implode(',', $addOn['variants']) ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php endforeach ?>
	<!-- Main -->
	<main>
		<section id="addons" class="title">
			<div class="intro">
				<h1>Add-ons</h1>
			</div>
			<a href="#" class="scroll">Scroll</a>
		</section>
		<section class="filter-container">
<!-- 			<select name="addonscategories">
				<option value="all">Browse All</option>
				<?php foreach ($addOnsByCategory as $category => $addOns): ?>
				<option value="<?php echo $category ?>"><?php echo $category ?></option>
				<?php endforeach ?>
			</select>
 -->			<?php foreach ($addOnsByCategory as $category => $addOns): ?>
			<section data-category="<?php echo $category ?>">
				<h2>Supplement Your Meals</h2>
				<p class="description">Here lies your answer to everyone’s inner snack monster. Who can resist in-between nibbles, and guilty sweet treats? It goes without saying - we have introduced your favourite fitness bars, and still help you meet your required daily nutritional intake.</p>
				<?php foreach ($addOns as $addOn): ?>
				<div class="addon card-4col" data-addon="<?php echo $addOn['_id'] ?>">
					<picture style="background-image: url('<?php echo $addOn['images'][0] ?>')"></picture>
					<h4><?php echo $addOn['name'] ?></h4>
					<p><?php echo $addOn['description'] ?></p>
					<a href="#" class="details">Details</a>
				</div>
				<?php endforeach ?>
			</section>
			<?php endforeach ?>
		</section>
	</main>
<?php tmpl_bottom() ?>