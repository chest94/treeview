<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function index() {
        $this->load->view('tree');
        //$this->get_unidades();
    }

    public function get_unidades() {
        $this->db->select('id_unidad as id, id_unidad_padre as parent, nombre_unidad as text');
        $this->db->from('unidad');
        $result = $this->db->get();

        $arreglo = array();

        foreach ($result->result_array() as $row) {
            $arreglo[] = $row;
        }
        echo json_encode($arreglo);
    }

    public function agregar() {

        if (isset($_POST) && !empty($_POST)) {
            $padre = $_POST['padre'];
            $nombre = $_POST['nombre'];

            $unidad = array(
                'nombre_unidad' => $nombre,
                'id_unidad_padre' => $padre
            );

            $this->db->insert('unidad', $unidad);
        }

        echo json_encode(array("msg" => "fin"));
    }

    public function editar() {

        $r = array("estado" => "false");
         
        if (isset($_POST) && !empty($_POST)){
            
            $id = $_POST['id']; // proble here? :v
            $nombre = $_POST['nombre'];
            
           
            $form_data = array(
                "nombre_unidad" => $nombre
            );
            
            $this->db->where('id_unidad', $id);
            $this->db->update('unidad', $form_data);

            if ($this->db->affected_rows() == '1') {
                $r['estado'] = "true";
            }
        
        }
        
        echo json_encode($r);
        
    }

    public function eliminar() {
        if (isset($_POST) && !empty($_POST)) {
            $id = $_POST['id'];

            //$id = 56;
            $r = array("estado" => "false");
            $this->db->select('nombre_unidad');
            $this->db->from('unidad');
            $this->db->where('id_unidad_padre', $id);

            $query = $this->db->get();

            if ($query->num_rows() == 0) {
                $this->db->where('id_unidad', $id);
                $this->db->delete('unidad');
                $r['estado'] = "true";
            }
        }

        echo json_encode($r);
    }

}

?>