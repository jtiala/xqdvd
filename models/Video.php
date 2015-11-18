<?php

class Video {
	public $id;
	public $dvd;
	public $title;
	public $url;
	public $suggestedBy;
	public $date;
	
	/**
	 * Loads video's details from the database
	 * 
	 * @param int $id	Video's id
	 * @return boolean	True if loaded successfully, false otherwise
	 */
	public function load($id) {
		$id = (int) $id;
		
		if ($id > 0) {
			$dbh = new Database();
			$sth = $dbh->prepare("SELECT * FROM " . DB_PREFIX . "videos WHERE id = ?");
			$sth->execute(array($id));
			$result = $sth->fetchObject();

			if (! empty($result)) {
				$this->id = $result->id;
				$this->dvd = $result->dvd;
				$this->title = $result->title;
				$this->url = $result->url;
				$this->suggestedBy = $result->suggested_by;
				$this->date = $result->date;
				
				return true;
			}
		}
		
		return false;
	}
	
	/**
	 * Deletes the video from database
	 * 
	 * @return boolean
	 */
	public function delete() {
		$dbh = new Database();
		$sth = $dbh->prepare("DELETE FROM " . DB_PREFIX . "videos WHERE id = ?");
		
		if ($sth->execute(array($this->id))) {
			return true;
		}
		
		return false;
	}
	
	/**
	 * Create a new video to the database
	 * 
	 * @return mixed	False if failed, admin url otherwise
	 */
	public function create() {		
		$dbh = new Database();
		$sth = $dbh->prepare("INSERT INTO " . DB_PREFIX . "videos (dvd, title, url, suggested_by) VALUES (?, ?, ?, ?)");
		if (! $sth->execute(array($this->dvd, $this->title, $this->url, $this->suggestedBy))) {
			return false;
		}
		
		return true;
	}
	
	/**
	 * Sums up votes the video has
	 * 
	 * @return int Score of the video
	 */
	public function getScore() {
		$dbh = new Database();
		$sth = $dbh->prepare("SELECT SUM(vote) FROM " . DB_PREFIX . "votes WHERE video = ?");
		$sth->execute(array($this->id));
		$result = $sth->fetchColumn();

		if (empty($result)) {
			return 0;
		} else {
			return (int) $result;
		}
	}
}
