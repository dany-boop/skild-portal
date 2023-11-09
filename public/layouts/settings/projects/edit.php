<?php
$params = $match['params'];
$slug = $params['slug'];
$section = "projects";

$entry_title = 'Skild';
$metaTitle = $entry_title;

$query2 = $service->initializeQueryBuilder();
$query3 = $service->initializeQueryBuilder();
$query4 = $service->initializeQueryBuilder();

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
	$roleId = $profile[0]->roles->id;
	$desc = $profile[0]->description;
	$avatar = $profile[0]->avatar_url;
	$roleId = $profile[0]->roles->id;

} catch (Exception $e) {
	echo "Error fetching profile data: " . $e->getMessage();
}
try {
	$query = $service->initializeQueryBuilder();
	$jobs = $query->select('*')
		->from('jobs')
		->where('id', 'eq.' . $slug)
		->execute()
		->getResult();
} catch (Exception $e) {
	echo "Error fetching profile data: " . $e->getMessage();
}

$jobs = $query4->select('*')
	->from('jobs')
	->where('id', 'eq.' . $slug)
	->execute()
	->getResult();

$categories = $query2->select('*')
	->from('jobcategories')
	->where('deleted', 'eq.false')
	->execute()
	->getResult();

$types = $query3->select('*')
	->from('jobtypes')
	->where('deleted', 'eq.false')
	->execute()
	->getResult();

?>

<?php include('includes/header.php'); ?>
<?php include('includes/_nav.php'); ?>

<section class="section is-medium has-background-light-gray add-pt-mobile">
	<div class="container">
		<div class="columns is-multiline is-mobile">
			<div class="column is-full-mobile is-3-tablet is-relative ">
				<?= card_profile_menu($id, "https://images.ctfassets.net/tr0mn1h6jqs3/4HUBAkA54aN53rF7o7SkYE/40c0b697cae40f78b1ccf303e78944ab/Rectangle_153.png", "https://images.ctfassets.net/tr0mn1h6jqs3/vbPnTteww08CHEIzDnmX6/ce7c73aa245e0c1ba0a6b783fd929844/Rectangle_150.png", $name, $role, $roleId, $section) ?>
			</div>
			<div class="column is-full-mobile pl-5-tablet is-6-tablet">
				<form action="process/projects.php" method="post" id="form-submit" name="form-submit"
					enctype="multipart/form-data">
					<input type="hidden" name="process" value="edit">
					<input type="hidden" name="id" value="<?= $slug ?>">
					<div class="card">
						<div class="card-content">
							<div class="columns is-multiline is-mobile add-border-bottom is-vcentered">
								<div class="column is-full-mobile is-6-tablet is-relative ">
									Project Edit Form
								</div>
								<div class="column is-full-mobile is-6-tablet is-relative ">
									<button id="btn-submit" class="btn-blue button float-right">Save</button>
								</div>
							</div>

							<div class="columns is-multiline is-mobile">
								<div class="column is-full-mobile is-12-tablet is-relative ">
									<?= input("Name", "name", "Please fill this field", $jobs[0]->name) ?>
								</div>
								<div class="column is-full-mobile is-12-tablet is-relative ">
									<?= textarea("Description", "desc", "Please fill this field", $jobs[0]->description) ?>
								</div>
								<!-- 	<div class="column is-full-mobile is-12-tablet is-relative ">
									<?= textarea("Brief", "brief", "Please fill this field", $jobs[0]->brief) ?>
								</div> -->
								<div class="column is-full-mobile is-6-tablet is-relative ">
									<?= input("Building area m2", "building_area", "Please fill this field", $jobs[0]->building_area_m2) ?>
								</div>
								<div class="column is-full-mobile is-6-tablet is-relative ">
									<?= input("Land area m2", "land_area", "Please fill this field", $jobs[0]->land_area_m2) ?>
								</div>
								<div class="column is-full-mobile is-6-tablet is-relative ">
									<?= input("Number of floors", "floor", "Please fill this field", $jobs[0]->number_of_floors) ?>
								</div>
								<div class="column is-full-mobile is-6-tablet is-relative ">
									<?= input("Estimated Budget", "estimated_budget", "Please fill this field", $jobs[0]->estimated_budget) ?>
								</div>
								<div class="column is-full-mobile is-6-tablet is-relative ">
									<?= input("Estimated Days", "estimated_day", "Please fill this field", $jobs[0]->estimated_days) ?>
								</div>
								<div class="column is-full-mobile is-6-tablet is-relative ">
									<?= input("Number Of Trades", "number_trades", "Please fill this field", $jobs[0]->number_of_trades) ?>
								</div>
								<div class="column is-full-mobile is-6-tablet is-relative ">
									<?= input("Date Start", "date_start", "Please fill this field", $jobs[0]->date_start, 'date') ?>
								</div>
								<div class="column is-full-mobile is-6-tablet is-relative ">
									<?= input("Date End", "date_end", "Please fill this field", $jobs[0]->date_finish, 'date') ?>
								</div>
								<div class="column is-full-mobile is-6-tablet is-relative ">
									<label class="label m-0 pl-0">Categories</label>
									<div class="select ">
										<select name="categories">
											<option>Select Categories</option>
											<?php foreach ($categories as $value) { ?>
												<option value="<?= $value->id ?>" <?= $jobs[0]->jobcategory_id == $value->id ? 'selected' : '' ?>>
													<?= $value->name ?>
												</option>
											<?php } ?>

										</select>
									</div>
								</div>
								<div class="column is-full-mobile is-6-tablet is-relative ">
									<label class="label m-0 pl-0">Types</label>
									<div class="select">
										<select name="types">
											<option>Select types</option>
											<?php foreach ($types as $value) { ?>
												<option value="<?= $value->id ?>" <?= $jobs[0]->jobtype_id == $value->id ? 'selected' : '' ?>>
													<?= $value->name ?>
												</option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="column is-full-mobile is-12-tablet is-relative ">
									<?= textarea("Address", "address", "Please fill this field", $jobs[0]->address) ?>
								</div>
								<div class="column is-full-mobile is-12-tablet is-relative ">
									<?= input("District", "district", "Please fill this field", $jobs[0]->district) ?>
								</div>

								<div class="column is-full-mobile is-6-tablet is-relative ">
									<label class="label m-0 pl-0">Upload Thumbnail</label>
									<input class="input" type="file" name="thumbnail">
									<!-- 		<div class="file has-name is-fullwidth">
										<label class="file-label pl-0">
											<input class="file-input" type="file" name="thumbnail"
												onchange="uploadFile('file-name-place')">
											<span class="file-cta">
												<span class="file-label">
													Choose a file…
												</span>
											</span>
											<span class="file-name file-name-place">
												Please select a file.
											</span>
										</label>
									</div> -->
								</div>
								<div class="column is-full-mobile is-6-tablet is-relative ">
									<label class="label m-0 pl-0">Upload Background</label>
									<input class="input" type="file" name="bg">
									<!-- 						<div class="file has-name is-fullwidth">
										<label class="file-label pl-0">
											<input class="file-input" type="file" name="bg"
												onchange="uploadFile('file-name-place-2')">
											<span class="file-cta">
												<span class="file-label">
													Choose a file…
												</span>
											</span>
											<span class="file-name file-name-place-2">
												Please select a file.
											</span>
										</label>
									</div> -->
								</div>
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
<?= component_js(''); ?>