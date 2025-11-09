<?php
/* @autor Fabrizio Lomello */
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once __DIR__ . '/../class/autoload.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: views/productos.html');
  exit;
}

// Tomar y normalizar
$nombre       = trim($_POST['nombre'] ?? '');
$imagen       = trim($_POST['imagen'] ?? '');
$precio_raw   = trim($_POST['precio'] ?? '');
$descripcion  = trim($_POST['descripcion'] ?? '');
$id_categoria = trim($_POST['id_categoria'] ?? '');

$precio_raw = str_replace(',', '.', $precio_raw);
$precio     = is_numeric($precio_raw) ? (float)$precio_raw : 0;
$id_cat     = ctype_digit($id_categoria) ? (int)$id_categoria : 0;

// Validación mínima
if ($nombre === '' || $id_cat <= 0) {
  die('Faltan datos: nombre y categoría son obligatorios.');
}

// Sanitizar simple para este TP (tu Database no expone escape)
$nombre      = addslashes($nombre);
$imagen      = addslashes($imagen);
$descripcion = addslashes($descripcion);

// INSERT (id autoincremental)
$sql = "INSERT INTO productos (nombre, imagen, precio, descripcion, categoria_id)
        VALUES ('$nombre', " . ($imagen !== '' ? "'$imagen'" : "NULL") . ",
                $precio, " . ($descripcion !== '' ? "'$descripcion'" : "NULL") . ",
                $id_cat)";

$db = new Database();
$db->insert($sql);

// Volver al listado
header('Location: lista_productos.php');
exit;