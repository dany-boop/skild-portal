
<section class="section is-medium has-background-light-gray">
	<div class="container mt-6">
		<div class="columns is-multiline is-mobile  is-centered">

			<div class="column is-12-tablet is-12-mobile mb-5">
				<h2 class="title has-text-blue mb-2"><?= $entry->getTitle() ?></h2>
			</div>
			<div class="column is-12-tablet is-12-mobile content small-text">
				<?= $parser->parse($entry->getDescription()); ?>
			</div>

		</div>
	</section>

