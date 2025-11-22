<?php
$tittle = '09-class-abstract';
$descripcion = 'A class that cannot be instantiated, only extended from.';
include 'template/header.php';

echo "<section>";
abstract class DataBase
{
    protected $host = 'localhost:3307';
    protected $user = 'root';
    protected $password = '';
    protected $dbname = 'pokeadso';
    protected $conx;

    abstract protected function getData();

    protected function connect()
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname}";
            $this->conx = new PDO($dsn, $this->user, $this->password);
            $this->conx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conx;
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    protected function disconnect()
    {
        $this->conx = null;
    }
}
class Pokemon extends DataBase
{

    public function __construct()
    {
        $this->conx = null;
    }

    protected function getData()
    {
        $this->connect();
        $sql = "SELECT id, name, type FROM pokemons ORDER BY id ASC";
        $stmt = $this->conx->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->disconnect();
        return $data;
    }

    public function displayTable()
    {
        $pokemons = $this->getData();

        echo "<h1>Lista de Pokémon</h1>
              <table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse; width: 100%; margin: 20px 0;'>
                  <thead style='background-color: #f2f2f2;'>
                      <tr>
                          <th>ID</th>
                          <th>Nombre</th>
                          <th>Tipo</th>
                      </tr>
                  </thead>
                  <tbody>";

        if (count($pokemons) > 0) {
            foreach ($pokemons as $pokemon) {
                echo "
                      <tr>
                          <td style='text-align: center; color: black; text-shadow: -1px 0 #c7c778, 0 1px #c7c778, 1px 0 #c7c778, 0 -1px #c7c778; font-size: 16px;'>" . htmlspecialchars($pokemon['id']) . "</td>
                          <td style='color: black; text-shadow: -1px 0 #c7c778, 0 1px #c7c778, 1px 0 #c7c778, 0 -1px #c7c778; font-size: 16px;'>" . htmlspecialchars($pokemon['name']) . "</td>
                          <td style='color: black; text-shadow: -1px 0 #c7c778, 0 1px #c7c778, 1px 0 #c7c778, 0 -1px #c7c778; font-size: 16px;'>" . htmlspecialchars($pokemon['type']) . "</td>
                      </tr>";
            }
        } else {
            echo "
                  <tr>
                      <td colspan='3' style='text-align: center;'>No hay pokémon disponibles</td>
                  </tr>";
        }

        echo "
                  </tbody>
              </table>";
    }
}
try {
    $pokemonManager = new Pokemon();
    $pokemonManager->displayTable();
} catch (PDOException $e) {
    echo "<p style='color: red;'>Error de base de datos: " . $e->getMessage() . "</p>";
} catch (Exception $e) {
    echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
}

echo "</section>";

include 'template/footer.php';
