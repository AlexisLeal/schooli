<?php namespace App\Controllers;
use  App\Models\Ciclos_model;

class Ciclos extends BaseController{

     
    public function index()
	{
        $data['page_title'] = "Ciclos";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
        return view('ciclos/panel_ciclos',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
	}
	
    public function agregarciclo()
	{
        $data['page_title'] = "Agregar un Ciclo";
        if($this->session->get('login')){
        $data['page_title'] = "Ciclo";	
        return view('ciclos/crear/agregar_ciclo',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }

    public function verciclo()
	{
        $data['page_title'] = "Agregar un Ciclo";
        if($this->session->get('login')){
        $data['page_title'] = "Alumnos";	
        return view('ciclos/mostrar/ver_ciclo',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }

    public function editarciclo()
	{
        $data['page_title'] = "Agregar un Ciclo";
        if($this->session->get('login')){
        $data['page_title'] = "Alumnos";	
        return view('ciclos/editar/editar_ciclo',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }

//Funciones que modifica la base de datos 

public function insertarCiclo()
{
    if($this->session->get('login')){
        if(isset($_POST['submitCL'])){
            $REQUEST = \Config\Services::request();
            $hoy = date("Y-m-d H:i:s");
            $data = ['nombre' =>$REQUEST->getPost('nombre'),
            'estatus' =>$REQUEST->getPost('estatus'),
            'fecha_inicio' =>$REQUEST->getPost('fechaInicio'),
            'fecha_fin' =>$REQUEST->getPost('fechaFIn'),
            'comentarios' =>$REQUEST->getPost('descripcion'),
            'fecha_creacion' =>$hoy,
            'fecha_ultimo_cambio' =>$hoy,
            'usuario_creo' => $this->session->get('id'),
            'usuario_modifico' => $this->session->get('id'),
        ];

        $usermodel_C = new Ciclos_model($db);
        $usermodel_C->insert($data);
        $data = ['Ciclo'  => 'El Ciclo se agregro correctamente'];
        $this->session->set($data,true);
        return redirect()->to(site_url('Ciclos/agregarciclo'));

    }else{
        return redirect()->to(site_url('Home/salir'));
       }
    }else{
        return redirect()->to(site_url('Home/salir'));
       }
}





}