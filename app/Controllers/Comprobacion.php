<?php namespace App\Controllers;
use  App\Models\Usuarios;
class Comprobacion extends BaseController{

    public function check(){

        $REQUEST = \Config\Services::request();  

        if(isset($_POST['login'])){
                
            $credenciales= array(
                'credencial' => $REQUEST->getPost('credencial'),
                'inputPassword' => $REQUEST ->getPost('inputPassword'),
                'tipo_usuario' => $REQUEST ->getPost('tipo_usuario')
                    );

                    if($credenciales['credencial'] == null|| $credenciales['inputPassword'] == null || $credenciales['tipo_usuario'] == null){
                        return redirect()->to(site_url('Home/index'));
                    }

        $usermodel = new Usuarios($db);
        $query = "SELECT * FROM usuarios WHERE usuario='".$credenciales['credencial']."' and password='".$credenciales['inputPassword']."' and estado=1 and id_tipo_usuario = '".$credenciales['tipo_usuario']."'";
        $resultado = $usermodel ->query($query);	
        $row = $resultado->getRow(); //Nos regresa la primera fila (y en este caso solo debe ser una) 
        if(empty($row)){ //Si no encuntra nada  nos regresa a login 
            //Ponemos una variable que indique que los datos ingresados son incorrectos
            return redirect()->to(site_url('Home/index'));
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
                case 1: return redirect()->to(site_url('Alumnos/index'));;break;
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