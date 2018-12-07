<?php
namespace src\Classes;

use \src\Model\Project;
use \src\Classes\LogFactory;

/**
 * 
 */
class LogManager
{
	private $logFactory;

	function __construct(LogFactory $logFactory)
	{
		$this->logFactory = $logFactory;
	}
		
	public function process(Project $project)
	{
		return $this->logFactory->build($project);
	}
}