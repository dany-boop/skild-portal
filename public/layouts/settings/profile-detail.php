<?php
$slug = "profile";
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
	$email = $profile[0]->email;
	$phone = $profile[0]->phone;
	$date = $profile[0]->dob;
	$desc = $profile[0]->description;
	$address = $profile[0]->address;
	$bank = $profile[0]->bank_name;
	$bankNumber = $profile[0]->bank_account_number;
	$avatar = $profile[0]->avatar_url;
	$background = $profile[0]->background_url;
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
			<div class="column is-full-mobile is-4-tablet is-relative ">
				<?= card_profile_menu($id, "https://images.ctfassets.net/tr0mn1h6jqs3/4HUBAkA54aN53rF7o7SkYE/40c0b697cae40f78b1ccf303e78944ab/Rectangle_153.png", "https://images.ctfassets.net/tr0mn1h6jqs3/vbPnTteww08CHEIzDnmX6/ce7c73aa245e0c1ba0a6b783fd929844/Rectangle_150.png", $name, $role, $roleId, $section) ?>
			</div>
			<div class="column is-full-mobile pl-5-tablet is-6-tablet">
				<form action="process.php" method="post" id="form-submit" name="form-submit">
					<input type="hidden" name="process" value="update_profile">
					<input type="hidden" name="id" value="<?= $_SESSION['id'] ?>">
					<div class="card">
						<div class="card-content">
							<div class="columns is-multiline is-mobile add-border-bottom is-vcentered">
								<div class="column is-full-mobile is-6-tablet is-relative ">
									<p>
										My Account
									</p>
								</div>
								<div class="column is-full-mobile is-6-tablet is-relative ">
									<button type="submit" id="btn-submit" class="btn-blue button float-right">Save</button>
								</div>
							</div>
							<div class="columns is-multiline is-mobile">
								<div class="column is-full-mobile is-6-tablet is-relative ">
									<?= input("Name", "name", "Please fill this field", $name) ?>
								</div>
								<div class="column is-full-mobile is-6-tablet is-relative ">
									<?= input("Email", "email", "Please fill this field", $email) ?>
								</div>
								<div class="column is-full-mobile is-6-tablet is-relative ">
									<?= input("Phone", "phone", "Please fill this field", $phone) ?>
								</div>
								<div class="column is-full-mobile is-6-tablet is-relative ">
									<?= input("Dob", "dob", "Please fill this field", $date, "date") ?>
								</div>
								<div class="column is-full-mobile is-6-tablet is-relative ">
									<?= input("Bank Name", "bank_name", "Please fill this field", $bank) ?>
								</div>
								<div class="column is-full-mobile is-6-tablet is-relative ">
									<?= input("Bank Number", "bank_account_number", "Please fill this field", $bankNumber) ?>
								</div>
								<div class="column is-full-mobile is-full-tablet is-relative ">
									<?= input("Address", "address", "Please fill this field", $address) ?>
								</div>
								<div class="column is-full-mobile is-12-tablet is-relative ">
									<?= textarea("Bio", "description", "Please fill this field", $desc) ?>
								</div>

								<div class="column is-full-mobile is-6-tablet is-relative ">
									<label class="label m-0 pl-0">Upload Avatar</label>
									<input class="input" type="file" name="avatar">
								</div>

								<div class="column is-full-mobile is-6-tablet is-relative ">
									<label class="label m-0 pl-0">Upload Background</label>
									<input class="input" type="file" name="background">
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