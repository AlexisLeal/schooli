<?php namespace App\Controllers;
use  App\Models\Grupos_recursos_model;
use  App\Models\Grupos_teachers_model;
use  App\Models\Grupos_alumnos_model;
use  App\Models\Grupos_evaluaciones_model;

class Asignacion extends BaseController{
	
	
//Vistas
     public function alumnos($id_grupo,$id_unidad_negocio,$id_plantel)
    {

        if($this->session->get('login')){
            $data['id_grupo'] = $id_grupo;
            $data['id_unidad_negocio'] = $id_unidad_negocio;
            $data['id_plantel'] = $id_plantel;
        return view('grupos/asignacion/alumno',$data);
    }else{
        return redirect()->to(site_url('Home/salir'));
       }

    }

    public function teacher($id_grupo,$id_unidad_negocio,$id_plantel)
    {
        if($this->session->get('login')){
            $data['id_grupo'] = $id_grupo;
            $data['id_unidad_negocio'] = $id_unidad_negocio;
            $data['id_plantel'] = $id_plantel;

        return view('grupos/asignacion/teacher',$data);
    }else{
        return redirect()->to(site_url('Home/salir'));
       }
    }

    public function recursos($id_grupo)
    {
        if($this->session->get('login')){
            $data['id_grupo'] = $id_grupo;
            return view('grupos/asignacion/recurso',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }



    public function evaluacion($id_grupo)
    {   
        if($this->session->get('login')){

            $data['id_grupo'] = $id_grupo;
            return view('grupos/asignacion/evaluacion',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
        
    }
    
    // vistas para eliminar

    public function deletedAlumno($id_grupo)
    {
        if($this->session->get('login')){
            $data['id_grupo'] = $id_grupo;
        return view('grupos/asignacion/eliminar/alumno',$data);
    }else{
        return redirect()->to(site_url('Home/salir'));
       }

    }

    public function deletedTeacher($id_grupo)
    {
        if($this->session->get('login')){
            $data['id_grupo'] = $id_grupo;
        return view('grupos/asignacion/eliminar/teacher',$data);
    }else{
        return redirect()->to(site_url('Home/salir'));
       }

    }
    public function deletedRecursos($id_grupo)
    {
        if($this->session->get('login')){
            $data['id_grupo'] = $id_grupo;
            return view('grupos/asignacion/eliminar/recurso',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }


    //Modifica la base de datos 
    

    //Asignar alumno

    public function asignaralumno()
    {
        if($this->session->get('login')){
            $REQUEST = \Config\Services::request();
            $hoy = date("Y-m-d H:i:s");
            $usermodel = new Grupos_alumnos_model($db);
            if(isset($_POST['submitAL'])){
                foreach(getAllAlumnos() as $fila){
                 if(!empty($REQUEST->getPost($fila->id_usuario))){
            $data = ['id_grupo' =>$REQUEST->getPost('id_grupo'),
            'id_alumno' =>$REQUEST->getPost($fila->id_usuario),
            'fecha_creacion' =>$hoy,
            'fecha_ultimo_cambio' =>$hoy,
            ];
            $usermodel->insert($data);
            echo "Se agrego correctameto";
        }
       
    }  
    echo "salio del for";
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
        
    }else{
        return redirect()->to(site_url('Home/salir'));
       }
}

    //Asignar teacher

    public function asignarteacher()
    {
        if($this->session->get('login')){
            $REQUEST = \Config\Services::request();
            $hoy = date("Y-m-d H:i:s");
            $usermodel = new Grupos_teachers_model($db);
            if(isset($_POST['submitTH'])){
                foreach(getAllMaestros() as $fila){
                 if(!empty($REQUEST->getPost($fila->id_usuario))){

            $data = ['id_grupo' =>$REQUEST->getPost('id_grupo'),
            'id_teacher' =>$REQUEST->getPost($fila->id_usuario),
            'fecha_creacion' =>$hoy,
            'fecha_ultimo_cambio' =>$hoy,
            ];
            $usermodel->insert($data);
            echo "Se agrego correctameto";
            }

        }
        echo "salio del for";
            }else{

                return redirect()->to(site_url('Home/salir'));
               }
        }else{

            return redirect()->to(site_url('Home/salir'));
           }
    }

    //Asignar recurso

    public function asignarrecurso()
    {
        if($this->session->get('login')){
            $REQUEST = \Config\Services::request();
            $hoy = date("Y-m-d H:i:s");
            $usermodel = new Grupos_recursos_model($db);
            $idgrupo = $REQUEST->getPost('id_grupo');
            if(isset($_POST['submitRC'])){   
            foreach(getRecursos() as $fila){
                if(!empty($REQUEST->getPost($fila->id))){

                    $data = ['id_grupo' =>$REQUEST->getPost('id_grupo'),
                    'id_recurso' =>$REQUEST->getPost($fila->id),
                    'fecha_creacion' =>$hoy,
                    'fecha_ultimo_cambio' =>$hoy,
                    ]; 
                    $usermodel->insert($data);
                   
              
                }
            }
            return redirect()->to(site_url("Asignacion/recursos/$idgrupo"));
        }else{
            return redirect()->to(site_url('Home/salir'));
           }  
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }

    public function asigniarevaluacion()
    {
        if($this->session->get('login')){
            $REQUEST = \Config\Services::request(); 
            if(isset($_POST['submitEV'])){  
                $hoy = date("Y-m-d H:i:s"); 
                    $data = ['id_grupo' =>$REQUEST->getPost('id_grupo'),
                    'id_evaluacion' =>$REQUEST->getPost('evaluacion'),
                    'fecha_creacion' =>$hoy,
                    'fecha_ultimo_cambio' =>$hoy,
                    ]; 
                    $usermodel = new Grupos_evaluaciones_model($db);
                    $usermodel->insert($data);
                    echo "Se agrego correctameto";
        }else{
            return redirect()->to(site_url('Home/salir'));
           }  
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
        
    }


    //FUNCION AJAX

    function EvaluacionEspecifica()
    {
        
        $REQUEST = \Config\Services::request();
        $id_nivel = $REQUEST->getPost('nivel');
        $id_leccion = $REQUEST->getPost('leccion');
        
        echo "<option value=''>Seleccione una opción</option>";
        foreach(getEvaluacion(1,$id_nivel,$id_leccion) as $fila){
            echo "<option value=$fila->id>$fila->nombre</option>";
        }

    }
    




   
            //elimnar alumno 
    public function eliminarAlumno()
    {
        if($this->session->get('login')){
            $REQUEST = \Config\Services::request();
            if(isset($_POST['submitAL'])){
                $id_grupo = $REQUEST->getPost('id_grupo');
                $usermodel = new Grupos_alumnos_model($db);
                foreach(getGrupoAlumnosEliminar($id_grupo) as $fila){
                 if(!empty($REQUEST->getPost($fila->id))){
                $usermodel->delete(['id'=> $fila->id]);
                 echo "Se elimino correctameto";
        }    
    }  
    echo "salio del for";
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
        
    }else{
        return redirect()->to(site_url('Home/salir'));
       }
    }

    public function eliminarMaestro()
    {
        if($this->session->get('login')){
            $REQUEST = \Config\Services::request();
            if(isset($_POST['submitTH'])){
                $usermodel = new Grupos_teachers_model($db);
                $id_grupo = $REQUEST->getPost('id_grupo');
                foreach(getGrupoMaestrosEliminar($id_grupo) as $fila){
                 if(!empty($REQUEST->getPost($fila->id))){

                $usermodel->delete(['id'=> $fila->id]);
            echo "Se elimino correctameto";
            }

        }
        echo "salio del for";
            }else{

                return redirect()->to(site_url('Home/salir'));
               }
        }else{

            return redirect()->to(site_url('Home/salir'));
           }

    }

    public function eliminarRecurso()
    {
        if($this->session->get('login')){
            $REQUEST = \Config\Services::request();
            if(isset($_POST['submitRC'])){  
                $usermodel = new Grupos_recursos_model($db);
                $id_grupo = $REQUEST->getPost('id_grupo');
            foreach(getGrupoRecursosEliminar($id_grupo) as $fila){
                if(!empty($REQUEST->getPost($fila->id))){
                    $usermodel->delete(['id'=> $fila->id]);
                }
            }
            return redirect()->to(site_url("Asignacion/deletedRecursos/$id_grupo"));
        }else{
            return redirect()->to(site_url('Home/salir'));
           }  
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }





}