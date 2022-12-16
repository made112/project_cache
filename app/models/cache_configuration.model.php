<?php
class cache_configuration{
    public function updateConfigCache($capacity,$policy){
        $db = new database();
        $minCapacity = 1;
        $maxCapacity = 4;

        $sql = "SELECT id,policy FROM polices WHERE policy = :policy";
        $tmp_data = $db->query($sql,["policy"=>$policy]);
        if(!$tmp_data || empty($tmp_data)){
            return false;
        }

        if($capacity < $minCapacity ||  $capacity > $maxCapacity){
            return false;
        }
        $query = "UPDATE configuration SET 
                      capacity = :capacity,
                      policy_id = :policy,
                      last_updated = :date";
        $data["capacity"] = $capacity;
        $data["policy"] = $tmp_data[0]->id;
        $data["date"] = date("y-m-d H:i:s");
        $db->query($query,$data);
        return true;
    }
    public function getConfiguration(){
        $sql = "SELECT c.capacity, p.policy FROM configuration c INNER JOIN polices p on c.policy_id = p.id";
        $db = new database();
        $data = $db->query($sql);
        if($data && is_array($data)){
            return $data[0];
        }
        return false;
    }
}