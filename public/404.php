<?php require_once 'vendor/autoload.php'; ?>
<?php require_once 'includes/appstart.php'; ?>
<?php require_once 'includes/functions.php'; ?>
<?php require_once 'includes/router.php'; ?>
<?php
$slug = '404';
$section = '404';
?>

<?php
/* set default meta title and description */
global $metaTitle, $metaDescription, $metaKeywords, $websiteURL, $websiteName;

// move this to globals to grab from Setting
$websiteName = ''.$setting->getCompany();


if (!isset($metaTitle) || is_null($metaTitle)) {
	$metaTitle = ''.$setting->getCompany();
}

if (!isset($metaDescription) || is_null($metaDescription)) {
	$metaDescription = ''.$setting->getCompany();
}

if (!isset($metaKeywords) || is_null($metaKeywords)) {
	$metaKeywords = ''.$setting->getCompany();
}
?>

<?php require_once 'includes/header.php'; ?>

<?php include('includes/_nav.php'); ?>

<section class="section is-medium  has-background-light-gray">
	<div class="container mt-6">
		<div class="bg-404">
			<div class="columns is-multiline is-mobile is-vcentered p-6">
				<div class="column is-full-mobile is-half-tablet is-offset-3-tablet has-text-centered card-with-shadow">
					<h1 class="title">404</h1>
					<div class="content">
						<h2>Opps!</h2> 
						<p class="mt-5">We’re sorry,<br>The page you were looking for doesn’t exist.</p>
						<a href="<?= $home; ?>" class="button btn-yellow mt-2">BACK TO HOME</a>
					</div>
				</div>
			</div>
		</div>

	</div>
</section>

<?php require_once 'includes/footer.php'; ?>