<?php namespace App\Controllers;
use  App\Models\Tipo_grupo;
class TiposGrupo extends BaseController{

     
    public function index()
	{
        $data['page_title'] = "tipo de grupo";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login') && $this->session->get('roll') == 4){
            return view('niveles/panel_niveles',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
	}
	


    public function agregartipogrupo()
	{	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login') && $this->session->get('roll') == 4){
            $data['page_title'] = "Agregar Nivel";
            return view('niveles/crear/agregar_nivel',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
	}


    public function vertipogrupo($id_nivel)
	{
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login') && $this->session->get('roll') == 4){
            $data['page_title'] = "Vista detalle Nivel";
            $nivel = getNivelEspecificogrupo($id_nivel);
            $data['nombre'] = $nivel->nombre;
            $data['comentarios'] = $nivel->comentarios;
            return view('niveles/mostrar/ver_niveles',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }
    

    
    public function editartipogrupo($id_nivel)
	{
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login') && $this->session->get('roll') == 4){
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

    public function insertartipogrupo()
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){
            if(isset($_POST['submitNV'])){
                $REQUEST = \Config\Services::request();
                $hoy = date("Y-m-d H:i:s");
                $data = ['nombre'=>$REQUEST->getPost('nombre'),
                'comentarios'=>$REQUEST->getPost('comentarios'),
                'fecha_creacion'=>$hoy,
                'fecha_ultimo_cambio'=>$hoy,
                ];
                $usermodel = new Tipo_grupo($db);
                $usermodel->insert($data);
                $data = ['Nivel'  => 'El nivel se agregro correctamente'];
                $this->session->set($data,true);
                return redirect()->to(site_url('TiposGrupo/agregartipogrupo'));
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
            if(isset($_POST['submitNV'])){
                $REQUEST = \Config\Services::request();
                $hoy = date("Y-m-d H:i:s");
                $data = ['nombre'=>$REQUEST->getPost('nombre'),
                'comentarios'=>$REQUEST->getPost('descripcion'),
                'fecha_ultimo_cambio'=>$hoy,
                ];
                $id_nivel = $REQUEST->getPost('idNv');
                $usermodel = new Tipo_grupo($db);
                $usermodel->update($id_nivel,$data);
                $data = ['Nivel'  => 'El nivel se modifico correctamente'];
                $this->session->set($data,true);
                return redirect()->to(site_url("TiposGrupo/editartipogrupo/$id_nivel"));
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
            if(isset($_POST['submitNV'])){
                $REQUEST = \Config\Services::request();
                $id_nivel = $REQUEST->getPost('idNv');
                $usermodel= new Tipo_grupo($db);
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