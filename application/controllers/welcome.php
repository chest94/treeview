<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
            //$this->load->view('tree');
            $this->get_unidades();
	}
        
        public function get_unidades()
        {
            $this->db->select('id_unidad as id, id_unidad_padre as parent, nombre_unidad as text');
            $this->db->from('unidad');
            $result = $this->db->get();
            
            foreach($result->result_array() as $row)
            {
                /*$arreglo = array(
                    'id' => $row->id_unidad,
                    'parent' => $row->id_unidad_padre,
                    'text' => $row->nombre_unidad
                );*/
                echo json_encode($row);
            }
            
            //print_r($arreglo);
            
            //echo json_encode($arreglo);
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */