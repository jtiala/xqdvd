<?php

class DVD {
	public $id;
	public $title;
	public $author;
	public $email;
	public $publishDate;
	public $deadlineDate;
	public $status;
	public $showFrontpage;
	public $description;
	public $publicUrl;
	public $adminHash;
	
	/**
	 * Loads DVD's details from the database
	 * 
	 * @param int $id	DVD's id
	 * @return boolean	True if loaded successfully, false otherwise
	 */
	public function load($id) {
		$id = (int) $id;
		
		if ($id > 0) {
			$dbh = new Database();
			$sth = $dbh->prepare("SELECT * FROM " . DB_PREFIX . "dvds WHERE id = ?");
			$sth->execute(array($id));
			$result = $sth->fetchObject();

			if (! empty($result)) {
				$this->id = $result->id;
				$this->title = $result->title;
				$this->author = $result->author;
				$this->email = $result->email;
				$this->publishDate = $result->publish_date;
				$this->deadlineDate = $result->deadline_date;
				$this->status = $result->status;
				$this->showFrontpage = $result->show_frontpage;
				$this->description = $result->description;
				$this->publicUrl = $result->public_url;
				$this->adminHash = $result->admin_hash;
				
				return true;
			}
		}
		
		return false;
	}
	
	/**
	 * Create a new DVD to the database
	 * 
	 * @return mixed	False if failed, admin url otherwise
	 */
	public function create() {
		$this->publicUrl = strtolower(urlencode($this->title));
		$this->adminHash = substr(md5($this->title . time() . rand()), 0, 8);
		
		$dbh = new Database();
		$sth = $dbh->prepare("INSERT INTO " . DB_PREFIX . "dvds (title, author, email, publish_date, deadline_date, status, show_frontpage, description, public_url, admin_hash) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		if (! $sth->execute(array($this->title, $this->author, $this->email, $this->publishDate, $this->deadlineDate, $this->status, $this->showFrontpage, $this->description, $this->publicUrl, $this->adminHash))) {
			return false;
		}
		
		$this->id = (int) $dbh->lastInsertId();
		$adminUrl = SITE_URL . '/' . $this->id . '/' . $this->publicUrl . '/' . $this->adminHash;

		return $adminUrl;
	}
	
	/**
	 * Updates DVD's data to the database
	 * 
	 * @return boolean	False if failed, true otherwise
	 */
	public function save() {
		$dbh = new Database();
		$sth = $dbh->prepare("UPDATE " . DB_PREFIX . "dvds SET title = ?, author = ?, email = ?, publish_date = ?, deadline_date = ?, status = ?, show_frontpage = ?, description = ? WHERE id = ?");
		if (! $sth->execute(array($this->title, $this->author, $this->email, $this->publishDate, $this->deadlineDate, $this->status, $this->showFrontpage, $this->description, $this->id))) {
			return false;
		}

		return true;
	}
	
	/**
	 * Deletes the DVD from database
	 * 
	 * @return boolean
	 */
	public function delete() {
		$dbh = new Database();
		$sth = $dbh->prepare("DELETE FROM " . DB_PREFIX . "dvds WHERE id = ?");
		
		if ($sth->execute(array($this->id))) {
			return true;
		}
		
		return false;
	}
	
	/**
	 * Get number of videos on the DVD
	 * 
	 * @return mixed	Null if none found, count otherwise
	 */
	public function getNumVideos() {
		if ($this->id > 0) {
			$dbh = new Database();
			$sth = $dbh->prepare("SELECT COUNT(id) FROM " . DB_PREFIX . "videos WHERE dvd = ?");
			$sth->execute(array($this->id));
			$result = $sth->fetchColumn();
			
			return (int) $result;
		} else {
			return null;
		}
	}
}
