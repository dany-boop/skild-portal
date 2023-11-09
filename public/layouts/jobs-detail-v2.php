<?php
$params = $match['params'];
$slug = $params['slug'];
$section = 'jobs';
$query = new \Contentful\Delivery\Query;
$query->setContentType('projects')
	->where('fields.slug', $slug);
$entries = $client->getEntries($query);


if ($entries->getTotal() < 1) {
	_404();
}

$entry = $entries[0];

if ($entry->getMetaTitle() == '') {
	$entry_title = $entry->getTitle();
	$metaTitle = $entry_title . ' - ' . $setting->getCompany();
} else {
	setMetaTags($entry);
}


?>

<?php include('includes/header.php'); ?>
<?php include('includes/_nav.php'); ?>

<section class="section is-medium has-background-light-gray">
	<div class="container">
		<div class="columns is-multiline is-mobile  is-centered">
			<div class="column is-12-tablet is-12-mobile ">
				<h2 class="title has-text-blue mb-1 mt-5 is-uppercase"><?= $entry->getTitle() ?></h2>
				<h1 class="mb-2 is-size-3-tablet">by <?= $entry->getTalents()->getName() ?></h1>
			</div>
			<div class="column is-12-tablet is-12-mobile ">
				<div class="swiper mySwiper2">
					<div class="swiper-wrapper">
						<?php foreach ($entry->getImages() as $img) { ?>
							<div class="swiper-slide">
								<?= getImage($img) ?>
							</div>
						<?php } ?>
					</div>
				</div>
				<div thumbsSlider="" class="swiper mySwiper">
					<div class="swiper-wrapper">
						<?php foreach ($entry->getImages() as $img) { ?>
							<div class="swiper-slide">
								<?= getImage($img) ?>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="section is-medium has-background-light-gray pt-0">
	<div class="container">
		<div class="columns is-multiline is-mobile  is-centered">
			<div class="column is-12-tablet is-12-mobile mb-5">
				<h2 class="title has-text-blue mb-1 is-size-3-tablet">About The Project</h2>
			</div>
		</div>
		<div class="columns is-multiline is-mobile  is-centered">
			<div class="column is-7-tablet is-12-mobile content">
				<?= $parser->parse($entry->getDescription()); ?>
			</div>
			<div class="column is-4-tablet is-offset-1-tablet is-12-mobile">
				<div class="columns is-multiline is-mobile  is-centered">
					<?php if ($entry->getProjectStyle()) { ?>
						<div class="column is-12-tablet is-12-mobile">
							<h3 class="title-small">Project Style</h3>
							<p class="paragraph-medium">
								<?php $text = [];
								foreach ($entry->getProjectStyle() as $prjStyle) {
									array_push($text, $prjStyle->getTitle());
								} ?>
								<?= implode(', ', $text); ?>
							</p>
						</div>
					<?php } ?>
					<?php if ($entry->getFileFormat()) { ?>
						<div class="column is-12-tablet is-12-mobile">
							<h3 class="title-small">File Format</h3>
							<p class="paragraph-medium"><?= $entry->getFileFormat() ?></p>
						</div>
					<?php } ?>
					<?php if ($entry->getTalents()) { ?>
						<div class="column is-12-tablet is-12-mobile">
							<h3 class="title-small">Skilled Worker</h3>
							<div class="wrap-profile">
								<?= getImage($entry->getTalents()->getProfilePicture()) ?>
								<div class="wrap-content">
									<h2><?= $entry->getTalents()->getName() ?></h2>
									<p c><?= $entry->getTalentCategory()->getName() ?></p>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- <a href="#home" class="back-to-top"><i class="fa fa-chevron-up"></i></a> -->
<?php include('includes/footer-init.php'); ?>
<?= component_js(); ?>