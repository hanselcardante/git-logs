<?php
namespace src\Model;

/**
 * 
 */
class Log
{
	private $commit;
	private $author;
	private $date;
	private $message;

	public __construct($log)
	{
		if(!is_array($log)) {
			throw exception('Invalid data type. Log data must be an array!');
		}

		foreach ($log as $key => $value) {
			$this->{$key} = $value;
		}	
	}

	public function setCommit($commit)
	{
		$this->commit = $commit;
	}

	public function getCommit()
	{
		return $this->commit;
	}

	public function setAuthor($author)
	{
		$this->author = $author;
	}

	public function getAuthor()
	{
		return $this->author;
	}

	public function setDate($date)
	{
		$this->date = $date;
	}

	public function getDate()
	{
		return $this->date;
	}

	public function setMessage($message)
	{
		$this->message = $message;
	}

	public function getMessage()
	{
		return $this->message;
	}
}