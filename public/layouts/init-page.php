<?php
$params = $match['params'];
$slug = $params['slug'];
$section = $slug;


if($slug != 'search'){
	$query = new \Contentful\Delivery\Query;
	$query->setContentType('pages')
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
}


?>

<?php include('includes/header.php'); ?>
<?php include('includes/_nav.php'); ?>

<?php if ($slug != 'search') { ?>
	<?php if ($entry->getSlug() == 'signin') { ?>
		<?php include('signin.php') ?>
	<?php } else if ($entry->getSlug() == 'signup') { ?>
		<?php include('signup.php') ?>
	<?php } else if ($entry->getSlug() == 'skilled-workers') { ?>
		<?php include('skilled-workers.php') ?>
	<?php } else if ($entry->getSlug() == 'find-jobs') { ?>
		<?php include('jobs.php') ?>	
	<?php } else { ?>
		<?php include('single-page.php') ?>
	<?php } ?>
<?php }else{ ?>
	<?php include('search.php') ?>
<?php } ?>

<!-- <a href="#home" class="back-to-top"><i class="fa fa-chevron-up"></i></a> -->
<?php include('includes/footer.php'); ?>