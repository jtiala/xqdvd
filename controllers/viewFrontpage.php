<?php

function viewDVDList() {
	$dbh = new Database();
	$sth = $dbh->prepare("SELECT id FROM " . DB_PREFIX . "dvds WHERE status = 1 OR status = 2 AND show_frontpage = true ORDER BY id DESC");
	$sth->execute();

	$dvdCount = 0;
	
	while ($id = $sth->fetchColumn()) {
		$dvdCount++;
		
		$dvd = new DVD();
		$dvd->load($id);

		include('../views/frontpage/singleDVD.php');
	}
	
	if ($dvdCount == 0) {
		include('../views/frontpage/noDVDs.php');
	}
}

include('../views/header.php');
include('../views/frontpage/header.php');

viewDVDList();

include('../views/frontpage/createDVD.php');
include('../views/footer.php');
