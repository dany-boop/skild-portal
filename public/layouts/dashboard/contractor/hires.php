<?php
$slug = "projects";
$section = $slug;

$query1 = $service->initializeQueryBuilder();
$query2 = $service->initializeQueryBuilder();
$query3 = $service->initializeQueryBuilder();
$query4 = $service->initializeQueryBuilder();


$query = $service->initializeQueryBuilder();
$profile = $query1->select('*')
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

$trades = $query2->select('*')
    ->from('profiles')
    ->join('roles', 'id')
    ->join('jobcategories', 'id')
    ->where('role_id', 'eq.5')
    ->execute()
    ->getResult();

$talent = $query4->select('*')
    ->from('jobapplications')
    ->join('jobs', 'id')
    ->join('profiles', 'id')
    ->execute()
    ->getResult();

$applicants = $talent[0]->jobs->contractor_id;

// echo json_encode($talent);
// die;

$jobs = $query3->select('*')
    ->from('jobs')
    ->join('jobcategories', 'id')
    ->join('jobtypes', 'id')
    ->where('contractor_id', 'eq.' . $_SESSION['id'])
    ->where('deleted', 'eq.false')
    ->execute()
    ->getResult();
$rec = $jobs[0]->recommended;
?>

<?php include('includes/header.php'); ?>
<?php include('includes/_nav.php'); ?>

<section class="section is-medium has-background-light-gray">
    <div class="container">
        <div class="columns is-multiline is-mobile">
            <div class="column is-full-mobile is-3-tablet is-relative ">
                <?= card_profile($role, $name, $desc, $id, $email, $address, $phone, $roleId) ?>
            </div>
            <div class="column is-full-mobile pl-5-tablet">
                <!-- <div class="columns is-multiline is-mobile is-vcentered is-centered ">
                    <div class="column is-full-mobile is-full-tablet is-relative">
                        <h2 class="title  has-text-blue">
                            Applicants
                        </h2>
                    </div>
                    <div class="column is-full-mobile is-full-tablet">
                        <?= card_list_applicant_grid($talent) ?>
                    </div>
                </div> -->
                <div class="columns is-multiline is-mobile is-vcentered is-centered ">
                    <div class="column is-full-mobile is-full-tablet is-relative">
                        <h2 class="title  has-text-blue">
                            My Hires
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