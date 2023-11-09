<?php
$params = $match['params'];
$slug = $params['slug'];
$section = 'applicant';
$query1 = $service->initializeQueryBuilder();
$query2 = $service->initializeQueryBuilder();
$query3 = $service->initializeQueryBuilder();
$query4 = $service->initializeQueryBuilder();
$query5 = $service->initializeQueryBuilder();

$trades = $query2->select('*')
    ->from('tradesskills')
    ->execute()
    ->getResult();

$jobs = $query3->select('*')
    ->from('jobs')
    ->join('jobcategories', 'id')
    ->join('jobtypes', 'id')
    ->where('contractor_id', 'eq.' . $_SESSION['id'])
    ->where('deleted', 'eq.false')
    ->execute()
    ->getResult();
$rec = $jobs[0]->recommended;

$talent = $query4->select('*')
    ->from('jobapplications')
    ->join('jobs', 'id')
    ->join('profiles', 'id')
    ->where('job_id', 'eq.' . $slug)
    ->execute()
    ->getResult();
$applicants = $talent[0]->jobs->contractor_id;

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


$data_talents = [
    [
        "image" => "//images.ctfassets.net/tr0mn1h6jqs3/3eLFgN5r1DZOm6MvNlashK/fc562307be14067fa78c141963fe3264/Rectangle_149.png",
        "name" => "Talent Name",
        "type" => "Architecture",
        "star" => 5
    ],
    [
        "image" => "//images.ctfassets.net/tr0mn1h6jqs3/3eLFgN5r1DZOm6MvNlashK/fc562307be14067fa78c141963fe3264/Rectangle_149.png",
        "name" => "Talent Name 2",
        "type" => "Architecture",
        "star" => 4
    ],
    [
        "image" => "//images.ctfassets.net/tr0mn1h6jqs3/3eLFgN5r1DZOm6MvNlashK/fc562307be14067fa78c141963fe3264/Rectangle_149.png",
        "name" => "Talent Name 3",
        "type" => "Architecture",
        "star" => 4.4
    ]
];

?>
<?php include('includes/header.php'); ?>
<?php include('includes/_nav.php'); ?>

<section class="section is-medium has-background-light-gray">
    <div class="container">
        <div class="columns is-multiline is-mobile">
            <div class="column is-full-mobile is-full-tablet">
                <?php if (count($talent) > 0) { ?>
                    <?= card_list_applicant_grid($talent, $trades) ?>
                <?php } else { ?>
                    - This Project Have no Applications -
                <?php } ?>
            </div>
        </div>
    </div>
    </div>
    </div>
</section>

<?php include('includes/footer-init.php'); ?>
<?= component_js(); ?>