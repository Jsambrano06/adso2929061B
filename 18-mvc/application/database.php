<?php 
    abstract class DataBase {
        protected static $conn = null;

        public static function connect(){
            if (self::$conn === null){
                try{
                    $host = 'localhost:3307';
                    $dbname = 'pokeadso';
                    $user = 'root';
                    $pass = '';
                    
                    self::$conn = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass);
                }catch (PDOException $e){
                    die("Error de conexión: " . $e->getMessage());
                }
            }
            return self::$conn;
        }
    }