<?php

class Vote {
	public $ip;
	public $vote;
	public $video;
	
	/**
	 * Loads vote's details from the database
	 * 
	 * @param int $id	vote's id
	 * @return boolean	True if loaded successfully, false otherwise
	 */
	public function load($ip, $video) {
		$video = (int) $video;
		
		if ($video > 0) {
			$dbh = new Database();
			$sth = $dbh->prepare("SELECT * FROM " . DB_PREFIX . "votes WHERE ip = ? AND video = ?");
			$sth->execute(array($ip, $video));
			$result = $sth->fetchObject();

			if (! empty($result)) {
				$this->ip = $result->ip;
				$this->video = $result->video;
				$this->vote = $result->vote;
				
				return true;
			}
		}
		
		return false;
	}
	
	/**
	 * Deletes the vote from database
	 * 
	 * @return boolean
	 */
	public function delete() {
		$dbh = new Database();
		$sth = $dbh->prepare("DELETE FROM " . DB_PREFIX . "votes WHERE ip = ? AND video = ?");
		
		if ($sth->execute(array($this->ip, $this->video))) {
			return true;
		}
		
		return false;
	}
	
	/**
	 * Create a new vote to the database
	 * 
	 * @return mixed	False if failed, admin url otherwise
	 */
	public function create() {		
		$dbh = new Database();
		$sth = $dbh->prepare("INSERT INTO " . DB_PREFIX . "votes (ip, video, vote) VALUES (?, ?, ?)");
		if (! $sth->execute(array($this->ip, $this->video, $this->vote))) {
			return false;
		}
		
		return true;
	}

	/**
	 * Updates votes's data to the database
	 * 
	 * @return boolean	False if failed, true otherwise
	 */
	public function save() {
		$dbh = new Database();
		$sth = $dbh->prepare("UPDATE " . DB_PREFIX . "votes SET vote = ? WHERE ip = ? AND video = ?");
		if (! $sth->execute(array($this->vote, $this->ip, $this->video))) {
			return false;
		}

		return true;
	}
}
