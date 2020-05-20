<?php  
    // Import the lib/ files

    require_once "lib/conn.php";
    require_once "lib/data.php";

    //Set the header to JSON
    header('Content-Type: application/json');

    // Get the data that sent with POST method

    $data = [];
    $data["url"] = $_POST['urladdress'];
    $data["expire"] = $_POST['expirationdate'];

    class Register extends User{

        private $data = [];

        public function __construct($data){
            global $db;
            parent::__construct($db);
            $this->data["alias"] = $data["url"];
            //Check if the MAIL is VALID
            if (filter_var($data["url"], FILTER_VALIDATE_URL) !== false){
                //Register to the database
                if ($this->registerAlias($data)){
                    //return to the index.html
                    echo json_encode($this->data, JSON_PRETTY_PRINT);
                }
            }
        }
        
        //Registering URL to database
        private function registerAlias($data){
            $alias = $this->generateAlias();
            $offset = 0*60*60;
            $dateFormat = "Y-m-d h:i:s";
            $date = gmdate($dateFormat, time()+$offset);

            //Expiration
            $asiap = [0, "+10 minutes", "+1 hour", "+12 hours", "+1 day", "+3 days", "+1 week", "+2 weeks", "+1 month", "+3 months", "+6 months", "+1 year"];
            if(!$data["expire"] == 0){
                $when = date($dateFormat, strtotime($asiap[$data["expire"]]));
                $expire = gmdate($dateFormat, strtotime($when));
            } else {
                $expire = "";
            }

            // Inserting things into $this->data so can be returned to the index.html
            $this->data["alias"] = $alias;
            $this->data["date"] = $date;
            $this->data["expire"] = $expire;

            if(parent::register($alias, $data["url"], $date, $expire)){
                return true;
            } else {
                return false;
            }
        }
        
        //This is a function that generate alias by incrementing the last ALIAS from database, it work like our base 10 calculation, but instead i use the alphabet
        private function generateAlias(){
            //Generate Alias based on last url
            $latestAlias = parent::getLastAlias();
            $latestAlias = str_split($latestAlias);
            $banyak = count($latestAlias);
            $tes = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];
            $banyak = count($latestAlias);
            $naik = true;            
            for($i = $banyak; $i > 0 && $naik == true ; $i--){
                $key = array_search($latestAlias[$i-1], $tes);
                if(!array_key_exists($key + 1, $tes)){
                    $latestAlias[$i-1] = $tes[0];
                    if($i == 1){
                        $naik = false;
                        array_unshift($latestAlias , $tes[0]);
                    } else {
                        $naik = true;
                    }
                } else {
                    $latestAlias[$i-1] = $tes[$key + 1];
                    $naik = false;
                }
            }

            return implode("", $latestAlias);
        }
    }
    $Register = new Register($data);
?>