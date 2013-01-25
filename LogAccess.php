<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);


class LogAccess implements arrayaccess
{

    private $contents = array();

    public function __construct(){

    }

    public function offsetExists($index){
        return isset($this->contents[$index]);
    }

    public function offsetGet($index){
        return isset($this->contents[$index]) ? $this->contents[$index] : null;
        }

    public function offsetSet($index, $value){
        if(is_null($index)){
            $this->contents[] = $value;
        }
        else {
            $this->contents[$index] = $value;
        }
        return true;
    }

    public function offsetUnset($index){
        unset($this->contents[$index]);
        return true;
    }

    public function getContents(){
        return $this->contents;
    }



}


