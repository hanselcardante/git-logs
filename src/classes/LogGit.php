<?php
namespace src\Classes;

use \src\Classes\Helpers;
use \src\Interfaces\LogInterface;
use \src\Interfaces\DependencyInjectionInterface;
use \src\Model\Log;
use \src\Model\Commit;
use \src\Model\Project;
use \src\Services\DataTransformer;

/**
 * 
 */
class LogGit implements LogInterface, DependencyInjectionInterface
{
	private $project;
	private $dataTransformer;

	function __construct(Project $project)
	{
		$this->project = $project;
	}

	public function setDataTransformer(DataTransformer $dataTransformer)
	{
		$this->dataTransformer = $dataTransformer;
	}

	public function getResults()
	{
		$rawLogs = $this->getRawLogs();
		$logs = $this->getLogs($rawLogs);
		$groupedLogs = $this->groupLogs($logs);
		//TODO: Refactor to a more readable codes
		$percent = Helpers::percentegatorize($groupedLogs);

		if(!count($groupedLogs)) {
			return [];
		}

	    foreach ($groupedLogs as $commit) {
	    	//Commit $commit 
	        if(isset($percent[$commit->getTicketNumber()]))
	            $commit->setPercentage($percent[$commit->getTicketNumber()]);
	    };

	   	return array_map(function($each) {
	   		return $each->getDataAsArray(); 
	   	}, $groupedLogs);
	}

	public function getRawLogs()
	{
		$output = [];		
        chdir($this->project->getDirectory());
        exec("git log --no-merges --stat --after=\"{$this->project->getDate()} 00:00\" --before=\"{$this->project->getDate()} 23:59\" --author={$this->project->getAuthor()}", $output);
        
        return $output;
	}

	public function getLogs(array $rawLogs)
	{
		$this->dataTransformer->setData($rawLogs);
		$this->dataTransformer->transform();
		return $this->dataTransformer->getResult();
	}

	public function groupLogs(array $logs)
	{
		if(!count($logs)) {
			return [];
		}

		$commits = [];
		$commit = new Commit;
		foreach ($logs as $log) {
			// Log $log
			$msg = explode(' ', trim($log->getMessage()));
			$ticketCommit = str_replace(':', '', strtolower(array_shift($msg)));

			if(Helpers::isTicketCommit($ticketCommit)) {		
				$commit->setTicketNumber($ticketCommit);
			} else {
				$commit->setTicketNumber('others');
			}
					
			if(empty($commits[$commit->getTicketNumber()])) {
                $commit->setMaxHours(LOG_MAX_HOURS);
				$commit->setAuthor($log->getAuthor());
				$commit->setDate($log->getDate());					
				$commit->setHash($log->getHash());
                $commit->setCommitMessages(implode(' ', $msg));
				$commit->setInsertions($log->getInsertions());
				$commit->setDeletions($log->getDeletions());	
				$commit->setChanges($log->getChanges());	
                $commits[$commit->getTicketNumber()] = $commit;
                $commit = new Commit;
            } else {            	
            	// here we just add some of the duplicate data for the same ticket commit
            	$obj = $commits[$commit->getTicketNumber()];
            	$obj->setCommitMessages(implode(' ', $msg));
            	$obj->setInsertions(bcadd($obj->getInsertions(), $log->getInsertions()));
				$obj->setDeletions(bcadd($obj->getDeletions(), $log->getDeletions()));
				$obj->setChanges(bcadd($obj->getChanges(), $log->getChanges()));
            }
		}

		return $commits;
	}	
}