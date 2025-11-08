<?php
/* @autor Fabrizio Lomello */

class Categorias {
    private $db;
    public $id;
    public $nombre;

    public function __construct($id = null, $nombre = null) {
        $this->db = new Database();
        $this->id = $id;
        $this->nombre = $nombre;
    }

    public function guardar() {
        if ($this->id) {
            // Si ya existe, actualiza
            $sql = "UPDATE categorias SET nombre='$this->nombre' WHERE id=$this->id";
            return $this->db->update($sql);
        } else {
            // Si no existe, inserta
            $sql = "INSERT INTO categorias (nombre) VALUES ('$this->nombre')";
            return $this->db->insert($sql);
        }
    }

    public function eliminar() {
        $sql = "DELETE FROM categorias WHERE id=$this->id";
        return $this->db->delete($sql);
    }

    public function listar() {
        $sql = "SELECT * FROM categorias ORDER BY id DESC";
        return $this->db->select($sql);
    }
}