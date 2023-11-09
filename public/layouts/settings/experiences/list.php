<?php
$slug = "experiences";
$section = $slug;

$entry_title = 'Skild';
$metaTitle = $entry_title;
$type = isset($_GET['type']);

$query1 = $service->initializeQueryBuilder();
$query2 = $service->initializeQueryBuilder();


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

$exp = $query2->select('*')
	->from('experiences')
	->order('name.asc')
	->where('tradesperson_id', 'eq.' . $_SESSION['id'])
	->where('deleted', 'eq.false')
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
								<p>

									Experience List
								</p>
							</div>
							<div class="column is-full-mobile is-6-tablet is-relative ">
								<a href="experience/add"><button class="btn-blue button float-right">Add</button></a>
							</div>
						</div>
						<div class="columns is-multiline is-mobile mt-2">
							<div class="column is-full-mobile is-12-tablet is-relative ">
								<table id="myTable" class="display table table-small">
									<thead>
										<tr>
											<th width="50">#</th>
											<th class="has-text-centered">Experience Name</th>
											<th class="has-text-centered">Description</th>
											<th class="has-text-centered">Date Start</th>
											<th class="has-text-centered">Date Finish</th>
											<th class="has-text-centered"></th>
										</tr>
									</thead>
									<tbody>
										<?php $x = 1;
										foreach ($exp as $value) { ?>
											<tr>
												<td class="has-text-centered">
													<?= $x ?>
												</td>
												<td>
													<?= $value->name ?>
												</td>
												<td class="has-text-centered">
													<?= $value->description ?>
												</td>
												<td class="has-text-centered">
													<?= $value->date_start ?>
												</td>
												<td class="has-text-centered">
													<?= $value->date_end ?>
												</td>

												<td class="has-text-end">
													<?= icon_action("experience/edit/" . $value->id, $value->id, true, true, false, "process/experience.php") ?>
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
<?= component_js() ?>