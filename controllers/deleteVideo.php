<?php

$dvd = (int) $URL[0];
$url = urlencode($URL[1]);
$adminHash = $URL[2];
$adminUrl = SITE_URL . '/' . $dvd . '/' . $url . '/' . $adminHash;
$video = $_GET['id'];

$dbh = new Database();
$sth = $dbh->prepare("SELECT id FROM " . DB_PREFIX . "dvds WHERE id = ? AND admin_hash = ?");
$sth->execute(array($dvd, $adminHash));

$result = $sth->fetchColumn();

if (empty($result) || empty($video)) {
	header('Location: ' . SITE_URL);
}

$sth = $dbh->prepare("DELETE FROM " . DB_PREFIX . "videos WHERE id = ? AND dvd = ?");
$sth->execute(array($video, $dvd));

header('Location: ' . $adminUrl);