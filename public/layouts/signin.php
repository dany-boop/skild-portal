<?php
$slug = "signin";
$section = $slug;

?>
<?php include('includes/header.php'); ?>
<?php include('includes/_nav.php'); ?>


<section class="section is-medium has-background-light-gray min-height-100vh-widescreen">
	<div class="container mt-6">
		<div class="columns is-multiline is-mobile">

			<div class="column is-5-tablet is-10-mobile">
				<div class="wrap-trapezoid">
					<img src="assets/images/1.png" class="trapezoid-right">
					<div class="border-right"></div>
				</div>
			</div>
			<div class="column is-4-tablet is-offset-2-tablet is-offset-1-mobile is-offset-3-desktop is-12-mobile">
				<div class="columns is-multiline is-mobile">
					<div class="column is-12-tablet is-12-mobile mb-2">
						<h2 class="title has-text-blue mb-1">SIGN IN</h2>
						<p>Please ensure carefully that the entered data is accurate and verified. It is necessary for
							data validation.</p>
					</div>
					<div class="column is-12-tablet is-12-mobile mb-2">
						<form action="process.php" id="login-form" name="login-form" method="post">
							<input type="hidden" name="process" value="login">
							<?= inputText('email', 'Email*', 'email') ?>
							<?= inputText('password', 'Password*', 'password') ?>
							<button type="submit" id="btn-login" class="button btn-yellow is-uppercase mt-5">Login</button>
						</form>

						<p class="mt-2">Create a new account? <a href="https://skildworld.mydevteam.id/signup"><strong>Sign Up</strong></a></p>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>

<?php include('includes/footer.php'); ?>