<?php namespace App\Controllers;
use  App\Models\Grupos_model;
use  App\Models\Grupos_teachers_model;
use  App\Models\Cursos_model;

class Grupos extends BaseController{

    public function index()
	{
        if($this->session->get('login') && $this->session->get('roll') == 4){
            $data['page_title'] = "Grupos";	

            return view('grupos/panel_grupos',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
	}

    public function agregargrupo()
	{   
        if($this->session->get('login') && $this->session->get('roll') == 4){

            return view('grupos/crear/agregar_grupo');
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
	}

    public function vergrupo($id_grupo)
	{
        
        if($this->session->get('login') && $this->session->get('roll') == 4){

            $usermodel = new Grupos_model();
            $usermodel->select('nombre,codigo_acceso,id_unidad_negocio,id_plantel,id_nivel,id_ciclo,id_curso');
            $usermodel->where('id',$id_grupo);
            $usermodel->where('deleted',0);
            $query = $usermodel->get();
            $row = $query->getRow();

            $data['page_title'] = "grupo";	
            $data['id_grupo'] = $id_grupo;	
            $data['nombre_grupo'] = $row->nombre;	
            $data['codigo_acceso'] = $row->codigo_acceso;
            $data['nivel'] = getnivelEspecifico($row->id_nivel);
            $data['id_plantel'] = $row->id_plantel;
            $data['id_unidad_negocio'] = $row->id_unidad_negocio;
            $data['id_ciclo'] = $row->id_ciclo;
            $data['id_curso'] = $row->id_curso;
            $data['id_nivel'] = $row->id_nivel;
            //Funcion ubicada en helper alumnos 	
            $data['unidad_negocio'] = getUnidadNegocioEspecifico($row->id_unidad_negocio);	
            $data['nombre_plantel'] = getPlanteEspecifico($row->id_plantel);

            return view('grupos/mostrar/ver_grupo',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }
    
    public function insertargrupo()
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){
            if(isset($_POST['submitGP'])){
                $REQUEST = \Config\Services::request();
                $nombregrupo = $REQUEST->getPost('nombre');
                $hoy = date("Y-m-d H:i:s");
                    
                if(!empty($REQUEST->getFile('imagen_grupo'))){
                    $file_imagen = $REQUEST->getFile('imagen_grupo');
                    if($file_imagen->isValid() && ! $file_imagen->hasMoved()){
            
                    if (!is_dir('uploads/Grupos/Imagenes')) {
                        mkdir('uploads/Grupos/Imagenes', 0777, TRUE);
                     }
            //Obtenemos el archivo 
                    $nombre = 'Imagen'.$nombregrupo.'.jpg';
                    $ruta_imagen_basedatos = "uploads/Grupos/Imagenes/".$nombre."";  
                    $ruta_imagen = 'uploads/Grupos/Imagenes';  
                    $file_imagen->move($ruta_imagen,$nombre);
                    }else{
                    }

                }else{
                    $ruta_imagen_basedatos = "Null";
                }

                $codigo = checkCodigo();

                $data = ['nombre' => $nombregrupo,
                'estatus' => $REQUEST->getPost('estatus'),
                'id_plantel' => $REQUEST->getPost('plantel'),
                'id_ciclo' => $REQUEST->getPost('ciclo'),
                'id_horario' => $REQUEST->getPost('horarios'),
                'id_curso' => $REQUEST->getPost('curso'),
                'id_salon' => $REQUEST->getPost('salon'),
                'id_nivel' => $REQUEST->getPost('nivel'),
                'codigo_acceso' =>$codigo,
                'cupo' => $REQUEST->getPost('cupo'),
                'descripcion' => $REQUEST->getPost('descripcion'),
                'id_unidad_negocio' => 1,
                'usuario_creo' => $this->session->get('id'),
                'usuario_modifico' => $this->session->get('id'),
                'url_imagen' => $ruta_imagen_basedatos, 
                'fecha_creacion' => $hoy, 
                'fecha_ultimo_cambio' => $hoy,     
                ];

                $usermodel = new Grupos_model();
                $usermodel->insert($data);

                $idgrupo = $usermodel->insertID();

                if(!empty($REQUEST->getPost('maestro'))){
                    $usermodelTeacher = new Grupos_teachers_model();
                    if(!empty($REQUEST->getPost('maestro2'))){
                        $data = ['id_grupo' =>$idgrupo,
                        'id_teacher' =>$REQUEST->getPost('maestro'),
                        'id_teacher_2' =>$REQUEST->getPost('maestro2'),
                        'fecha_creacion' =>$hoy,
                        'fecha_ultimo_cambio' =>$hoy,
                        ];
                    
                        $usermodelTeacher->insert($data);
                    }else{
                        $data = ['id_grupo' =>$idgrupo,
                        'id_teacher' =>$REQUEST->getPost('maestro'),
                        'fecha_creacion' =>$hoy,
                        'fecha_ultimo_cambio' =>$hoy,
                        ];

                        $usermodelTeacher->insert($data);
                    }
                }
                $data = ['Grupo'  => 'El Grupo se agregro correctamente'];
                $this->session->set($data,true);

                return redirect()->to(site_url('Grupos/agregargrupo'));

            }else{
                return redirect()->to(site_url('Home/salir'));
            }
    
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }

    public function editar($id_grupo)
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){
                $data['page_title'] = "Grupos";	
                $data['id_grupo'] = $id_grupo;
                
                $usermodel = new Grupos_model();
                $usermodel->select('nombre,id_plantel,estatus');
                $usermodel->where('id',$id_grupo);
                $usermodel->where('deleted',0);
                $query = $usermodel->get();
                $row = $query->getRow();

                $data['nombre']     = $row->nombre;
                $data['id_plantel'] = $row->id_plantel;
                $data['estatus']    = $row->estatus;



                return view('grupos/editar/editar_grupo',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }







    public function eliminar()
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){
            if(isset($_POST['submitGP'])){

        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }

    function ajaxlistadomaestrostipo2(){
        $REQUEST = \Config\Services::request();
        $idmaestro1 = $REQUEST->getPost('id_maestro1');
        echo "<option value=''>Seleccione una opción</option>";
        foreach(MaestrosGetAllMaestros() as $fila){
            if($idmaestro1 != $fila->id_usuario){
                echo "<option value = $fila->id_usuario> $fila->nombre $fila->apellido_paterno $fila->apellido_materno</option>";
            }
        }
    }
    function ajaxListadodeNiveles(){
        $REQUEST = \Config\Services::request();
        $idCurso = $REQUEST->getPost('idCurso');
        $UserModel = new Cursos_model($db);
        $UserModel->select('num_niveles');
        $UserModel->where('id',$idCurso);
        $UserModel->where('deleted',0);
        $Query = $UserModel->get();
        $Resultado = $Query->getRow();
        echo "<option value=''>Seleccione una opción</option>";
        foreach(getNivel() as $fila){
            if($fila->id <= $Resultado->num_niveles){
                echo "<option value=$fila->id>$fila->nombre</option>";
            }

        }
        
    }

    public function editargrupo()
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){
                $usermodel = new Grupos_model($db);
                $REQUEST = \Config\Services::request();
                if(isset($_POST['editarGrupo'])){

                    $data['page_title'] = "Grupos";	
                    $id_grupo   = $REQUEST->getPost('id_grupo');
                    $nombre     = $REQUEST->getPost('nombreGrupo');
                    $id_plantel = $REQUEST->getPost('plantelGrupo');
                    $estatus    = $REQUEST->getPost('estatusGrupo');

                    $usermodel = new Grupos_model();
                    $data_grupo = ['nombre'=>$nombre,
                                   'id_plantel'=>$id_plantel,
                                   'estatus'=>$estatus,];
                    $usermodel->update($id_grupo,$data_grupo);
                    
                    $data['id_grupo']   = $id_grupo;
                    $data['nombre']     = $nombre;
                    $data['id_plantel'] = $id_plantel;
                    $data['estatus']    = $estatus;

                    $data_session = ['editar-grupo-exito'  => 'El Grupo se edito correctamente'];
                    $this->session->set($data_session,true);
                    return view('grupos/editar/editar_grupo',$data);


                }else{
                    return redirect()->to(site_url('Home/salir'));
                }
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }
    

}