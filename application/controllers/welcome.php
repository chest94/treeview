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
            /*$form_data = array(
                        'ID_PLAN_OPERATIVO' => 'plan_operativo',
                        'TIPO_EVALUACION' => 'tipo_evaluacion',
                        'PONDERACION_OBJETIVOS' => 'ponderacion_objetivos',
                        'PONDERACION_COMPETENCIAS' => 'ponderacion_competencias',
                        'USUARIO_CREACION' => 'NOMBRE_USUARIO'
                    );
            echo json_encode($form_data);*/
            //$this->load->view('tree');
            $this->get_unidades();
	}
        
        public function get_unidades()
        {
            $this->db->select('id_unidad, id_unidad_padre, nombre_unidad');
            $this->db->from('unidad');
            $result = $this->db->get();
            
            $arreglo = array();
            
            foreach($result->result_array() as $row)
            {
                $arreglo[] = $row;
            }
            
            //print_r($arreglo);
            
            echo json_encode($arreglo);
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */