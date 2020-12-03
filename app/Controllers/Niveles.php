<?php namespace App\Controllers;
use  App\Models\Niveles_grupo;
class Niveles extends BaseController{

     
    public function index()
	{
        $data['page_title'] = "Niveles";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
            return view('niveles/panel_niveles',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
	}
	


    public function agregarnivel()
	{	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
            $data['page_title'] = "Agregar Nivel";
            return view('niveles/crear/agregar_nivel',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
	}


    public function vernivel($id_nivel)
	{
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
            $data['page_title'] = "Vista detalle Nivel";
            $nivel = getNivelEspecificogrupo($id_nivel);
            $data['nombre'] = $nivel->nombre;
            $data['comentarios'] = $nivel->comentarios;
            return view('niveles/mostrar/ver_niveles',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }
    

    
    public function editarnivel($id_nivel)
	{
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
            $data['page_title'] = "Editar Nivel";
            $nivel = getNivelEspecificogrupo($id_nivel);
            $data['nombre'] = $nivel->nombre;
            $data['comentarios'] = $nivel->comentarios;
            $data['idNv'] = $id_nivel;
            return view('niveles/editar/editar_niveles',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }



    //Funciones para editar la base de datos

    public function insertarnivel()
    {
        if($this->session->get('login')){
            if(isset($_POST['submitNV'])){
                $REQUEST = \Config\Services::request();
                $hoy = date("Y-m-d H:i:s");
                $data = ['nombre'=>$REQUEST->getPost('nombre'),
                'comentarios'=>$REQUEST->getPost('comentarios'),
                'fecha_creacion'=>$hoy,
                'fecha_ultimo_cambio'=>$hoy,
                ];
                $usermodel = new Niveles_grupo($db);
                $usermodel->insert($data);
                $data = ['Nivel'  => 'El nivel se agregro correctamente'];
                $this->session->set($data,true);
                return redirect()->to(site_url('Niveles/agregarnivel'));
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
            if(isset($_POST['submitNV'])){
                $REQUEST = \Config\Services::request();
                $hoy = date("Y-m-d H:i:s");
                $data = ['nombre'=>$REQUEST->getPost('nombre'),
                'comentarios'=>$REQUEST->getPost('descripcion'),
                'fecha_ultimo_cambio'=>$hoy,
                ];
                $id_nivel = $REQUEST->getPost('idNv');
                $usermodel = new Niveles_grupo($db);
                $usermodel->update($id_nivel,$data);
                $data = ['Nivel'  => 'El nivel se modifico correctamente'];
                $this->session->set($data,true);
                return redirect()->to(site_url("Niveles/editarnivel/$id_nivel"));
            }else{
                return redirect()->to(site_url('Home/salir'));
            }
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
        
    }


    public function eliminar()
    {
        if($this->session->get('login')){
            if(isset($_POST['submitNV'])){
                $REQUEST = \Config\Services::request();
                $id_nivel = $REQUEST->getPost('idNv');
                $usermodel= new Niveles_grupo($db);
                $usermodel->delete(['id'=> $id_nivel]);
                return redirect()->to(site_url('Niveles/index'));

            }else{
                return redirect()->to(site_url('Home/salir'));
            }
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
        
    }

}