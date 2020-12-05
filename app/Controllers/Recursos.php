<?php namespace App\Controllers;
use  App\Models\Recursos_model;

class Recursos extends BaseController{

    public function recursos()
	{
        if($this->session->get('login') && $this->session->get('roll') == 4){
            $data['page_title'] = "Recursos";	
            return view('recursos/recursos',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
	}
    
    
    public function agregarRecurso()
	{
        if($this->session->get('login') && $this->session->get('roll') == 4){
            $REQUEST         = \Config\Services::request();
            
            $hoy             = date("Y-m-d H:i:s");
            $recurso_archivo = $REQUEST->getFile('recurso_archivo');
            $descripcion     = $REQUEST->getPost('descripcion');
/*
                case 'docx':
                case 'xlsx':
                case 'pdf':
                case 'zip':
                case 'rar':
                case 'jpg':
                case 'png':
                case 'mp3':
                case 'mp4':*/


            $recurso_extension= $recurso_archivo->getClientExtension();
            switch ($recurso_extension){
                case 'docx':
                $tipo_archivo="Word";
                break;
                case 'xlsx':
                $tipo_archivo="Excel";
                break;
                case 'pdf':
                $tipo_archivo="Pdf";
                break;
                case 'zip':
                $tipo_archivo="Zip";
                break;
                case 'rar':
                $tipo_archivo="Rar";
                break;
                case 'jpg':
                $tipo_archivo="Jpg";
                break;
                case 'png':
                $tipo_archivo="Png";
                break;
                case 'mp3':
                $tipo_archivo="Mp3";
                break;
                case 'mp4':
                $tipo_archivo="Mp4";
                break;
                deafult:
                $tipo_archivo ="Desconocido";
            }


            if ($recurso_archivo->isValid() && !$recurso_archivo->hasMoved())
            {
             
                if (!is_dir("recursos/$recurso_extension")) {
                    mkdir("/recursos/$recurso_extension", 0777, TRUE);
                } 
                     $nombre_recurso = $recurso_archivo->getClientName();;

                     $ruta_recurso_basedatos = "recursos/$recurso_extension/$nombre_recurso";

                     $ruta_mover_recurso = "recursos/".$recurso_extension;
                     $recurso_archivo->move($ruta_mover_recurso,$nombre_recurso);
            }else{
                //Si algo sale mal nos marca un error 
                //throw new RuntimeException($recurso_audio->getErrorString().'('.$recurso_audio->getError().')');
                     }
    
                      
            $sqlRecurso ="INSERT INTO recursos(
                nombre,
                extencion,
                tipo_archivo,
                descripcion,
                ruta,
                fecha_creacion,
                fecha_ultimo_cambio,
                deleted
                ) VALUES(
                '".$nombre_recurso."',
                '".$recurso_extension."',
                '".$tipo_archivo."',
                '".$descripcion."',
                '".$ruta_recurso_basedatos."',
                '".$hoy."',
                '".$hoy."',
                0)";
                
                $usermodel = new Recursos_model($db);
                if($usermodel ->query($sqlRecurso)){
                    $data = ['mensaje-recurso'  => 'El recurso se agrego de forma correcta',
                            'tipo-mensaje'=>'alert-success'];
                    
                    $this->session->set($data,true);
                }else{
                    $data = ['mensaje-recurso'  => 'El recurso no  se pudo agregar, consulte con el administrador del sistema.'
                    ,'tipo-mensaje'=>'alert-danger'];
                    $this->session->set($data,true);
                }

        return redirect()->to(site_url("Recursos/recursos"));
        }else{
           return redirect()->to(site_url('Home/salir'));
        }
	}

}