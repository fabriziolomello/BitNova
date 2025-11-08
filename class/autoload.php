<?php
/* @autor Fabrizio Lomello */

spl_autoload_register(function($clase) {
    $ruta = __DIR__ . '/' . strtolower($clase) . '.php';
    if (file_exists($ruta)) {
        require_once $ruta;
    }
});