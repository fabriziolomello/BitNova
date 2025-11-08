<?php
/* @autor Fabrizio Lomello */
require_once __DIR__ . '/../class/autoload.php';

// Instanciamos la clase y obtenemos el listado
$categorias = (new Categorias())->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Listado de Categorías</title>
  <link rel="stylesheet" href="/assets/css/estilos.css">
  <style>
    body { font-family: Arial, sans-serif; background: #fafafa; margin: 0; padding: 0; }
    .contenedor { max-width: 900px; margin: 40px auto; background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 0 10px rgba(0,0,0,.1); }
    h1 { color: #2b4eff; margin-bottom: 20px; text-align: center; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
    th { background: #f5f5f5; }
    .btn-agregar { display: inline-block; padding: 8px 16px; margin-top: 10px; background: #2b4eff; color: #fff; text-decoration: none; border-radius: 8px; }
    .btn-agregar:hover { background: #173ccf; }
    .autor { text-align: center; margin-top: 25px; color: #555; font-weight: 600; }
  </style>
</head>
<body>
  <div class="contenedor">
    <h1>Listado de Categorías</h1>

    <?php if (empty($categorias)): ?>
      <p>No hay categorías cargadas.</p>
    <?php else: ?>
      <table>
        <thead>
          <tr><th>ID</th><th>Nombre</th></tr>
        </thead>
        <tbody>
          <?php foreach ($categorias as $cat): ?>
            <tr>
              <td><?= (int)$cat['id'] ?></td>
              <td><?= htmlspecialchars($cat['nombre']) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>

    <!-- Botón Agregar -->
    <a href="views/categorias.html" class="btn-agregar">Agregar</a>

    <!-- Nombre centrado -->
    <p class="autor">Fabrizio Lomello</p>
  </div>
</body>
</html>