<?php
$query1 = $service->initializeQueryBuilder();
$query2 = $service->initializeQueryBuilder();
$query3 = $service->initializeQueryBuilder();
$query4 = $service->initializeQueryBuilder();
$query5 = $service->initializeQueryBuilder();

$profile = $query1->select('*')
	->from('profiles')
	->join('roles', 'id')
	->where('id', 'eq.' . $_SESSION['id'])
	->execute()
	->getResult();
$name = $profile[0]->name;

$jobs = $query2->select('*')
	->from('jobs')
	->join('jobcategories', 'id')
	->join('jobtypes', 'id')
	->where('recommended', 'eq.true')
	->execute()
	->getResult();
$rec = $jobs[0]->recommended;

$apply = $query4->select('*')
	->from('jobapplications')
	->where('deleted', 'eq.' . 'false')
	->execute()
	->getResult();


$projects = $query3->select('*')
	->from('jobapplications')
	->join('jobs', 'id')
	->where('tradesperson_id', 'eq.' . $_SESSION['id'])
	->where('active', 'eq.true')
	->execute()
	->getResult();

$wishlisted = $query5->select('*')
	->from('wishlist')
	->join('jobs', 'id')
	->where('trades_id', 'eq.' . $_SESSION['id'])
	->where('mark', 'eq.true')
	->execute()
	->getResult();

$wishlist = $wishlisted[0]->jobs;
// echo json_encode($wishlist);
// die;
$data_project = [
	[
		"image" => "https://images.ctfassets.net/tr0mn1h6jqs3/4HUBAkA54aN53rF7o7SkYE/40c0b697cae40f78b1ccf303e78944ab/Rectangle_153.png",
		"type" => "Project Architecture",
		"description" => "A minimalist-style hotel offers a serene and relaxed accommodation experience in a simple and organized setting."
	],
	[
		"image" => "https://images.ctfassets.net/tr0mn1h6jqs3/4HUBAkA54aN53rF7o7SkYE/40c0b697cae40f78b1ccf303e78944ab/Rectangle_153.png",
		"type" => "Project Architecture 2",
		"description" => "A minimalist-style hotel offers a serene and relaxed accommodation experience in a simple and organized setting."
	],
	[
		"image" => "https://images.ctfassets.net/tr0mn1h6jqs3/4HUBAkA54aN53rF7o7SkYE/40c0b697cae40f78b1ccf303e78944ab/Rectangle_153.png",
		"type" => "Project Architecture 3",
		"description" => "A minimalist-style hotel offers a serene and relaxed accommodation experience in a simple and organized setting."
	]
];

?>




<section class="section pt-6 mt-6-tablet is-medium has-background-light-gray">
	<div class="container">
		<div class="columns mt-6 is-multiline is-mobile">
			<div class="column is-full-mobile pl-2-tablet">

				<h2 class="has-text-blue">Hello , <span class="header-text">
						<?= $name ?>
					</span>
				</h2>

				<div class="columns is-multiline  is-mobile is-vcentered  mb-5 mt-3">
					<div class="column is-6-tablet is-full-mobile is-vcentered is-relative mb-5 ">
						<a href="profile">
							<div class="card-cta">
								<div class="columns is-multiline is-mobile">
									<div class="column is-2 vector">
										<?php include 'assets/images/ppl.svg' ?>
									</div>
									<div class="column is-6">
										<h1 class=" has-text-blue">Tell Us About You</h1>
										<p class=" has-text-blue">making a New Profile & Introduction Yourself</p>
									</div>
									<div class="column is-4  chevron">
										<?php include 'assets/images/Chevron.svg' ?>
									</div>
								</div>
							</div>
						</a>
					</div>
					<div class="column is-6-tablet is-full-mobile is-vcentered is-relative mb-5 ">
						<a href="">
							<div class="card-cta">
								<div class="columns is-multiline is-mobile">
									<div class="column is-2 vector">
										<?php include 'assets/images/construction.svg' ?>
									</div>
									<div class="column is-6 has-text-blue ">
										<h1 class=" has-text-blue">Create New Project</h1>
										<p class=" has-text-blue">Hiring Trandeperson to Finish your projects</p>
									</div>
									<div class="column is-4  chevron">
										<?php include 'assets/images/Chevron.svg' ?>
									</div>
								</div>
							</div>
						</a>
					</div>

					<?php
					$count = 0;
					if ($projects > 0) {
					?>
						<div class="column is-full-mobile is-full-tablet is-relative mt-5">
							<h2 class=" header-text has-text-blue">
								On Going Project
							</h2>
						</div>

						<div class="column is-full-mobile is-full-tablet ">
							<?= card_list_ongoing(
								$projects,
								$rec,
								$apply
							) ?>
						</div>
					<?php } ?>


					<div class="column is-full-mobile is-full-tablet is-relative mt-5">
						<h2 class=" header-text has-text-blue">
							Featured Projects
						</h2>
					</div>
					<div class="column is-full-mobile is-full-tablet">
						<?= card_list_recommended(
							$jobs,
							$rec,
							$apply
						) ?>
					</div>
					<div class="column is-full-mobile is-full-tablet is-relative mt-5">
						<h2 class=" header-text has-text-blue">
							My Wishlist
						</h2>
					</div>
					<div class="column is-full-mobile is-full-tablet">
						<?= card_list_project_grid($jobs, $rec) ?>
					</div>

					<div class="column is-full-tablet is-full-mobile ">
						<a href="">
							<div class="card-subscription">
								<div class="columns is-multiline is-mobile">
									<div class="column is-2 vector">
										<?php include 'assets/images/subscription.svg' ?>
									</div>
									<div class="column is-6">
										<h1 class=" has-text-blue">Subscription Status</h1>
										<p class=" has-text-blue">Get Other Attractive Bonus</p>
									</div>
									<div class="column is-4  chevron">
										<?php include 'assets/images/chevron-white.svg' ?>
									</div>
								</div>
							</div>
						</a>
					</div>

				</div>

				<!-- <div class="columns is-multiline is-mobile is-vcentered is-centered mb-5">
					<div class="column is-full-mobile is-full-tablet is-relative">
						<h2 class=" header-text has-text-blue">
							Recent Job Posts
						</h2>
					</div>
				</div> -->
			</div>
		</div>
	</div>
</section>
<?php include 'includes/footer-init.php'; ?>
<?= component_js('<script type="text/javascript" src="assets/js/wishlist.js"></script> <script type="text/javascript" src="assets/js/apply.js"></script>'); ?>