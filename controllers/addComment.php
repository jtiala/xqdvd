<?php

$commentErrors = array();

$data = array_map('strip_tags', $_POST);
$dvd = (int) $URL[0];

if (empty($_POST)) {
	header('Location: ' . SITE_URL);
}

if (strlen($data['name']) < 3 || strlen($data['name']) > 20) {
	$commentErrors[] = 'Kommentoijan nimen tulee olla 3-20 merkkiä pitkä.';
}
if (strlen($data['comment']) < 3 || strlen($data['comment']) > 256) {
	$commentErrors[] = 'Kommentin tulee olla 3-256 merkkiä pitkä.';
}

if (! empty($commentErrors)) {
	include('../controllers/showDVD.php');
} else {
	$comment = new Comment;
	$comment->name = htmlspecialchars($data['name']);
	$comment->comment = htmlspecialchars($data['comment']);
	$comment->dvd = $dvd;
	
	$comment->create();
	
	header('Location: ' . SITE_URL . '/' . $dvd . '/' . urlencode($URL[1]));
}
