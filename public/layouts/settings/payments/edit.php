<?php
$params = $match['params'];
$slug = $params['slug'];
$section = "payments";

$entry_title = 'Skild';
$metaTitle = $entry_title;
$type = isset($_GET['type']);
$query1 = $service->initializeQueryBuilder();
$query2 = $service->initializeQueryBuilder();
$query3 = $service->initializeQueryBuilder();
$query4 = $service->initializeQueryBuilder();

$profile = $query1->select('*')
	->from('profiles')
	->join('roles', 'id')
	->where('id', 'eq.' . $_SESSION['id'])
	->execute()
	->getResult();
$id = $profile[0]->id;
$name = $profile[0]->name;
$role = $profile[0]->roles->name;
$desc = $profile[0]->description;
$avatar = $profile[0]->avatar_url;
$roleId = $profile[0]->roles->id;

$payments = $query2->select('*')
	->from('payments')
	// ->join('jobinvoices', 'id')
	// ->join('jobs', 'id')
	// ->where('jobinvoices.tradesperson_id', 'eq.' . $_SESSION['id'])
	->execute()
	->getResult();

$jobinvoices = $query3->select('*')
	->from('jobinvoices')
	->join('jobs', 'id')
	->where('id', 'eq.' . $slug)
	->execute()
	->getResult();

$contracts = $query4->select('*')
	->from('jobcontracts')
	->join('jobs', 'id')
	->where('tradesperson_id', 'eq.' . $_SESSION['id'])
	->where('status', 'eq.Success')
	->execute()
	->getResult();
?>

<?php include('includes/header.php'); ?>
<?php include('includes/_nav.php'); ?>

<section class="section is-medium has-background-light-gray add-pt-mobile">
	<div class="container">
		<div class="columns is-multiline is-mobile">
			<div class="column is-full-mobile is-4-tablet is-relative ">
				<?= card_profile_menu($id, "https://images.ctfassets.net/tr0mn1h6jqs3/4HUBAkA54aN53rF7o7SkYE/40c0b697cae40f78b1ccf303e78944ab/Rectangle_153.png", "https://images.ctfassets.net/tr0mn1h6jqs3/vbPnTteww08CHEIzDnmX6/ce7c73aa245e0c1ba0a6b783fd929844/Rectangle_150.png", $name, $role, $roleId, $section) ?>
			</div>
			<div class="column is-full-mobile pl-5-tablet is-6-tablet">
				<form action="process/payments.php" method="post" id="form-submit" name="form-submit">
					<input type="hidden" name="process" value="edit">
					<input type="hidden" name="id" value="<?= $slug ?>">
					<div class="card">
						<div class="card-content">
							<div class="columns is-multiline is-mobile add-border-bottom is-vcentered">
								<div class="column is-full-mobile is-6-tablet is-relative ">
									Payments Edit
								</div>
								<div class="column is-full-mobile is-6-tablet is-relative ">
									<button type="submit" id="btn-submit" class="btn-blue button float-right">Save</button>
								</div>
							</div>
							<div class="columns is-multiline is-mobile">
								<div class="column is-full-mobile is-6-tablet is-relative ">
									<label class="label m-0 pl-0">Select Jobs</label>
									<div class="select">
										<select name="job_id">

											<option>
												<?= $jobinvoices[0]->jobs->name ?>

											</option>
											<?php foreach ($contracts as $value) { ?>
												<?php $selected = ($value->jobs->name === $name) ? 'selected' : ''; ?>
												<option value="<?= $value->job_id ?>" <?= $selected ?>>
													<?= $value->jobs->name ?>
												</option>
											<?php } ?>
										</select>
									</div>
									<input type="hidden" name="name" value="<?= $name ?>">
								</div>
								<div class="column is-full-mobile is-6-tablet is-relative ">
									<?= input("Nominal", "total", "Please fill this field", $jobinvoices[0]->total) ?>
								</div>
								<div class="column is-full-mobile is-6-tablet is-relative ">
									<?= input("Status", "status", "Please fill this field", $jobinvoices[0]->status) ?>
								</div>

								<div class="column is-full-mobile is-6-tablet is-relative ">
									<?= input("Date Finish", "due_date", "Please fill this field", $jobinvoices[0]->due_date, "date") ?>
								</div>
								<div class="column is-full-mobile is-12-tablet is-relative ">
									<?= textarea("Description", "description", "Please fill this field", $jobinvoices[0]->description) ?>
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
<!-- <?= component_js('<script type="text/javascript" src="assets/js/redirect-form.js"></script>'); ?> -->