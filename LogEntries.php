<?php

error_reporting(E_ALL|E_STRICT);
ini_set("display_errors",1);

class LogEntries extends Model{

    public function __init(){

        $arrayOfColumns = array();
        $dataTypes = array();
        $tableName = "log_entries";
        $primaryKey = "log_entry_id";
        $column = "log_entry_id";
        $columnFilter = 136;

        array_push($arrayOfColumns, $primaryKey, "hour", "remote_addr", "server_name_request_uri", "session_id", "log");
        array_push($dataTypes, "int NOT NULL AUTO_INCREMENT", "varchar(255)", "varchar(255)", "varchar(255)", "varchar(255)", "varchar(255)");
        $arrayOfValues = $this->create_log_entry("Test");

        $this->createTable($tableName, $arrayOfColumns, $dataTypes, $primaryKey);
        $this->insertData($tableName, $arrayOfColumns, $arrayOfValues);
        $this->getCollection($tableName, $arrayOfColumns);
        $this->filterByRow($tableName, $arrayOfColumns, $column, $columnFilter);


    }

/* Writing to a file */
    public function create_log_entry($str){
        $d = date("Y-m-d");
        $file_path = getcwd();
        $file_path .= "/logs/";
        $file_path .= $d;
        $file_path .= ".log";
        $file = fopen($file_path, 'a+') or die("cannot open the file");
        $stringData = date('H-i-s') . " : " . $_SERVER['REMOTE_ADDR'] . " : " . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . " : "
            . 'Session_id: ' . session_id() . "\n\t" . $str . "\n";
        $arrayOfValues = array();
        array_push($arrayOfValues, date('H-i-s'), $_SERVER['REMOTE_ADDR'], $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'], 'Session_id: ' . session_id(), "$str");
        fwrite($file, "$stringData");
        fclose($file);
        return $arrayOfValues;
    }









}
