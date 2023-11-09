<?php
$slug = "payments";
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
				<form>
					<div class="card">
						<div class="card-content">
							<div class="columns is-multiline is-mobile add-border-bottom is-vcentered">
								<div class="column is-full-mobile is-6-tablet is-relative ">
									Skills Form
								</div>
								<div class="column is-full-mobile is-6-tablet is-relative ">
									<button class="btn-blue button float-right">Save</button>
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
<?= component_js(); ?>