<pre><?php
error_reporting(E_ALL|E_STRICT);
ini_set('display_errors',1);

class Logs{

    public function initialize(){
        $this->displayMonths();
        echo "<h4>Log File List</h4>";
        //var_dump($_GET);
        //var_dump($this->getLogs());
        foreach($this->getLogs() as $logs){
            var_dump($logs);

        }

        if(isset($_GET['month'])){
            $this->listLogFiles($_GET['month']);}
    }

    public function displayMonths(){
        include('displayMonths.phtml');
        }

    public function listLogFiles($month = 'null'){

        $str = "logs/*";
        if ($_GET['month'] != 'null'){
            $str .= "-{$month}-*.log";

        }
        else {
            $str .= ".log";
        }

        foreach((array) glob($str) as $file){

            echo "<a href='Logs?filename=".substr($file,5)."&month=".$month."'>$file</a><br/>";
            if ((isset($_GET['filename'])) && $_GET['filename']== substr($file,5))
            {
               echo($this->displayFileContents($_GET['filename']));
            }
        }
    }

    public function getLogs(){
        $str = "logs/*";
        $newLog = array();

        $logs = glob($str);
        foreach($logs as $var=>$log){
            $newLog[$var] = $this->getSingleLog($log);

        }
        return (object)$newLog;

    }

    public function getSingleLog($log){
        $newLog = array();
        $newLog['log_dump'] = file_get_contents($log);
        $newLog['path'] = $log;
        return (object)$newLog;

    }


    public function displayFileContents($fileName){
        //$path = getcwd();    //add /logs/
        //echo $path;
        $path = '/var/www/MVC/logs/';
        $fileToRead = $path.$fileName;
        $fh = fopen($fileToRead,'r');
        $data = fread($fh, filesize($fileToRead));
        fclose($fh);
        return $data;
    }

}





