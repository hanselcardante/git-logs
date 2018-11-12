<?php
namespace src\Classes;

/**
 * 
 */
class Helpers
{
    /*
     * @param string $ticketCommit
    */
    public static function isTicketCommit($ticketCommit)
    {
        return preg_match("/[A-Za-z]+-[0-9]+/", $ticketCommit);
    }
    /*
     * @param Array $arr
    */
	public static function bcsum($arr)
	{
		$sum = 0;
        if(count($arr)) {
            foreach($arr as $v) {
                $sum = bcadd($sum, $v);
            }
        }

        return $sum;
	}

    // TODO: needs refactoring, put this to a service class
    // @param Commit[] $commits
    public static function percentegatorize(array $commits)
    {
        $arrayOfPercentages = [];
        $totalPercentage = 0;
        $totalWork = array_reduce($commits, function($total, $commit) {
            return $total + $commit->getTotalRevisions();
        });

        foreach ($commits as $key => $commit) {
            $p = round($commit->getTotalRevisions() / $totalWork, 2);
            $totalPercentage += $p;
            if ($p > .01) {
                $arrayOfPercentages[$key] = $p;
            }
        };

        if ($totalPercentage < 1) {
            $minKey = null;
            foreach ($arrayOfPercentages as $pKey => $pValue) {
                if (!$minKey) {
                    $minKey = $pKey;
                } else {
                    $minKey = $arrayOfPercentages[$minKey] < $pValue ? $minKey : $pKey;
                }
            }

            $arrayOfPercentages[$minKey] = $arrayOfPercentages[$minKey] + 1 - $totalPercentage;
        }

        return $arrayOfPercentages;
    }

    public static function convertPercentToTime($percentage, $maxHours)
    {
        if($percentage > 0 && $percentage <= 1) {
            $hours = $maxHours * $percentage;
            $hoursRem = fmod($hours, 1);
            $minutes = $hoursRem * 60;
            return  "".(int)$hours."h ".round($minutes, 0)."m";
        } else {
            // not applicable
            return "0h";
        }
    }
}