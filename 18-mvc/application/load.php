<?php 
class Load {
    public function view($nameView, $data = null) {
        if (file_exists('views/' . $nameView)) {
            include_once 'views/' . $nameView;
        } else {
            die("Error: La vista '{$nameView}' no existe.");
        }
    }
}