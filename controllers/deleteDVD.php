<?php

$dvd = (int) $URL[0];
$url = urlencode($URL[1]);
$adminHash = $URL[2];

$dbh = new Database();
$sth = $dbh->prepare("SELECT id FROM " . DB_PREFIX . "dvds WHERE id = ? AND admin_hash = ?");
$sth->execute(array($dvd, $adminHash));

$result = $sth->fetchColumn();

if (empty($result)) {
	header('Location: ' . SITE_URL);
}

$adminUrl = SITE_URL . '/' . $dvd . '/' . $url . '/' . $adminHash;

$sth = $dbh->prepare("DELETE FROM " . DB_PREFIX . "dvds WHERE id = ?");
$sth->execute(array($dvd));

header('Location: ' . SITE_URL);