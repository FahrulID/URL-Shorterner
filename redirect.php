<?php  
    // Import the lib/ files
    require_once "lib/conn.php";
    require_once "lib/data.php";

    //Get "Alias" through Get method
    $c = $_GET['c'];
    class Redirect extends User{
        public function __construct($param){
            //Connect to DB
            global $db;
            parent::__construct($db);
            //Call getUrl function to get the URL we must redirect to
            $this->getUrl($param);
        }
        
        private function getUrl($alias){
            try{
                $dbValue = parent::getDatabase($alias);
                // Get URL by Alias
                $url = $dbValue[0];

                //Get time now
                $offset = 0*60*60;
                $dateFormat = "Y-m-d h:i:s";
                $date = gmdate($dateFormat, time()+$offset);
                // Redirect to the URL if exist in DB

                if($url && $dbValue[1] == "0000-00-00 00:00:00"){
                    header("Location: ".$url);
                } elseif($url && $date < $dbValue[1]) {
                    header("Location: ".$url);
                } else {
                    header("Location: index.html");
                }
                exit;
            }catch(Exception $e){
                // Display error
                echo $e->getMessage();
            }
        }
    }
    //Calling Redirect class
    $Redirect = new Redirect($c);
?>