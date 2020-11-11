<?php namespace App\Controllers;
use  App\Models\Horarios_model;
class Horarios extends BaseController{

     
    public function index()
	{
        $data['page_title'] = "Horarios";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
        return view('horarios/panel_horarios',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
	}
	

    public function agregarhorario()
	{
        $data['page_title'] = "Agregar Horario";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
        return view('horarios/crear/agregar_horario',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
	}


    public function verhorario($id_horario)
	{
        $data['page_title'] = "Vista detalle de Horario";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
         $data['page_title'] = "Vista detalle de Horario";
         $horario = getHorarioEspecifico($id_horario);
         $data['nombre'] = $horario->nombre;
         $data['estatus'] = ($horario->estatus == 1) ? "Activo" : "Inactivo" ;
         $data['horaInicio'] = $horario->hora_inicio;
         $data['horaFin'] = $horario->hora_fin;
         $data['comentarios'] = $horario->comentarios; 
        return view('horarios/mostrar/ver_horarios',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }
    

    
    public function editarhorario($id_horario)
	{
        $data['page_title'] = "Vista detalle de Horario";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
         $data['page_title'] = "Vista detalle de Horario";
         $horario = getHorarioEspecifico($id_horario);
         $data['nombre'] = $horario->nombre;
         $data['estatus'] = $horario->estatus;
         $data['horaInicio'] = $horario->hora_inicio;
         $data['horaFin'] = $horario->hora_fin;
         $data['comentarios'] = $horario->comentarios; 
         $data['idHO'] = $id_horario; 
        return view('horarios/editar/editar_horarios',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
    }
}



//Funciones para modificar la base de datos 

public function insertarHorario()
{
    if($this->session->get('login')){     
        if(isset($_POST['submitHO'])){
            $REQUEST = \Config\Services::request();
                $hoy = date("Y-m-d H:i:s");
                $data = ['nombre' =>$REQUEST->getPost('nombre'),
                'hora_inicio' =>$REQUEST->getPost('horaInicio'),
                'hora_fin' =>$REQUEST->getPost('horaFin'),
                'comentarios' =>$REQUEST->getPost('descripcion'),
                'fecha_creacion' =>$hoy,
                'fecha_ultimo_cambio' =>$hoy,
                'estatus' =>$REQUEST->getPost('estatus'),
            ];
            $usermodel = new Horarios_model($db);
            $usermodel->insert($data);
            $data = ['Horario'  => 'El Horario se agregro correctamente'];
             $this->session->set($data,true);
             return redirect()->to(site_url('Horarios/agregarhorario'));




        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }else{
        return redirect()->to(site_url('Home/salir'));
    }
  
}
public function editar()
{
    if($this->session->get('login')){     
        if(isset($_POST['submitHO'])){
            $REQUEST = \Config\Services::request();
                $hoy = date("Y-m-d H:i:s");
                $data_horario = ['nombre' =>$REQUEST->getPost('nombre'),
                'hora_inicio' =>$REQUEST->getPost('horaInicio'),
                'hora_fin' =>$REQUEST->getPost('horaFin'),
                'comentarios' =>$REQUEST->getPost('descripcion'),
                'fecha_creacion' =>$hoy,
                'fecha_ultimo_cambio' =>$hoy,
                'estatus' =>$REQUEST->getPost('estatus'),
            ];
            $id_horario = $REQUEST->getPost('idHO');
            $usermodel = new Horarios_model($db);
            $usermodel->update($id_horario,$data_horario);
            $data = ['Horario'  => 'El Horario se modifico correctamente'];
             $this->session->set($data,true);
             return redirect()->to(site_url("Horarios/editarhorario/$id_horario"));

        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }else{
        return redirect()->to(site_url('Home/salir'));
    }
  
}







}