<?php

namespace domath\utils;

class SimpleStorage{
    /** @var array */
    private $answers = [];
    /**
     * Stores the input, $key is the name of the input
     * @param mixed $key
     * @param int $input
     */
    public static function store($key, $input){
        $this->answers[strtolower($key)] = $input;
    }
    /**
     * Removes the input from stored answers, if it is stored
     * @param mixed $key
     */
    public static function remove($key){
        if(self::exists($key)) unset($this->answers[strtolower($key)]);
    }
    /**
     * Retrieves the input from stored answers, if it exists
     * @param mixed $key
     * @return int|bool
     */
    public static function retrieve($key){
        if(self::exists($key)){
            return $this->answers[strtolower($key)];
        }
        return false;
    }
    /**
     * Returns true if $key exists in stored answers
     * @param mixed $key
     * @return bool
     */
    public static function exists($key){
        return $this->answers[strtolower($key)] !== null;
    }
    public static function clear(){
        $this->answers = [];
    }
}