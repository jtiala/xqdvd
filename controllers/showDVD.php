<?php

function viewVideoList($dvd = 0) {
	$dbh = new Database();
	$sth = $dbh->prepare("SELECT id FROM " . DB_PREFIX . "videos WHERE dvd = ? ORDER BY id DESC");
	$sth->execute(array($dvd));

	$videoCount = 0;
	
	while ($id = $sth->fetchColumn()) {
		$videoCount++;
		
		$video = new Video();
		$video->load($id);
		
		include('../views/showDVD/singleVideo.php');
	}
	
	if ($videoCount == 0) {
		include('../views/showDVD/noVideos.php');
	}
}

function viewComments($dvd = 0) {
	$dbh = new Database();
	$sth = $dbh->prepare("SELECT id FROM " . DB_PREFIX . "comments WHERE dvd = ? ORDER BY id DESC");
	$sth->execute(array($dvd));

	$commentCount = 0;
	
	while ($id = $sth->fetchColumn()) {
		$commentCount++;
		
		$comment = new Comment();
		$comment->load($id);
		
		include('../views/showDVD/singleComment.php');
	}
}

$dvd = (int) $URL[0];
$currentDVD = new DVD();
$currentDVD->load($dvd);

include('../views/header.php');
include('../views/showDVD/header.php');

viewVideoList($dvd);

include('../views/showDVD/suggestVideo.php');
include('../views/showDVD/addComment.php');

viewComments($dvd);

include('../views/showDVD/footer.php');
include('../views/footer.php');
