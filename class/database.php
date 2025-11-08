<?php
/* @autor Fabrizio Lomello */

class Database {
    private $conexion;

    public function __construct() {
        $this->conexion = new mysqli("localhost", "root", "", "miproyecto");
        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    }

    // --- INSERT ---
    public function insert($sql) {
        if ($this->conexion->query($sql)) {
            return $this->conexion->insert_id;
        } else {
            die("Error en INSERT: " . $this->conexion->error);
        }
    }

    // --- UPDATE ---
    public function update($sql) {
        if ($this->conexion->query($sql)) {
            return true;
        } else {
            die("Error en UPDATE: " . $this->conexion->error);
        }
    }

    // --- DELETE ---
    public function delete($sql) {
        if ($this->conexion->query($sql)) {
            return true;
        } else {
            die("Error en DELETE: " . $this->conexion->error);
        }
    }

    // --- SELECT ---
    public function select($sql) {
        $resultado = $this->conexion->query($sql);
        if ($resultado && $resultado->num_rows > 0) {
            return $resultado->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }
}