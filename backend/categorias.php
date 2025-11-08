<?php
/* @autor Fabrizio Lomello */
require_once __DIR__ . '/../class/autoload.php';

// Solo aceptamos POST desde el formulario
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: views/categorias.html'); // relativo a /backend
  exit;
}

// Tomar y sanitizar campos (¡ojo al name!)
$nombre = trim($_POST['nombre_categoria'] ?? '');

// Validación mínima
if ($nombre === '') {
  header('Location: views/categorias.html'); // vuelve al form si faltan datos
  exit;
}

// Crear objeto y guardar
$cat = new Categorias(null, $nombre);
$cat->guardar();

// Redirigir al listado dinámico
header('Location: lista_categorias.php'); // relativo a /backend
exit;