<?php
$slug = "categories";
$section = $slug;

$entry_title = 'Skild';
$metaTitle = $entry_title;
?>

<?php include('includes/header.php'); ?>
<?php include('includes/_nav.php'); ?>

<section class="section is-medium has-background-light-gray add-pt-mobile">
	<div class="container">
		<div class="columns is-multiline is-mobile">
			<div class="column is-full-mobile pl-5-tablet is-6-tablet">
				<form action="process/categories.php" method="post" id="form-submit" name="form-submit">
					<input type="hidden" name="process" value="add">
					<div class="card">
						<div class="card-content">
							<div class="columns is-multiline is-mobile add-border-bottom is-vcentered">
								<div class="column is-full-mobile is-6-tablet is-relative ">
									Categories Form
								</div>
								<div class="column is-full-mobile is-6-tablet is-relative ">
									<button type="submit" id="btn-submit" class="btn-blue button float-right">Save</button>
								</div>
							</div>
							<div class="columns is-multiline is-mobile">
								<div class="column is-full-mobile is-12-tablet is-relative ">
									<?= input("Name", "name", "Please fill this field", null) ?>
								</div>
								<div class="column is-full-mobile is-12-tablet is-relative ">
									<?= textarea("Description", "desc", "Please fill this field", null) ?>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

<?php include('includes/footer-init.php'); ?>
<?= component_js('<script type="text/javascript" src="assets/js/redirect-form.js"></script>'); ?>