<?php
$slug = "projects";
$section = $slug;

$entry_title = 'Skild';
$metaTitle = $entry_title;
$type = isset($_GET['type']);
try {
	$query = $service->initializeQueryBuilder();
	$profile = $query->select('*')
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
} catch (Exception $e) {
	echo "Error fetching profile data: " . $e->getMessage();
}

$query = $service->initializeQueryBuilder();
$projects = $query->select('*')
->from('jobs')
->join('profiles', 'id')
->where('contractor_id', 'eq.' . $_SESSION['id'])
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
								Projects List
							</div>
							<div class="column is-full-mobile is-6-tablet is-relative ">
								<a href="project/add"><button class="btn-blue button float-right">Add</button></a>
							</div>
						</div>
						<div class="columns is-multiline is-mobile mt-2">
							<div class="column is-full-mobile is-12-tablet is-relative ">
								<table id="myTable" class="display table table-small">
									<thead>
										<tr>
											<th width="50">#</th>
											<th class="has-text-centered">Project Name</th>
											<th class="has-text-centered">Date Start</th>
											<th class="has-text-centered">Total Skild Worker</th>
											<th class="has-text-centered"></th>
										</tr>
									</thead>
									<tbody>
										<?php $x = 1;
										foreach ($projects as $value) { ?>
											<tr>
												<td class="has-text-centered">
													<?= $x ?>
												</td>
												<td >
													<?= $value->name ?>
												</td>
												<td class="has-text-centered">
													<?= $value->date_start ?>
												</td>
												<td class="has-text-centered">
													<?= $value->number_of_trades ?>
												</td>
												<td class="has-text-centered">
													<?= icon_action("project/edit/" . $value->id,$value->id,true,true,false,"process/projects.php") ?>
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