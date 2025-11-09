<?php
/* index.php - BitNova 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
*/
require __DIR__ . '/class/autoload.php';

try {
    $db = new Database();

    // Consulta para traer productos + nombre de categoría
    $sql = "SELECT p.id, p.nombre, p.imagen, p.precio, p.descripcion,
                   c.nombre AS categoria
            FROM productos p
            INNER JOIN categorias c ON c.id = p.categoria_id
            ORDER BY p.id DESC";

    // Usamos el método select() de tu clase Database
    $productos = $db->select($sql);

} catch (Throwable $e) {
    echo "<pre style='padding:20px;background:#111;color:#0f0'>";
    echo 'ERROR: ' . $e->getMessage() . "\n\n";
    echo $e->getFile() . ' : ' . $e->getLine() . "\n";
    echo "</pre>";
    exit;
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>BitNova</title>
  <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body class="home-page">

  <?php include __DIR__ . '/views/home.html'; ?>

  <script>
    // Pasamos los productos al JS
    window.PRODUCTOS = <?= json_encode($productos, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;
    window.BASE = <?= json_encode(dirname($_SERVER['SCRIPT_NAME'])); ?>;
  </script>
  <script src="assets/js/main.js"></script>
</body>
</html>