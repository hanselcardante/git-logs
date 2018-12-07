<?php
namespace src\Model;
/**
 * 
 */
class Project
{
	private $name;
	private $directory;
	private $maxHours;
	private $author;
	private $date;

	public function __construct($date, $author, $dir, $maxHours)
	{
		$this->directory = $dir;
		$this->author = $author;
		$this->date = $date;
		$this->maxHours = $maxHours;
	}

	public function getDirectory()
	{
		return $this->directory;
	}

	public function getDate()
	{
		return $this->date;
	}

	public function getAuthor()
	{
		return $this->author;
	}

	public function getMaxHours()
	{
		return $this->maxHours;
	}
}