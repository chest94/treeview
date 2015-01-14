<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Welcome extends CI_Controller {
	public function index()
	{
            $this->load->view('tree');
            //$this->get_unidades();
	}
        
        public function get_unidades()
        {
            $this->db->select('id_unidad as id, id_unidad_padre as parent, nombre_unidad as text');
            $this->db->from('unidad');
            $result = $this->db->get();
            
            $arreglo = array();
            
            foreach($result->result_array() as $row)
            {
                $arreglo[] = $row;
            }
            echo json_encode($arreglo);
        }
        
        public function agregar()
        {
            
        }
    }
?>