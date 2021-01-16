<?php namespace App\Controllers;
use  App\Models\Grupos_teachers_model;
use  App\Models\Grupos_alumnos_model;
use  App\Models\Grupos_evaluaciones_model;
use  App\Models\Grupos_model;
use  App\Models\Alumnos_model;
helper('Calificar');

class Asignacion extends BaseController{	

    public function alumnos($id_grupo,$id_unidad_negocio,$id_plantel)
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){

            $data['id_grupo'] = $id_grupo;
            $data['id_unidad_negocio'] = $id_unidad_negocio;
            $data['id_plantel'] = $id_plantel;

            return view('grupos/asignacion/alumno',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }

    
    public function asignarcalificaciones($id_grupo,$id_curso,$id_ciclo,$id_nivel)
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){

            $data['id_grupo']  = $id_grupo;
            $data['id_curso']  = $id_curso;
            $data['id_ciclo']  = $id_ciclo;
            $data['id_nivel']  = $id_nivel;

            return view('grupos/mostrar/asignar_calificacion',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }



    public function teacher($id_grupo,$id_unidad_negocio,$id_plantel)
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){

            $data['id_grupo'] = $id_grupo;
            $data['id_unidad_negocio'] = $id_unidad_negocio;
            $data['id_plantel'] = $id_plantel;

            return view('grupos/asignacion/teacher',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }

    public function sesiones($id_grupo,$id_curso,$id_nivel)
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){

            $data['id_curso'] = $id_curso;
            $data['id_nivel'] = $id_nivel;
            $data['id_grupo'] = $id_grupo;
            
            return view('grupos/asignacion/sesiones',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }


    public function recursosasignados($IdCurso,$IdNivel,$Sesion,$id_grupo)
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){

            $data['IdCurso']  = $IdCurso;
            $data['IdNivel']  = $IdNivel;
            $data['Sesion']   = $Sesion;
            $data['id_grupo'] = $id_grupo;

           return view('grupos/asignacion/recursos',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }

    }

    public function evaluacion($id_grupo)
    {   
        if($this->session->get('login') && $this->session->get('roll') == 4){

            $data['id_grupo'] = $id_grupo;

            return view('grupos/asignacion/evaluacion',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
        
    }
    
   
    public function deletedAlumno($id_grupo)
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){

            $data['id_grupo'] = $id_grupo;

            return view('grupos/asignacion/eliminar/alumno',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }

    }

    public function deletedTeacher($id_grupo)
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){

            $data['id_grupo'] = $id_grupo;

            return view('grupos/asignacion/eliminar/teacher',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }

    }

    public function deletedEvaluacion($id_grupo)
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){

            $data['id_grupo'] = $id_grupo;

            return view('grupos/asignacion/eliminar/evaluacion',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
        
    }
    
    public function asignaralumno()
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){

            $REQUEST = \Config\Services::request();
            $hoy = date("Y-m-d H:i:s");
            $idgrupo = $REQUEST->getPost('id_grupo');
            $id_unidad_negocio = $REQUEST->getPost('id_unidad_negocio');
            $id_plantel = $REQUEST->getPost('id_plantel');

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
                    }
                }  
                return redirect()->to(site_url("Asignacion/alumnos/$idgrupo/$id_unidad_negocio/$id_plantel"));
            }else{
                return redirect()->to(site_url('Home/salir'));
           }
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }

    public function asignarteacher()
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){

            $REQUEST = \Config\Services::request();
            $hoy = date("Y-m-d H:i:s");
            $id_grupo = $REQUEST->getPost('id_grupo');
            $id_unidad_negocio = $REQUEST->getPost('id_unidad_negocio');
            $id_plantel = $REQUEST->getPost('id_plantel');

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
                    }

                }
                return redirect()->to(site_url("Asignacion/teacher/$id_grupo/$id_unidad_negocio/$id_plantel"));
            }else{
                return redirect()->to(site_url('Home/salir'));
               }
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }

   

    public function asigniarevaluacion()
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){
            if(isset($_POST['submitEV'])){
                $REQUEST = \Config\Services::request(); 
                $hoy = date("Y-m-d H:i:s"); 

                $data = ['id_grupo' =>$REQUEST->getPost('id_grupo'),
                'id_evaluacion' =>$REQUEST->getPost('evaluacion'),
                'fecha_creacion' =>$hoy,
                'fecha_ultimo_cambio' =>$hoy,
                ]; 

                $usermodel = new Grupos_evaluaciones_model($db);
                $usermodel->insert($data);

                $id_grupo = $REQUEST->getPost('id_grupo');

                return redirect()->to(site_url("Asignacion/evaluacion/$id_grupo"));
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
    
    public function eliminarAlumno()
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){
            
            if(isset($_POST['submitAL'])){
                $REQUEST = \Config\Services::request();
                $id_grupo = $REQUEST->getPost('id_grupo');
                $usermodel = new Grupos_alumnos_model($db);

                foreach(getGrupoAlumnosEliminar($id_grupo) as $fila){
                    if(!empty($REQUEST->getPost($fila->id))){
                        $usermodel->delete(['id'=> $fila->id]);
                    }    
                }  
                return redirect()->to(site_url("Asignacion/deletedAlumno/$id_grupo"));
            }else{
                return redirect()->to(site_url('Home/salir'));
           }
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }

    public function eliminarMaestro()
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){
            if(isset($_POST['submitTH'])){

                $REQUEST = \Config\Services::request();
                $usermodel = new Grupos_teachers_model($db);
                $id_grupo = $REQUEST->getPost('id_grupo');

                foreach(getGrupoMaestrosEliminar($id_grupo) as $fila){
                    if(!empty($REQUEST->getPost($fila->id))){
                        $usermodel->delete(['id'=> $fila->id]);
            
                    }
                }
                return redirect()->to(site_url("Asignacion/deletedTeacher/$id_grupo"));
            }else{
                return redirect()->to(site_url('Home/salir'));
            }
        }else{
            return redirect()->to(site_url('Home/salir'));
        }

    }

    public function eliminarEvaluacion()
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){
            if(isset($_POST['submitEV'])){

                $REQUEST = \Config\Services::request();  
                $usermodel = new Grupos_evaluaciones_model($db);
                $id_grupo = $REQUEST->getPost('id_grupo');

                foreach(getGrupoEvaluacionEliminar($id_grupo) as $fila){
                    if(!empty($REQUEST->getPost($fila->id))){
                        $usermodel->delete(['id'=> $fila->id]);
                    }
                }
                return redirect()->to(site_url("Asignacion/deletedEvaluacion/$id_grupo"));
            }else{
                return redirect()->to(site_url('Home/salir'));
            }  
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }

    public function reasignaralumno()
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){
            if(isset($_POST['submitRSG'])){ 
                $REQUEST = \Config\Services::request();

                $usermodel = new Grupos_alumnos_model($db);
                $hoy = date("Y-m-d H:i:s");
                $id_usuario = $REQUEST->getPost('id_usuario');
                $id_grupo_nuevo = $REQUEST->getPost('id_grupo_nuevo');
                $id_grupo_actual = $REQUEST->getPost('id_grupo_actual');

                //Eliminamos al alumno del gpo
                $usermodel->select('id');
                $usermodel->where('id_grupo',$id_grupo_actual);
                $usermodel->where('id_alumno',$id_usuario);
                $usermodel->where('deleted',0);
                $resultado = $usermodel->get();
                $row = $resultado->getRow();
                $usermodel->delete(['id'=> $row->id]);

                //Cambiamos al alumno de unidad de negocio y plantel al grupo correspodiente
                $usermodel_grupo = new Grupos_model();
                $usermodel_grupo->select('id_plantel,id_unidad_negocio');
                $usermodel_grupo->where('id',$id_grupo_nuevo);
                $usermodel_grupo->where('deleted',0);
                $resultado_grupo = $usermodel_grupo->get();
                $row_grupo = $resultado_grupo->getRow();
                $data_negocio_plantel =['id_plantel' => $row_grupo->id_plantel,
                'id_unidad_negocio' => $row_grupo->id_unidad_negocio,];

                $usermodel_alumno = new Alumnos_model();
                $usermodel_alumno->select('id');
                $usermodel_alumno->where('id_usuario',$id_usuario);
                $usermodel_alumno->where('deleted',0);
                $resultado_alumno = $usermodel_alumno->get();
                $row_alumno = $resultado_alumno->getRow();
                $usermodel_alumno->update($row_alumno->id,$data_negocio_plantel);
           
                 //Insertamos el alumno a nuevo gpo
                $data = ['id_grupo' =>$id_grupo_nuevo,
                'id_alumno' =>$id_usuario,
                'fecha_creacion' =>$hoy,
                'fecha_ultimo_cambio' =>$hoy,
                 ];

                 $usermodel->insert($data);

                 echo 'se agrego correctamente';

            }else{
                 echo "Esta saliendo";
           // return redirect()->to(site_url('Home/salir'));
            }
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }

}




