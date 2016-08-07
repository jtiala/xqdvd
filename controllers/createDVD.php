<?php

if (empty($_POST)) {
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
	include('../controllers/viewFrontpage.php');
} else {
	$dvd = new DVD;
	
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
	
	$adminUrl = $dvd->create();
	
	if (empty($adminUrl)) {
		die('Virhe luodessa DVD:tä.');
	}
	
	// Send the admin link via email
	$link = SITE_URL . '/' . $dvd->id . '/' . $dvd->publicUrl . '/' . $dvd->adminHash;
	$to = $dvd->email;
	$subject = 'xqDVD:si ylläpitolinkki';
	$message = '
<html> 
<head> 
<title>xqDVD:si ylläpitolinkki</title> 
</head> 
<body> 
xqDVD:si ylläpitolinkki on <a href="' . $link . '">' . $link . '</a> 
</body> 
</html>
';
	$headers = 'From: ' . SITE_EMAIL . "\r\n";
	$headers .= 'Reply-To: ' . SITE_EMAIL . "\r\n";
	$headers .= 'X-Mailer: PHP/' . phpversion();
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

	mail($to, $subject, $message, $headers);
	
	header("Location: $adminUrl");
}
