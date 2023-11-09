<?php
$slug = "saved-list";
$section = $slug;

$entry_title = 'Skild';
$metaTitle = $entry_title;
$type = isset($_GET['type']);

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
if ($_SESSION['roles'] == 'contractor') {
    $query1 = $service->initializeQueryBuilder();
    $wishlist = $query1->select('*')
        ->from('wishlist')
        ->join('jobs', 'id')
        ->where('contractor_id', 'eq.' . $_SESSION['id'])
        ->where('deleted', 'eq.false')
        ->execute()
        ->getResult();
    $trades_id = $wishlist[0]->trades_id ? $wishlist[0]->trades_id : '-';
}
if ($_SESSION['roles'] == 'tradesperson') {
    $query = $service->initializeQueryBuilder();
    $wishlist2 = $query->select('*')
        ->from('wishlist')
        ->join('jobs', 'id')
        ->where('trades_id', 'eq.' . $_SESSION['id'])
        ->where('mark', 'eq.true')
        ->where('wishlist_types', 'eq.Jobs')
        ->execute()
        ->getResult();
    // $trades_id = $wishlist[0]->trades_id ? $wishlist[0]->trades_id : '-';
}
// echo json_encode($t_id);
// die;

// $query = $service->initializeQueryBuilder();
// $profiles = $query->select('*')
//     ->from('profiles')
//     ->join('jobs', 'id')
//     // ->where('tradesperson_id', 'eq.' . $t_id)
//     ->execute()
//     ->getResult();


// echo json_encode($profiles);
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
                                    Wishlist
                                </p>
                            </div>
                        </div>

                        <div class="columns is-multiline is-mobile mt-2">
                            <?php if ($_SESSION['roles'] == 'contractor') {
                            ?>

                                <div class="column is-full-mobile is-12-tablet is-relative ">
                                    <table id="myTable" class="display table table-small">
                                        <thead>
                                            <tr>
                                                <th width="50">#</th>
                                                <th class="has-text-centered">Talent Name</th>
                                                <th class="has-text-centered">Address</th>
                                                <th class="has-text-centered">Email</th>
                                                <th class="has-text-centered"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $x = 1;
                                            foreach ($wishlist as $value) {

                                                $profiles = json_decode(json_encode(get_profile($value->trades_id)), true);
                                            ?>
                                                <tr>
                                                    <td class="has-text-centered">
                                                        <?= $x ?>
                                                    </td>

                                                    <td class="has-text-centered">
                                                        <?= $profiles['data'][0]['name'] ?>
                                                    </td>

                                                    <td class="has-text-centered">
                                                        <?= $profiles['data'][0]['address'] ? $profiles['data'][0]['address'] : 'Data not Available' ?>
                                                    </td>
                                                    <td class="has-text-centered">
                                                        <?= $profiles['data'][0]['email'] ?>
                                                    </td>
                                                    <td class="has-text-centered">
                                                        <?= icon_action("saved/detail/trades/" . $value->trades_id, $value->trades_id, false, false, true, "process/projects.php") ?>
                                                    </td>
                                                </tr>
                                            <?php $x++;
                                                // }
                                            } ?>

                                        </tbody>
                                    </table>
                                </div>
                            <?php } elseif ($_SESSION['roles'] == 'tradesperson') { ?>
                                <div class="column is-full-mobile is-12-tablet is-relative ">
                                    <table id="myTable" class="display table table-small">
                                        <thead>
                                            <tr>
                                                <th width="50">#</th>
                                                <th class="has-text-centered">Projects Name</th>
                                                <th class="has-text-centered">Descriprtion</th>
                                                <th class="has-text-centered">Budget</th>
                                                <th class="has-text-centered"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $x = 1;
                                            foreach ($wishlist2 as $value) {

                                                // $profiles = json_decode(json_encode(get_profile($value->trades_id)), true);
                                            ?>
                                                <tr>
                                                    <td class="has-text-centered">
                                                        <?= $x ?>
                                                    </td>

                                                    <td class="has-text-centered">
                                                        <?= $value->jobs->name ?>
                                                    </td>

                                                    <td class="has-text-centered">
                                                        <?= $value->jobs->description ? $value->jobs->description : 'Data not Available' ?>
                                                    </td>
                                                    <td class="has-text-centered">
                                                        <?= $value->jobs->estimated_budget ?>
                                                    </td>
                                                    <td class="has-text-centered">
                                                        <?= icon_action("saved/detail/jobs/" . $value->job_id, $value->job_id, false, false, true, "process/projects.php") ?>
                                                    </td>
                                                </tr>
                                            <?php $x++;
                                                // }
                                            } ?>

                                        </tbody>
                                    </table>
                                </div>
                            <?php } ?>
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