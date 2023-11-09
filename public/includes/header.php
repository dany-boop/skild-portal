 <?php
 /* set default meta title and description */
 global $metaTitle, $metaDescription, $metaKeywords, $websiteURL, $websiteName;

// move this to globals to grab from Setting
//  $websiteName = $website->getTitle();
//  $websiteURL = $website->getUrl();

 if ($slug != $section) {
   $websiteURL = $websiteURL . '/' . $section . '/' . $slug;
 } else {
   if ($slug != 'home') {
    $websiteURL = $websiteURL . '/' . $slug;
  } else {
    $websiteURL = $websiteURL . '/';
  }
}

if ($slug == 'journals') {
  $websiteURL = $websiteURL . '?page=' . $page;
}

if (!isset($metaTitle) || is_null($metaTitle)) {
  $metaTitle = $websiteName;
}

if (!isset($metaDescription) || is_null($metaDescription)) {
  $metaDescription = $websiteName;
}

if (!isset($metaKeywords) || is_null($metaKeywords)) {
  $metaKeywords = $websiteName;
}
?>



<!DOCTYPE html>

<html lang="id">

<head>

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-KXF620FW0M"></script>
  
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-KXF620FW0M');
  </script>

  <link rel="alternate" hreflang="x-default" href="<?= $websiteURL; ?>" />
  <base href="<?php echo APP_PATH; ?>" />
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>

  <!-- Canonical -->
  <?php if($slug == '404') { ?>
   <link rel="canonical" href="<?= $websiteURL; ?>" />
   <meta name="robots" content="follow, noindex"/>
 <?php } else { ?>
  <link rel="canonical" href="<?= $websiteURL; ?>" />
<?php } ?>

<!-- Meta -->
<title><?php echo $metaTitle; ?></title>
<meta name="description" content="<?php echo $metaDescription; ?>" />
<meta name="keywords" content="<?php echo $metaKeywords; ?>"/>
<meta name="author" content="https://mydevteam.id" />

<meta property="og:locale" content="en_US" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo $websiteURL; ?>" />
<meta property="og:site_name" content="<?php echo $websiteName; ?>" />
<meta property="og:title" content="<?php echo $metaTitle; ?>" />
<meta property="og:description" content="<?php echo $metaDescription; ?>" />
<meta name="theme-color" content="#000" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="<?php echo $metaTitle; ?>" />
<meta name="twitter:description" content="<?php echo $metaDescription; ?>" />

<?php if($setting->getFavicon()){ ?>
  <link rel="shortcut icon" href="<?= $setting->getFavicon()->getFile()->getUrl();?>" type="image/png" />
<?php } ?> 



<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/fontawesome.min.css"/>
<script src="https://kit.fontawesome.com/15181efa86.js" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://bulmatemplates.github.io/bulma-templates/css/landing.css"/>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.4.3/plyr.css"/> 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.6/dist/css/splide.min.css">
<link
rel="stylesheet"
href="https://unpkg.com/swiper@8/swiper-bundle.min.css"
/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.css" integrity="sha512-Woz+DqWYJ51bpVk5Fv0yES/edIMXjj3Ynda+KWTIkGoynAMHrqTcDUQltbipuiaD5ymEo9520lyoVOo9jCQOCA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-video@0.7.1/dist/css/splide-extension-video.min.css">
<link href="https://vjs.zencdn.net/7.19.2/video-js.css" rel="stylesheet" />
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css"/>

<link rel='stylesheet' href='assets/css/main.css' type='text/css' media='all' />

</head>

<body style="overflow: hidden;" class="<?php if(!isset($_COOKIE['theme'])){ echo '';}else{ if($_COOKIE['theme'] == 'dark'){ echo 'theme-dark';} } ?>">