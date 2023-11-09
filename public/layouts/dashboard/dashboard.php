<?php
$slug = "home";
$section = $slug;

$entry_title = 'Skild';
$metaTitle = $entry_title;


?>
<?php
if (!isset($_SESSION['id'])) {
    header("location: signin");
}

?>

<?php include('includes/header.php'); ?>
<?php include('includes/_nav.php'); ?>
<?php
if (isset($_SESSION['roles'])) {
    $userRoles = $_SESSION['roles'];
    switch ($userRoles) {
        case 'admin':
            include('admin/dashboard_admin.php');
            break;
        case 'contractor':
            include('contractor/dashboard_contractor.php');
            break;
        case 'tradesperson':
            include('worker/dashboard_worker.php');
            break;
        default:
            var_dump($_SESSION['roles']);
            break;
    }
} else {
    // Handle the case when 'roles' is not set in the session
    // For example, you can redirect the user to a login page or display a message
}
// if($type == 'trades'){
// 	include('dashboard_worker.php'); 
// }else{
// 	include('dashboard_contractor.php'); 
// }

?>