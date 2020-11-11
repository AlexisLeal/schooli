<?php namespace App\Controllers;
use  App\Models\Cursos_model;

class Cursos extends BaseController{

     
    public function index()
	{
        $data['page_title'] = "Cursos";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
        return view('cursos/panel_cursos',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
	}
	
    public function agregarcurso()
	{
        $data['page_title'] = "Agregar Curso";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
        return view('cursos/crear/agregar_curso',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
	}


    public function vercurso($id_curso)
	{
        if($this->session->get('login')){
            $curso = getCursoEspecifico($id_curso);
            $data['page_title'] = "Vista detalle del Curso";
            $data['nombre'] = $curso->nombre;
            $data['estatus'] = $curso->estatus;
            $data['numero_niveles'] = $curso->num_niveles;
            $data['p_curso'] = $curso->precio;
            $data['p_nivel'] = $curso->precio_por_nivel;
            $data['descripcion'] = $curso->comentarios;
        return view('cursos/mostrar/ver_curso',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }
    

    
    public function editarcurso($id_curso)
	{
       	
        if($this->session->get('login')){
            $data['page_title'] = "Editar Curso";
            $curso = getCursoEspecifico($id_curso);
            $data['page_title'] = "Vista detalle del Curso";
            $data['nombre'] = $curso->nombre;
            $data['estatus'] = $curso->estatus;
            $data['numero_niveles'] = $curso->num_niveles;
            $data['p_curso'] = $curso->precio;
            $data['p_nivel'] = $curso->precio_por_nivel;
            $data['descripcion'] = $curso->comentarios;
            $data['idCr'] = $id_curso;
        return view('cursos/editar/editar_curso',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }



    public function insertarcurso()
    {
        if($this->session->get('login')){
            if(isset($_POST['submitCR'])){
            $REQUEST = \Config\Services::request();
            $hoy = date("Y-m-d H:i:s");
                $data = ['nombre'=>$REQUEST->getPost('nombre'),
                'num_niveles'=>$REQUEST->getPost('numero_niveles'),
                'precio'=>$REQUEST->getPost('p_curso'),
                'precio_por_nivel'=>$REQUEST->getPost('p_nivel'),
                'comentarios'=>$REQUEST->getPost('descripcion'),
                'fecha_creacion'=>$hoy,
                'fecha_ultimo_cambio'=>$hoy,
                'estatus'=>$REQUEST->getPost('estatus'),
             ];
             $usermodel = new Cursos_model($db);
             $usermodel->insert($data);
             $data = ['Curso'  => 'El curso se agregro correctamente'];
            $this->session->set($data,true);

             return redirect()->to(site_url('Cursos/agregarcurso'));


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
            if(isset($_POST['submitCR'])){
            $REQUEST = \Config\Services::request();
            $hoy = date("Y-m-d H:i:s");
                $data = ['nombre'=>$REQUEST->getPost('nombre'),
                'num_niveles'=>$REQUEST->getPost('numero_niveles'),
                'precio'=>$REQUEST->getPost('p_curso'),
                'precio_por_nivel'=>$REQUEST->getPost('p_nivel'),
                'comentarios'=>$REQUEST->getPost('descripcion'),
                'fecha_ultimo_cambio'=>$hoy,
                'estatus'=>$REQUEST->getPost('estatus'),
             ];
             $id_curso = $REQUEST->getPost('idCr');
             $usermodel = new Cursos_model($db);
             $usermodel->update($id_curso,$data);
             $data = ['Curso'  => 'El curso se modifico  correctamente'];
             $this->session->set($data,true);
             return redirect()->to(site_url("Cursos/editarcurso/$id_curso"));


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
            if(isset($_POST['submitCR'])){
            $REQUEST = \Config\Services::request();
            $id_curso = $REQUEST->getPost('idCr');
            $usermodel = new Cursos_model($db);
            $usermodel->delete(['id'=> $id_curso]);
            return redirect()->to(site_url('Curso/index'));
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }



}