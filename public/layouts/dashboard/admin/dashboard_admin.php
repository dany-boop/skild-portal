<?php include('includes/header.php') ?>
<?php include('includes/_nav.php') ?>
<?php
try {
    $query = $service->initializeQueryBuilder();
    $profile = $query->select('*')
        ->from('profiles')
        ->join('roles', 'id')
        ->where('id', 'eq.' . $_SESSION['id'])
        ->execute()
        ->getResult();
    $id = $profile[0]->id;
    $name = $profile[0]->name;
    $role = $profile[0]->roles->name;
    // $desc = null;
    $email = $profile[0]->email;
    $phone = $profile[0]->phone;
    $desc = $profile[0]->description;
    $address = $profile[0]->address;
    $avatar = $profile[0]->avatar_url;
    $roleId = $profile[0]->roles->id;
} catch (Exception $e) {
    echo "Error fetching profile data: " . $e->getMessage();
}

$query = $service->initializeQueryBuilder();
$trades = $query->select('*')
    ->from('profiles')
    ->join('roles', 'id')
    ->join('jobcategories', 'id')
    ->where('role_id', 'eq.5')
    ->execute()
    ->getResult();


$query2 = $service->initializeQueryBuilder();
$jobs = $query2->select('*')
    ->from('jobs')
    ->join('jobcategories', 'id')
    ->join('jobtypes', 'id')
    ->where('deleted', 'eq.false')
    ->execute()
    ->getResult();

?>


<section class="section is-medium has-background-light-gray">
    <div class="container">
        <div class="columns is-multiline is-mobile">
            <div class="column is-full-mobile is-3-tablet is-relative ">
                <?= card_profile($role, $name, $desc, $id, $email, $address, $phone, $roleId) ?>
            </div>
            <div class="column is-full-mobile pl-5-tablet">
                <div class="columns is-multiline is-mobile is-vcentered is-centered mb-5">
                    <div class="column is-full-mobile is-full-tablet is-relative">
                        <h2 class="title  has-text-blue">
                            JOBS LIST
                        </h2>
                    </div>
                    <div class="column is-full-mobile is-full-tablet">
                        <?php if (count($jobs) > 0) { ?>
                            <?= card_list_project_grid($jobs, $roleId, $rec) ?>
                        <?php } else { ?>
                            - No Data -
                        <?php } ?>
                    </div>
                </div>
                <div class="columns is-multiline is-mobile is-vcentered is-centered ">
                    <div class="column is-full-mobile is-full-tablet is-relative">
                        <h2 class="title  has-text-blue">
                            WORKERS LIST
                        </h2>
                    </div>
                    <div class="column is-full-mobile is-full-tablet">
                        <?= card_list_talent_grid($trades) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('includes/footer-init.php'); ?>
<?= component_js(); ?>