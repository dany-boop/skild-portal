<?php
$params = $match['params'];
$slug = $params['slug'];
$section = 'jobs-detail';

$query1 = $service->initializeQueryBuilder();
$query2 = $service->initializeQueryBuilder();
$query3 = $service->initializeQueryBuilder();
$query4 = $service->initializeQueryBuilder();

try {
    $query5 = $service->initializeQueryBuilder();
    $profile = $query5->select('*')
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

$apply = $query1->select('*')
    ->from('jobapplications')
    ->where('deleted', 'eq.' . 'false')
    ->where('tradesperson_id', 'eq.' . $_SESSION['id'])
    ->execute()
    ->getResult();

// echo json_encode($apply);
// die;

$jobs = $query3->select('*')
    ->from('jobs')
    ->join('jobcategories', 'id')
    ->join('jobtypes', 'id')
    ->where('id', 'eq.' . $slug)
    ->execute()
    ->getResult();

$joblogs = $query2->select('*')
    ->from('jobslogs')
    // ->join('jobcategories', 'id')
    // ->join('jobtypes', 'id')
    ->where('job_id', 'eq.' . $slug)
    ->execute()
    ->getResult();

$contractor = $query4->select('*')
    ->from('profiles')
    ->where('id', 'eq.' . $jobs[0]->contractor_id)
    ->execute()
    ->getResult();

// echo  json_encode($apply[0]->job_id);
// echo json_encode($jobs[0]->id);
// die;

?>
<?php include('includes/header.php'); ?>
<?php include('includes/_nav.php'); ?>

<section class="section  is-relative mt-6 has-background-light-gray">
    <div class="column is-10-tablet is-vcentered container">
        <div class="columns  is-multiline ">
            <div class="column is-5-tablet is-12-mobile text-job">
                <h2 class="title-large has-text-blue mb-1 ">
                    <?= $jobs[0]->name ?>
                </h2>

                <h1 class="mb-2">
                    By <?= $contractor[0]->name ?>
                </h1>
            </div>
            <div class=" column is-7-tablet content mt-6">
                <?php
                if ($_SESSION['roles'] == 'tradesperson') {
                ?>
                    <div class="level-right ">
                        <?php if ($_SESSION['roles'] == 'tradesperson') { ?>
                            <?php
                            $applied = false;
                            foreach ($apply as $item) {
                                if ($item->job_id == $jobs[0]->id) {
                                    $applied = true;
                                    break;
                                }
                            }
                            ?>
                            <button <?php if ($applied) {
                                        echo 'disabled';
                                    } ?> class="button<?= $applied ? '0' : '1' ?> 
                            <?php if (!$applied) {
                                echo 'is-apply';
                            } ?>" <?php if (!$applied) { ?> data-jobid="<?= $jobs[0]->id ?>" data-tradesId="<?= $_SESSION['id'] ?>" data-name="<?= $jobs[0]->name ?>" data-description="<?= $jobs[0]->description ?>" <?php } ?>>
                                <span class="icon">
                                    <?php include 'assets/images/apply.svg'; ?>
                                </span>
                                <span class="text">
                                    <?= $applied ? 'Applied' : 'Apply' ?>
                                </span>
                            </button>
                        <?php } ?>
                    </div>
                <?php
                } ?>
            </div>
        </div>
        <div class="banner-jobs2" style="background:url('https://plus.unsplash.com/premium_photo-1684311194674-21112e547fe4?auto=format&fit=crop&q=80&w=1930&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
            <img scr="https://plus.unsplash.com/premium_photo-1684311194674-21112e547fe4?auto=format&fit=crop&q=80&w=1930&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
        </div>
    </div>
</section>

<!-- <section class="section is-medium has-background-light-gray">
    <div class="container">
        <div class="columns is-multiline is-mobile  is-centered">



        </div>
    </div>
</section> -->
<section class="section has-background-light-gray ">
    <div class="container column is-10-tablet is-vcentered">
        <div class=" columns is-multiline">
            <div class="column is-9-tablet is-full-mobile  ">
                <h3 class="text-title has-text-blue">
                    About The Project
                </h3>
                <span class="text-job">
                    <?= $parser->parse($jobs[0]->description ? $jobs[0]->description : '-- No Description --'); ?>
                </span>

            </div>
            <div class="column is-3-tablet is-12-mobile ">
                <h3 class="has-text-grey ">
                    Job Types </h3>
                <span class="text-job mt-5">
                    <?= $parser->parse($jobs[0]->jobtypes->name) ?>
                </span>

                <h2 class="has-text-grey">Categories</h2>
                <span class="text-job mt-5">
                    <?= $parser->parse($jobs[0]->jobcategories ? $jobs[0]->jobcategories->name : '-') ?>
                </span>

                <h3 class="has-text-grey ">Address</h3>
                <span class="text-job mt-5"> <?= $jobs[0]->address ? $jobs[0]->address : ' Address Not Available ' ?>,<?= $jobs[0]->district ? $jobs[0]->district : 'Uknown' ?></span>
            </div>
        </div>
    </div>
</section>

<?php include('includes/footer-init.php'); ?>
<?= component_js('<script type="text/javascript" src="assets/js/apply.js"></script>'); ?>