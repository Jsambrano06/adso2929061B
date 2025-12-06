<?php 

class Load {
    public function view($nameView, $data = null) {
        include_once 'views/' . $nameView;
    }
}