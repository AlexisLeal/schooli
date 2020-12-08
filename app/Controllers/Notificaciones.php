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


    /*
    public function verfrecuencia($id_frecuencia)
	{
        if($this->session->get('login') && $this->session->get('roll') == 4){
            $frecuencia = getFrencueciaEspecifica($id_frecuencia);
            $nombremodalidad = getModalidadEspecifica($frecuencia->id_modalidad);
            $data['nombre'] = $frecuencia->nombre;
            $data['descripcion'] = $frecuencia->descripcion;
            $data['modalidad'] = $nombremodalidad->nombre;
            $data['lunes'] = $frecuencia->lunes;
            $data['martes'] = $frecuencia->martes;
            $data['miercoles'] = $frecuencia->miercoles;
            $data['jueves'] = $frecuencia->jueves;
            $data['viernes'] = $frecuencia->viernes;
            $data['sabado'] = $frecuencia->sabado;
            $data['domingo'] = $frecuencia->domingo;
            $data['estatus'] = ($frecuencia->estatus == 1) ?  "Activo" : "Inactivo";
            $data['page_title'] = "Frecuencias";
            return view('frecuencias/mostrar/ver_frecuencia',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }*/



    /*
    public function editarfrecuencia($id_frecuencia)
	{
        if($this->session->get('login') && $this->session->get('roll') == 4){
            $data['page_title'] = "Frecuencias";
            $frecuencia = getFrencueciaEspecifica($id_frecuencia);
            $data['nombre'] = $frecuencia->nombre;
            $data['descripcion'] = $frecuencia->descripcion;
            $data['modalidad'] = $frecuencia->id_modalidad;
            $data['lunes'] = $frecuencia->lunes;
            $data['martes'] = $frecuencia->martes;
            $data['miercoles'] = $frecuencia->miercoles;
            $data['jueves'] = $frecuencia->jueves;
            $data['viernes'] = $frecuencia->viernes;
            $data['sabado'] = $frecuencia->sabado;
            $data['domingo'] = $frecuencia->domingo;
            $data['estatus'] = $frecuencia->estatus;
            $data['idFr'] = $id_frecuencia;
            return view('frecuencias/editar/editar_frecuencia',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }*/
    





/*
    public function editar()
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){
            if(isset($_POST['submitFR'])){
                $REQUEST = \Config\Services::request();
                $hoy = date("Y-m-d H:i:s");
                $data = ['nombre' =>$REQUEST->getPost('nombre'),
                'id_modalidad' =>$REQUEST->getPost('modalidad'),
                'descripcion' =>$REQUEST->getPost('descripcion'),
                'lunes' =>(empty($REQUEST->getPost('lunes'))) ? 0 :$REQUEST->getPost('lunes'),
                'martes' =>(empty($REQUEST->getPost('martes'))) ? 0 :$REQUEST->getPost('martes'),
                'miercoles' =>(empty($REQUEST->getPost('miercoles'))) ? 0 :$REQUEST->getPost('miercoles'),
                'jueves' =>(empty($REQUEST->getPost('jueves'))) ? 0 :$REQUEST->getPost('jueves'),
                'viernes' => (empty($REQUEST->getPost('viernes'))) ? 0 :$REQUEST->getPost('viernes'),
                'sabado' => (empty($REQUEST->getPost('sabado'))) ? 0 :$REQUEST->getPost('sabado'),
                'domingo' => (empty($REQUEST->getPost('domingo'))) ? 0 :$REQUEST->getPost('domingo'),
                'estatus' => $REQUEST->getPost('estatus'),
                'fecha_ultimo_cambio' => $hoy,
            ];
            $id_frecuencia = $REQUEST->getPost('idFr');
            $usermodel = new Frecuencia_model($db);
            $usermodel->update($id_frecuencia,$data);
            $data = ['Frecuencia'  => 'El Frecuencia  se actualizado correctamente'];
            $this->session->set($data,true);
            return redirect()->to(site_url("Frecuencia/editarfrecuencia/$id_frecuencia"));
    
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
       
    }*/

/*
    public function eliminar()
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){
            if(isset($_POST['submitFR'])){
                $REQUEST = \Config\Services::request();
                $id_frecuencia = $REQUEST->getPost('idFr');
                $usermodel = new Frecuencia_model($db);
                $usermodel->delete(['id'=> $id_frecuencia]);
                return redirect()->to(site_url('Frecuencia/index'));
            }else{
                return redirect()->to(site_url('Home/salir'));
            }
        }else{
            return redirect()->to(site_url('Home/salir'));
        
        }
    }*/


}