<?php function card_profile($role, $name, $desc, $id, $email, $address, $phone, $roleId)
{ ?>

	<div class="card card-profile-home">
		<div class="bg-profile" style="background: url('https://images.ctfassets.net/tr0mn1h6jqs3/4HUBAkA54aN53rF7o7SkYE/40c0b697cae40f78b1ccf303e78944ab/Rectangle_153.png')">
			<img src="https://images.ctfassets.net/tr0mn1h6jqs3/vbPnTteww08CHEIzDnmX6/ce7c73aa245e0c1ba0a6b783fd929844/Rectangle_150.png">
		</div>


		<div class="wrap-profile">
			<h2 class="has-text-blue mb-1 mt-5 is-uppercase">
				<?php echo $role ?>
			</h2>
			<h1 class="mb-2 subtitle">
				<?php echo $name ?>
			</h1>
			<div class="content">
				<?php echo $desc ?>
			</div>

			<!-- <a href="profile" class="has-text-centered has-text-blue is-underlined">Edit Profile</a> -->
		</div>
	</div>
	<div class="card menus mt-3">
		<aside class="menu" style="padding: 1.5rem;">
			<p class="menu-label">
				General
			</p>
			<ul class="menu-list">
				<li><a>Dashboard</a></li>
				<?php
				if ($roleId == 4) {
				?>
					<li><a href="dashboard/hires">My Hires </a></li>
					<li><a href="jobs/search">Search Worker</a></li>
					<li><a href="dashboard/project">My Projects </a></li>
				<?php }
				?>
				<?php if ($roleId == 5) { ?>
					<li><a href="jobs/search">Search Job</a></li>
					<li><a href="dashboard/saved-jobs">My Saved Jobs</a></li>
				<?php } ?>
			</ul>
			<?php if ($roleId != 2) { ?>
				<p class="menu-label">
					My Profile
				</p>
			<?php } ?>
			<ul class="menu-list">
				<?php if ($roleId != 2) { ?>
					<li><a href="profile">Edit Profile</a></li>
				<?php } ?>
				<?php
				if ($roleId == 5) {
				?>
					<li><a href="dashboard/skills">My Skills </a></li>

					<li><a href="experience/list">Past Experiences </a></li>
				<?php }
				?>
			</ul>
			<?php if ($roleId != 4 && $roleId != 5) { ?>
				<p class="menu-label">
					Admins
				</p>
				<ul class="menu-list">
					<li><a>Summary</a></li>
					<li><a>Project List</a></li>
					<li><a>Skilledworker List</a></li>
					<li><a>Reports</a></li>
				</ul>
			<?php } ?>
			<p class="menu-label">
				Account
			</p>
			<ul class="menu-list">
				<li><a href="settings/update-password">Update Password</a></li>
				<?php if ($roleId != 2) { ?>
					<li><a>My Subscription</a></li>
				<?php } ?>
			</ul>
			<p class="menu-label">
				Logout
			</p>
			<ul class="menu-list">
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</aside>
	</div>
<?php } ?>

<?php function card_list_project_grid($jobs, $rec)
{
	$count = 0;
?>
	<div class="grid-4">
		<?php foreach ($jobs as $value) {
			if ($count >= 4) {
				break;
			}
			$count++;

			$wishlistStatus = json_decode(json_encode(wishlistcheck($value->id)), true);
			$profile = json_decode(json_encode(get_profile($value->contractor_id)), true);


			$isMark = $wishlistStatus['status'] == '200' ? $wishlistStatus['data'][0]['mark'] == '1' : false;

			$address = strlen($value->address) > 30 ? substr($value->address, 0, 30) . '...' : $value->address;
		?>
			<div class="wrap-img-text ">
				<?php
				if ($rec == true && $value->recommended == true) {
				?>
					<div class="rec-label ">
						<div class="thumbs">
							<?php include 'assets/images/thumbs.svg'; ?>
						</div>
					</div>
				<?php } ?>

				<div class="bookmark-small">
					<div class="bookmark" data-jobid="<?= $value->id ?>" data-tradesId="<?= $_SESSION['id'] ?>" data-contractorId="<?= 'null' ?>" data-bookmarkTypes="Jobs" data-create="<?= $wishlistStatus['status'] == '400' ? '1' : '0' ?>" data-marked="<?= $wishlistStatus['status'] == '200' ? $wishlistStatus['data'][0]['mark'] == '1' ? '1' : '0' : '1' ?>" data-wishlistid="<?= $wishlistStatus['status'] == '200' ? $wishlistStatus['data'][0]['id'] : 'error' ?>">

						<?= $isMark ? include 'assets/images/bookmarked.svg' : include 'assets/images/bookmark.svg' ?>
					</div>
				</div>

				<a href="jobs/detail/<?= $value->id ?>" title="Jobs detail">
					<img src="https://images.ctfassets.net/tr0mn1h6jqs3/4HUBAkA54aN53rF7o7SkYE/40c0b697cae40f78b1ccf303e78944ab/Rectangle_153.png" alt="">
				</a>
				<div class="content">
					<h2>
						<?= $value->name ?>
					</h2>
					<p class="mt-4">
						<?= !empty($address) ? $address : '-' ?>
					</p>
					<!-- <div class="line mb-3">
						</div>
						<div class="columns is-multiline ">
							<div class="column is-6-tablet">
								<p class="m-0">by
									<?= $profile['data'][0]['name'] ? $profile['data'][0]['name'] : '-' ?>
								</p>
							</div>
							<div class="column is-6-tablet ">
								<span class="text-address level-right">$
									<?= $value->estimated_budget ?>
								</span>
							</div>
						</div> -->
				</div>
			</div>
		<?php } ?>
	</div>
<?php } ?>
<?php function card_list_recommended($jobs, $rec, $apply)
{
	$count = 0; ?>
	<div class="grid-4">
		<?php foreach ($jobs as $value) {
			if ($count >= 4) {
				break;
			}
			$count++;

			$wishlistStatus = json_decode(json_encode(wishlistcheck($value->id)), true);
			$profile = json_decode(json_encode(get_profile($value->contractor_id)), true);

			$isMark = $wishlistStatus['status'] == '200' ? $wishlistStatus['data'][0]['mark'] == '1' : false;

			$address = strlen($value->address) > 30 ? substr($value->address, 0, 30) . '...' : $value->address;
		?>
			<div class="wrap-img-text ">
				<?php
				if ($rec == true && $value->recommended == true) {
				?>
					<div class="rec-label ">
						<div class="thumbs">
							<?php include 'assets/images/thumbs.svg'; ?>
						</div>
					</div>
				<?php } ?>

				<div class="bookmark-small">
					<div class="bookmark" data-jobid="<?= $value->id ?>" data-tradesId="<?= $_SESSION['id'] ?>" data-contractorId="<?= 'null' ?>" data-bookmarkTypes="Jobs" data-create="<?= $wishlistStatus['status'] == '400' ? '1' : '0' ?>" data-marked="<?= $wishlistStatus['status'] == '200' ? $wishlistStatus['data'][0]['mark'] == '1' ? '1' : '0' : '1' ?>" data-wishlistid="<?= $wishlistStatus['status'] == '200' ? $wishlistStatus['data'][0]['id'] : 'error' ?>">

						<?php $isMark ? include 'assets/images/bookmarked.svg' : include 'assets/images/bookmark.svg' ?>
					</div>
				</div>

				<a href="jobs/detail/<?= $value->id ?>" title="Jobs detail">
					<img src="https://images.ctfassets.net/tr0mn1h6jqs3/4HUBAkA54aN53rF7o7SkYE/40c0b697cae40f78b1ccf303e78944ab/Rectangle_153.png" alt="">
				</a>

				<div class="content">
					<div class="columns is-multiline is-mobile">
						<div class="column is-9-tablet is-6-mobile">
							<h2>
								<?= $value->name ?>
							</h2>
							<p class="mt-4">
								<?= !empty($address) ? $address : '-' ?>
							</p>
						</div>
						<div class="column is-2-tablet level-right mt-3">
							<div class="wrap-rating">
								<img class="star-talent" src="assets/images/star.png" />
								<p class="fs-2r">
									0.0
								</p>
							</div>
						</div>
					</div>

					<!-- <div class="columns is-multiline ">
							<div class="column is-6-tablet">
								<p class="m-0">by <?= $profile['data'][0]['name'] ? $profile['data'][0]['name'] : '-' ?></p>
							</div>
							<div class="column is-6-tablet ">
								<span class="text-address level-right">$ <?= number_format($value->estimated_budget, 2) ?></span>
							</div>
						</div> -->
				</div>
			</div>
		<?php } ?>
	</div>
<?php } ?>
<?php function card_list_ongoing($projects, $rec, $apply)
{
	$count = 0; ?>
	<div class="grid-4">
		<?php foreach ($projects as $value) {
			if ($count >= 4) {
				break;
			}
			$profile = json_decode(json_encode(get_profile($value->jobs->contractor_id)), true);
			$count++;


			$address = strlen($value->jobs->address) > 20 ? substr($value->jobs->address, 0, 20) . '...' : $value->jobs->address;
		?>
			<div class="wrap-img-text ">
				<?php
				if ($rec == true && $value->jobs->recommended == true) {
				?>
					<div class="rec-label ">
						<div class="thumbs">
							<?php include 'assets/images/thumbs.svg'; ?>
						</div>
					</div>
				<?php } ?>

				<a href="jobs/detail/<?= $value->id ?>" title="Jobs detail">
					<img src="https://images.ctfassets.net/tr0mn1h6jqs3/4HUBAkA54aN53rF7o7SkYE/40c0b697cae40f78b1ccf303e78944ab/Rectangle_153.png" alt="">
				</a>
				<div class="content">
					<h2>
						<?= $value->jobs->name ?>
					</h2>
					<p>
						<?= !empty($address) ? $address : '-' ?>
					</p>


					<div class="level-right mt-2">
						<?php if ($_SESSION['roles'] == 'tradesperson') { ?>
							<?php
							$applied = false;
							foreach ($apply as $item) {
								if ($item->job_id == $value->jobs->id) {
									$applied = true;
									break; // Exit the loop when a match is found
								}
							}
							?>
							<button <?php if ($applied) {
										echo 'disabled ';
									} ?>class="button<?= $applied ? '0' : '1' ?> <?php if (!$applied) {
																						echo 'is-apply';
																					} ?>" <?php if (!$applied) { ?> data-jobid="<?= $value->id ?>" data-tradesId="<?= $_SESSION['id'] ?>" data-name="<?= $value->name ?>" data-description="<?= $value->description ?>" <?php } ?>>
								<span class="icon">
									<?php include 'assets/images/apply.svg'; ?>
								</span>
								<span class="text">
									<?= $applied ? 'Applied' : 'Apply' ?>
								</span>
							</button>
						<?php } ?>
					</div>
					<!-- <div class="line mb-3">
						</div> -->
					<!-- <div class="columns is-multiline ">
							<div class="column is-6-tablet">
								<p class="m-0">by <?= $profile['data'][0]['name'] ? $profile['data'][0]['name'] : '-' ?></p>
							</div>
							<div class="column is-6-tablet ">
								<span class="text-address level-right">$ <?= number_format($value->jobs->estimated_budget, 2) ?></span>
							</div>
						</div> -->
				</div>
			</div>
		<?php } ?>
	</div>
<?php } ?>
<?php function card_list_ongoing_contractor($jobs, $rec, $apply)
{
	$count = 0; ?>
	<div class="grid-4">
		<?php foreach ($jobs as $value) {
			if ($count >= 4) {
				break;
			}
			$profile = json_decode(json_encode(get_profile($value->contractor_id)), true);
			$count++;


			$address = strlen($value->address) > 20 ? substr($value->address, 0, 20) . '...' : $value->address;
		?>
			<div class="wrap-img-text ">
				<?php
				if ($rec == true && $value->recommended == true) {
				?>
					<div class="rec-label ">
						<div class="thumbs">
							<?php include 'assets/images/thumbs.svg'; ?>
						</div>
					</div>
				<?php } ?>

				<a href="jobs/detail/<?= $value->id ?>" title="Jobs detail">
					<img src="https://images.ctfassets.net/tr0mn1h6jqs3/4HUBAkA54aN53rF7o7SkYE/40c0b697cae40f78b1ccf303e78944ab/Rectangle_153.png" alt="">
				</a>
				<div class="content">
					<h2>
						<?= $value->name ?>
					</h2>
					<p>
						<?= !empty($address) ? $address : '-' ?>
					</p>


					<div class="level-right mt-2">
						<?php if ($_SESSION['roles'] == 'tradesperson') { ?>
							<?php
							$applied = false;
							foreach ($apply as $item) {
								if ($item->job_id == $value->id) {
									$applied = true;
									break; // Exit the loop when a match is found
								}
							}
							?>
							<button <?php if ($applied) {
										echo 'disabled ';
									} ?>class="button<?= $applied ? '0' : '1' ?> <?php if (!$applied) {
																						echo 'is-apply';
																					} ?>" <?php if (!$applied) { ?> data-jobid="<?= $value->id ?>" data-tradesId="<?= $_SESSION['id'] ?>" data-name="<?= $value->name ?>" data-description="<?= $value->description ?>" <?php } ?>>
								<span class="icon">
									<?php include 'assets/images/apply.svg'; ?>
								</span>
								<span class="text">
									<?= $applied ? 'Applied' : 'Apply' ?>
								</span>
							</button>
						<?php } ?>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
<?php } ?>

<?php function card_list_talent_grid($trades)
{ ?>
	<ul class="grid-talent">
		<?php foreach (array_slice($trades, 0, 4) as $value) {

			$wishlistStatus = json_decode(json_encode(wishlistchecktrades($value->id)), true);

			$isMark = $wishlistStatus['status'] == '200' ? $wishlistStatus['data'][0]['mark'] == true : false;
		?>
			<li>
				<div class="data-talent">
					<div class="profpic-talent" style="background-image:url('<?= $value->avatar_url ? $value->avatar_url : 'https://images.ctfassets.net/tr0mn1h6jqs3/3eLFgN5r1DZOm6MvNlashK/fc562307be14067fa78c141963fe3264/Rectangle_149.png' ?>') ">
						<div class="bookmark" data-tradesId="<?= $value->id ?>" data-contractorid="<?= $_SESSION['id'] ?>" data-jobid="<?= 'null' ?>" data-bookmarkTypes="Workers" data-create="<?= $wishlistStatus['status'] == '400' ? '1' : '0' ?>" data-marked="<?= $wishlistStatus['status'] == '200' ? $wishlistStatus['data'][0]['mark'] == '1' ? '1' : '0' : '1' ?>" data-wishlistid="<?= $wishlistStatus['status'] == '200' ? $wishlistStatus['data'][0]['id'] : 'error' ?>">
							<?php $isMark ? include 'assets/images/bookmarked.svg' : include 'assets/images/bookmark.svg ' ?>
						</div>
					</div>
					<a href="worker/<?= $value->id ?>">

						<div class="wrap-rating-content">
							<div class="columns is-multiline is-mobile is-vcentered p-0 m-0">
								<div class="column is-8-tablet is-8-mobile">
									<p>
										<?= $value->jobcategories ? $value->jobcategories->name : '-' ?>
									</p>
									<h2>
										<?= $value->name ?>
									</h2>
								</div>
								<div class="column is-4-tablet is-4-mobile pr-5">
									<div class="wrap-rating">
										<img class="star-talent" src="assets/images/star.png" />
										<p class="fs-2r">
											0.0
										</p>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
			</li>
		<?php } ?>
	</ul>
<?php } ?>


<?php function card_list_applicant_grid($talent, $trades)
{ ?>
	<ul class="grid-talent">
		<?php foreach ($talent as $value) {
			if ($value->jobs->contractor_id == $_SESSION['id']) {
				$tradespersonId = $value->tradesperson_id; // Get the Tradesperson ID from the talent
				$tradespersonName = ''; // Initialize Tradesperson Name

				foreach ($talent as $profileData) {
					if ($profileData->profiles->id == $tradespersonId) {
						$tradespersonName = $profileData->profiles->name;

						break; // Exit the loop once a match is found

					}
				};

		?>

				<li>
					<a href="worker/<?= $value->profiles->id ?>">
						<div class="data-talent">
							<div class="profpic-talent" style="background-image:url('<?= $value->profiles->avatar_url ? $value->profiles->avatar_url : 'https://images.ctfassets.net/tr0mn1h6jqs3/3eLFgN5r1DZOm6MvNlashK/fc562307be14067fa78c141963fe3264/Rectangle_149.png' ?>') ">
							</div>
							<div class="wrap-rating-content">
								<div class="columns is-multiline is-mobile is-vcentered p-0 m-0">
									<div class="column is-8-tablet is-8-mobile">
										<h2>
											<?= $tradespersonName ?>
										</h2>
										<div class="skill-container">
											<?php foreach ($trades as $item) {
												if ($value->tradesperson_id == $item->tradesperson_id) {
											?>
													<span class=skill-list>
														<?= $item->name ?>
													</span>
											<?php }
											} ?>
										</div>

									</div>
									<div class="column is-4-tablet is-4-mobile pr-5">
										<div class="wrap-rating">
											<img class="star-talent" src="assets/images/star.png" />
											<p class="fs-2r">
												0.0
											</p>
										</div>

										<img class="book-talent" src="assets/images/bookmark.png" />
									</div>
								</div>
								<!-- <div class="level-right">
									<?php
									$applied = false;
									foreach ($apply as $item) {
										if ($item->job_id == $value->id) {
											$applied = true;
											break; // Exit the loop when a match is found
										}
									}
									?>
									<button <?php if ($applied) {
												echo 'disabled ';
											} ?>class="button<?= $applied ? '0' : '1' ?> <?php if (!$applied) {
																								echo 'is-apply';
																							} ?>" <?php if (!$applied) { ?> data-jobid="<?= $value->id ?>" data-tradesId="<?= $_SESSION['id'] ?>"
											data-name="<?= $value->name ?>" data-description="<?= $value->description ?>" <?php } ?>>
										<span class="icon">
											<?php include 'assets/images/apply.svg'; ?>
										</span>
										<span class="text">
											<?= $applied ? 'Applied' : 'Apply' ?>
										</span>
									</button>
								</div> -->
							</div>
						</div>
					</a>
				</li>
			<?php } ?>
		<?php } ?>
	</ul>
<?php } ?>
<?php function card_profile_menu($id = "", $bg = "", $img = "", $name = "", $type = "", $roleId = "", $section = "")
{ ?>
	<div class="card card-profile-home">
		<div class="bg-profile" style="background: url('<?= $bg ?>')">
			<img src="<?= $img ?>">
		</div>
		<div class="wrap-profile">
			<h2 class="has-text-blue mb-1 mt-5 is-uppercase">
				<?= $type ?>
			</h2>
			<h1 class="mb-2 subtitle">
				<?= $name ?>
			</h1>
		</div>
		<div class="wrap-menu">
			<p class="menu-label">
				General
			</p>

			<ul class="">
				<li><a href="">Dashboard</a></li>
				<?php
				if ($roleId == 4) {
				?>
					<!-- <li><a href="dashboard/hires">My Hires </a></li> -->
					<li><a href="jobs/search">Search Worker</a></li>
					<!-- <li><a href="dashboard/project">My Projects </a></li> -->
				<?php }
				?>
				<?php if ($roleId == 5) { ?>
					<li><a href="jobs/search">Search Job</a></li>
				<?php } ?>
			</ul>
			<p class="menu-label">
				My Profile
			</p>
			<ul>
				<li class=" <?= $section == 'profile' ? 'active' : '' ?> "><a href="profile">My Account</a></li>
				<?php if ($roleId == 4) {
				?>
					<li class="<?= $section == 'projects' ? 'active' : '' ?> "><a href="project/list">Projects</a></li>
				<?php }
				?>
				<?php
				if ($roleId == 5) {
				?>
					<li class=" <?= $section == 'experiences' ? 'active' : '' ?> "><a href="experience/list">Experiences</a>
					</li>
				<?php }
				?>
				<li class=" <?= $section == 'applications' ? 'active' : '' ?> "><a href="application/list">Job
						Application</a>
				</li>
				<?php
				if ($roleId == 5) {
				?>
					<li class=" <?= $section == 'skills' ? 'active' : '' ?> "><a href="skill/list">Skills</a></li>
				<?php }
				?>
				<li class="<?= $section == 'saved-list' ? 'active' : '' ?> "><a href="saved/list">Wishlist</a></li>

				<p class="menu-label">
					Account
				</p>
				<ul>
					<li><a href="settings/update-password">Update Password</a></li>
					<?php if ($roleId != 2) { ?>
						<li><a>My Subscription</a></li>
					<?php } ?>
				</ul>
				<p class="menu-label">
					Logout
				</p>
				<li class=" "><a href="logout.php">Logout</a></li>
			</ul>
		</div>
	</div>
<?php } ?>

<?php function input($label = "", $name = "", $placeholder = "", $value = "", $type = "text")
{ ?>
	<label class="label m-0 pl-0">
		<?= $label ?>
	</label>
	<input class="input input-grey" name="<?= $name ?>" type="<?= $type ?>" placeholder="<?= $placeholder ?>" value="<?= $value ?>">
<?php } ?>

<?php function textarea($label = "", $name = "", $placeholder = "", $value = "")
{ ?>
	<label class="label m-0 pl-0">
		<?= $label ?>
	</label>
	<textarea class="textarea input-grey" name="<?= $name ?>" placeholder="<?= $placeholder ?>"><?= $value ?></textarea>
<?php } ?>


<?php function icon_action($url = "", $id = 0, $edit = true, $del = false, $eye = false, $action = "")
{ ?>
	<?php if ($edit == true) { ?>
		<a href="<?= $url ?>">
			<?php include 'assets/images/edit.svg'; ?>
		</a>
	<?php } ?>
	<?php if ($del == true) { ?>
		<a data-id="<?= $id ?>" data-action="<?= $action ?>" class="btn-delete">
			<?php include 'assets/images/delete.svg'; ?>

		</a>
	<?php } ?>
	<?php if ($eye == true) { ?>
		<a href="<?= $url ?>">
			<?php include 'assets/images/eye.svg'; ?>
		</a>
	<?php } ?>
<?php } ?>

<?php function card_list_project_grid_medium($jobs, $rec, $apply)
{ ?>

	<div class="grid-3">
		<?php foreach ($jobs as $value) {
			$wishlistStatus = json_decode(json_encode(wishlistcheck($value->id)), true);
			$profile = json_decode(json_encode(get_profile($value->contractor_id)), true);

			$isMark = $wishlistStatus['status'] == '200' ? $wishlistStatus['data'][0]['mark'] == '1' : false;
			// print_r($profile);

			// echo json_encode($apply);
			// die;
			//  = $apply[0]->job_id == $value->id
			// $isMark = 'data-marked';
		?>
			<div class="wrap-img-text-medium">
				<?php
				if ($rec == true && $value->recommended == true) { ?>

					<div class="rec-label ">
						<div class="thumbs">
							<?php include 'assets/images/thumbs.svg'; ?>
						</div>
					</div>
				<?php } ?>

				<div class="bookmark" data-jobid="<?= $value->id ?>" data-tradesId="<?= $_SESSION['id'] ?>" data-contractorId="<?= 'null' ?>" data-bookmarkTypes="Jobs" data-create="<?= $wishlistStatus['status'] == '400' ? '1' : '0' ?>" data-marked="<?= $wishlistStatus['status'] == '200' ? $wishlistStatus['data'][0]['mark'] == '1' ? '1' : '0' : '1' ?>" data-wishlistid="<?= $wishlistStatus['status'] == '200' ? $wishlistStatus['data'][0]['id'] : 'error' ?>">

					<?php $isMark ? include 'assets/images/bookmarked.svg' : include 'assets/images/bookmark.svg' ?>
				</div>

				<a href="jobs/detail/<?= $value->id ?>" title="Jobs detail">
					<img src="https://images.ctfassets.net/tr0mn1h6jqs3/4HUBAkA54aN53rF7o7SkYE/40c0b697cae40f78b1ccf303e78944ab/Rectangle_153.png" alt="" class="">
				</a>

				<div class="content mt-4 ">
					<h2 class="mt-1">
						<?= $value->name ?>
					</h2>
					<p class="m-0">
						<?php
						$address = $value->address ? $value->address : 'Not Available';
						echo strlen($address) > 20 ? substr($address, 0, 20) . '...' : $address;
						?>
					</p>

					<div class="line mb-3">
					</div>
					<div class="columns is-multiline ">
						<div class="column is-6-tablet">
							<p class="m-0 ">by
								<?= $profile['data'][0]['name'] ? $profile['data'][0]['name'] : '-' ?>
							</p>
						</div>
						<div class="column is-6-tablet ">
							<span class="text-address level-right">$
								<?= number_format($value->estimated_budget, 2) ?>
							</span>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
<?php } ?>
<?php function card_list_project_grid_logs($joblogs)
{ ?>

	<div class="grid-3">
		<?php foreach ($joblogs as $value) {
		?>
			<!-- <a href="" title=""> -->
			<div class="wrap-img-text-medium">
				<img src="https://images.ctfassets.net/tr0mn1h6jqs3/4HUBAkA54aN53rF7o7SkYE/40c0b697cae40f78b1ccf303e78944ab/Rectangle_153.png" alt="" class="">
				<div class="content ">

					<h2 class="mt-1 pt-3">
						<?= $value->name ?>
					</h2>
					<p>
						<?= $value->description ? $value->description : 'Not Available' ?>
					</p>
				</div>
			</div>
			<!-- </a> -->
		<?php } ?>
	</div>
<?php } ?>
<?php function card_list_project_grid_saved($jobs, $apply, $wishlist)
{ ?>
	<div class="grid-4">
		<?php foreach ($wishlist as $value) {

			// print_r($value);

			$wishlistStatus = json_decode(json_encode(wishlistcheck($value->id)), true);
			$isMark = $wishlistStatus['status'] == '200' ? $wishlistStatus['data'][0]['mark'] == '1' : false;
		?>
			<?php if ($_SESSION['roles'] == 'contractor') {
				$profile = json_decode(json_encode(get_profile($value->trades_id)), true);
				// print_r($profile);
			} else if ($_SESSION['roles'] == 'tradesperson') {
				$profile = json_decode(json_encode(get_profile($value->contractor_id)), true);
			} ?>


			<?php if ($_SESSION['roles'] == 'tradesperson') { ?>
				<!-- <a href="" title=""> -->
				<div class="wrap-img-text-medium">
					<?php
					if ($jobs[0]->recommended == true) { ?>

						<div class="rec-label ">
							<div class="thumbs">
								<?php include 'assets/images/thumbs.svg'; ?>
							</div>
						</div>
					<?php } ?>

					<div class="bookmark" data-jobid="<?= $value->id ?>" data-tradesId="<?= $_SESSION['id'] ?>" data-contractorId="<?= 'null' ?>" data-bookmarkTypes="Jobs" data-create="<?= $wishlistStatus['status'] == '400' ? '1' : '0' ?>" data-marked="<?= $wishlistStatus['status'] == '200' ? $wishlistStatus['data'][0]['mark'] == '1' ? '1' : '0' : '1' ?>" data-wishlistid="<?= $wishlistStatus['status'] == '200' ? $wishlistStatus['data'][0]['id'] : 'error' ?>">

						<?php $isMark ? include 'assets/images/bookmarked.svg' : include 'assets/images/bookmark.svg ' ?>
					</div>

					<img src="https://images.ctfassets.net/tr0mn1h6jqs3/4HUBAkA54aN53rF7o7SkYE/40c0b697cae40f78b1ccf303e78944ab/Rectangle_153.png" alt="" class="">
					<div class="content ">
						<h2 class="mt-1">
							<?= $value->jobs->name ?>
						</h2>
						<p>
							<?= $value->jobs->description ? $value->jobs->description : 'Not Available' ?>
						</p>
					</div>
				</div>
				<!-- </a> -->
			<?php } else if ($_SESSION['roles'] == 'contractor') { ?>
				<div>
					<div class="data-talent">
						<div class="profpic-talent" style="background-image:url( 'https://images.ctfassets.net/tr0mn1h6jqs3/3eLFgN5r1DZOm6MvNlashK/fc562307be14067fa78c141963fe3264/Rectangle_149.png' ) ">
							<div class="bookmark" data-tradesId="<?= $value->id ?>" data-contractorid="<?= $_SESSION['id'] ?>" data-jobid="<?= 'null' ?>" data-bookmarkTypes="Workers" data-create="<?= $wishlistStatus['status'] == '400' ? '1' : '0' ?>" data-marked="<?= $wishlistStatus['status'] == '200' ? $wishlistStatus['data'][0]['mark'] == '1' ? '1' : '0' : '1' ?>" data-wishlistid="<?= $wishlistStatus['status'] == '200' ? $wishlistStatus['data'][0]['id'] : 'error' ?>">
								<?php $isMark ? include 'assets/images/bookmark.svg' : include 'assets/images/bookmarked.svg ' ?>
							</div>
						</div>
						<a href="worker/<?= $value->trades_id ?>">

							<div class="wrap-rating-content">
								<div class="columns is-multiline is-mobile is-vcentered p-0 m-0">
									<div class="column is-8-tablet is-8-mobile">
										<h2>
											<?= $profile['data'][0]['name'] ?>
										</h2>
										<p>
											<?= $profile['data'][0]['address'] ? $profile['data'][0]['address'] : '-' ?>
										</p>
									</div>
									<div class="column is-4-tablet is-4-mobile pr-5">
										<div class="wrap-rating">
											<img class="star-talent" src="assets/images/star.png" />
											<p class="fs-2r">
												0.0
											</p>
										</div>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
			<?php } ?>
		<?php } ?>
	</div>
<?php } ?>

<?php function card_list_talent_grid_medium($trades)
{ ?>
	<ul class="grid-talent-medium">
		<?php foreach ($trades as $value) {

			// print_r($value);

			$wishlistStatus = json_decode(json_encode(wishlistchecktrades($value->id)), true);

			$isMark = $wishlistStatus['status'] == '200' ? $wishlistStatus['data'][0]['mark'] == true : false;
		?>
			<li>

				<div class="data-talent">
					<div class="profpic-talent medium" style="background-image:url('<?= $value->avatar_url ? $value->avatar_url : 'https://images.ctfassets.net/tr0mn1h6jqs3/3eLFgN5r1DZOm6MvNlashK/fc562307be14067fa78c141963fe3264/Rectangle_149.png' ?>') ">
						<div class="bookmark" data-tradesId="<?= $value->id ?>" data-contractorid="<?= $_SESSION['id'] ?>" data-jobid="<?= 'null' ?>" data-bookmarkTypes="Workers" data-create="<?= $wishlistStatus['status'] == '400' ? '1' : '0' ?>" data-marked="<?= $wishlistStatus['status'] == '200' ? $wishlistStatus['data'][0]['mark'] == '1' ? '1' : '0' : '1' ?>" data-wishlistid="<?= $wishlistStatus['status'] == '200' ? $wishlistStatus['data'][0]['id'] : 'error' ?>">
							<?php $isMark ? include 'assets/images/bookmarked.svg' : include 'assets/images/bookmark.svg ' ?>
						</div>
					</div>
					<a href="worker/<?= $value->id ?>">
						<div class="wrap-rating-content">
							<div class="columns is-multiline is-mobile is-vcentered p-0 m-0">
								<div class="column is-8-tablet is-8-mobile">
									<p>
										<?= $value->jobcategories ? $value->jobcategories->name : 'not available' ?>
									</p>
									<h2>
										<?= $value->name ?>
									</h2>
								</div>
								<div class="column is-4-tablet is-4-mobile pr-5">
									<div class="wrap-rating">
										<img class="star-talent" src="assets/images/star.png" />
										<p class="fs-2r">
											4.5
										</p>
									</div>
									<!-- <img class="book-talent" src="assets/images/bookmark.svg" /> -->
								</div>
							</div>
						</div>
					</a>
				</div>
			</li>
		<?php } ?>
	</ul>
<?php } ?>