<?php namespace App\Controllers;
use  App\Models\Grupos_model;

class Grupos extends BaseController{

    public function index()
	{
        //Pasamos de forma dinamica el titulo  y se crear un array
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
            $usermodel->select('nombre,codigo_acceso,id_unidad_negocio,id_plantel');
            $usermodel->where('id',$id_grupo);
            $usermodel->where('deleted',0);
            $query = $usermodel->get();
            $row = $query->getRow();

            $data['page_title'] = "grupo";	
            $data['id_grupo'] = $id_grupo;	
            $data['nombre_grupo'] = $row->nombre;	
            $data['codigo_acceso'] = $row->codigo_acceso;
            //-------------------------------------
            $data['id_plantel'] = $row->id_plantel;
            $data['id_unidad_negocio'] = $row->id_unidad_negocio;
            
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
            
                //Comprobar si existe la ruta donde se va a guardar el audio
                    if (!is_dir('uploads/Grupos/Imagenes')) {
                        mkdir('uploads/Grupos/Imagenes', 0777, TRUE);
                     }
            //Obtenemos el archivo 
                    $nombre = 'Imagen'.$nombregrupo.'.jpg';
                    $ruta_imagen_basedatos = "uploads/Grupos/Imagenes/".$nombre."";  
                    $ruta_imagen = 'uploads/Grupos/Imagenes';  
                    $file_imagen->move($ruta_imagen,$nombre);
                    }else{
            //Si algo sale mal nos marca un error 
           // throw new RuntimeException($file_imagen->getErrorString().'('.$file_imagen->getError().')');
                    }

                }else{
                    $ruta_imagen_basedatos = "Null";
                }
        //Es una funcion recursiva esta esta en  helper      
                $codigo = checkCodigo();

                $data = ['nombre' => $nombregrupo,
                'estatus' => $REQUEST->getPost('estatus'),
                'id_plantel' => $REQUEST->getPost('plantel'),
                'id_horario' => $REQUEST->getPost('horarios'),
                'id_salon' => $REQUEST->getPost('salon'),
                'id_nivel' => $REQUEST->getPost('nivel'),
                'codigo_acceso' =>$codigo,
                'cupo' => $REQUEST->getPost('cupo'),
                'precio' => $REQUEST->getPost('precio'),
                'descripcion' => $REQUEST->getPost('descripcion'),
                'id_unidad_negocio' => $REQUEST->getPost('unidad_negocio'),
                'usuario_creo' => $this->session->get('id'),
                'usuario_modifico' => $this->session->get('id'),
                'url_imagen' => $ruta_imagen_basedatos, 
                'fecha_creacion' => $hoy, 
                'fecha_ultimo_cambio' => $hoy,     
                ];
                $usermodel = new Grupos_model();
                $usermodel->insert($data);
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




    public function editar()
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

}