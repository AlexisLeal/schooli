<?php namespace App\Controllers;
use  App\Models\Tipo_grupo;
class TiposGrupo extends BaseController{

     
    public function index()
	{
        $data['page_title'] = "tipo de grupo";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login') && $this->session->get('roll') == 4){
            return view('tiposgrupos/panel_tiposgrupos',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
	}
	


    public function agregartipogrupo()
	{	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login') && $this->session->get('roll') == 4){
            $data['page_title'] = "Agregar tipo de grupo";
            return view('tiposgrupos/crear/agregar_tipogrupo',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
	}


    public function vertipogrupo($id_tipogrupo)
	{
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login') && $this->session->get('roll') == 4){
            $data['page_title'] = "Vista detalle tipo grupo";
            $tipogrupo = getNivelEspecificogrupo($id_tipogrupo);
            $data['nombre'] = $tipogrupo->nombre;
            $data['comentarios'] = $tipogrupo->comentarios;
            return view('tiposgrupos/mostrar/ver_tipogrupo',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }
    

    
    public function editartipogrupo($id_tipogrupo)
	{
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login') && $this->session->get('roll') == 4){
            $data['page_title'] = "Editar Tipo de grupo";
            $tipogrupo = getNivelEspecificogrupo($id_tipogrupo);
            $data['nombre'] = $tipogrupo->nombre;
            $data['comentarios'] = $tipogrupo->comentarios;
            $data['idtipogrupo'] = $id_tipogrupo;
            return view('tiposgrupos/editar/editar_tipogrupo',$data);
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
                $idtipogrupo = $REQUEST->getPost('idtipogrupo');
                $usermodel = new Tipo_grupo($db);
                $usermodel->update($idtipogrupo,$data);
                $data = ['Nivel'  => 'El nivel se modifico correctamente'];
                $this->session->set($data,true);
                return redirect()->to(site_url("TiposGrupo/editartipogrupo/$idtipogrupo"));
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
                $idtipogrupo = $REQUEST->getPost('idtipogrupo');
                $usermodel= new Tipo_grupo($db);
                $usermodel->delete(['id'=> $idtipogrupo]);
                return redirect()->to(site_url('TiposGrupo/index'));

            }else{
                return redirect()->to(site_url('Home/salir'));
            }
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
        
    }

}