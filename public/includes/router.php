<?php
$router = new AltoRouter();
$router->setBasePath(BASE_PATH);
// $router->setBasePath('skild-portal/public');

$router->map('GET', '/404', '404.php', 'imlost');
$router->map('GET', '/sitemap.xml', 'sitemap.xml.php', 'sitemap');

// $router->map('GET', '/skilled-workers', 'layouts/skilled-workers.php', 'skilled-workers');
// $router->map('GET', '/find-jobs', 'layouts/jobs.php', 'find-jobs');
$router->map('GET', '/job/[:slug]', 'layouts/jobs-detail-v2.php', 'freelance-detail');
$router->map('GET', '/worker/[:slug]', 'layouts/workers/detail.php', 'skilled-worker-detail');
$router->map('GET', '/applicant/[:slug]', 'layouts/dashboard/contractor/applicant.php', 'skilled-worker-application');
$router->map('GET', '/signin', 'layouts/signin.php', 'signin');
$router->map('GET', '/signup', 'layouts/signup.php', 'signup');
$router->map('GET', '/signup/[:slug]', 'layouts/signup-detail.php', 'signup-detail');
// $router->map( 'GET', '/[:slug]', 'layouts/init-page.php', 'single-page'); 
$router->map('GET', '/profile', 'layouts/settings/profile-detail.php', 'profile-detail');
$router->map('GET', '/experience/list', 'layouts/settings/experiences/list.php', 'experiences-list');
$router->map('GET', '/experience/add', 'layouts/settings/experiences/add.php', 'experiences-add');
$router->map('GET', '/experience/edit/[:slug]', 'layouts/settings/experiences/edit.php', 'experiences-edit');

$router->map('GET', '/payment/list', 'layouts/settings/payments/list.php', 'payment-list');
$router->map('GET', '/payment/add', 'layouts/settings/payments/add.php', 'payment-add');
$router->map('GET', '/payment/edit/[:slug]', 'layouts/settings/payments/edit.php', 'payment-edit');

$router->map('GET', '/skill/list', 'layouts/settings/skills/list.php', 'skill-list');
$router->map('GET', '/skill/add', 'layouts/settings/skills/add.php', 'skill-add');
$router->map('GET', '/skill/edit/[:slug]', 'layouts/settings/skills/edit.php', 'skill-edit');

$router->map('GET', '/project/list', 'layouts/settings/projects/list.php', 'project-list');
$router->map('GET', '/project/add', 'layouts/settings/projects/add.php', 'project-add');
$router->map('GET', '/project/edit/[:slug]', 'layouts/settings/projects/edit.php', 'project-edit');

$router->map('GET', '/saved/list', 'layouts/settings/saved/list.php', 'saved-list');
$router->map('GET', '/saved/detail/trades/[:slug]', 'layouts/settings/saved/detail.php', 'saved-detail-trades');
$router->map('GET', '/saved/detail/jobs/[:slug]', 'layouts/settings/saved/detail_jobs.php', 'saved-detail-jobs');

$router->map('GET', '/application/list', 'layouts/settings/jobs_application/list.php', 'application-list');
$router->map('GET', '/application/detail/jobs/[:slug]', 'layouts/settings/jobs_application/detail_jobs.php', 'application-jobs-detail');
$router->map('GET', '/application/detail/trades/[:slug]', 'layouts/settings/jobs_application/detail_trades.php', 'application-talent-detail');


$router->map('GET', '/jobs/detail/[:slug]', 'layouts/jobs/detail.php', 'job-detail');
$router->map('GET', '/jobs/search', 'layouts/jobs/search.php', 'job-search');
$router->map('GET', '/job/add', 'layouts/jobs/add.php', 'job-add');

$router->map('GET', '/category/list', 'layouts/master/categories/list.php', 'category-list');
$router->map('GET', '/category/add', 'layouts/master/categories/add.php', 'category-add');
$router->map('GET', '/category/edit/[:slug]', 'layouts/master/categories/edit.php', 'category-edit');

$router->map('GET', '/dashboard/skills', 'layouts/dashboard/worker/skills.php', 'my-skills');
$router->map('GET', '/dashboard/experiences', 'layouts/dashboard/worker/exp.php', 'my-experince');
$router->map('GET', '/dashboard/find-jobs', 'layouts/jobs/search.php', 'find-jobs');
$router->map('GET', '/dashboard/saved-jobs', 'layouts/dashboard/worker/saved.php', 'saved-jobs');

$router->map('GET', '/dashboard/project', 'layouts/dashboard/contractor/project.php', 'my-projects');
$router->map('GET', '/dashboard/hires', 'layouts/dashboard/contractor/hires.php', 'my-hires');


$router->map('GET', '/settings/update-password', 'layouts/settings/update-password.php', 'update-password');

$router->map('GET', '/home', 'layouts/dashboard/dashboard.php', 'home-1'); //map home
$home = $router->map('GET', '/', 'layouts/dashboard/dashboard.php', 'home'); //map home

$match = $router->match();
