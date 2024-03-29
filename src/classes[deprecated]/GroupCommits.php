<?php
class GroupCommits
{
    public function ticketCommit($line){
        // assumptions for project key is very limited
        if (preg_match("/[A-Za-z]+-[0-9]+/", $line, $matches))
            return true;
        else
            return false;
    }
    public function getResults ($date, $author, $directory, $stats=false)
    {
        $output = array();
        chdir($directory);
        if($stats){
            exec("git log  --no-merges --stat --after=\"$date 00:00\" --before=\"$date 23:59\" --author=$author",$output);
        }else{
            exec("git log  --no-merges --after=\"$date 00:00\" --before=\"$date 23:59\" --author=$author",$output);
        }
        // echo '<pre>';
        // print_r($output);
        // exit;
        return $output;
    }
    public function groupCommit ($author,$date,$dir)
    {
        // Why run groupings and groupStats separately?
        $history = $this->groupings($date, $author, $dir);
        echo '<pre>';
        // print_r($history);
        // echo 'waheheh';
        // exit;
        $stats = $this->groupStats($date, $author, $dir);
        // print_r($stats);
        // print_r($this->combineArr($history,$stats));
        // exit;
        return $this->combineArr($history,$stats);
    }
    public function groupings($date, $author, $dir){
        $output = $this->getResults($date, $author, $dir);
        $history = array();
        $others = array();
        $ticketCommits =array();
        // uninitialized $commit var
        foreach($output as $line){
            if(stripos($line, 'commit')===0){
                if(!empty($commit)){
                    array_push($history, $commit);
                    unset($commit);
                }
                $commit['hash']   = substr($line, strlen('commit'));
            }
            // author can be assumed as as $author
            else if(stripos($line, 'author')===0){
                $commit['author'] = substr($line, strlen('Author:'));
            }
            else if(stripos($line, 'date')===0){
                $oldDate = substr($line, strlen('Date:   '));
                $commit['newDate']   = strtotime($oldDate);
            }
            else{
                $arr = explode(' ',trim($line));
                if($arr[0]!= '' && $this->ticketCommit($arr[0])){
                    array_push($ticketCommits, $line);
                    $commit['type'] = str_replace(":","",$arr[0]);
                    unset($arr[0]);
                    $commit['message'] = implode(" ", $arr);
                }
                else if ($arr[0]!= '' && !$this->ticketCommit($arr[0])){
                    array_push($others, $line);
                    $commit['message'] = $line;
                    $commit['type'] = "others";
                }
            }
        }

        return $history;
    }
    public function groupStats($date, $author, $dir){
        $output = $this->getResults($date, $author, $dir, true);
        $stats = array();
        foreach($output as $line){
            if(strpos($line, 'commit')===0){
                if(!empty($commit)){
                    array_push($stats, $commit);
                    unset($commit);
                }
                $commit['hash']   = substr($line, strlen('commit'));
            }
            elseif (preg_match('/\bfile\b/',$line) || preg_match('/\bfiles\b/',$line)) {
                $arr = explode(' ', $line);
                foreach ($arr as $key=>$value) {
                    if(preg_match('^file^',$value)){
                        $commit['changed'] = $arr[$key-1];
                    }elseif (preg_match('^insert^',$value)) {
                        $commit['insertions'] =$arr[$key-1];
                    }elseif (preg_match('^del^',$value)) {
                        $commit['deletions'] = $arr[$key-1];
                    }
                }
            }
        }
        return $stats;
    }
    public function combineArr($arr1,$arr2){
        $main = array();
        $types = array();
        $var = array();
        usort($arr1,  $this->build_sorter("type"));
        foreach($arr1 as $key => $value){
            if(!in_array($value["type"], $types)){
                array_push($types, $value["type"]);
                if(!empty($var)){
                    array_push($main, $var);
//                    unset($var);
                }
                $var['ticketNum'] = $value["type"];
                $var['author'] = $value["author"];
                $var['date'] = $value["newDate"];
                $var['message'] = "";
                $var['deletions'] = 0;
                $var['changed'] = 0;
                $var['insertions'] = 0;
            }
            $var['message'] .= $value["message"];
            $var['changed'] =(int) $var['changed']+(int)$this->getStat($value["hash"], $arr2, "changed");
            $var['insertions'] = (int) $var['insertions']+(int)$this->getStat($value["hash"], $arr2, "insertions");
            $var['deletions'] += (int)$this->getStat($value["hash"], $arr2, "deletions");
            if ($key === count($arr1)-1)
            {
                array_push($main, $var);
            }
        }
        return $main;
    }
    public function getStat ($hash, $arr2, $type) {
        foreach ($arr2 as $value)
        {
            if($value["hash"] === $hash) {
                if(isset($value[$type])) {
                    return $value[$type];
                }
            }
        }
        return 0;
    }
    public function build_sorter($key) {
        return function ($a, $b) use ($key) {
            return strnatcmp($a[$key], $b[$key]);
        };
    }
}
