<?php
global $setting, $service;
$websiteId = '3gbbi6y2CVHJaE3g5hDsH3';

$query = new \Contentful\Delivery\Query;
$query->setContentType('settings');
// ->where('sys.id', $websiteId);
$entries = $client->getEntries($query);

if ($entries->getTotal() > 0) {
    $setting = $entries[0];
} else {
    _404();
}


$service = new PHPSupabase\Service
(
    "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InprcXhuY3pvdWp3cGJ6bWJiaGhsIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODg1MzIxNDYsImV4cCI6MjAwNDEwODE0Nn0.-on7BPN5u1hfMU2VT5NEUdMxgXtpC5QBEeARQt2LpVw",
    "https://zkqxnczoujwpbzmbbhhl.supabase.co/rest/v1"
);



$parser = new \cebe\markdown\Markdown();