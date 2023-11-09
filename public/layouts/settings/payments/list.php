<?php
$slug = "payments";
$section = $slug;

$entry_title = 'Skild';
$metaTitle = $entry_title;
$type = isset($_GET['type']);

$query1 = $service->initializeQueryBuilder();
$query2 = $service->initializeQueryBuilder();
$query3 = $service->initializeQueryBuilder();


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
	->execute()
	->getResult();

$jobinvoices = $query3->select('*')
	->from('jobinvoices')
	->join('jobs', 'id')
	->where('tradesperson_id', 'eq.' . $_SESSION['id'])
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
			<div class="column is-full-mobile pl-5-tablet is-8-tablet">
				<div class="card card-payment">
					<div class="card-content">
						<div class="columns is-multiline is-mobile add-border-bottom is-vcentered">
							<div class="column is-full-mobile is-6-tablet is-relative ">
								Payment List
							</div>

						</div>
						<div class="columns is-multiline is-mobile mt-2">
							<div class="column is-full-mobile is-12-tablet is-relative ">
								<table id="myTable" class="display table table-small">
									<thead>
										<tr>
											<th width="50">#</th>
											<th class="has-text-centered">Project Name</th>
											<th class="has-text-centered">Due Date</th>
											<th class="has-text-centered">Nominal</th>
											<th class="has-text-centered">Status</th>
											<th class="has-text-centered"></th>
										</tr>
									</thead>
									<tbody>
										<?php $x = 0;
										foreach ($jobinvoices as $value) { ?>
											<tr>
												<td>
													<?= $x ?>
												</td>
												<td class="has-text-centered">
													<?= $value->jobs ? $value->jobs->name : '-' ?>
												</td>
												<td class="has-text-centered">
													<?= $value->due_date ?>
												</td>
												<td class="has-text-centered">
													<?= $value->total ?>
												</td>
												<td class="has-text-centered">
													<?php
													$status = $value->status;
													$labelClass = '';

													if ($status === 'Success') {
														$labelClass = 'label label-success';
													} elseif ($status === 'On Progress') {
														$labelClass = 'label label-progress';
													} else {
														$labelClass = 'label label-overdue';
													}
													?>

													<label class="<?= $labelClass ?>">
														<?= $status ?>
													</label>
												</td>
												<td class="has-text-centered">
													<?= icon_action("payment/edit/" . $value->id, $value->id, false, false, true) ?>
												</td>
											</tr>
										<?php $x++;
										} ?>

									</tbody>
								</table>
							</div>
						</div>
					</div>


				</div>

			</div>
		</div>
	</div>
	</div>
</section>

<?php include('includes/footer-init.php'); ?>
<?= component_js(); ?>