<?php namespace App\Controllers;
use  App\Models\Usuarios;
class Comprobacion extends BaseController{

    public function check(){

        $REQUEST = \Config\Services::request();  
        if(isset($_POST['login'])){
            $username = strtolower(trim($REQUEST->getPost('credencial')));
            $password = trim($REQUEST ->getPost('inputPassword'));
            $tipo_usuario =  $REQUEST ->getPost('tipo_usuario');
            
            
            if($username == null || $password == null || $tipo_usuario == null){
                    return redirect()->to(site_url('Home/index'));
            }

            $usermodel = new Usuarios($db);
            $usermodel->select('id,nombre,apellido_paterno,apellido_materno,usuario,id_tipo_usuario,roll');
            $usermodel->where('usuario',$username);
            $usermodel->where('password',$password);
            $usermodel->where('id_tipo_usuario',$tipo_usuario);
            $usermodel->where('deleted',0);
            $usermodel->where('estado',1);
            $resultado = $usermodel ->get();	
            $row = $resultado->getRow();

            if(empty($row)){ 
                $data = ['errorcredenciales'  => 'Los datos ingresados son incorrectos.'];
                $this->session->set($data);

                return redirect()->to(site_url('Home/index'));
            }
        
            $namearray = [
            'id'  => $row ->id,
            'nombre' =>$row ->nombre,
            'apellido' => $row ->apellido_paterno,
            'apellido_materno'=> $row->apellido_materno,
            'usuario' => $row->usuario,
            'tipo_usuario' => $row ->id_tipo_usuario,
            'roll'=> $row->roll,
            'login' => true,
            'notificaciones_usuario' => true
            ];

            $this->session ->set($namearray);

            if($this->session->get('login')){
                switch($this->session->get('tipo_usuario')){
                    case 1: 
                        $gruposdeAlumno = ObtenerGruposdeAlumnosparaSesiones($this->session->get('id'));
                        if(!empty($gruposdeAlumno)){
                            foreach($gruposdeAlumno as $fila){
                                $sesionArrayGrupos[] = $fila->id_grupo;
                            }
                            $data = ['sesionArrayGrupos'  => $sesionArrayGrupos];
                            $this->session->set($data,true);
                            return redirect()->to(site_url('Alumno/index'));;break;
                        }
                        
                        return redirect()->to(site_url('Alumno/index'));;break;
                    case 2: return redirect()->to(site_url('Tutores/index'));;break;
                    case 3: return redirect()->to(site_url('Teacher/index'));;break;
                    case 4: return redirect()->to(site_url('Panel/index'));;break;
                    case 5: return redirect()->to(site_url('Panel/index'));;break;
                }
            }	
        }
    }	
}