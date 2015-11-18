<?php

$dvdID = (int) $URL[0];
$url = urlencode($URL[1]);
$adminHash = $URL[2];

$dbh = new Database();
$sth = $dbh->prepare("SELECT id FROM " . DB_PREFIX . "dvds WHERE id = ? AND admin_hash = ?");
$sth->execute(array($dvdID, $adminHash));

$result = $sth->fetchColumn();

if (empty($result) || empty($_POST)) {
	header('Location: ' . SITE_URL);
}

$errors = array();

$data = array_map('strip_tags', $_POST);

if (strlen($data['title']) < 3 || strlen($data['title']) > 40) {
	$errors[] = 'DVD:n nimen tulee olla 3-40 merkkiä pitkä.';
}
if (empty($data['author'])) {
	$errors[] = 'DVD:n tekijä on pakollinen.';
}
if (! filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
	$errors[] = 'Email on virheellinen.';
}
if (! empty($data['publishDate']) && ! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $data['publishDate'])) {
	$errors[] = 'Julkaisupäivämäärän muoto tulee olla YYYY-MM-DD';
}
if (! empty($data['deadlineDate']) && ! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $data['deadlineDate'])) {
	$errors[] = 'Ehdotusten deadlinen muoto tulee olla YYYY-MM-DD';
}

if (! empty($errors)) {
	include('controllers/admin.php');
} else {
	$dvd = new DVD;
	$dvd->load($dvdID);
	
	$dvd->title = htmlspecialchars($data['title']);
	$dvd->author = htmlspecialchars($data['author']);
	$dvd->email = htmlspecialchars($data['email']);
	$dvd->publishDate = empty($data['publishDate']) ? null : $data['publishDate'];
	$dvd->deadlineDate = empty($data['deadlineDate']) ? null : $data['deadlineDate'];
	$dvd->description = empty($data['description']) ? null : htmlspecialchars($data['description']);
	
	if (! empty($data['status']) && $data['status'] == 'active') {
		$dvd->status = 1;
	} else {
		$dvd->status = 0;
	}
	
	if (! empty($data['showFrontpage']) && $data['showFrontpage'] == 'show') {
		$dvd->showFrontpage = 1;
	} else {
		$dvd->showFrontpage = 0;
	}
	
	$dvd->save();
	
	header('Location: ' . SITE_URL . '/' . $dvdID . '/' . $url . '/' . $adminHash);
}