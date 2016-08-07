<?php

if (empty($_POST)) {
	header('Location: ' . SITE_URL);
}

$errors = array();

$data = array_map('strip_tags', $_POST);
$dvd = (int) $URL[0];
$videoAlreadySuggested = false;

if (youtube_id_from_url($data['url'])) {
	$dbh = new Database();
	$sth = $dbh->prepare("SELECT * FROM " . DB_PREFIX . "videos WHERE url = ? AND dvd = ?");
	$sth->execute(array(youtube_id_from_url($data['url']), $dvd));
	$result = $sth->fetchObject();

	if (! empty($result)) {
		$videoAlreadySuggested = true;
	}
}

if ($videoAlreadySuggested) {
	$errors[] = 'Videoa on jo ehdotettu DVD:lle.';
}

if (strlen($data['suggestedBy']) < 3 || strlen($data['suggestedBy']) > 20) {
	$errors[] = 'Ehdottajan nimen tulee olla 3-20 merkkiä pitkä.';
}
if (strlen($data['title']) < 3 || strlen($data['title']) > 20) {
	$errors[] = 'Videon nimen tulee olla 3-20 merkkiä pitkä.';
}
if (empty($data['url']) || ! youtube_id_from_url($data['url'])) {
	$errors[] = 'Videon URL on pakollinen ja videon tulee olla YouTubesta';
}

if (! empty($errors)) {
	include('../controllers/showDVD.php');
} else {
	$video = new Video;
	$video->suggestedBy = htmlspecialchars($data['suggestedBy']);
	$video->title = htmlspecialchars($data['title']);
	$video->url = youtube_id_from_url($data['url']);
	$video->dvd = $dvd;
	
	$video->create();
	
	header('Location: ' . SITE_URL . '/' . $dvd . '/' . urlencode($URL[1]));
}

/**
 * Get youtube video ID from URL
 *
 * @param string $url
 * @return mixed Youtube video id or false if none found. 
 */
function youtube_id_from_url($url) {
	$pattern = '%^# Match any youtube URL
		(?:https?://)?  # Optional scheme. Either http or https
		(?:www\.)?      # Optional www subdomain
		(?:             # Group host alternatives
		  youtu\.be/    # Either youtu.be,
		| youtube\.com  # or youtube.com
		  (?:           # Group path alternatives
			/embed/     # Either /embed/
		  | /v/         # or /v/
		  | /watch\?v=  # or /watch\?v=
		  )             # End path alternatives.
		)               # End host alternatives.
		([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
		$%x';
	
	$matches = array();
	$result = preg_match($pattern, $url, $matches);
	
	if (! empty($matches) && false !== $result) {
		return $matches[1];
	}

	return false;
}
