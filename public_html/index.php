<?php

// Get URL components (check .htaccess)
if (! empty($_GET['url'])) {
	$URL = explode("/", $_GET['url']);
} else {
	$URL = array();
}

// Load resources
$resources = array(
	'../config.php',
	'../models/Database.php',
	'../models/DVD.php', 
	'../models/Video.php',
	'../models/Comment.php',
	'../models/Vote.php'
);

foreach ($resources as $resource) {
	require($resource);
}

// Include the right controller
if (! empty($URL) && $URL[0] == 'create') {
	include('../controllers/createDVD.php');
} elseif (! empty($URL) && $URL[0] == 'vote') {
	include('../controllers/vote.php');
} elseif (! empty($URL) && (int) $URL[0] > 0 && ! empty($URL[1]) && empty($URL[2])) {
	include('../controllers/showDVD.php');
} elseif (! empty($URL) && (int) $URL[0] > 0 && ! empty($URL[1]) && $URL[2] == 'suggest') {
	include('../controllers/suggestVideo.php');
} elseif (! empty($URL) && (int) $URL[0] > 0 && ! empty($URL[1]) && $URL[2] == 'comment') {
	include('../controllers/addComment.php');
} elseif (! empty($URL) && (int) $URL[0] > 0 && ! empty($URL[1]) && ! empty($URL[2]) && empty($URL[3])) {
	include('../controllers/admin.php');
} elseif (! empty($URL) && (int) $URL[0] > 0 && ! empty($URL[1]) && ! empty($URL[2]) && $URL[3] == 'settings') {
	include('../controllers/saveSettings.php');
} elseif (! empty($URL) && (int) $URL[0] > 0 && ! empty($URL[1]) && ! empty($URL[2]) && $URL[3] == 'deleteVideo') {
	include('../controllers/deleteVideo.php');
} elseif (! empty($URL) && (int) $URL[0] > 0 && ! empty($URL[1]) && ! empty($URL[2]) && $URL[3] == 'deleteDVD') {
	include('../controllers/deleteDVD.php');
} else {
	include('../controllers/viewFrontpage.php');
}
