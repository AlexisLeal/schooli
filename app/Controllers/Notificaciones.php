<?php namespace App\Controllers;
use  App\Models\Notificaciones_model;

class Notificaciones extends BaseController{

    public function index()
	{
        $data['page_title'] = "Notificaciones";	
        if($this->session->get('login') && $this->session->get('roll') == 4){
            return view('notificaciones/panel_notificaciones',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }
    



	
    public function agregarnotificacion()
	{
        $data['page_title'] = "Notificaciones";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login') && $this->session->get('roll') == 4){
            return view('notificaciones/crear/agregar_notificacion',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }


    public function insertarnotificacion()
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){
            if(isset($_POST['sbNotificacion'])){
                $REQUEST = \Config\Services::request();
                $hoy = date("Y-m-d H:i:s");
                $data = ['nombre' =>$REQUEST->getPost('nombre'),
                'notificacion' =>$REQUEST->getPost('notificacion'),
                'tipo_usuario' =>$REQUEST->getPost('tipo_usuario'),
                'estatus' => $REQUEST->getPost('estatus'),
                'fecha_inicio' => $REQUEST->getPost('fecha_inicio'),
                'fecha_termina' => $REQUEST->getPost('fecha_termina'),
                'fecha_creacion' => $hoy,
                'fecha_ultimo_cambio' => $hoy,
            ];
            $usermodel = new Notificaciones_model($db);
            $usermodel->insert($data);
            $data = ['Notificaciones'  => 'La notificación se agregro correctamente'];
            $this->session->set($data,true);
            return redirect()->to(site_url('Notificaciones/agregarnotificacion'));
    
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }

}