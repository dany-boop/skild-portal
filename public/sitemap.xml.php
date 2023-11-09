<?php header('Content-type: application/xml; charset="ISO-8859-1"',true); ?>
<?php require_once 'vendor/autoload.php'; ?>
<?php require_once 'includes/appstart.php'; ?>
<?php require_once 'includes/router.php'; ?>
<?php require_once 'includes/clientstart.php'; ?>
<?php	$skip = array( 'home' ); ?>
<?php $actual_link = "https://$_SERVER[HTTP_HOST]"; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<url>
		<loc><?= $actual_link.$router->generate('home'); ?></loc>
		<priority>1.0</priority>
	</url>
</urlset>