<?php namespace App\Controllers;
use  App\Models\Preguntas_model;
class Preguntas extends BaseController{

    public function agregar_preguntas()
	{
     if($this->session->get('login')){
        if(isset($_POST['submitAP'])){
            $REQUEST = \Config\Services::request();  
            $data['idEvaluacion'] = $REQUEST->getPost('id_e');
            $data['nombre'] = $REQUEST->getPost('nombre');
            $data['tipo_evaluacion'] = $REQUEST->getPost('nombre_tipo_evaluacion');
            $data['usuario_creo'] = $REQUEST->getPost('usuario_creo');
            $data['estado'] = $REQUEST->getPost('estado');
            $data['clave'] = $REQUEST->getPost('clave');
            $data['valorpreguntas'] = $REQUEST->getPost('valorpreguntas');	
            $data['totalpreguntas'] = $REQUEST->getPost('totalpreguntas');	
            $data['page_title'] = "Preguntas";	
         return view('evaluaciones/crear/agregar_preguntas',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
	}
}

public function insertarPregunta()
{
    if($this->session->get('login')){
        $REQUEST = \Config\Services::request();  
        $pregunta = $REQUEST->getPost('pregunta');
        $clave = $REQUEST->getPost('clave');
        $idEvaluacion = $REQUEST->getPost('idEvaluacion');
        $valorpreguntas = $REQUEST->getPost('valorpreguntas');//Es el valor total de todas las preguntas
        $valor = $REQUEST->getPost('valor');
        $hoy = date("Y-m-d H:i:s");
        $tipoPregunta = $REQUEST->getPost('tipoPregunta');
        $usermodel = new Preguntas_model($db);
          if(empty($valorpreguntas)){
              $numeropregunta = 1;
          }else{
          //Vamos a obtener el numero maximo de preguntas
          $usermodel->Select('(SELECT max(num_pregunta) FROM preguntas WHERE idEvaluacion= '.$idEvaluacion.') as ultimo_numero_pregunta', FALSE);
          $query = $usermodel->get();
          $fila = $query -> getRow();
        
          $numeropregunta = $fila->ultimo_numero_pregunta + 1;

          }

        //si la pregunta contiene audio 
        if(isset($_POST['activarCargarAudioPregunta'])){
        $file_audio = $REQUEST->getFile('archivo_audio_pregunta');
        if ($file_audio->isValid() && ! $file_audio->hasMoved())
        {
            $audio= 1;
            $ruta_audio = "uploads/".$clave."/audio-pregunta";
                //Comprobar si existe la ruta donde se va a guardar el audio
            if (!is_dir('uploads/'.$clave.'/audio-pregunta')) {
                mkdir('./uploads/' .$clave.'/audio-pregunta', 0777, TRUE);
            }

            //Obtenemos el archivo 
            $nombre = 'pre'.$clave.$numeropregunta.'.mp3';
        //Verifica si es valido
        
            $file_audio->move($ruta_audio,$nombre);
        }else{
            //Si algo sale mal nos marca un error 
            throw new RuntimeException($file_audio->getErrorString().'('.$file_audio->getError().')');
                 }

        }else{
            $audio= 0;
            $ruta_audio = NULL;
        }

       
        if(isset($_POST['activarCargarImagen'])){
            $file_imagen = $REQUEST->getFile('archivo_imagen');
            if ($file_imagen->isValid() && ! $file_imagen->hasMoved())
            {
            $imagen= 1;
            $ruta_imagen = base_url("uploads/$clave/imagen-pregunta");
                //Comprobar si existe la ruta donde se va a guardar el audio
            if (!is_dir('uploads/'.$clave.'/imagen-pregunta')) {
                mkdir('./uploads/' .$clave.'/imagen-pregunta', 0777, TRUE);
            }
            //Obtenemos el archivo 
         
            $nombre = 'pre'.$clave.$numeropregunta;
        //Verifica si es valido
       
            $file_imagen->move($file_imagen,$nombre);
        }else{
            //Si algo sale mal nos marca un error 
            throw new RuntimeException($file_imagen->getErrorString().'('.$file_imagen->getError().')');
             }

        }else{
            $imagen= 0;
            $ruta_imagen = NULL;
        }  


        $query ="INSERT INTO preguntas(
            idEvaluacion,
            num_pregunta,
            pregunta,
            valor,
            idTipoPregunta,
            tiene_imagen,
            ruta_imagen,
            tiene_audio_pregunta,
            ruta_audio_pregunta,
            fecha_creacion,
            fecha_ultimo_cambio
          ) VALUES ($idEvaluacion,$numeropregunta,'".$pregunta."',$valor,$tipoPregunta,$imagen,'".$ruta_imagen."',$audio,'".$ruta_audio."','".$hoy."','".$hoy."')";

        $usermodel->query($query);


 

}
    

}
}



