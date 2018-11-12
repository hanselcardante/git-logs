<?php


class TicketCommit
{
    private $ticketNum;
    private $commitMgs;
    private $author;
    private $timestamps;
    private $insertions;
    private $deletions;
    private $changes;
    private $percentage;
    private $maxHours;

    function __construct($ticketNum, $commitMgs, $author, $timestamps, $insertions, $deletions, $changes, $maxHours)
    {
        $this->ticketNum = $ticketNum;
        $this->commitMgs = $commitMgs;
        $this->author = $author;
        $this->timestamps = $timestamps;
        $this->insertions = $insertions;
        $this->deletions = $deletions;
        $this->changes = $changes;
        $this->maxHours = $maxHours;
    }

    public function getTicketNum(){
        return $this->ticketNum;
    }

    public function getInsertions(){
        return $this->insertions;
    }

    public function getDeletions(){
        return $this->deletions;
    }

    public function getChanges(){
        return $this->changes;
    }

    public function setPercentage($percentage) {
        $this->percentage = $percentage;
    }

    public function getPercentage() {
        return $this->percentage;
    }

    public function getDataAsArray() {
        return [
            "ticketNum" => $this->ticketNum,
            "commitMgs" => $this->commitMgs,
            "author" => $this->author,
            "hours" => $this->getHours(),
        ];
    }

    public function getHours() {
        return $this->convertPercentToTime($this->percentage, $this->maxHours);
    }

    private function convertPercentToTime($percentage, $maxHours) {
        if($percentage > 0 && $percentage <= 1) {
            $hours = bcmul($maxHours, $percentage);
            $hoursRem = fmod($hours, 1);
            $minutes = $hoursRem * 60;
            return  "".(int)$hours."h ".round($minutes, 0)."m";
        } else {
            // not applicable
            return "0h";
        }
    }
}