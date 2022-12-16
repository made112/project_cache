<?php
class details{
    public function getStatistics(){
        $sql = "SELECT AVG(hit_rate) hit_rate,AVG(miss_rate) miss_rate,
        AVG(total_size) total_size,AVG(number_of_items_in_cache) numberOfItems,
        MAX(number_of_requests_made) numberOfRequest
        FROM  statistics WHERE date BETWEEN DATE_SUB(CURRENT_TIMESTAMP(),INTERVAL 10 MINUTE)
        AND CURRENT_TIMESTAMP()";
        $db = new database();
        $data =  $db->query($sql);
        if($data && is_array($data)){
            return $data;
        }
        return false;
    }

}