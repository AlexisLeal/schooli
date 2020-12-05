<?php namespace App\Controllers;
use  App\Models\Usuarios;
class Comprobacion extends BaseController{

    public function check(){

        $REQUEST = \Config\Services::request();  
        if(isset($_POST['login'])){
            $username = trim($REQUEST->getPost('credencial'));
            $password = trim($REQUEST ->getPost('inputPassword'));
            $tipo_usuario =  $REQUEST ->getPost('tipo_usuario');
                
          /*  $credenciales= array(
                'credencial' => $REQUEST->getPost('credencial'),
                'inputPassword' => $REQUEST ->getPost('inputPassword'),
                'tipo_usuario' => $REQUEST ->getPost('tipo_usuario')
                    );
*/
            if($username == null || $password == null || $tipo_usuario == null){
                    return redirect()->to(site_url('Home/index'));
            }

                 /*   if($credenciales['credencial'] == null|| $credenciales['inputPassword'] == null || $credenciales['tipo_usuario'] == null){
                        return redirect()->to(site_url('Home/index'));
                    }
                        */
            $usermodel = new Usuarios($db);
            $usermodel->select('id,nombre,apellido_paterno,apellido_materno,usuario,id_tipo_usuario,roll');
            $usermodel->where('usuario',$username);
            $usermodel->where('password',$password);
            $usermodel->where('id_tipo_usuario',$tipo_usuario);
            $usermodel->where('deleted',0);
            $usermodel->where('estado',1);
        //$query = "SELECT * FROM usuarios WHERE usuario='".$credenciales['credencial']."' and password='".$credenciales['inputPassword']."' and estado=1 and id_tipo_usuario = '".$credenciales['tipo_usuario']."'AND deleted = 0";
            $resultado = $usermodel ->get();	
            $row = $resultado->getRow(); //Nos regresa la primera fila (y en este caso solo debe ser una) 
            if(empty($row)){ //Si no encuntra nada  nos regresa a login 
            //Ponemos una variable que indique que los datos ingresados son incorrectos
                return redirect()->to(site_url('Home/index'));
        }
        
       //Array en codelgniter  obtenemos los datos para manejarlo en la session 
       //La session fue configurada en archivo baseContreoller 
            $namearray = [
            'id'  => $row ->id,
            'nombre' =>$row ->nombre,
            'apellido' => $row ->apellido_paterno,
            'apellido_materno'=> $row->apellido_materno,
            'usuario' => $row->usuario,
            'tipo_usuario' => $row ->id_tipo_usuario,
            'roll'=> $row->roll,
            'login' => true
            ];
        //introducimos los datos en la session y con get los obtemos checa la vista
            $this->session ->set($namearray);
            if($this->session->get('login')){
                switch($this->session->get('tipo_usuario')){
                    case 1: return redirect()->to(site_url('Alumno/index'));;break;
                    case 2: return redirect()->to(site_url('Tutores/index'));;break;
                    case 3: return redirect()->to(site_url('Teacher/index'));;break;
                    case 4: return redirect()->to(site_url('Panel/index'));;break;
                    case 5: return redirect()->to(site_url('Panel/index'));;break;
                }
      
      // redirect()->to()  redirreciona a un punto especifico en este caso sera un contraldor con ayuda de site_url()
            }	
        }
    }	
}