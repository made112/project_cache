<?php
class Cache
{
    private static $cache;
    public $db;
    public function __construct()
    {
       $this->db = new database();
        self::load_cache();
        if (!isset(self::$cache["config"]) || !isset(self::$cache["config"]["size"])) {
            self::$cache["config"]["capacity"] = 1.0;
            self::$cache["config"]["policy"] = "random";
            self::$cache["config"]["size"] = 0;
            self::$cache["config"]["numberOfRequests"] = 0;
            self::$cache["config"]["cachehit"] = 0;
            self::$cache["config"]["cachemiss"] = 0;
        }
        if(!isset(self::$cache["data"])){
            self::$cache["data"] = array();
        }
        $this->refreshConfiguration();

    }

    public function PUT($key, $value)
    {
        $sizeOfTheImage = strlen($key) + strlen($value);
        $sizeOfTheImage /= 1000000;
        if($sizeOfTheImage > self::$cache["config"]["capacity"]){
            return "The Image Size is too large for the Capacity of the Cache";
        }
        $freesize = self::$cache["config"]["capacity"] - self::$cache["config"]["size"];
        while($freesize < $sizeOfTheImage){
            $this->replace();
            $freesize = self::$cache[""]["capacconfigity"] - self::$cache["config"]["size"];
        }
        self::$cache["config"]["size"] += $sizeOfTheImage;
        self::$cache["data"][$key] = $value;
        $this->saveCache();
    }

    public function get($key)
    {
        self::$cache["config"]["numberOfRequests"] += 1;
        if (isset(self::$cache["data"][$key])) {
            self::$cache["config"]["cachehit"] += 1;
            $this->moveToFront($key);
            self::saveCache();
            return self::$cache["data"][$key];
        } else {
            self::$cache["config"]["cachemiss"] += 1;
            $this->saveCache();
            return false;
        }
    }
    public function clear()
    {
        unset(self::$cache["data"]);
        self::$cache["data"] = array();
        self::$cache["config"]["size"] = 0;
        $this->saveCache();
    }

    public function InvalidateKey($key)
    {
        if (isset(self::$cache["data"][$key])) {
            $sizeOfTheImage = (strlen($key) + strlen(self::$cache["data"][$key])) / 1000000;
            self::$cache["config"]["size"] -= $sizeOfTheImage;
            unset(self::$cache["data"][$key]);
            $this->saveCache();
        }
        return true;
    }

    public function refreshConfiguration()
    {
        $query = "select c.capacity,p.policy from configuration c INNER JOIN polices p on (c.policy_id = p.id)";

        $data = $this->db->query($query);
        if ($data) {
            self::$cache["config"]["capacity"] = $data[0]->capacity;
            self::$cache["config"]["policy"] = $data[0]->policy;
            $this->saveCache();
        }
        $this->checkCapcityConstraint();
    }
    private function checkCapcityConstraint(){
        while(self::$cache["config"]["size"] > self::$cache["config"]["capacity"]){
            $this->replace();
        }
    }

    private function replace()
    {
        if (self::$cache["config"]["policy"] == "random") {
            $this->random();
        } else {
            $this->LRU();
        }
    }

    private function random()
    {
        if(count(self::$cache["data"]) > 0){
            $replaced = array_rand(self::$cache["data"]);
            $sizeOfTheImage = (strlen($replaced) + strlen(self::$cache["data"][$replaced])) / 1000000;
            self::$cache["config"]["size"] -= $sizeOfTheImage;
            unset(self::$cache["data"][$replaced]);
            $this->saveCache();
        }
    }

    public function LRU()
    {
        reset(self::$cache["data"]);
        $currentKey = key(self::$cache["data"]);
        $sizeOfTheImage = (strlen($currentKey) + strlen(self::$cache["data"][$currentKey])) / 1000000;
        self::$cache["config"]["size"] -= $sizeOfTheImage;
        unset(self::$cache["data"][$currentKey]);
        $this->saveCache();
    }
    public function getStatistics(){
        $statistics = array();
        $statistics["numberOfRequest"] = self::$cache["config"]["numberOfRequests"];
        $statistics["cache_hits"] = self::$cache["config"]["cachehit"];
        $statistics["cache_miss"] = self::$cache["config"]["cachemiss"];
        $statistics["size"] = self::$cache["config"]["size"];
        $statistics["numberOfItems"] = count(self::$cache["data"]);
        return $statistics;
    }
    public function clearStat(){
        self::$cache["config"]["numberOfRequests"] = 0;
        self::$cache["config"]["cachehit"] = 0;
        self::$cache["config"]["cachemiss"] = 0;
        $this->saveCache();
    }
    private function moveToFront($key){
        $cachedItem = self::$cache["data"][$key];
        unset(self::$cache["data"][$key]);
        self::$cache["data"][$key] = $cachedItem;
    }
    /* Test Functions */
    public function TestPUT($key, $value){
        $return = $this->PUT($key,$value);
        if(isset($return)){
            return false;
        }
        return true;
    }

    public function getCache(){
        return self::$cache["data"];
    }
    public function getSize(){
        return self::$cache["config"]["size"];
    }

    private static function load_cache()
    {
        if(!isset($_SESSION["cache"])){
            $_SESSION["cache"] = array();
        }
        self::$cache = $_SESSION["cache"];
    }
    private function saveCache()
    {
        $_SESSION["cache"] = self::$cache;
    }




}
