<?php
namespace src\Interfaces;

interface LogInterface
{
	public function getResults();
	public function getRawLogs();
	public function getLogs(array $rawLogs);
	/*
	 * @param Log[] $logs
	*/
	public function groupLogs(array $logs);
}