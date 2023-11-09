<?php
$slug = "home";
$section = $slug;

$entry_title = 'Skild';
$metaTitle = $entry_title ;
$type = isset($_GET['type']);
?>

<?php include('includes/header.php'); ?>
<?php include('includes/_nav.php'); ?>
<?php 
if($type == 'worker'){
	include('dashboard_worker.php'); 
}else{
	include('dashboard_contractor.php'); 
}

?>
<?php include('includes/footer.php'); ?>