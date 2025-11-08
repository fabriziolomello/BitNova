<?php
/* @autor Fabrizio Lomello */

class Productos {
    private $db;
    public $id;
    public $nombre;
    public $imagen;
    public $precio;
    public $descripcion;
    public $categoria_id;

    public function __construct($id = null, $nombre = null, $imagen = null, $precio = null, $descripcion = null, $categoria_id = null) {
        $this->db = new Database();
        $this->id = $id;
        $this->nombre = $nombre;
        $this->imagen = $imagen;
        $this->precio = $precio;
        $this->descripcion = $descripcion;
        $this->categoria_id = $categoria_id;
    }

    public function guardar() {
        if ($this->id) {
            $sql = "UPDATE productos 
                    SET nombre='$this->nombre', imagen='$this->imagen', precio=$this->precio, 
                        descripcion='$this->descripcion', categoria_id=$this->categoria_id
                    WHERE id=$this->id";
            return $this->db->update($sql);
        } else {
            $sql = "INSERT INTO productos (nombre, imagen, precio, descripcion, categoria_id)
                    VALUES ('$this->nombre', '$this->imagen', $this->precio, '$this->descripcion', $this->categoria_id)";
            return $this->db->insert($sql);
        }
    }

    public function eliminar() {
        $sql = "DELETE FROM productos WHERE id=$this->id";
        return $this->db->delete($sql);
    }

    public function listar() {
        $sql = "SELECT p.*, c.nombre AS categoria
                FROM productos p
                JOIN categorias c ON p.categoria_id = c.id
                ORDER BY p.id DESC";
        return $this->db->select($sql);
    }
}