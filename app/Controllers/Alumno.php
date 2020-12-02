<?php namespace App\Controllers;
use  App\Models\Grupos_alumnos_model;

class Alumno extends BaseController{

    public function index()
	{
        if($this->session->get('login')){
            $db = \Config\Database::connect();
            $id_usuario= $this->session->get('id');
            $usermodel = $db->table('usuarios U');
            $usermodel->select('*');
            $usermodel->join('alumnos AL',"U.id = AL.id_usuario and U.id = $id_usuario");
            $usermodel->join(' grupo_alumnos G_AL','G_AL.id_alumno = U.id and G_AL.deleted = 0','left');
            $resultado = $usermodel->get();   
            $row = $resultado->getRow();
            $data['matricula'] = $row->matricula;
            $data['id_grupo'] = $row->id_grupo;
            $data['page_title'] = "Alumnos";	
            return view('alumnos/alumno/index_alumno',$data);
            }else{
                return redirect()->to(site_url('Home/salir'));
               }
	}
    
    public function evaluaciones()
    {
        if($this->session->get('login')){
            $usermodel = new Grupos_alumnos_model($db);
            $usermodel->select('id_grupo');
            $usermodel->where('id_alumno',$this->session->get('id'));
            $usermodel->where('deleted',0);
            $resultado = $usermodel->get();   
            $row = $resultado->getRow();
            if(empty($row)){
                $data['id_grupo'] = null;
            }else{
                $data['id_grupo'] = $row->id_grupo;
            }

            return view('alumnos/alumno/evaluaciones',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }

    public function presentarevaluacion($id_evaluacion)
    {
        if($this->session->get('login')){

            $data['id_evaluacion'] = $id_evaluacion;
            return view('alumnos/alumno/presentarevaluacion',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }




}