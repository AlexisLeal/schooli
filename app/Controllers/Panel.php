<?php namespace App\Controllers;
use  App\Models\Usuarios;

class Panel extends BaseController{

    public function index()
	{
    
    /*    // $this->response->setHeader('Cache-Control', 'no-cache');
        $REQUEST = \Config\Services::request();  

        if(isset($_POST['login'])){
                
            $credenciales= array(
                'credencial' => $REQUEST->getPost('credencial'),
                'inputPassword' => $REQUEST ->getPost('inputPassword'),
                'tipo_usuario' => $REQUEST ->getPost('tipo_usuario')
                    );

                    if($credenciales['credencial'] == null|| $credenciales['inputPassword'] == null || $credenciales['tipo_usuario'] == null){
                        $data['page_title'] = "INBI";	
                         return view('login',$data);
                    }

        $usermodel = new Usuarios($db);
        $query = "SELECT * FROM usuarios WHERE usuario='".$credenciales['credencial']."' and password='".$credenciales['inputPassword']."' and estado=1 and id_tipo_usuario = '".$credenciales['tipo_usuario']."'";
        $resultado = $usermodel ->query($query);	
        $row = $resultado->getRow(); //Nos regresa la primera fila (y en este caso solo debe ser una) 
        if(empty($row)){ //Si no encuntra nada  nos regresa a login 
            //Ponemos una variable que indique que los datos ingresados son incorrectos
            $data['page_title'] = "INBI";	
            return view('login',$data);
        }
        
       //Array en codelgniter 
        $namearray = [
            'id'  => $row ->id,
            'nombre' =>$row ->nombre,
            'apellido' => $row ->apellido_paterno,
            'tipo_usuario' => $row ->id_tipo_usuario,
            'login' => true
    ];
        //introducimos los datos en la session y con get los obtemos checa la vista
        $this->session ->set($namearray);
        if($this->session->get('login')){
            switch($this->session->get('tipo_usuario')){
                case 1: $data['page_title'] = "Alumnos"; return view('alumnos/alumnos_crud',$data);break;
                case 2: $data['page_title'] = "Tutores"; return view('tutores/tutores_crud',$data);break;
                case 3: $data['page_title'] = "Maestros";return view('teacher/teacher_crud',$data);break;
                case 4: $data['page_title'] = "Plataforma de evaluaciones INBI"; return view('panel',$data);break;
                case 5: $data['page_title'] = "Plataforma de evaluaciones INBI"; return view('panel',$data);break;
      }
        



        }	
        */
        //Pasamos de forma dinamica el titulo propio de Codelgniter
        $data['page_title'] = "Plataforma de evaluaciones INBI";
        //$data['credenciales'] = $datos;

        //Para verificar si el usuario se encuentra logeado y si no nos mande a a salir y salir nos manda a login 
        if($this->session->get('login')){
		return view('panel',$data);
    
            }else{
                return redirect()->to(site_url('Home/salir'));
               }
            }
	

}



