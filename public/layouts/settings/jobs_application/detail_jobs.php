<?php
$params = $match['params'];
$slug = $params['slug'];
$section = 'applications';

$query = $service->initializeQueryBuilder();
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
$jobs = $query3->select('*')
    ->from('jobs')
    ->join('jobcategories', 'id')
    ->join('jobtypes', 'id')
    ->where('id', 'eq.' . $slug)
    ->execute()
    ->getResult();
$application = $query2->select('*')
    ->from('jobapplications')
    ->where('job_id', 'eq.' . $slug)
    ->execute()
    ->getResult();
$active = $application[0]->active
?>

<?php include('includes/header.php'); ?>
<?php include('includes/_nav.php'); ?>


<section class="section is-medium has-background-light-gray add-pt-mobile">
    <div class="container">
        <div class="columns is-multiline is-mobile">
            <div class="column is-full-mobile is-4-tablet is-relative ">
                <?= card_profile_menu($id, "https://images.ctfassets.net/tr0mn1h6jqs3/4HUBAkA54aN53rF7o7SkYE/40c0b697cae40f78b1ccf303e78944ab/Rectangle_153.png", "https://images.ctfassets.net/tr0mn1h6jqs3/vbPnTteww08CHEIzDnmX6/ce7c73aa245e0c1ba0a6b783fd929844/Rectangle_150.png", $name, $role, $roleId, $section) ?>
            </div>
            <div class="column is-full-mobile pl-5-tablet is-8-tablet ">
                <div class="card-content has-background-white">
                    <div class="profile-jobs">
                        <div class="section banner-jobs is-relative" style="background:url('https://plus.unsplash.com/premium_photo-1684311194674-21112e547fe4?auto=format&fit=crop&q=80&w=1930&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
                        </div>
                        <img src="//images.ctfassets.net/tr0mn1h6jqs3/3eLFgN5r1DZOm6MvNlashK/fc562307be14067fa78c141963fe3264/Rectangle_149.png?w=720&fm=webp">
                        <div class="column  is-mobile">
                            <div class="mt-5">
                                <div class="column is-12-tablet is-12-mobile text-job">
                                    <h2 class="title-large has-text-blue  ">
                                        <?= $jobs[0]->name ?>
                                    </h2>
                                    <h3>
                                        <?= $jobs[0]->address ? $jobs[0]->address : ' Address Not Available ' ?>,<?= $jobs[0]->district ? $jobs[0]->district : 'Uknown' ?>
                                    </h3>
                                </div>
                            </div>
                            <div class="columns is-multiline justify-content-end">
                                <?php if ($active == false) {
                                ?>
                                    <button data-jobid=<?= $jobs[0]->id ?> data-applyid=<?= $application[0]->id ?> data-active='false' data-rejected='true' class="accept-btn pulse accept">
                                        Accept
                                    </button>
                                    <button data-jobid=<?= $application[0]->job_id ?> data-applyid=<?= $application[0]->id ?> data-active='true' data-rejected='false' class="decline-btn accept">Decline</button>
                                <?php } elseif ($active == true) { ?>
                                    <button class="button0 m-4 ">
                                        Accepted
                                    </button>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="column is-7-tablet is-full-mobile content ml-1">
                            <h3 class="has-text-blue">
                                Job Description
                            </h3>
                            <?= $parser->parse($jobs[0]->description ? $jobs[0]->description : '-- No Description --'); ?>
                        </div>

                        <div class="container ml-4">
                            <div class="columns is-multiline is-mobile  is-centered">
                                <div class="column is-5-tablet is-12-mobile mb-6">
                                    <h3 class=" has-text-blue">Job Types</h3>
                                    <span><?= $jobs[0]->jobtypes->name ?></span>
                                </div>
                                <div class="column is-7-tablet is-full-mobile">
                                    <h3 class="has-text-blue">Job Categories</h3>

                                    <span> <?= $jobs[0]->jobcategories ? $jobs[0]->jobcategories->name : '-' ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="container ml-4">
                            <div class="columns is-multiline is-mobile">

                                <div class="column is-9-tablet is-full-mobile">
                                    <h3 class="has-text-blue">Brief</h3>
                                    <span><?= $jobs[0]->brief ? $jobs[0]->brief : 'There`s No brief yet about this jobs'  ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('includes/footer-init.php'); ?>
<?= component_js('<script type="text/javascript" src="assets/js/invitation.js"></script><script type="text/javascript" src="assets/js/invite.js"></script>'); ?>