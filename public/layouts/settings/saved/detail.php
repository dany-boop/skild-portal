<?php
$params = $match['params'];
$slug = $params['slug'];
$section = 'worker';

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

$profiles = $query->select('*')
    ->from('profiles')
    ->join('jobcategories', 'id')
    ->where('role_id', 'eq.5')
    ->where('id', 'eq.' . $slug)
    ->execute()
    ->getResult();
$name = $profiles[0]->name;
$email = $profiles[0]->email;
$phone = $profiles[0]->phone;
$address = $profiles[0]->address;

$skillWorkers = $query2->select('*')
    ->from('tradesskills')
    ->join('skills', 'id')
    ->where('tradesperson_id', 'eq.' . $slug)
    ->execute()
    ->getResult();

$jobs = $query3->select('*')
    ->from('jobs')
    ->where('contractor_id', 'eq.' . $_SESSION['id'])
    ->execute()
    ->getResult();


$exp = $query4->select('*')
    ->from('experiences')
    ->where('tradesperson_id', 'eq.' . $slug)
    ->where('deleted', 'eq.false')
    ->execute()
    ->getResult();

// print_r($jobs);
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
            <div class="column is-full-mobile pl-5-tablet is-8-tablet ">
                <div class="card-content has-background-white">
                    <div class="profile">
                        <img src="//images.ctfassets.net/tr0mn1h6jqs3/3eLFgN5r1DZOm6MvNlashK/fc562307be14067fa78c141963fe3264/Rectangle_149.png?w=720&fm=webp">
                        <div class=" is-md">
                            <div class="columns is-multiline is-mobile">
                                <div class="column is-5-tablet is-12-mobile text-job">
                                    <h2 class="title-large has-text-blue mb-1 ">
                                        <?= $profiles[0]->name ?>
                                    </h2>
                                    <h3 class="ml-2">
                                        <?= $profiles[0]->jobcategories ? $profiles[0]->jobcategories->name : '-' ?>
                                    </h3>
                                    <h3 class="ml-2">
                                        <?= $profiles[0]->address ? $profiles[0]->address : ' Address Not Available ' ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="column is-7-tablet is-full-mobile content">
                            Summary
                            <?= $parser->parse($profiles[0]->description ? $profiles[0]->description : '-- No Description --'); ?>
                        </div>

                        <div class="container">
                            <div class="columns is-multiline is-mobile  is-centered">
                                <div class="column is-5-tablet is-12-mobile mb-6">
                                    <h3 class=" has-text-blue">Skills</h3>
                                    <?php if (count($skillWorkers) > 0) { ?>
                                        <ul class="svg-wtext2 mt-2">
                                            <?php foreach ($skillWorkers as $skill) { ?>
                                                <li>
                                                    <?php include 'assets/images/skill.svg'; ?>
                                                    <?= $skill->skills->name ?>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    <?php } ?>
                                </div>
                                <div class="column is-7-tablet is-full-mobile">
                                    <h3 class="has-text-blue">EXPERIENCES</h3>

                                    <?php if (count($exp) > 0) { ?>
                                        <ul class="svg-wtext2 item-start mt-2">
                                            <?php foreach ($exp as $items) {
                                            ?>
                                                <li>
                                                    <?= $items->name ?>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    <?php } else { ?>
                                        <li>No Experience</li>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="columns is-multiline is-mobile">

                                <div class="column is-9-tablet is-full-mobile">
                                    <h3 class="has-text-blue">CONTACT</h3>
                                    <ul class="svg-wtext2 item-start mt-2">
                                        <li>
                                            Email:
                                            <?= $profiles[0]->email ?>
                                        </li>
                                        <li>
                                            Phone:
                                            <?= $profiles[0]->phone ?>
                                        </li>
                                    </ul>
                                </div>
                                <div class="column is-3-tablet is-full-mobile mt-6">
                                    <button class="button1 is-apply" onclick="openForm()">
                                        <span class="icon">
                                            <?php include 'assets/images/apply.svg'; ?>
                                        </span>
                                        <span class="text">
                                            Hire
                                        </span>
                                    </button>
                                </div>
                            </div>

                            <div class="form-popup" id="myForm">
                                <form form action="process/application.php" method="post" id="form-submit" name="form-submit" class="form-container">
                                    <input type="hidden" name="process" value="add">
                                    <input type="hidden" name="tradesperson_id" value=<?= $slug ?>>
                                    <input type="hidden" name="applied" value='0'>

                                    <div class="columns is-multiline is-mobile">
                                        <h1 class="text-job mt-2 ml-2"> Invite The Talent </h1>
                                        <button type="button" class="btn-cancel mt-2" onclick="closeForm()">
                                            <?php include 'assets/images/close.svg' ?>
                                        </button>
                                    </div>

                                    <div class="columns is-multiline is-mobile">
                                        <div class="column is-full-mobile is-6-tablet is-relative " disabled>
                                            <?= input("Name", "nameasd", "Please fill this field", $name) ?>
                                        </div>
                                        <div class="column is-full-mobile is-6-tablet is-relative " disabled>
                                            <?= input("Email", "email", "Please fill this field", $email) ?>
                                        </div>
                                        <div class="column is-full-mobile is-6-tablet is-relative " disabled>
                                            <?= input("Phone", "phone", "Please fill this field", $phone) ?>
                                        </div>
                                        <div class="column is-full-mobile is-6-tablet is-relative ">
                                            <?= input("Job Name", "name", "Please fill this field", null) ?>
                                        </div>


                                        <div class="column is-full-mobile is-6-tablet is-relative ">
                                            <label class="label m-0 pl-0">Select Job</label>
                                            <div class="select mt-2">
                                                <select name="job_id">
                                                    <option>Select Job</option>
                                                    <?php foreach ($jobs as $value) { ?>
                                                        <?php $selected = ($value->name) ? 'selected' : ''; ?>
                                                        <option value="<?= $value->id ?>" <?= $selected ?>>
                                                        <option value="<?= $value->id ?>">
                                                            <?= $value->name ?>
                                                        </option>
                                                    <?php }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="column is-full-mobile is-6-tablet is-relative ">
                                            <?= input("Roles", "roles", "Please fill this field", null) ?>
                                        </div>
                                        <div class="column is-full-mobile is-12-tablet is-relative ">
                                            <?= textarea("Description", "description", "Please fill this field", null) ?>
                                        </div>


                                        <button type="submit" id="btn-submit" class="btn">Invite</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('includes/footer-init.php'); ?>
<?= component_js('<script type="text/javascript" src="assets/js/invite.js"></script><script type="text/javascript" src="assets/js/redirect-form.js"></script>'); ?>