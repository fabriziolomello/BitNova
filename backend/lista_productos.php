<?php
/* @autor Fabrizio Lomello */
require_once __DIR__ . '/../class/autoload.php';

// Instanciamos la clase y obtenemos el listado
$productos = (new Productos())->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Listado de Productos</title>
  <link rel="stylesheet" href="/assets/css/estilos.css">
  <style>
    body { font-family: Arial, sans-serif; background: #fafafa; margin: 0; padding: 0; }
    .contenedor { max-width: 1000px; margin: 40px auto; background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 0 10px rgba(0,0,0,.1); }
    h1 { color: #2b4eff; margin-bottom: 20px; text-align: center; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th, td { border: 1px solid #ddd; padding: 10px; text-align: left; vertical-align: top; }
    th { background: #f5f5f5; }
    img { max-width: 90px; border-radius: 6px; }
    .btn-agregar { display: inline-block; padding: 8px 16px; margin-top: 10px; background: #2b4eff; color: #fff; text-decoration: none; border-radius: 8px; }
    .btn-agregar:hover { background: #173ccf; }
    .autor { text-align: center; margin-top: 25px; color: #555; font-weight: 600; }
  </style>
</head>
<body>
  <div class="contenedor">
    <h1>Listado de Productos</h1>

    <?php if (empty($productos)): ?>
      <p>No hay productos cargados.</p>
    <?php else: ?>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Imagen</th>
            <th>Precio</th>
            <th>Categoría</th>
            <th>Descripción</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($productos as $p): ?>
            <tr>
              <td><?= (int)$p['id'] ?></td>
              <td><?= htmlspecialchars($p['nombre']) ?></td>
              <td>
                <?php if (!empty($p['imagen'])): ?>
                  <img src="<?= htmlspecialchars($p['imagen']) ?>" alt="Imagen del producto">
                <?php else: ?>
                  <span>Sin imagen</span>
                <?php endif; ?>
              </td>
              <td>$ <?= number_format((float)$p['precio'], 2, ',', '.') ?></td>
              <td><?= htmlspecialchars($p['categoria']) ?></td>
              <td><?= nl2br(htmlspecialchars($p['descripcion'] ?? '')) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>

    <!-- Botón Agregar -->
    <a href="views/productos.html" class="btn-agregar">Agregar</a>

    <!-- Nombre centrado -->
    <p class="autor">Fabrizio Lomello</p>
  </div>
</body>
</html>