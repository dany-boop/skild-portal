<?php 
$key = isset($_GET['k']) ? $_GET['k'] : '';
$type = isset($_GET['t']) ? $_GET['t'] : '';

$query = new \Contentful\Delivery\Query;
$query->setContentType('projects')
->where("fields.title[match]", $key)
->setLimit(6);
$allproject = $client->getEntries($query);
$x=0;
?>

<section class="section is-medium has-background-light-gray">
	<div class="container mt-6">
		<div class="columns is-multiline is-mobile">
			<div class="column is-12-tablet is-12-mobile">
				<h2 class="title has-text-blue">Result for <?= $key ?></h2>
				<p class="title-small">123 services available</p>
			</div>	
		</div>
		<?php if(count($allproject) > 0){ ?>
		<div class="columns is-multiline is-mobile mt-6">
			<div class="column is-12-tablet is-12-mobile">
				<ul class="grid-talent">
				<?php foreach ($allproject as $project) :
					if($project->getTalents()){
						?>
						<li>
							<a href="job/<?= $project->getSlug() ?>" title="">
								<div class="data-talent <?= $x > 2 ? 'blurry' : '' ?>">
									<div class="profpic-talent" style="background:linear-gradient(0deg, rgba(0,0,0,0.5) 0%, rgba(0,0,0,0.4962359943977591) 100%), url(<?= $project->getThumbnail()->getFile()->getUrl(); ?>); background-size:cover;"> 
										<!-- <h3 class=""><?= $project->getCost() ?></h3> -->
										<!-- <img class="book-talent-abs" src="assets/images/bookmark-white.png" /> -->
									</div>
									<div class="wrap-rating-content">
										<div class="columns is-multiline is-mobile is-vcentered p-0 m-0">
											<div class="column is-12-tablet is-12-mobile has-text-centered">
												<p class="fs-1-5r"><?= $project->getTalentCategory() ? $project->getTalentCategory()->getName() : ''; ?></p>
												<h2><?= $project->getTitle(); ?></h2>
												<p class="fs-1-5r">by <?= $project->getTalents() ? $project->getTalents()->getName() : ''; ?></p>
											</div>
											<div class="column is-12-tablet is-12-mobile div-book-talent pt-0">
												<div class="wrap-rating">
													<img class="stars-talent mr-3" src="assets/images/stars.png" />
													<p class="fs-2r"><?= $project->getRating() ? $project->getRating() : '0.0' ?></p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</a>
						</li>

					<?php } $x++; endforeach;?>
				</ul>
			</div>
			<div class="column is-12-tablet is-12-mobile mt-6">
				<a href="signup" class="btn-yellow py-2">SEE MORE</a>
			</div>
		</div>
	<?php }else{ ?>
		<div class="columns is-multiline is-mobile mt-6">
			<div class="column is-12-tablet is-12-mobile">
				<p>- Data Not Exist -</p>
			</div>
		</div>
		<?php } ?>
	</div>
</section>