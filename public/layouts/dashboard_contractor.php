<?php 

$id = 2;
$bg = "https://images.ctfassets.net/tr0mn1h6jqs3/4HUBAkA54aN53rF7o7SkYE/40c0b697cae40f78b1ccf303e78944ab/Rectangle_153.png";
$img = "https://images.ctfassets.net/tr0mn1h6jqs3/vbPnTteww08CHEIzDnmX6/ce7c73aa245e0c1ba0a6b783fd929844/Rectangle_150.png";
$name = "CONTRACTOR";
$type = "Architechture";
$desc = "I'm a joiner with over five years of experience. I have experience in concrete finishing and steel fixing. During my career, I've worked as a skilled labourer to support other trades. I'm keen to resume my career after completing a period of training to broaden my skills.";
$prjRunning = 50;
$prjHold = 50;
$prjFinish = 50;

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


$data_talents = [
	[
		"image" => "//images.ctfassets.net/tr0mn1h6jqs3/3eLFgN5r1DZOm6MvNlashK/fc562307be14067fa78c141963fe3264/Rectangle_149.png",
		"name" => "Talent Name",
		"type" => "Architecture",
		"star" => 5
	],
	[
		"image" => "//images.ctfassets.net/tr0mn1h6jqs3/3eLFgN5r1DZOm6MvNlashK/fc562307be14067fa78c141963fe3264/Rectangle_149.png",
		"name" => "Talent Name 2",
		"type" => "Architecture",
		"star" => 4
	],
	[
		"image" => "//images.ctfassets.net/tr0mn1h6jqs3/3eLFgN5r1DZOm6MvNlashK/fc562307be14067fa78c141963fe3264/Rectangle_149.png",
		"name" => "Talent Name 3",
		"type" => "Architecture",
		"star" => 4.4
	]
];

?>
<section class="section is-medium has-background-light-gray">
	<div class="container">
		<div class="columns is-multiline is-mobile">
			<div class="column is-full-mobile is-4-tablet is-relative ">
				<?= card_profile($id, $bg, $img, $name, $type, $desc, $prjRunning, $prjHold, $prjFinish) ?>
			</div>
			<div class="column is-full-mobile pl-5-tablet">
				<div class="columns is-multiline is-mobile is-vcentered is-centered mb-5">
					<div class="column is-full-mobile is-full-tablet is-relative">
						<h2 class="title  has-text-blue">
							MY PROJECTS
						</h2>
					</div>
					<div class="column is-full-mobile is-full-tablet">
						<?= card_list_project_grid($data_project) ?>
					</div>
				</div>
				<div class="columns is-multiline is-mobile is-vcentered is-centered ">
					<div class="column is-full-mobile is-full-tablet is-relative">
						<h2 class="title  has-text-blue">
							MY HIRE
						</h2>
					</div>
					<div class="column is-full-mobile is-full-tablet">
						<?= card_list_talent_grid($data_talents) ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section is-small has-background-gray">
	<div class="container">
		<div class="columns is-multiline is-mobile is-vcentered is-centered ">
			<div class="column is-full-mobile is-full-tablet is-relative ">
				<h2 class="subtitle  has-text-blue">
					SEARCH PROJECT
				</h2>
			</div>
			<div class="column is-full-mobile is-4-tablet">
				<div class="select">
					<select>
						<option>Select Type</option>
						<option>With options</option>
					</select>
				</div>
			</div>
			<div class="column is-full-mobile is-4-tablet">
				<div class="select">
					<select>
						<option>Select Skild Worker</option>
						<option>With options</option>
					</select>
				</div>
			</div>
			<div class="column is-full-mobile is-4-tablet">
				<button class="button btn-blue">Search</button>
			</div>
		</div>
	</div>
</section>

<section class="section is-medium has-background-light-gray">
	<div class="container">
		<div class="columns is-multiline is-mobile is-vcentered is-centered ">
			<div class="column is-full-mobile is-full-tablet is-relative mb-5">
				<h2 class="title  has-text-blue">
					BILLING
				</h2>
			</div>
			<div class="column is-full-mobile is-full-tablet">
				<div class="card card-payment">
					<div class="card-content">
						<table id="myTable" class="display table">
							<thead>
								<tr>
									<th width="80">#</th>
									<th class="has-text-centered">Project Name</th>
									<th class="has-text-centered">Due Date</th>
									<th class="has-text-centered">Nominal</th>
									<th class="has-text-centered">Status</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td >Architecture</td>
									<td class="has-text-centered">20 Oct 2023</td>
									<td class="has-text-right">$200</td>
									<td class="has-text-centered"><label class="label label-success">Success</label></td>
								</tr>
								<tr>
									<td>2</td>
									<td >Architecture</td>
									<td class="has-text-centered">20 Oct 2023</td>
									<td class="has-text-right">$200</td>
									<td class="has-text-centered"><label class="label label-overdue">Over Due</label></td>
								</tr>
							</tbody>
						</table>	
					</div>

				</div>

			</div>
		</div>
	</div>
</section>
<!-- <section class="section is-medium has-background-light-gray pt-0">
	<div class="container">
		<div class="columns is-multiline is-mobile is-vcentered is-centered ">
			<div class="column is-full-mobile is-full-tablet is-relative mb-5">
				<h2 class="title  has-text-blue">
					MY POST
				</h2>
			</div>
			<div class="column is-full-mobile is-full-tablet">

				<ul class="grid-talent">
					<?php for ($i = 0; $i < 6; ++$i) { ?>
						<li>
							<a href="job/a" title="">
								<div class="data-talent">
									<div class="profpic-talent" style="background:linear-gradient(0deg, rgba(0,0,0,0.5) 0%, rgba(0,0,0,0.4962359943977591) 100%), url('https://images.ctfassets.net/tr0mn1h6jqs3/4HUBAkA54aN53rF7o7SkYE/40c0b697cae40f78b1ccf303e78944ab/Rectangle_153.png'); background-size:cover;"> 
									</div>
									<div class="wrap-rating-content">
										<div class="columns is-multiline is-mobile is-vcentered p-0 m-0">
											<div class="column is-12-tablet is-12-mobile has-text-centered">
												<p class="fs-1-5r">Architechture</p>
												<h2>Testing</h2>
												<a href="" class="btn-blue button mt-3 ">Post</a>
											</div>
										</div>
									</div>
								</div>
							</a>
						</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>
</section> -->



