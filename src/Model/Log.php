<?php
namespace src\Model;

/**
 * 
 */
class Log
{
	protected $hash;
	protected $author;
	protected $date;
	protected $message;
	protected $insertions;
    protected $deletions;
    protected $changes;

    // GETTERS

	public function getHash()
	{
		return $this->hash;
	}

	public function getAuthor()
	{
		return $this->author;
	}

	public function getDate()
	{
		return $this->date;
	}

	public function getMessage()
	{
		return $this->message;
	}

	public function getChanges()
	{
		return $this->changes;
	}

	public function getDeletions()
	{
		return $this->deletions;
	}

	public function getInsertions()
	{
		return $this->insertions;
	}

	// SETTERS

	public function setHash($hash)
	{
		$this->hash = $hash;
	}

	public function setAuthor($author)
	{
		$this->author = $author;
	}

	public function setDate($date)
	{
		$this->date = $date;
	}

	public function setMessage($message)
	{
		$this->message = $message;
	}

	public function setChanges($changes)
	{
		$this->changes = $changes;
	}

	public function setDeletions($deletions)
	{
		$this->deletions = $deletions;
	}

	public function setInsertions($insertions)
	{
		$this->insertions = $insertions;
	}
}