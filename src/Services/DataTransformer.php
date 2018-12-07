<?php
namespace src\Services;

use \src\Interfaces\DataTransformerInterface;
use \src\Model\Log;
/**
 * 
 */
class DataTransformer implements DataTransformerInterface
{
    private $data;
    private $result = [];

    public function getResult()
    {        
        return $this->result;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function transform()
    {
        if(!is_array($this->data)) {
            throw new Exception('Data must be an array type', 1);            
        }

        // TODO: Need more refactor
        // too much if else
        $log = new Log;
        foreach($this->data as $key => $line) {
            if(stripos($line, 'commit') === 0) {
                $hash = substr($line, strlen('commit'));
                $log->setHash($hash);
            } else if(stripos($line, 'author') === 0) {
                $author = substr($line, strlen('Author:'));
                $log->setAuthor($author);
            } else if(stripos($line, 'date') === 0) {
                $date = substr($line, strlen('Date:   '));
                $log->setDate(strtotime($date));
            } else if(preg_match('/\bfile\b/',$line) || preg_match('/\bfiles\b/',$line)) {
                $arr = explode(' ', $line);
                foreach ($arr as $key => $value) {
                    if(preg_match('^file^',$value)) {
                        $changes = $arr[$key - 1];
                        $log->setChanges($changes);
                    } else if (preg_match('^insert^',$value)) {
                        $insertions =$arr[$key - 1];
                        $log->setInsertions($insertions);
                    } else if (preg_match('^del^',$value)) {
                        $deletions = $arr[$key - 1];
                        $log->setDeletions($deletions);
                    }
                }

                // this is the last line to complete a Log object
                array_push($this->result, $log);
                $log = new Log;

            } else if(!preg_match('/(\+|\-)$/i', $line)) {
                $message = trim($line);    
                if(!empty($message))
                    $log->setMessage($message);
            }
        }
    }
}