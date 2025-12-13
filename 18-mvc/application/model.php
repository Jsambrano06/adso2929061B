<?php 
class Model extends DataBase {
    protected $db;

    public function __construct(){
        $this->db = DataBase::connect();
    }

    // ========== POKEMONES ==========
    
    public function listPokemons(){
        $sql = "SELECT p.*, t.name as trainer_name 
                FROM pokemons p 
                LEFT JOIN trainers t ON p.trainer_id = t.id 
                ORDER BY p.id ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getPokemonById($id){
        $sql = "SELECT p.*, t.name as trainer_name, t.level as trainer_level 
                FROM pokemons p 
                LEFT JOIN trainers t ON p.trainer_id = t.id 
                WHERE p.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createPokemon($data){
        $sql = "INSERT INTO pokemons (name, type, trainer_id, strength, staming, speed, accuracy) 
                VALUES (:name, :type, :trainer_id, :strength, :staming, :speed, :accuracy)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
        $stmt->bindParam(':type', $data['type'], PDO::PARAM_STR);
        $stmt->bindParam(':trainer_id', $data['trainer_id'], PDO::PARAM_INT);
        $stmt->bindParam(':strength', $data['strength'], PDO::PARAM_INT);
        $stmt->bindParam(':staming', $data['staming'], PDO::PARAM_INT);
        $stmt->bindParam(':speed', $data['speed'], PDO::PARAM_INT);
        $stmt->bindParam(':accuracy', $data['accuracy'], PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function updatePokemon($id, $data){
        $sql = "UPDATE pokemons 
                SET name = :name, type = :type, trainer_id = :trainer_id, 
                    strength = :strength, staming = :staming, speed = :speed, accuracy = :accuracy 
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
        $stmt->bindParam(':type', $data['type'], PDO::PARAM_STR);
        $stmt->bindParam(':trainer_id', $data['trainer_id'], PDO::PARAM_INT);
        $stmt->bindParam(':strength', $data['strength'], PDO::PARAM_INT);
        $stmt->bindParam(':staming', $data['staming'], PDO::PARAM_INT);
        $stmt->bindParam(':speed', $data['speed'], PDO::PARAM_INT);
        $stmt->bindParam(':accuracy', $data['accuracy'], PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deletePokemon($id){
        $stmt = $this->db->prepare("DELETE FROM pokemons WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // ========== ENTRENADORES ==========
    
    public function listTrainers(){
        $sql = "SELECT t.*, g.name as gym_name 
                FROM trainers t 
                LEFT JOIN gyms g ON t.gym_id = g.id 
                ORDER BY t.name ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getTrainerById($id){
        $sql = "SELECT t.*, g.name as gym_name 
                FROM trainers t 
                LEFT JOIN gyms g ON t.gym_id = g.id 
                WHERE t.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getPokemonsByTrainer($trainer_id){
        $stmt = $this->db->prepare("SELECT * FROM pokemons WHERE trainer_id = :trainer_id ORDER BY name ASC");
        $stmt->bindParam(':trainer_id', $trainer_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countPokemonsByTrainer($trainer_id){
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM pokemons WHERE trainer_id = :trainer_id");
        $stmt->bindParam(':trainer_id', $trainer_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    // ========== GIMNASIOS ==========
    
    public function listGyms(){
        $stmt = $this->db->query("SELECT * FROM gyms ORDER BY name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}