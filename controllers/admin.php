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

$publicUrl = SITE_URL . '/' . $dvd . '/' . $url;
$adminUrl = SITE_URL . '/' . $dvd . '/' . $url . '/' . $adminHash;

$currentDVD = new DVD();
$currentDVD->load($dvd);

if (empty($_POST)) {
	$data = array(
		'title' => $currentDVD->title,
		'author' => $currentDVD->author,
		'email' => $currentDVD->email,
		'description' => $currentDVD->description
	);
	
	if (! empty($currentDVD->publishDate)) {
		$data['publishDate'] = date("Y-m-d", strtotime($currentDVD->publishDate));
	}
	
	if (! empty($currentDVD->deadlineDate)) {
		$data['deadlineDate'] = date("Y-m-d", strtotime($currentDVD->deadlineDate));
	}
	
	switch ($currentDVD->status) {
		case 1:
			$data['status'] = 'active';
		case 2:
			$data['status'] = 'published';
		default:
			$data['status'] = 'inactive';
	}
	
	if ($currentDVD->showFrontpage == 1) {
		$data['showFrontpage'] = 'show';
	}
}

/**
 * Views list of videos
 * 
 * @param type $url
 * @param type $adminHash
 * @param type $dvd
 */
function viewVideoList($url, $adminHash, $dvd = 0) {
	$dbh = new Database();
	$sth = $dbh->prepare("SELECT id FROM " . DB_PREFIX . "videos WHERE dvd = ? ORDER BY id DESC");
	$sth->execute(array($dvd));

	$videoCount = 0;
	
	while ($id = $sth->fetchColumn()) {
		$videoCount++;
		
		$video = new Video();
		$video->load($id);
		
		include('views/admin/singleVideo.php');
	}
	
	if ($videoCount == 0) {
		include('views/admin/noVideos.php');
	}
}

include('views/header.php');
include('views/admin/header.php');

viewVideoList($url, $adminHash, $dvd);

include('views/admin/links.php');
include('views/admin/settings.php');
include('views/footer.php');