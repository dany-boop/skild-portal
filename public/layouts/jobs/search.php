<?php
$slug = "job";
$section = $slug;

$entry_title = 'Skild';
$metaTitle = $entry_title;


$query = $service->initializeQueryBuilder();
$query2 = $service->initializeQueryBuilder();
$query3 = $service->initializeQueryBuilder();
$query4 = $service->initializeQueryBuilder();
$query5 = $service->initializeQueryBuilder();
$query6 = $service->initializeQueryBuilder();
$query7 = $service->initializeQueryBuilder();
$query8 = $service->initializeQueryBuilder();

$t = isset($_GET['t']) ? $_GET['t'] : '';
$j = isset($_GET['j']) ? $_GET['j'] : '';
$c = isset($_GET['c']) ? $_GET['c'] : '';
$f = isset($_GET['f']) ? $_GET['f'] == 'desc' ? 'desc' : 'asc' : 'asc';

$keywords = isset($_GET['keywords']) ? $_GET['keywords'] : '';
$keywords = trim($keywords);

$apply = $query7->select('*')
  ->from('jobapplications')
  ->where('deleted', 'eq.' . 'false')
  ->execute()
  ->getResult();
// $applied = $apply[0]->job_id;
// $tradesperson_id = $apply[0]->tradesperson_id;

// echo json_encode($job_id);
// die;


// $wishlisted = $query6->select('*')
//   ->from('wishlist')
//   ->execute()
//   ->getResult();

// $trades_id = $wishlisted[0]->trades_id;

$jobcategories = $query3->select('*')
  ->from('jobcategories')
  ->execute()
  ->getResult();


// $profile = $query5->select('*')
//   ->from('profiles')
//   ->join('roles', 'id')
//   ->execute()
//   ->getResult();
// $roleId = $profile[0]->roles->id;

// $jobs2 = $query4->select('*')
//   ->from('jobs')
//   ->join('jobcategories', 'id')
//   ->join('jobtypes', 'id')
//   ->order('name.' . $f)
//   ->execute()
//   ->getResult();
// $rec = $jobs2[0]->recommended;


if ($_SESSION['roles'] == 'tradesperson') {

  $jobtypes = $query2->select('*')
    ->from('jobtypes')
    ->execute()
    ->getResult();

  if ($t && $c) {
    $jobs = $query3->select('*')
      ->from('jobs')
      ->join('jobcategories', 'id')
      ->join('jobtypes', 'id')
      ->where('name', 'ilike.' . '%' . $keywords . '%')
      ->where('jobtype_id', 'eq.' . $t)
      ->where('jobcategory_id', 'eq.' . $c)
      ->order('name.' . $f)
      ->execute()
      ->getResult();
    $rec = count($jobs) > 0 ? $jobs[0]->recommended : false;
  } else {

    $jobs = $query->select('*')
      ->from('jobs')
      ->join('jobcategories', 'id')
      ->join('jobtypes', 'id')
      ->where('name', 'ilike.' . '%' . $keywords . '%')
      ->order('name.' . $f)
      ->execute()
      ->getResult();
    $rec = count($jobs) > 0 ? $jobs[0]->recommended : false;
  }
} else {

  $skills = $query8->select('*')
    ->from('tradesskills')
    ->execute()
    ->getResult();

  if ($c && $t) {
    $trades = $query->select('*')
      ->from('profiles')
      ->join('jobcategories', 'id')
      ->where('name', 'ilike.' . '%' . $keywords . '%')
      ->where('jobcategory_id', 'eq.' . $c)
      ->where('tradesskills', 'eq.' . $t)
      ->where('role_id', 'eq.5')
      ->order('name.' . $f)
      ->execute()
      ->getResult();
  } else {
    $trades = $query->select('*')
      ->from('profiles')
      ->join('jobcategories', 'id')
      ->where('name', 'ilike.' . '%' . $keywords . '%')
      ->where('role_id', 'eq.5')
      ->order('name.' . $f)
      ->execute()
      ->getResult();
  }
}
?>


<?php include('includes/header.php'); ?>
<?php include('includes/_nav.php'); ?>

<!-- <section class="section is-small has-background-gray add-pt-tablet">
  <div class="container">
    <form action="jobs/search" method="GET">
      <div class="columns is-multiline is-align-items-flex-end">
        <div class="column is-full-mobile is-10-tablet is-relative ">
          <div class="columns is-multiline is-mobile is-align-items-flex-end">
            <div class="column is-full-mobile is-full-tablet is-relative ">
              <h2 class="subtitle  has-text-blue">
                SEARCH
                <?= $_SESSION['roles'] == 'tradesperson' ? 'JOBS' : 'TRADEPERSONS' ?>
              </h2>
            </div>
            <?php if ($_SESSION['roles'] == 'tradesperson') { ?>
              <div class="column is-full-mobile is-3-tablet">
                <label class="label m-0 pl-0">
                  Select Jobs
                </label>
                <div class="">
                  <select class="select2 selectSearch" name="j" required>
                    <option disabled>Select Jobs</option>
                    <?php foreach ($jobs2 as $job) { ?>
                      <option value="<?= $job->id ?>" <?= $j == $job->id ? 'selected' : '' ?>><?= $job->name ?></option>
                    <?php } ?>

                  </select>
                </div>
              </div>
              <div class="column is-full-mobile is-3-tablet" style="display: none;">
                <label class="label m-0 pl-0">
                  Select Type
                </label>
                <div class="">
                  <select class="select2 selectSearch" name="t" required>
                    <option disabled>Select Type</option>
                    <?php foreach ($jobtypes as $type) { ?>
                      <option value="<?= $type->id ?>" <?= $t == $type->id ? 'selected' : '' ?>>
                        <?= $type->name ?>
                      </option>
                    <?php } ?>

                  </select>
                </div>
              </div>
            <?php } ?>

            <div class="column is-full-mobile is-3-tablet" style="display: none;">
              <label class="label m-0 pl-0">
                Select Category
              </label>
              <div class="">
                <select class="select2 selectSearch" name="c" required>
                  <option disabled>Select Category</option>
                  <?php foreach ($jobcategories as $cat) { ?>
                    <option value="<?= $cat->id ?>" <?= $c == $cat->id ? 'selected' : '' ?>>
                      <?= $cat->name ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="column is-full-mobile is-3-tablet" style="display: none;">
              <button type="submit" class="button btn-blue">Search</button>
            </div>
          </div>
        </div>
      </div>

    </form>
  </div>
</section> -->
<section class="section is-medium pt-5 has-background-light-gray mt-6">
  <div class="container mt-6 pt-6">
    <div class="columns is-multiline is-mobile">
      <div class="column is-full-mobile is-3-tablet">
        <div class="columns is-multiline is-mobile">
          <div class="column is-full-mobile is-12-tablet">
            <div class="card-filter ">
              <div class="header columns is-multiline is-centered is-vcentered is-mobile ">
                <span class="column is-10 text-title2 mt-2">
                  FILTERS
                </span>
                <span class="level-right column is-2 filter mt-4 p-0">
                  <?php include('assets/images/filter.svg') ?>
                </span>
              </div>
              <div class="body px-5 pb-6">

                <?php if ($_SESSION['roles'] == 'tradesperson') { ?>
                  <h2 class="has-text-blue text-title2">Job Types</h2>
                  <?php foreach ($jobtypes as $type) { ?>
                    <label class="checkbox">
                      <input type="checkbox">
                      <?= $type->name ?>
                    </label>
                  <?php } ?>

                  <div class="lines my-4">
                  </div>
                  <h2 class="has-text-blue text-title2">Job Categories</h2>

                  <?php foreach ($jobcategories as $cat) { ?>
                    <label class="checkbox">
                      <input type="checkbox" onchange="this.form.submit()" >
                      
                      <?= $cat->name ?>
                    </label>
                  <?php }  ?>

                  <div class="lines my-4">
                  </div>
                  <h2 class="has-text-blue text-title2">Location</h2>

                  <label class="checkbox">
                    <input type="checkbox">
                    Singapore
                  </label>
                  <label class="checkbox">
                    <input type="checkbox">
                    USA
                  </label>
                  <div class="lines my-4">
                  </div>
                  <h2 class="has-text-blue text-title2">Working Type</h2>

                  <label class="checkbox">
                    <input type="checkbox">
                    Full Time
                  </label>
                  <label class="checkbox">
                    <input type="checkbox">
                    Part Time
                  </label>

                <?php } ?>

                <?php if ($_SESSION['roles'] != 'tradesperson') { ?>
                  <!-- <div class="lines my-4">
                  </div> -->
                  <h2 class="has-text-blue text-title2">Skills</h2>
                  <?php foreach ($skills as $value) { ?>
                    <label class="checkbox">
                      <input type="checkbox" name="t" value="<?= $value->id ?>" onchange="this.form.submit()" >
                      <?= $value->name ?>
                    </label>
                  <?php } ?>

                  <div class="lines my-4">
                  </div>
                  <h2 class="has-text-blue text-title2">Experience</h2>

                  <label class="checkbox">
                    <input type="checkbox">
                    > 10th
                  </label>
                  <label class="checkbox">
                    <input type="checkbox">
                    5 - 10th
                  </label>
                  <label class="checkbox">
                    <input type="checkbox">
                    3 - 5th
                  </label>
                  <label class="checkbox">
                    <input type="checkbox">
                    1 - 3th
                  </label>
                  <div class="lines my-4">
                  </div>
                  <h2 class="has-text-blue text-title2">Stars</h2>

                  <label class="checkbox">
                    <input type="checkbox">
                    5
                  </label>
                  <label class="checkbox">
                    <input type="checkbox">
                    4
                  </label>
                  <label class="checkbox">
                    <input type="checkbox">
                    3
                  </label>
                  <label class="checkbox">
                    <input type="checkbox">
                    2
                  </label>
                  <label class="checkbox">
                    <input type="checkbox">
                    1
                  </label>
                <?php } ?>
              </div>
            </div>
          </div>

        </div>
      </div>
      <div class="column is-full-mobile is-9-tablet">
        <div class="columns is-multiline is-mobile">
          <div class="column is-full-mobile is-8-tablet  is-relative">
            <h2 class="subtitle mt-2 has-text-blue">
              <?= $_SESSION['roles'] == 'tradesperson' ? 'Projects' : 'TRADEPERSONS' ?>
            </h2>
          </div>
          <div class="column is-full-mobile is-4-tablet  is-relative ">
            <div class="columns is-multiline">
              <div class="column is-3">
                <label class="label m-2 pl-0">
                  Sort By
                </label>
              </div>
              <div class="column is-9">
                <form action="jobs/search" method="GET">
                  <?php if ($t && $c) { ?>
                    <input type="hidden" name="t" value="<?= $t ?>" />
                    <input type="hidden" name="c" value="<?= $c ?>" />
                  <?php } else if ($c) { ?>
                    <input type="hidden" name="c" value="<?= $c ?>" />
                  <?php } else if ($j) { ?>
                    <input type="hidden" name="j" value="<?= $j ?>" />
                  <?php } ?>
                  <select class="select2 selectSearch1" name="f" onchange="this.form.submit()">
                    <option disabled>Sort By</option>
                    <option value="asc" <?= $f == 'asc' ? 'selected' : '' ?>>A - Z</option>
                    <option value="desc" <?= $f == 'desc' ? 'selected' : '' ?>>Z - A</option>
                  </select>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="column is-full-mobile is-12-tablet">

          <div class="columns is-multiline is-mobile">
            <?php if ($c) { ?>
              <div class="column is-full-mobile is-12-tablet">
                <p>Results for
                  <?php if ($t && $c) { ?>
                    <?= count($jobs) ?>
                    <?= count($jobs) <= 1 ? 'item' : 'items' ?>
                  <?php } else { ?>
                    <?= count($trades) ?>
                    <?= count($trades) <= 1 ? 'item' : 'items' ?>
                  <?php } ?>
                </p>
              </div>
            <?php } ?>


            <div class="column is-full-mobile is-12-tablet p-0">
              <?php
              function paginateArray($items, $page, $itemsPerPage)
              {
                $totalItems = count($items);
                $totalPages = ceil($totalItems / $itemsPerPage);

                if ($page < 1) $page = 1;
                if ($page > $totalPages) $page = $totalPages;

                $offset = ($page - 1) * $itemsPerPage;

                return array_slice($items, $offset, $itemsPerPage);
              }
              $itemsPerPage = 6;
              $page = isset($_GET['page']) ? intval($_GET['page']) : 1;

              if ($_SESSION['roles'] == 'tradesperson') {
                $paginatedJobs = paginateArray($jobs, $page, $itemsPerPage);
                card_list_project_grid_medium($paginatedJobs, $rec, $apply);
              } else {
                $paginatedTrades = paginateArray($trades, $page, $itemsPerPage);
                card_list_talent_grid_medium($paginatedTrades);
              }
              ?>
            </div>

            <div class="pagination">
              <?php
              if ($_SESSION['roles'] == 'tradesperson') {
                $totalItems = count($jobs);
              } else if ($_SESSION['roles'] == 'contractor') {
                $totalItems = count($trades);
              }

              $totalPages = ceil($totalItems / $itemsPerPage);

              // if ($totalPages > 1) {
              //   echo "<span>Page $page of $totalPages</span>";

              if ($page > 1) {
                echo "<a class='page-next' href='jobs/search?page=" . ($page - 1) . "'> <p> < </p> </a>";
              }
              if ($page < $totalPages) {
                echo "<a class='page-next' href='jobs/search?page=" . ($page + 1) . "'> <p> > </p> </a>";
              }
              // }
              ?>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include('includes/footer-init.php'); ?>
<?= component_js('<script type="text/javascript" src="assets/js/wishlist.js"></script> <script type="text/javascript" src="assets/js/apply.js"></script>'); ?>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->