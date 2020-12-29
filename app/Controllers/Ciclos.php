<?php namespace App\Controllers;
use  App\Models\Ciclos_model;

class Ciclos extends BaseController{

     
    public function index()
	{
        if($this->session->get('login') && $this->session->get('roll') == 4){
            $data['page_title'] = "Ciclos";	
            
            return view('ciclos/panel_ciclos',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
	} 
	
    public function agregarciclo()
	{
        if($this->session->get('login') && $this->session->get('roll') == 4){
            $data['page_title'] = "Agregar un Ciclo";

            return view('ciclos/crear/agregar_ciclo',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }

    public function verciclo($id_ciclo)
	{   
        if($this->session->get('login') && $this->session->get('roll') == 4){
            $ciclo = getCicloEspecifico($id_ciclo);

            $data['nombre'] = $ciclo->nombre;
            $data['estatus'] = ($ciclo->estatus==1) ? "Activo" : "Inactivo";
            $data['fechaInicio'] = $ciclo->fecha_inicio;
            $data['fechaFin'] = $ciclo->fecha_fin;
            $data['comentarios'] = $ciclo->comentarios;
            $data['page_title'] = "Ver Ciclo";	      

            return view('ciclos/mostrar/ver_ciclo',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }

    public function editarciclo($id_ciclo)
	{
        if($this->session->get('login') && $this->session->get('roll') == 4){
           
            $ciclo = getCicloEspecifico($id_ciclo);
            $data['nombre'] = $ciclo->nombre;
            $data['estatus'] = $ciclo->estatus;
            $data['fechaInicio'] = $ciclo->fecha_inicio;
            $data['fechaFin'] = $ciclo->fecha_fin;
            $data['comentarios'] = $ciclo->comentarios; 
            $data['idCiclo'] = $id_ciclo; 
            $data['page_title'] = "Editar";	

            return view('ciclos/editar/editar_ciclo',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }

    public function insertarCiclo()
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){
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

    public function editar()
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){
            if(isset($_POST['submitCL'])){
                $REQUEST = \Config\Services::request();
                $hoy = date("Y-m-d H:i:s");

                $data = ['nombre' =>$REQUEST->getPost('nombre'),
                'estatus' =>$REQUEST->getPost('estatus'),
                'fecha_inicio' =>$REQUEST->getPost('fechaInicio'),
                'fecha_fin' =>$REQUEST->getPost('fechaFIn'),
                'comentarios' =>$REQUEST->getPost('descripcion'),
                'fecha_ultimo_cambio' =>$hoy,
                'usuario_modifico' => $this->session->get('id'),
                ];

                $id_ciclo = $REQUEST->getPost('idCiclo');

                $usermodel_C = new Ciclos_model($db);
                $usermodel_C->update($id_ciclo,$data);

                $data = ['Ciclo'  => 'El Ciclo se actualizo correctamente'];
                $this->session->set($data,true);

                return redirect()->to(site_url("Ciclos/editarciclo/$id_ciclo"));
            }else{
                return redirect()->to(site_url('Home/salir'));
           }
        }else{
            return redirect()->to(site_url('Home/salir'));
       }

    }

    public function eliminar()
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){
            if(isset($_POST['submitCL'])){

                $REQUEST = \Config\Services::request();
                $id_ciclo = $REQUEST->getPost('idCiclo');

                $usermodel_C = new Ciclos_model($db);
                $usermodel_C->delete(['id'=> $id_ciclo]);

                return redirect()->to(site_url('Ciclos/index'));
            }else{
                return redirect()->to(site_url('Home/salir'));
            }
        }else{
            return redirect()->to(site_url('Home/salir'));
       }
    }

    public function AjaxCiclos()
    {
       $REQUEST = \Config\Services::request();
        $FechaInicio = new DateTime ($REQUEST->getPost('FechaInicio'));
        $FechaFin = new DateTime ($REQUEST->getPost('FechaFin'));
        $Intervarlo = $FechaInicio->diff($FechaFin);
        $No_Semanas = floor($Intervarlo->format('%a')/7).'Semanas';

        echo  "<input type=text id=No.Semanas class=form-control form-control-sm value= $No_Semanas>";

        
        
    }

}