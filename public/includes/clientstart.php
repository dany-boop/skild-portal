<?php
/* Contentful API LANDING */
$liveKey = '9nf1frS6RVRtndzaoc3M_9R4lfVD2SoZFHiA9PLE_AE';
$previewKey = '9XH7j9imP0jyG-rTM7TJAWnhF5sP7jBRhOYMzb-YbJA';
$spaceID = 'tr0mn1h6jqs3';

/* Calling the api */
$client = new \Contentful\Delivery\Client($liveKey, $spaceID, 'master'); 

define('POSTS_TYPE', 'post');
define('PAGES_TYPE', 'page');
