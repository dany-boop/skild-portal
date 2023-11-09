<?php
$params = $match['params'];
$slug = $params['slug'];
$section = 'signup';

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

?>

<?php include('includes/header.php'); ?>
<?php include('includes/_nav.php'); ?>

<section class="section is-medium has-background-light-gray">
	<div class="container mt-6">
		<div class="columns is-multiline is-mobile">

			<div class="column is-5-tablet is-10-mobile">
				<div class="wrap-trapezoid">
					<?= getImage($entry->getThumbnail(), 'trapezoid-right') ?>
					<div class="border-right"></div>
				</div>
			</div>
			<div class="column is-6-tablet is-offset-1-tablet is-12-mobile">
				<div class="columns is-multiline is-mobile ">
					<div class="column is-12-tablet is-12-mobile mb-5 pl-0">
						<h2 class="title has-text-blue mb-2">SIGN UP <span>
								<?= $entry->getTitle() ?>
							</span></h2>
						<div class="content">
							<?= $parser->parse($entry->getIntroduction()); ?>
						</div>

					</div>
					<div class="column is-12-tablet is-12-mobile mb-5">
						<?php if ($entry->getSlug() == 'as-business') { ?>



							<form action="process.php" id="register-form" name="register-form" method="post">
								<input type="hidden" name="process" value="register">
								<input type="hidden" name="roles" value="contractor">
								<div class="columns is-multiline is-mobile  is-vcentered">
									<div class="column is-6-tablet is-12-mobile pl-0">
										<?= inputText('username', 'First Name*', 'first_name') ?>
									</div>
									<div class="column is-6-tablet is-12-mobile pl-0">
										<?= inputText('fullname', 'Last Name*', 'last_name') ?>
									</div>
									<div class="column is-12-tablet is-12-mobile pl-0">
										<?= inputText('email', 'Email*', 'email') ?>
									</div>
									<div class="column is-6-tablet is-12-mobile pl-0">
										<?= inputText('password', 'Password*', 'password') ?>
									</div>
									<div class="column is-6-tablet is-12-mobile pl-0">
										<?= inputText('confirmpassword', 'Confirm Password*', 'password') ?>
									</div>

									<button type="submit" id="btn-register"
										class="button btn-yellow is-uppercase">SUBMIT</button>

								</div>
							</form>


							<p class="mt-6">Login your account? <a href="signin"><strong>Sign In</strong></a></p>
						<?php } else { ?>
							<input action="process.php" type="hidden" name="roles" value="tradesperson">
							<form action="process.php" id="register-form" name="register-form" method="post">
								<input type="hidden" name="process" value="register">
								<input type="hidden" name="roles" value="tradesperson">
								<div class="columns is-multiline is-mobile  is-vcentered">
									<div class="column is-6-tablet is-12-mobile pl-0">
										<input type="hidden" name="process" value="register">
										<?= inputText('username', 'First Name*', 'first_name') ?>
									</div>
									<div class="column is-6-tablet is-12-mobile pl-0">
										<?= inputText('fullname', 'Last Name*', 'last_name') ?>
									</div>
									<div class="column is-12-tablet is-12-mobile pl-0">
										<?= inputText('email', 'Email*', 'email') ?>
									</div>
									<div class="column is-6-tablet is-12-mobile pl-0">
										<?= inputText('password', 'Password*', 'password') ?>
									</div>
									<div class="column is-6-tablet is-12-mobile pl-0">
										<?= inputText('confirm_password', 'Confirm Password*', 'password') ?>
									</div>
									<div class="column is-12-tablet is-12-mobile pl-0">
										<?= inputText('address', 'Location*', 'location') ?>
									</div>
									<div class="column is-12-tablet is-12-mobile pl-0">
										<?= inputText('phone', 'Phone Number*', 'phone') ?>
									</div>
									<button type="submit" id="btn-register"
										class="button btn-yellow is-uppercase">SUBMIT</button>

								</div>
								</input>
							</form>

							<p class="mt-6">Login your account? <a href="signin"><strong>Sign In</strong></a></p>
						<?php } ?>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>

<!-- <a href="#home" class="back-to-top"><i class="fa fa-chevron-up"></i></a> -->
<?php include('includes/footer.php'); ?>