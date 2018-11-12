<?php
namespace src\Model;
/**
 * 
 */
class Project
{
	private $name;
	private $directory;
	private $author;
	private $date;

	public function __construct($date, $author, $dir)
	{
		$this->directory = $dir;
		$this->author = $author;
		$this->date = $date;
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
}