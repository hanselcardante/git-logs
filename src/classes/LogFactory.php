<?php
namespace src\Classes;

use \src\Interfaces\VersionControl;
use \src\Model\Project;
use \src\Classes\LogGit;
use \src\Classes\LogSvn;
use \src\Services\DataTransformer;
/**
 * 
 */
class LogFactory
{
	private $versionControl = VersionControl::GIT; //default version control	

	public function build(Project $project)
	{	
		switch($this->versionControl) {
			case VersionControl::GIT:
				$log = new LogGit($project);
				$log->setDataTransformer(new DataTransformer);
				break;
			case VersionControl::SVN:
				$log = new LogSvn($project);
				break;
			case VersionControl::OTHER:
				echo 'hehe nothing';
				break;
		}

		return $log->getResults();
	}

	public function setVersionControl($versionControl)
	{
		$this->versionControl = $versionControl;
	}
}