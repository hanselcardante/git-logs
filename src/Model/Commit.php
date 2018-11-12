<?php
namespace src\Model;

use \src\Model\Log;
use \src\Classes\Helpers;

class Commit extends Log
{
    private $ticketNumber;
    private $commitMessages = [];
    private $percentage;
    private $maxHours;
    private $hoursWorked;

    //This property consists of the insertions, deletions and changes stats in total
    private $totalRevisions;

    public function setTicketNumber($ticketNumber)
    {
        $this->ticketNumber = $ticketNumber;
    }

    public function setCommitMessages($commitMessages)
    {
        $this->commitMessages[] = $commitMessages;
    }

    public function setPercentage($percentage)
    {
        $this->percentage = $percentage;
    }

    public function setMaxHours($maxHours)
    {
        $this->maxHours = $maxHours;
    }

    public function getTicketNumber()
    {
        return $this->ticketNumber;
    }

    public function getCommitMessages()
    {
        return $this->commitMessages;
    }

    public function getPercentage()
    {
        return $this->percentage;
    }

    public function getTotalRevisions()
    {
        return Helpers::bcsum([
            $this->deletions,
            $this->insertions,
            $this->changes
        ]);
    }

    public function getDataAsArray() {
        return [
            "ticketNumber" => $this->ticketNumber,
            "commitMessages" => $this->commitMessages,
            "author" => $this->author,
            "hoursWorked" => $this->getHours(),
        ];
    }

    public function getHours() {
        return Helpers::convertPercentToTime($this->percentage, $this->maxHours);
    }
}