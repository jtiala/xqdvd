<?php

$videoID = (int) $_GET['video'];
$votePoints = (int) $_GET['points'];

if (empty($videoID)) {
	die();
}

if (! empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

$ip = md5($ip);

$dbh = new Database();
$sth = $dbh->prepare("SELECT * FROM " . DB_PREFIX . "votes WHERE video = ? AND ip = ?");
$sth->execute(array($videoID, $ip));

$result = $sth->fetchObject();

$vote = new Vote();
$vote->ip = $ip;
$vote->video = $videoID;
$vote->vote = $votePoints;
	
if (empty($result)) {
	if ($votePoints == 1 || $votePoints == -1) {
		$vote->create();
	}
} else {
	if ($votePoints == 1 || $votePoints == -1) {
		$vote->save();
	} elseif ($votePoints == 0) {
		$vote->delete();
	}
}
