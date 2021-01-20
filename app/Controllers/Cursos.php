<?php namespace App\Controllers;
use  App\Models\Cursos_model;
use  App\Models\Frecuencia_model;

class Cursos extends BaseController{

     
    public function index()
	{
        if($this->session->get('login') && $this->session->get('roll') == 4){

            $data['page_title'] = "Cursos";	

            return view('cursos/panel_cursos',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }
    


    

    
    public function agregarcurso()
	{
        if($this->session->get('login') && $this->session->get('roll') == 4){

            $data['page_title'] = "Agregar Curso";

            return view('cursos/crear/agregar_curso',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
	}

    public function vercurso($id_curso)
	{
        if($this->session->get('login') && $this->session->get('roll') == 4){

            $curso = getCursoEspecifico($id_curso);
            $data['page_title'] = "Vista detalle del Curso";
            $data['nombre'] = $curso->nombre;
            $data['estatus'] = $curso->estatus;
            $data['numero_niveles'] = $curso->num_niveles;
            
            $data['total_dias_laborales'] = $curso->total_dias_laborales;
            $data['id_frecuencia'] = $curso->id_frecuencia;
            $data['num_examenes'] = $curso->num_examenes;
            $data['num_ejercicios'] = $curso->num_ejercicios;
            $data['valor_asistencia'] = $curso->valor_asistencia;
            $data['valor_ejercicios'] = $curso->valor_ejercicios;
            $data['valor_examenes'] = $curso->valor_examenes;

            return view('cursos/mostrar/ver_curso',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }
    
    public function editarcurso($id_curso)
	{
        if($this->session->get('login') && $this->session->get('roll') == 4){
            $data['page_title'] = "Editar Curso";
            $curso = getCursoEspecifico($id_curso);
            $data['page_title'] = "Vista detalle del Curso";
            $data['nombre'] = $curso->nombre;
            $data['estatus'] = $curso->estatus;
            $data['numero_niveles'] = $curso->num_niveles;

            $data['idCr'] = $id_curso;
            
            return view('cursos/editar/editar_curso',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }

    public function cursosrecursos($id_curso)
	{
        if($this->session->get('login') && $this->session->get('roll') == 4){

            $data['id_curso'] = $id_curso;	
            return view('cursos/cursos_recursos_asignados',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }
    

    public function insertarcurso()
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){
            if(isset($_POST['submitCR'])){
                $REQUEST = \Config\Services::request();
                $hoy = date("Y-m-d H:i:s");

                $data = ['nombre'=>$REQUEST->getPost('nombre'),
                'num_niveles'=>$REQUEST->getPost('numero_niveles'),
                'total_dias_laborales'=>$REQUEST->getPost('dias'),
                'id_frecuencia'=>$REQUEST->getPost('frecuencia'),
                'num_examenes'=>$REQUEST->getPost('num_examenes'),
                'num_ejercicios'=>$REQUEST->getPost('num_ejercicios'),
                'valor_asistencia'=>$REQUEST->getPost('valor_total_asistencia'),
                'valor_ejercicios'=>$REQUEST->getPost('valor_total_ejercicios'),
                'valor_examenes'=>$REQUEST->getPost('valor_total_examanes'),
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
        if($this->session->get('login') && $this->session->get('roll') == 4){
            if(isset($_POST['submitCR'])){

                $REQUEST = \Config\Services::request();
                $hoy = date("Y-m-d H:i:s");

                $data = ['nombre'=>$REQUEST->getPost('nombre'),
                'num_niveles'=>$REQUEST->getPost('numero_niveles'),

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
        if($this->session->get('login') && $this->session->get('roll') == 4){
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

    public function AjaxObtenerNumeroSesiones()
    {
        $REQUEST = \Config\Services::request();
        $IdFrecuencia = $REQUEST->getPost('IdFrecuencia');
        $NumeroSesiones = $REQUEST->getPost('NumeroSesiones');
        if($IdFrecuencia != 0){
            
            $UseModelFrecuencia = new Frecuencia_model($db);
            $UseModelFrecuencia->select('(lunes+martes+miercoles+jueves+viernes+sabado+domingo) as suma');
            $UseModelFrecuencia->where('id',$IdFrecuencia);
            $UseModelFrecuencia->where('deleted',0);
            $Query = $UseModelFrecuencia->get();
            $Resultado = $Query->getRow();
            $Suma = $Resultado->suma; 
            
        }else{
            $Suma = 0;
        }
        echo $Suma*$NumeroSesiones;
    }
    public function AjaxObtenerNumerodeDiasdeFrecuencia()
    {
        $REQUEST = \Config\Services::request();
        $IdFrecuencia = $REQUEST->getPost('IdFrecuencia');
        if($IdFrecuencia != 0){
            $UseModelFrecuencia = new Frecuencia_model($db);
            $UseModelFrecuencia->select('(lunes+martes+miercoles+jueves+viernes+sabado+domingo) as suma');
            $UseModelFrecuencia->where('id',$IdFrecuencia);
            $UseModelFrecuencia->where('deleted',0);
            $Query = $UseModelFrecuencia->get();
            $Resultado = $Query->getRow();
            $dias = $Resultado->suma; 
            
        }else{
            $dias = 0;
        }
        echo $dias;
    }


}