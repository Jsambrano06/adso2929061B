<?php 
class Controller {
    public $load;
    public $model;
    private $base_url;

    public function __construct($action = 'index', $id = null) {
        $this->load = new Load;
        $this->model = new Model;
        $this->base_url = '/18-mvc/';

        switch($action) {
            case 'add':
            case 'crear':
                $this->add();
                break;
            case 'store':
            case 'guardar':
                $this->store();
                break;
            case 'show':
            case 'ver':
                $this->show($id);
                break;
            case 'edit':
            case 'editar':
                $this->edit($id);
                break;
            case 'update':
            case 'actualizar':
                $this->update($id);
                break;
            case 'delete':
            case 'eliminar':
                $this->delete($id);
                break;
            case 'destroy':
                $this->destroy($id);
                break;
            case 'index':
            case '':
            default:
                $this->index();
                break;
        }
    }

    private function redirect($path = '') {
        header('Location: ' . $this->base_url . $path);
        exit;
    }

    public function index() {
        $pokemons = $this->model->listPokemons();
        $data = [
            'pokemons' => $pokemons,
            'url' => $this->base_url
        ];
        $this->load->view('welcome.php', $data);
    }

    public function add() {
        $trainers = $this->model->listTrainers();
        $data = [
            'url' => $this->base_url,
            'trainers' => $trainers
        ];
        $this->load->view('add.php', $data);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name'],
                'type' => $_POST['type'],
                'trainer_id' => $_POST['trainer_id'] ?? null,
                'strength' => $_POST['strength'] ?? 100,
                'staming' => $_POST['staming'] ?? 100,
                'speed' => $_POST['speed'] ?? 50,
                'accuracy' => $_POST['accuracy'] ?? 50
            ];
            
            $this->model->createPokemon($data);
            $_SESSION['message'] = $data['name'] . ' ha sido agregado exitosamente';
            $_SESSION['message_type'] = 'success';
            $this->redirect();
        }
    }

    public function show($id) {
        if (!$id) {
            $this->redirect();
        }
        
        $pokemon = $this->model->getPokemonById($id);
        
        if (!$pokemon) {
            $this->redirect();
        }
        
        $data = [
            'pokemon' => $pokemon,
            'url' => $this->base_url
        ];
        $this->load->view('show.php', $data);
    }

    public function edit($id) {
        if (!$id) {
            $this->redirect();
        }
        
        $pokemon = $this->model->getPokemonById($id);
        
        if (!$pokemon) {
            $this->redirect();
        }
        
        $trainers = $this->model->listTrainers();
        $data = [
            'pokemon' => $pokemon,
            'trainers' => $trainers,
            'url' => $this->base_url
        ];
        $this->load->view('edit.php', $data);
    }

    public function update($id) {
        if (!$id) {
            $this->redirect();
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name'],
                'type' => $_POST['type'],
                'trainer_id' => $_POST['trainer_id'] ?? null,
                'strength' => $_POST['strength'] ?? 100,
                'staming' => $_POST['staming'] ?? 100,
                'speed' => $_POST['speed'] ?? 50,
                'accuracy' => $_POST['accuracy'] ?? 50
            ];
            
            $this->model->updatePokemon($id, $data);
            $_SESSION['message'] = $data['name'] . ' ha sido actualizado exitosamente';
            $_SESSION['message_type'] = 'success';
            $this->redirect();
        }
    }

    public function delete($id) {
        if (!$id) {
            $this->redirect();
        }
        
        $pokemon = $this->model->getPokemonById($id);
        
        if (!$pokemon) {
            $this->redirect();
        }
        
        $data = [
            'pokemon' => $pokemon,
            'url' => $this->base_url
        ];
        $this->load->view('delete.php', $data);
    }

    public function destroy($id) {
        if (!$id) {
            $this->redirect();
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $pokemon = $this->model->getPokemonById($id);
            $name = $pokemon ? $pokemon['name'] : 'Pokemon';
            
            $this->model->deletePokemon($id);
            $_SESSION['message'] = $name . ' ha sido eliminado exitosamente';
            $_SESSION['message_type'] = 'success';
            $this->redirect();
        } else {
            $this->redirect('delete/' . $id);
        }
    }
}