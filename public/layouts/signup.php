<?php
$slug = "signup";
$section = $slug;

?>
<?php include('includes/header.php'); ?>
<?php include('includes/_nav.php'); ?>
<section class="section is-medium has-background-light-gray">
	<div class="container mt-6">
		<div class="columns is-multiline is-mobile  is-centered">

			<div class="column is-12-tablet is-12-mobile has-text-centered mb-5">
				<h2 class="title has-text-blue mb-2 is-uppercase">SIGN UP</h2>
			</div>
			<div class="column is-5-tablet is-12-mobile">

				<label class="card">
					<input name="plan" class="radio getPlan" type="radio" value="as-business" data-name="BUSINESS">
					<span class="plan-details" aria-hidden="true">
						<span>I’m a Business,<br>hiring for a project</span>
					</span>
				</label>

			</div>
			<div class="column is-5-tablet is-12-mobile">
				<label class="card">
					<input name="plan" class="radio getPlan" type="radio" value="as-skilled-worker"
						data-name="SKILLED WORKER">
					<span class="plan-details" aria-hidden="true">
						<span>I’m a Skilled Worker,<br>looking for work</span>
					</span>
				</label>
				<!-- <p class="mt-6">Already have an account? <a href="signin"><strong>Sign In</strong></a></p> -->
			</div>
			<div class="column is-12-tablet is-12-mobile has-text-centered mt-6">
				<a href="/signup/[:slug]" class="create-account">CREATE ACCOUNT</a>
			</div>
			<div class="column is-12-tablet is-12-mobile has-text-centered">
				<p class="mt-6">Already have an account? <a href="signin"><strong>Sign In</strong></a></p>
			</div>
		</div>
	</div>
</section>

<!-- <script src="signup.js"></script> -->
<?php include('includes/footer.php'); ?>