<?php
/* @autor Fabrizio Lomello */
require_once __DIR__ . '/../class/autoload.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: views/productos.html'); // relativo a /backend
  exit;
}

// Tomar y sanitizar campos (match exacto con los name del formulario)
$id_producto  = trim($_POST['id_producto'] ?? '');
$nombre       = trim($_POST['nombre'] ?? '');
$imagen       = trim($_POST['imagen'] ?? '');
$precio_raw   = trim($_POST['precio'] ?? '');
$descripcion  = trim($_POST['descripcion'] ?? '');
$id_categoria = trim($_POST['id_categoria'] ?? '');

// Normalizar precio (acepta coma o punto)
$precio_raw = str_replace(',', '.', $precio_raw);
$precio = is_numeric($precio_raw) ? (float)$precio_raw : null;

// Normalizar IDs
$id = ($id_producto !== '' && ctype_digit($id_producto)) ? (int)$id_producto : null;
$categoria_id = ctype_digit($id_categoria) ? (int)$id_categoria : null;

// Validación mínima requerida por la BD
if ($nombre === '' || $precio === null || $categoria_id === null) {
  header('Location: views/productos.html'); // vuelve al form si faltan datos
  exit;
}

// Crear objeto y guardar
$prod = new Productos(
  $id,                                // id (null para alta, número para edición)
  $nombre,
  $imagen !== '' ? $imagen : null,    // opcional
  $precio,
  $descripcion !== '' ? $descripcion : null, // opcional
  $categoria_id
);

$prod->guardar();

// Redirigir al listado dinámico
header('Location: lista_productos.php'); // relativo a /backend
exit;