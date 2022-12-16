<?php


class database{
    public static $conn = null;
    private function connect(){
        if(self::$conn == null){
            $dsn = DB_TYPE . ":host=" . HOST . ";dbname=" . DB_NAME;
            try{
                self::$conn = new PDO($dsn,DB_USER,DB_PASSWORD,
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ));
            }
            catch(PDOException $e){
                die($e->getMessage());
            }
        }
    }
    public function query($query,$data = array(),$datatypeReturned = "object"){
        if(self::$conn == null){
            $this->connect();
        }
        $stmt = self::$conn->prepare($query);
        if($stmt){
            $result = $stmt->execute($data);
            $data = false;
            if($result){
                if($datatypeReturned == "object"){
                    $data = $stmt->fetchAll(PDO::FETCH_OBJ);
                }
                else{
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
                return $data;
            }
        }
        return false;
    }
}