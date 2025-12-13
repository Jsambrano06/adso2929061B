<?php 
// index.php - Punto de entrada principal con routing
session_start();

// Cargar las clases necesarias
require_once 'application/database.php';
require_once 'application/model.php';
require_once 'application/load.php';
require_once 'application/controller.php';

// Obtener la URI actual y limpiarla
$request = $_SERVER['REQUEST_URI'];
$base_path = '/18-mvc/';

// Remover el base path de la URL
$url = str_replace($base_path, '', $request);

// Remover query string si existe
$url = strtok($url, '?');

// Limpiar la URL
$url = trim($url, '/');

// Dividir la URL en partes
$params = $url ? explode('/', $url) : [];

// Determinar la acción y el ID
$action = isset($params[0]) && $params[0] !== '' ? $params[0] : 'index';
$id = isset($params[1]) ? $params[1] : null;

// Crear instancia del controlador con los parámetros
new Controller($action, $id);