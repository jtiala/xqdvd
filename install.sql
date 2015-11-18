-- if you want to use different prefixes,
-- please replace 'exqdvd_' in this file
-- and config.php also!

-- drop old tables

DROP TABLE `exqdvd_comments`;
DROP TABLE `exqdvd_votes`;
DROP TABLE `exqdvd_videos`;
DROP TABLE `exqdvd_dvds`;

-- create tables

CREATE TABLE exqdvd_dvds (
	id INTEGER NOT NULL AUTO_INCREMENT,
	title VARCHAR(128) NOT NULL,
	author VARCHAR(128) NOT NULL,
	email VARCHAR(255) NOT NULL,
	publish_date TIMESTAMP NULL DEFAULT NULL,
	deadline_date TIMESTAMP NULL DEFAULT NULL,
	status INTEGER NOT NULL DEFAULT 0, -- 0 inactive, 1 active, 2 published
	show_frontpage BOOLEAN NOT NULL DEFAULT false,
	description TEXT,
	public_url VARCHAR(255) NOT NULL,
	admin_hash VARCHAR(8) NOT NULL,
	PRIMARY KEY (id),
	UNIQUE KEY admin_hash (admin_hash)
);

CREATE TABLE exqdvd_videos (
	id INTEGER NOT NULL AUTO_INCREMENT,
	dvd INTEGER NOT NULL,
	title VARCHAR(128),
	url VARCHAR(155),
	suggested_by VARCHAR(128),
	date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id),
	FOREIGN KEY (dvd) REFERENCES exqdvd_dvds(id) ON UPDATE CASCADE ON DELETE CASCADE,
	UNIQUE KEY unique_url_dvd (url, dvd)
);

CREATE TABLE exqdvd_votes (
	ip VARCHAR(64) NOT NULL,
	vote INTEGER NOT NULL,
	video INTEGER NOT NULL,
	PRIMARY KEY (ip, video),
	FOREIGN KEY (video) REFERENCES exqdvd_videos(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE exqdvd_comments (
	id INTEGER NOT NULL AUTO_INCREMENT,
	name VARCHAR(128),
	comment TEXT NOT NULL,
	date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	dvd INTEGER NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (dvd) REFERENCES exqdvd_dvds(id) ON UPDATE CASCADE ON DELETE CASCADE
);

-- example data

INSERT INTO exqdvd_dvds (id, title, author, email, publish_date, deadline_date, status, show_frontpage, description, public_url, admin_hash) VALUES (1, 'Syysexcu 2014 - Markos Redemption', 'Marko Tsaari', 'marko.tsaari@example.com', '2015-01-01 00:00:00', '2014-12-10 00:00:00', 2, true, 'Markon eeppinen dvd', 'syysexcu+2014+-+markos+redemption', '12345678');

INSERT INTO exqdvd_videos (id, dvd, title, url, suggested_by) VALUES (1, 1, 'Kissavideo 1', '2XID_W4neJo', 'Marko Tsaari');

INSERT INTO exqdvd_videos (id, dvd, title, url, suggested_by) VALUES (2, 1, 'Kissavideo 2', 'K219abPZdug', 'Marko Tsaari');

INSERT INTO exqdvd_votes (ip, vote, video) VALUES ('2001:14b8:201:20:5d64:6a0e:f70c:1f80', 1, 1);

INSERT INTO exqdvd_comments (name, comment, dvd) VALUES ('Andreas Pyykkonen', 'Hieno DVD Marko! :D', 1);
