<?php  
    /**
     * Create a new class
     */
    class User
    {

        private $db; // Save DB connection
        private $error; // Save the error message

        // Constructor that needs a paramater which is connecting to database
        function __construct($db_conn)
        {
            $this->db = $db_conn;

            // start session
            session_start();
        }
		
		public function getDatabase($alias)
        {
            try
            {
                // get Data from database
                $query = $this->db->prepare("SELECT * FROM `short` WHERE alias = :alias");
                $query->bindParam(":alias", $alias);
                $query->execute();
                $data = $query->fetch();

                // if row more than 0
                if($query->rowCount() > 0){
                    //Returning the desired data
					return [$data["url"], $data["expire"]];
                }else{
                    $this->error = "Url not listed";
                    return false;
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

		public function getLastAlias()
        {
            try
            {
                // get Data from database
                $query = $this->db->prepare("SELECT * FROM `short` ORDER BY `id` DESC limit 1");
                $query->execute();
                $data = $query->fetch();

                // if row more than 0
                if($query->rowCount() > 0){
                    //Returning the desired data
					return $data["alias"];
                }else{
                    $this->error = "Url not listed";
                    return false;
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
		
		public function register($alias, $url, $date, $expire)
        {
            try
            {
                //Insert new URL to database
                $query = $this->db->prepare("INSERT INTO short( alias, url, date, expire) VALUES(:alias, :url, :date, :expire)");
                $query->bindParam(":alias", $alias);
				$query->bindParam(":url", $url);
                $query->bindParam(":date", $date);
                $query->bindParam(":expire", $expire);
                $query->execute();

                return true;
            }catch(PDOException $e){
                // If there is an error
                if($e->errorInfo[0] == 23000){
                    //23000 is an error when there is a same data which is must be unique
                    $this->error = "Error!";
                    return false;
                }else{
                    echo $e->getMessage();
                    return false;
                }
            }
        }
    }
?>