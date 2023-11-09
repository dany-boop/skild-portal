<?php
$slug = "skills";
$section = $slug;

$entry_title = 'Skild';
$metaTitle = $entry_title;

$query1 = $service->initializeQueryBuilder();
$query2 = $service->initializeQueryBuilder();
$query3 = $service->initializeQueryBuilder();
$query4 = $service->initializeQueryBuilder();

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

$wishlisted = $query2->select('*')
    ->from('wishlist')
    ->where('trades_id', 'eq.' . $_SESSION['id'])
    ->execute()
    ->getResult();

// echo $wishlisted;
// echo json_encode($wishlisted);
// die;
$jobs = $query3->select('*')
    ->from('jobs')
    ->join('jobcategories', 'id')
    ->join('jobtypes', 'id')
    ->execute()
    ->getResult();
// $rec = $jobs->recommended;

$apply = $query4->select('*')
    ->from('jobapplications')
    ->execute()
    ->getResult();

$job_id = $apply[0]->job_id;
$tradesperson_id = $apply[0]->tradesperson_id;



$data_project = [
    [
        "image" => "https://images.ctfassets.net/tr0mn1h6jqs3/4HUBAkA54aN53rF7o7SkYE/40c0b697cae40f78b1ccf303e78944ab/Rectangle_153.png",
        "type" => "Project Architecture",
        "description" => "A minimalist-style hotel offers a serene and relaxed accommodation experience in a simple and organized setting."
    ],
    [
        "image" => "https://images.ctfassets.net/tr0mn1h6jqs3/4HUBAkA54aN53rF7o7SkYE/40c0b697cae40f78b1ccf303e78944ab/Rectangle_153.png",
        "type" => "Project Architecture 2",
        "description" => "A minimalist-style hotel offers a serene and relaxed accommodation experience in a simple and organized setting."
    ],
    [
        "image" => "https://images.ctfassets.net/tr0mn1h6jqs3/4HUBAkA54aN53rF7o7SkYE/40c0b697cae40f78b1ccf303e78944ab/Rectangle_153.png",
        "type" => "Project Architecture 3",
        "description" => "A minimalist-style hotel offers a serene and relaxed accommodation experience in a simple and organized setting."
    ]
];

?>

<?php include('includes/header.php'); ?>
<?php include('includes/_nav.php'); ?>

<section class="section is-medium has-background-light-gray">
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
                                Projects List
                            </div>
                        </div>
                        <div class="columns is-multiline is-mobile mt-2">
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
                                                    <?= icon_action("saved/detail/" . $value->trades_id, $value->trades_id, false, false, true, "process/projects.php") ?>
                                                </td>
                                            </tr>
                                        <?php $x++;
                                            // }
                                        } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</section>
<?php include('includes/footer-init.php'); ?>
<?= component_js(); ?>