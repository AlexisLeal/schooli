<?php namespace App\Controllers;
use  App\Models\Valor_asistencia_model;

class Valor_Asistencia extends BaseController{

    public function index()
	{	
        if($this->session->get('login') && $this->session->get('roll') == 4){

            return view('');
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }
    
    public function insertarvalorasistencia()
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){
            if(isset($_POST[''])){
                $REQUEST = \Config\Services::request();
                $UseModelValorAsistencia = new Valor_asistencia_model($db);
                $data = [];

                $UseModelValorAsistencia->insert($data);
            }

            return redirect()->to(site_url('Asistencia/index'));
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }
       
    
	




}