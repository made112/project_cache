<?php
class Statistics extends Controller{
    public function index(){
        $statistics = new details();
        $data["statistics"] = $statistics->getStatistics();
        $data["page_title"] = "Statistics";
        // print_r($data)  ;
        $this->view("Statistics",$data);
        
    }
}

