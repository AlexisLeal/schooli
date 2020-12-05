<?php namespace App\Controllers;
use  App\Models\Salones_model;

class Salones extends BaseController{

     
    public function index()
	{	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login') && $this->session->get('roll') == 4){
            $data['page_title'] = "Salones";
            return view('salones/panel_salones',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
	}
	

    public function agregarsalon()
	{	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login') && $this->session->get('roll') == 4){
            $data['page_title'] = "Agregar Nivel";
            return view('salones/crear/agregar_salon',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
	}


    public function versalon($id_salon)
	{
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login') && $this->session->get('roll') == 4){
            $data['page_title'] = "Vista detalle Salon";
            $salon = getSalonEspecificogrupo($id_salon);
            $data['nombre'] = $salon->nombre;
            $data['comentarios'] = $salon->comentarios;
            return view('salones/mostrar/ver_salon',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }
    

    
    public function editarsalon($id_salon)
	{
       
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login') && $this->session->get('roll') == 4){
            $salon = getSalonEspecificogrupo($id_salon);
            $data['page_title'] = "Editar Salon";	
            $data['nombre'] = $salon->nombre;
            $data['comentarios'] = $salon->comentarios;
            $data['idSl'] = $id_salon;
            return view('salones/editar/editar_salon',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }




    //Funciones que modifican la base de datos 


    public function insertasalon()
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){
            if(isset($_POST['submitSL'])){
                $REQUEST = \Config\Services::request();
                $hoy = date("Y-m-d H:i:s");
                $data = ['nombre'=>$REQUEST->getPost('nombre'),
                'comentarios'=>$REQUEST->getPost('comentarios'),
                'fecha_creacion'=>$hoy,
                'fecha_ultimo_cambio'=>$hoy,
                ];
                $usermodel = new Salones_model($db);
                $usermodel->insert($data);
                $data = ['Salon'  => 'El Salon se agregro correctamente'];
                $this->session->set($data,true);
                return redirect()->to(site_url('Salones/agregarsalon'));

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
            if(isset($_POST['submitSL'])){
                $REQUEST = \Config\Services::request();
                $hoy = date("Y-m-d H:i:s");
                $data = ['nombre'=>$REQUEST->getPost('nombre'),
                'comentarios'=>$REQUEST->getPost('descripcion'),
                'fecha_ultimo_cambio'=>$hoy,
                ];
                $id_salon = $REQUEST->getPost('idSl');
                $usermodel = new Salones_model($db);
                $usermodel->update($id_salon,$data);
                $data = ['Salon'  => 'El salon se modifico correctamente'];
                $this->session->set($data,true);
                return redirect()->to(site_url("Salones/editarsalon/$id_salon"));
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
            if(isset($_POST['submitSL'])){
                $REQUEST = \Config\Services::request();
                $id_salon = $REQUEST->getPost('idSl');
                $usermodel= new Salones_model($db);
                $usermodel->delete(['id'=> $id_salon]);
                return redirect()->to(site_url('Salones/index'));

            }else{
                return redirect()->to(site_url('Home/salir'));
           }
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
        
    }


}