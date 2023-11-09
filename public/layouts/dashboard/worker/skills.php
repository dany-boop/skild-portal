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

$tradesskills = $query3->select('*')
    ->from('tradesskills')
    ->where('tradesperson_id', 'eq.' . $_SESSION['id'])
    ->execute()
    ->getResult();


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
            <div class="column is-full-mobile is-3-tablet is-relative ">
                <?= card_profile($role, $name, $desc, $id, $email, $address, $phone, $roleId) ?>
            </div>


            <div class="column is-full-mobile pl-5-tablet">
                <div class="columns is-multiline is-mobile is-vcentered is-centered mb-5">
                    <div class="column is-full-mobile is-full-tablet is-relative">
                        <h2 class="title  has-text-blue">
                            MY SKILLS
                        </h2>
                    </div>
                    <div class="column is-full-mobile is-full-tablet">
                        <?php
                        $count = 0;
                        if (empty($tradesskills)) {
                            echo "There's no data";
                        } else {
                        ?>
                            <div class="grid-3">
                                <?php foreach ($tradesskills as $value) {
                                    if ($count >= 9) {
                                        break;
                                    }
                                    $count++;
                                ?>
                                    <div class="card">
                                        <div class="card-content">
                                            <div class="columns ">
                                                <div class="column is-narrow">
                                                    <?php include 'assets/images/skill.svg'; ?>
                                                </div>
                                                <div class="column">
                                                    <p class="subtitle">
                                                        <?= $value->name ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <?= $value->description ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('includes/footer-init.php'); ?>
<?= component_js(); ?>