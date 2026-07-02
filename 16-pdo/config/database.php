<?php
    // Connection Data Base
    try {
        $conx = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Login
    function login($email, $password, $conx) {
        try {
           $sql = "SELECT * 
                   FROM users
                   WHERE email = :email
                   AND password = :password
                   LIMIT 1";
            $stmt = $conx->prepare($sql);
            $stmt->bindparam(":email", $email);
            $stmt->bindparam(":password", $password);
            $stmt->execute();

            if($stmt->rowCount() > 0) {
                $usr = $stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION['uid'] = $usr['id'];
                return true;
            } else {
                 $_SESSION['error'] = "El Usuario no esta registrado!";
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // List Pets
    function listPets($conx) {
        try {
            $sql = "SELECT p.id AS id,
                           p.name AS name,
                           p.photo AS photo,
                           s.name AS specie,
                           b.name AS bread
                    FROM pets AS p,
                         species AS s,
                         breads AS b
                    WHERE s.id = p.specie_id
                    AND b.id = p.bread_id";
            $stmt = $conx->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Add Pet
    function addPet($name, $specie_id, $bread_id, $sex_id, $photo, $conx) {
        try {
            $sql = "INSERT INTO pets
                    (name, specie_id, bread_id, sex_id, photo)
                    VALUES
                    (:name, :specie_id, :bread_id, :sex_id, :photo)";
            $stmt = $conx->prepare($sql);
            $stmt->bindparam(":name", $name);
            $stmt->bindparam(":specie_id", $specie_id);
            $stmt->bindparam(":bread_id", $bread_id);
            $stmt->bindparam(":sex_id", $sex_id);
            $stmt->bindparam(":photo", $photo);
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Show Pet
    function showPet($id, $conx) {
        try {
            $sql = "SELECT p.name AS name,
                           p.photo AS photo,
                           p.specie_id AS specie_id,
                           p.bread_id AS bread_id,
                           p.sex_id AS sex_id,
                           s.name AS specie,
                           b.name AS bread,
                           x.name AS sex
                    FROM pets AS p,
                         species AS s,
                         breads AS b,
                         sexes AS x
                    WHERE s.id = p.specie_id
                    AND b.id = p.bread_id
                    AND x.id = p.sex_id
                    AND p.id = :id";
            $stmt = $conx->prepare($sql);
            $stmt->bindparam(":id", $id);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    // Delete Pet
    function deletePet($id, $conx) {
        try {

            $sql = "SELECT photo FROM pets WHERE id = :id";
            $stmt = $conx->prepare($sql);
            $stmt->bindparam(":id", $id);
            $stmt->execute();
            $pet = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($pet && $pet['photo']) {
                $photoPath = '../uploads/' . $pet['photo'];
                if (file_exists($photoPath)) {
                    unlink($photoPath);
                }
            }
            
            $sql = "DELETE FROM pets WHERE id = :id";
            $stmt = $conx->prepare($sql);
            $stmt->bindparam(":id", $id);
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // List Species
    function listSpecies($conx) {
        try {
            $sql = "SELECT *
                    FROM species";
            $stmt = $conx->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // List breads
    function listbreads($conx) {
        try {
            $sql = "SELECT *
                    FROM breads";
            $stmt = $conx->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // List breads
    function listSexes($conx) {
        try {
            $sql = "SELECT *
                    FROM sexes";
            $stmt = $conx->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

        //edit pet
    function editPet($id, $name, $specie_id, $bread_id, $sex_id, $photo, $conx) {
        try {
            $sql = "UPDATE pets
                    SET name = :name, specie_id = :specie_id, bread_id = :bread_id, sex_id = :sex_id, photo = :photo
                    WHERE id = :id";
            $stmt = $conx->prepare($sql);
            $stmt->bindparam(":name", $name);
            $stmt->bindparam(":specie_id", $specie_id);
            $stmt->bindparam(":bread_id", $bread_id);
            $stmt->bindparam(":sex_id", $sex_id);
            $stmt->bindparam(":photo", $photo);
            $stmt->bindparam(":id", $id);
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }