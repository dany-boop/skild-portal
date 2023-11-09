<?php
$params = $match['params'];
$slug = $params['slug'];
$section = 'worker';

$query = $service->initializeQueryBuilder();
$query2 = $service->initializeQueryBuilder();
$query3 = $service->initializeQueryBuilder();
$query4 = $service->initializeQueryBuilder();

$profiles = $query->select('*')
	->from('profiles')
	// ->join('jobcategories', 'id')
	->where('role_id', 'eq.5')
	->where('id', 'eq.' . $slug)
	->execute()
	->getResult();

$skillWorkers = $query2->select('*')
	->from('tradesskills')
	->join('skills', 'id')
	->where('tradesperson_id', 'eq.' . $slug)
	->execute()
	->getResult();

$applications = $query4->select('*')
	->from('jobapplications')
	// ->join('jobs', 'id')
	->where('tradesperson_id', 'eq.' . $slug)
	->where('deleted', 'eq.false')
	->execute()
	->getResult();

// $applicationss = $applications->applied;
// echo json_encode($applications);
// die;



$jobs = $query3->select('*')
	->from('jobslogs')
	->join('jobs', 'id')
	->where('tradesperson_id', 'eq.' . $slug)
	->execute()
	->getResult();
// $rec = $jobs[0]->jobs->recommended

?>

<?php include('includes/header.php'); ?>
<?php include('includes/_nav.php'); ?>

<section class="section is-medium has-background-light-gray mt-6 min-height-100vh">
	<div class=" container">
		<div class="columns mt-6 is-multiline is-mobile ">
			<div class="column is-5-tablet is-12-mobile ">
				<div class="columns is-multiline is-mobile">
					<div class="column is-3-tablet">
						<div class="bg-profiles">
							<img src="//images.ctfassets.net/tr0mn1h6jqs3/3eLFgN5r1DZOm6MvNlashK/fc562307be14067fa78c141963fe3264/Rectangle_149.png?w=720&fm=webp">
						</div>
					</div>
					<div class="column is-7-tablet ">
						<h2 class="text-title has-text-blue ">
							<?= $profiles[0]->name ?>
						</h2>
						<div class="pw-icon">
							<?php include('assets/images/building.svg') ?>
							<p class="mb-2">
								<?= count($jobs) ?> Jobs Completed
							</p>
							<?php include('assets/images/map-pin.svg') ?>
							<p class="mb-2">
								<?= $profiles[0]->address ?>
							</p>
						</div>
					</div>
				</div>
			</div>
			<div class=" column is-7-tablet card-trades content mt-6">
				<div class="columns is-multiline">
					<p class="column is-7 text-job ">Expected Salaries</p>
					<span class="column is-5 has-text-grey">
						$ 200,000.00
					</span>
				</div>

				<div class="columns is-multiline">
					<p class="column is-7 text-job ">Expected Sallaries</p>
					<span class="column is-5 has-text-grey">
						$ 200,000.00
					</span>
				</div>

				<div class="columns is-multiline">
					<p class="column is-7 text-job ">Expected Sallaries</p>
					<span class="column is-5 has-text-grey">
						$ 200,000.00
					</span>
				</div>
				<!-- <?php
						if (count($applications) > 0) {
							if ($applications == true) {
						?>
						<div class=" is-centered">
							<?php if ($applications[0]->active == false && $applications[0]->rejected == null || false) {
							?>
								<button data-jobid=<?= $applications[0]->job_id ?> data-applyid=<?= $applications[0]->id ?> data-active='false' data-rejected='true' class="accept-btn  accept ">
									Accept
								</button>
								<button data-jobid=<?= $applications[0]->job_id ?> data-applyid=<?= $applications[0]->id ?> data-active='true' data-rejected='false' class="decline-btn accept">Decline</button>
							<?php } elseif ($applications[0]->active == true) { ?>
								<button class="button0  ">
									Accepted
								</button>
							<?php } ?>
						</div>
					<?php } else { ?>
						<div class=" is-centered">

							<button class=button-f>
								<p>
									Contact
								</p>
							</button>
						</div>
					<?php }
						} else { ?>
					<div class=" is-centered">
						<button class=button-f>
							<p>
								Contact
							</p>
						</button>
					</div>
				<?php }  ?> -->

			</div>
		</div>
		<div class="column is-5-tablet is-full-mobile  ">
			<h3 class="text-title2 has-text-blue">
				Summary
			</h3>
			<span class="text-job">
				<?= $parser->parse($profiles[0]->description ? $profiles[0]->description : '-- No Description --'); ?>
			</span>
			<div class="mt-3">
				<h3 class="text-title2 has-text-blue">Skills</h3>
				<?php if (count($skillWorkers) > 0) { ?>
					<ul class="svg-wtext2 mt-2">
						<?php foreach ($skillWorkers as $skill) { ?>
							<li>
								<?php include 'assets/images/skill.svg'; ?>
								<?= $skill->skills->name ?>
							</li>
						<?php } ?>
					</ul>
				<?php } ?>
			</div>
		</div>
	</div>
	</div>
</section>

<?php include('includes/footer-init.php'); ?>
<?= component_js('<script type="text/javascript" src="assets/js/invitation.js"></script> <script type="text/javascript" src="assets/js/invite.js"></script>'); ?>