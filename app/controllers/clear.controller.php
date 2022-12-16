<?php


class clear extends Controller{
    public function index(){
        $cache = new Cache();
        $cache->clearStat();
        $this->redirect("home");
    }
}