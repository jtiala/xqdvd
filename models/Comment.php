<?php

class Comment {
	public $id;
	public $name;
	public $comment;
	public $date;
	public $dvd;
	
	/**
	 * Loads comments's details from the database
	 * 
	 * @param int $id	Comment's id
	 * @return boolean	True if loaded successfully, false otherwise
	 */
	public function load($id) {
		$id = (int) $id;
		
		if ($id > 0) {
			$dbh = new Database();
			$sth = $dbh->prepare("SELECT * FROM " . DB_PREFIX . "comments WHERE id = ?");
			$sth->execute(array($id));
			$result = $sth->fetchObject();

			if (! empty($result)) {
				$this->id = $result->id;
				$this->name = $result->name;
				$this->comment = $result->comment;
				$this->date = $result->date;
				$this->dvd = $result->dvd;
				
				return true;
			}
		}
		
		return false;
	}
	
	/**
	 * Create a new comment to the database
	 * 
	 * @return mixed	False if failed, admin url otherwise
	 */
	public function create() {		
		$dbh = new Database();
		$sth = $dbh->prepare("INSERT INTO " . DB_PREFIX . "comments (name, comment, date, dvd) VALUES (?, ?, ?, ?)");
		if (! $sth->execute(array($this->name, $this->comment, $this->date, $this->dvd))) {
			return false;
		}
		
		return true;
	}
	
	/**
	 * Deletes the comment from database
	 * 
	 * @return boolean
	 */
	public function delete() {
		$dbh = new Database();
		$sth = $dbh->prepare("DELETE FROM " . DB_PREFIX . "comments WHERE id = ?");
		
		if ($sth->execute(array($this->id))) {
			return true;
		}
		
		return false;
	}
}
