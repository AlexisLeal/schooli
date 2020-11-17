<?php namespace App\Controllers;
use  App\Models\Grupos_recursos_model;
use  App\Models\Grupos_teachers_model;
use  App\Models\Grupos_alumnos_model;

class Asignacion extends BaseController{
	
	
//Vistas
     public function alumnos($id_grupo)
    {

        if($this->session->get('login')){
            $data['id_grupo'] = $id_grupo;
        return view();
    }else{
        return redirect()->to(site_url('Home/salir'));
       }

    }

    public function teacher($id_grupo)
    {
        if($this->session->get('login')){
            $data['id_grupo'] = $id_grupo;
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



    //Modifica la base de datos 
    

    //Asignar alumno

    public function asignaralumno()
    {
        if($this->session->get('login')){
            $REQUEST = \Config\Services::request();
            $hoy = date("Y-m-d H:i:s");
            $data = ['id_grupo ' =>$REQUEST->getPost(''),
            'id_alumno' =>$REQUEST->getPost(''),
            'fecha_creacion' =>$hoy,
            'fecha_ultimo_cambio' =>$hoy,
            ];
           $usermodel = new Grupos_alumnos_model($db);
           $usermodel->insert();
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
            $data = ['id_grupo ' =>$REQUEST->getPost(''),
            'id_teacher' =>$REQUEST->getPost(''),
            'fecha_creacion' =>$hoy,
            'fecha_ultimo_cambio' =>$hoy,
            ];
            $usermodel = new Grupos_teachers_model($db);
            $usermodel->insert();
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
            if(isset($_POST['submitRC'])){   
            foreach(getRecursos() as $fila){
                if(!empty($REQUEST->getPost($fila->id))){

                    $data = ['id_grupo' =>$REQUEST->getPost('id_grupo'),
                    'id_recurso' =>$REQUEST->getPost($fila->id),
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



}