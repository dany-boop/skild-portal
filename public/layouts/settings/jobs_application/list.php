<?php
$slug = "jobs-application";
$section = $slug;

$entry_title = 'Skild';
$metaTitle = $entry_title;
$type = isset($_GET['type']);

$query1 = $service->initializeQueryBuilder();
$query2 = $service->initializeQueryBuilder();
$query3 = $service->initializeQueryBuilder();



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
    $desc = $profile[0]->description;
    $avatar = $profile[0]->avatar_url;
    $roleId = $profile[0]->roles->id;

    // echo json_encode($profile);
    // die;
} catch (Exception $e) {
    echo "Error fetching profile data: " . $e->getMessage();
}

// $applications = $query1->select('*')
//     ->from('jobs')
//     ->where('contractor_id', 'eq.' . $_SESSION['id'])
//     ->where('deleted', 'eq.false')
//     ->execute()
//     ->getResult();
$applications = $query1->select('*')
    ->from('jobapplications')
    ->join('jobs', 'id')
    ->where('tradesperson_id', 'eq.' . $_SESSION['id'])
    ->where('deleted', 'eq.false')
    ->execute()
    ->getResult();
$applicant = $query2->select('*')
    ->from('jobapplications')
    ->join('jobs', 'id')
    ->join('profiles', 'id')
    ->where('applied', 'eq.true')
    ->where('deleted', 'eq.false')
    ->execute()
    ->getResult();


// $trades_id = $applications[0]->trades_id;
$trades = get_contractor_id();
// echo $trades;
// die;

?>

<?php include('includes/header.php'); ?>
<?php include('includes/_nav.php'); ?>

<section class="section is-medium has-background-light-gray add-pt-mobile">
    <div class="container">
        <div class="columns is-multiline is-mobile">
            <div class="column is-full-mobile is-4-tablet is-relative ">
                <?= card_profile_menu($id, "https://images.ctfassets.net/tr0mn1h6jqs3/4HUBAkA54aN53rF7o7SkYE/40c0b697cae40f78b1ccf303e78944ab/Rectangle_153.png", "https://images.ctfassets.net/tr0mn1h6jqs3/vbPnTteww08CHEIzDnmX6/ce7c73aa245e0c1ba0a6b783fd929844/Rectangle_150.png", $name, $role, $roleId, $section) ?>
            </div>
            <div class="column is-full-mobile pl-5-tablet is-8-tablet">
                <div class="card card-payment">
                    <div class="card-content">
                        <div class="columns is-multiline is-mobile add-border-bottom is-vcentered">
                            <div class="column is-full-mobile is-6-tablet is-relative ">
                                <p>
                                    Projects List
                                </p>
                            </div>
                        </div>
                        <div class="columns is-multiline is-mobile mt-2">
                            <div class="column is-full-mobile is-12-tablet is-relative ">
                                <table id="myTable" class="display table table-small">
                                    <thead>
                                        <tr>
                                            <th width="50">#</th>
                                            <th class="has-text-centered">Project Name</th>
                                            <?php if ($_SESSION['roles'] == 'tradesperson') { ?>
                                                <th class="has-text-centered">Contractor Name</th>
                                            <?php } else if ($_SESSION['roles'] == 'contractor') { ?>
                                                <th class="has-text-centered">Talents Name</th>

                                            <?php } ?>
                                            <th class="has-text-centered">Roles</th>
                                            <th class="has-text-centered">Status</th>
                                            <th class="has-text-centered"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $x = 1;
                                        if ($_SESSION['roles'] == 'tradesperson') {
                                            foreach ($applications as $value) {
                                                $profiles = json_decode(json_encode(get_profile($value->jobs->contractor_id)), true);
                                        ?>
                                                <tr>
                                                    <td class="has-text-centered">
                                                        <?= $x ?>
                                                    </td>

                                                    <td class="has-text-centered">
                                                        <?= $value->jobs->name ?>
                                                    </td>

                                                    <td class="has-text-centered">
                                                        <?= $profiles['data'][0]['name'] ? $profiles['data'][0]['name'] : 'Data not Available' ?>
                                                    </td>
                                                    <td class="has-text-centered">
                                                        <?= $value->roles ? $value->roles : 'Not Available' ?>
                                                    </td>
                                                    <?php if ($value->applied == true) { ?>
                                                        <td class="has-text-centered ">
                                                            <span class="apply"">
                                                            Apply
                                                        </span>
                                                    </td>
                                                <?php } elseif ($value->applied == false) { ?>
                                                    <td class=" has-text-centered ">
                                                        <span class=" hire"">
                                                                Hire
                                                            </span>
                                                        </td>
                                                    <?php } ?>
                                                    <td class=" has-text-centered">
                                                        <?= icon_action("application/detail/jobs/" . $value->job_id, $value->job_id, false, true, true, "process/projects.php") ?>
                                                    </td>
                                                </tr>
                                            <?php $x++;
                                                // }
                                            } ?>
                                            <?php } else if ($_SESSION['roles'] == 'contractor') {
                                            // foreach ($applicant as $items) {
                                            $contractorIds = get_contractor_id();

                                            foreach ($applicant as $items) {
                                                if (in_array($items->job_id, $contractorIds)) {
                                                    $profiles = json_decode(json_encode(get_profile($items->tradesperson_id)), true);
                                                    // print_r($profiles);
                                                    // die;
                                            ?>
                                                    <tr>
                                                        <td class="has-text-centered">
                                                            <?= $x ?>
                                                        </td>

                                                        <td class="has-text-centered">
                                                            <?= $items->jobs->name ?>
                                                        </td>

                                                        <td class="has-text-centered">
                                                            <?= $profiles['data'][0]['name'] ? $profiles['data'][0]['name'] : 'Data not Available' ?>
                                                        </td>
                                                        <td class="has-text-centered">
                                                            <?= $items->roles ? $items->roles : 'Not Available' ?>
                                                        </td>
                                                        <?php if ($items->applied == true) { ?>
                                                            <td class="has-text-centered ">
                                                                <span class="apply"">
                                                            Apply
                                                        </span>
                                                    </td>
                                                <?php } elseif ($items->applied == false) { ?>
                                                    <td class=" has-text-centered ">
                                                        <span class=" hire"">
                                                                    Hire
                                                                </span>
                                                            </td>
                                                        <?php } ?>
                                                        <td class=" has-text-centered">
                                                            <?= icon_action("application/detail/trades/" . $items->id, $items->id, false, true, true, "process/projects.php") ?>
                                                        </td>
                                                    </tr>
                                        <?php }
                                                $x++;
                                            }
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
    </div>
</section>

<?php include('includes/footer-init.php'); ?>
<?= component_js() ?>