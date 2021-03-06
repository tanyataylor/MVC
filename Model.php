<pre><?php

error_reporting(E_ALL|E_STRICT);
ini_set("display_errors",1);

abstract class Model{

    public function createTable($tableName = null, $arrayOfColumns = array(), $dataTypes = array(), $primaryKey = null){

        $sql = "CREATE TABLE IF NOT EXISTS $tableName (";
        //$sql = "CREATE TABLE $tableName (";


        foreach($arrayOfColumns as $key => $column){
            $dataType = $dataTypes[$key];
            $sql = $sql . "$column $dataType, ";
        }
        $sql = $sql . "PRIMARY KEY ($primaryKey)";
        //$sql = substr($sql, 0, strlen($sql) - 1);
        $sql = $sql . ")";
        //echo $sql;

        $result = mysql_query($sql);
        if (!$result) {
            die('Invalid query : ' . mysql_error());
        }
    }

    public function insertData($tableName = null, $arrayOfColumns = array(), $arrayOfValues = array()){
        array_shift($arrayOfColumns);
        //var_dump($arrayOfColumns);
        $sqlInsert = "INSERT INTO $tableName (";
        foreach($arrayOfColumns as $column){
            $sqlInsert .= "$column, ";
        }
        $sqlInsert = substr($sqlInsert, 0, strlen($sqlInsert) - 2);
        $sqlInsert .= ") VALUES (";
        foreach($arrayOfValues as $value){
            $sqlInsert .= "'$value', ";
        }
        $sqlInsert = substr($sqlInsert, 0, strlen($sqlInsert) - 2);
        $sqlInsert = $sqlInsert . ")";

        //echo $sqlInsert;
        $result = mysql_query($sqlInsert);
        if (!$result) {
            die("Invalid query : " . mysql_error());
        }
        //else{echo"executed";}
    }

    public function getCollection($tableName = null, $arrayOfColumns = null){
        $sql = "SELECT * FROM $tableName";
        $result = mysql_query($sql);
        if(!$result){
            die("Invalid query : " . mysql_error());
            }
        echo "<table border=1>";
        while ($row = mysql_fetch_assoc($result)){
            foreach($arrayOfColumns as $key => $value){
                echo "<tr><td><b>" . $value . "</b></td></tr><tr><td>" . $row[$value] . "</td></tr>";
                }
            }
        echo "</table>";
        }

    public function filterByRow($tableName = null, $arrayOfColumns = null, $column = null, $columnFilter = null){
        $sql = "SELECT * FROM $tableName WHERE $column = $columnFilter";
        $result = mysql_query($sql);
        if(!$result){
            die("Invalid query : " . mysql_error());
            }
        echo "<table border=1>";
        while($row = mysql_fetch_assoc($result)){
            foreach($arrayOfColumns as $key => $value){
                echo "<tr><td><b>" . $value . "</b></td></tr>" . "<tr><td>" . $row[$value] . "</td></tr>";
            }
        }
    }

    public function updateCollection($tableName = null, $colUpdateArray = null, $valUpdateArray = null, $predicateColumn = null, $predicate = null, $value = null){
        $sql1 = "UPDATE $tableName SET $colUpdateArray=$valUpdateArray WHERE $predicateColumn $predicate $value";
        $sql = "UPDATE $tableName SET";


    }

    public function deleteCollectionAll(){

    }

    public function deleteCollectionByRow(){

    }








}
