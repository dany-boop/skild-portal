<?php
$slug = "projects";
$section = $slug;

$entry_title = 'Skild';
$metaTitle = $entry_title;

$query = $service->initializeQueryBuilder();

$categories = $query->select('*')
	->from('jobcategories')
	->where('deleted', 'eq.false')
	->order('name.asc')
	->execute()
	->getResult();

?>

<?php include('includes/header.php'); ?>
<?php include('includes/_nav.php'); ?>

<section class="section is-medium has-background-light-gray add-pt-mobile">
	<div class="container">
		<div class="columns is-multiline is-mobile">

			<div class="column is-full-mobile pl-5-tablet is-12-tablet">
				<div class="card card-payment">
					<div class="card-content">
						<div class="columns is-multiline is-mobile add-border-bottom is-vcentered">
							<div class="column is-full-mobile is-6-tablet is-relative ">
								Category List
							</div>
							<div class="column is-full-mobile is-6-tablet is-relative ">
								<a href="category/add"><button class="btn-blue button float-right">Add</button></a>
							</div>
						</div>
						<div class="columns is-multiline is-mobile mt-2">
							<div class="column is-full-mobile is-12-tablet is-relative ">
								<table id="myTable" class="display table table-small">
									<thead>
										<tr>
											<th width="50">#</th>
											<th>Category Name</th>
											<th>Description</th>
											<th class="has-text-centered" width="80"></th>
										</tr>
									</thead>
									<tbody>
										<?php $x = 1;
										foreach ($categories as $value) { ?>
											<tr>
												<td><?= $x ?></td>
												<td><?= $value->name ?></td>
												<td><?= $value->description ?></td>
												<td class="has-text-centered"><?= icon_action("category/edit/" . $value->id, $value->id, true, true, false, "process/categories.php") ?></td>
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
</section>

<?php include('includes/footer-init.php'); ?>
<?= component_js() ?>