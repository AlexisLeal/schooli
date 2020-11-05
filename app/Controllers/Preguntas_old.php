<?php namespace App\Controllers;
use  App\Models\Preguntas_model;
use  App\Models\Pregunta_opcion_multiple;
use  App\Models\Pregunta_opcion_audio;
use  App\Models\Pregunta_opcion_video;
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

            $data['idtipoevaluacion'] = $REQUEST->getPost('idtipoevaluacion');	
            $data['nivel'] = $REQUEST->getPost('nivel');	
            $data['leccion'] = $REQUEST->getPost('leccion');	

            $data['page_title'] = "Preguntas";	
         return view('evaluaciones/crear/agregar_preguntas',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
	}else{
        return redirect()->to(site_url('Home/salir'));
       }
}

//Nos muestra las preguntas de la evaluacion
public function verEvaluacion()
{  
     if($this->session->get('login')){
     if(isset($_POST['submitAP'])){
        $REQUEST = \Config\Services::request();  
        $data['idEvaluacion'] = $REQUEST->getPost('id_e');
        $data['nombre'] = $REQUEST->getPost('nombre');
        $data['tipo_evaluacion'] = $REQUEST->getPost('nombre_tipo_evaluacion');

        $data['clave'] = $REQUEST->getPost('clave');
        $data['valorpreguntas'] = $REQUEST->getPost('valorpreguntas');	
        $data['totalpreguntas'] = $REQUEST->getPost('totalpreguntas');

        $data['idtipoevaluacion'] = $REQUEST->getPost('idtipoevaluacion');	
        $data['nivel'] = $REQUEST->getPost('nivel');	
        $data['leccion'] = $REQUEST->getPost('leccion');	

        $data['page_title'] = "Preguntas";	

         return view('evaluaciones/mostrar/evaluacion',$data);
}else{
    return redirect()->to(site_url('Home/salir'));
   }

}else{
    return redirect()->to(site_url('Home/salir'));
   }
}

//Editar las preguntas de la evaluacion
public function editarEvaluacion()
{   
    if($this->session->get('login')){
        if(isset($_POST['submitAP'])){
           $REQUEST = \Config\Services::request();  
           $data['idEvaluacion'] = $REQUEST->getPost('id_e');
           $data['nombre'] = $REQUEST->getPost('nombre');
           $data['tipo_evaluacion'] = $REQUEST->getPost('nombre_tipo_evaluacion');
   
           $data['clave'] = $REQUEST->getPost('clave');
           $data['valorpreguntas'] = $REQUEST->getPost('valorpreguntas');	
           $data['totalpreguntas'] = $REQUEST->getPost('totalpreguntas');
   
           $data['idtipoevaluacion'] = $REQUEST->getPost('idtipoevaluacion');	
           $data['nivel'] = $REQUEST->getPost('nivel');	
           $data['leccion'] = $REQUEST->getPost('leccion');	
   
           $data['page_title'] = "Preguntas";	



    return view('evaluaciones/editar/evaluacion',$data);
}else{
    return redirect()->to(site_url('Home/salir'));
   }
}else{
    return redirect()->to(site_url('Home/salir'));
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
        $valor = $REQUEST->getPost('valor');//Valor que le da al usuario a la pregunta
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
          
                //Comprobar si existe la ruta donde se va a guardar el audio
            if (!is_dir('uploads/'.$clave.'/audio-pregunta')) {
                mkdir('./uploads/' .$clave.'/audio-pregunta', 0777, TRUE);
            }

                 //Obtenemos el archivo 
                 $audio= 1;
                 $nombre = 'pre'.$clave.$numeropregunta.'.mp3';
                 //Ruta para la base de datos 
                 $ruta_audio_basedatos = "uploads/".$clave."/audio-pregunta/".$nombre."";
                 //Ruta para mover el archivo
                 $ruta_audio = "uploads/".$clave."/audio-pregunta";
                 $file_audio->move($ruta_audio,$nombre);
        }else{
            //Si algo sale mal nos marca un error 
            throw new RuntimeException($file_audio->getErrorString().'('.$file_audio->getError().')');
                 }

        }else{
            $audio= 0;
            $ruta_audio_basedatos = NULL;
        }

       
        if(isset($_POST['activarCargarImagen'])){
            $file_imagen = $REQUEST->getFile('archivo_imagen');
            if ($file_imagen->isValid() && ! $file_imagen->hasMoved())
            {
            
                //Comprobar si existe la ruta donde se va a guardar el audio
            if (!is_dir('uploads/'.$clave.'/imagen-pregunta')) {
                mkdir('./uploads/' .$clave.'/imagen-pregunta', 0777, TRUE);
            }
            //Obtenemos el archivo 
            $imagen= 1;
            $nombre = 'pre'.$clave.$numeropregunta.'.jpg';
            $ruta_imagen_basedatos = "uploads/".$clave."/imagen-pregunta/".$nombre."";  
            $ruta_imagen = "uploads/".$clave."/imagen-pregunta";  
            $file_imagen->move($ruta_imagen,$nombre);
        }else{
            //Si algo sale mal nos marca un error 
            throw new RuntimeException($file_imagen->getErrorString().'('.$file_imagen->getError().')');
             }

        }else{
            $imagen= 0;
            $ruta_imagen_basedatos = NULL;
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
          ) VALUES ($idEvaluacion,$numeropregunta,'".$pregunta."',$valor,$tipoPregunta,$imagen,'".$ruta_imagen_basedatos."',$audio,'".$ruta_audio_basedatos."','".$hoy."','".$hoy."')";

        $usermodel->query($query);


            //Opcion Multiple 
        if($tipoPregunta == 2){
            $opcion1 = $REQUEST->getPost('opcion_1');
            $opcion2 = $REQUEST->getPost('opcion_2');
            $opcion3 = $REQUEST->getPost('opcion_3');
            $opcion4 = $REQUEST->getPost('opcion_4');
            $respuesta = $REQUEST->getPost('opcion_correcta');

            $usermodel = new Pregunta_opcion_multiple($db);


            $sqlOpcionMultiple="insert into pregunta_opcion_multiple(
                idEvaluacion,
                idPregunta,
                valor1,
                valor2,
                valor3,
                valor4,
                opcion_correcta,
                fecha_creacion,
                fecha_ultimo_cambio) values(
                $idEvaluacion,$numeropregunta,'".$opcion1."','".$opcion2."','".$opcion3."','".$opcion4."',$respuesta,'".$hoy."','".$hoy."')";

                $usermodel->query($sqlOpcionMultiple);
        }

        //Cuando sea AUDIO 
        if($tipoPregunta == 3){

            $file_audio = $REQUEST->getFile('archivo_audio');
              //Verifica si es valido
        if ($file_audio->isValid() && ! $file_audio->hasMoved())
        {

                //Comprobar si existe la ruta donde se va a guardar el audio
            if (!is_dir('uploads/'.$clave.'/audio')) {
                mkdir('./uploads/' .$clave.'/audio', 0777, TRUE);
            }

            //Obtenemos el archivo 
            $nombre = 'pregunta-ingles'.$numeropregunta.'.mp3';  
            $ruta_audio_basedatos = "uploads/".$clave."/audio/".$nombre."";
            $ruta_audio = "uploads/".$clave."/audio";

            $audio_extension= $file_audio->getClientExtension();
            $file_audio->move($ruta_audio,$nombre);

            //Insertamos en la base de datos 
            $sqlAudio ="INSERT INTO pregunta_opcion_audio (
                idEvaluacion,
                idPregunta,
                nombre_audio,
                ruta_audio,
                extension,
                fecha_creacion,
                fecha_ultimo_cambio
                ) VALUES(
                $idEvaluacion,
                $numeropregunta,
                '".$nombre."',
                '".$ruta_audio_basedatos."',
                '".$audio_extension."',
                '".$hoy."',
                '".$hoy."')";

                $usermodel = new Pregunta_opcion_audio($db);
                $usermodel ->query($sqlAudio);
        }else{
            //Si algo sale mal nos marca un error 
            throw new RuntimeException($file_audio->getErrorString().'('.$file_audio->getError().')');
                 }

        }

        
        if($tipoPregunta == 4){
            $file_video = $REQUEST->getFile('archivo_video');
            //Verifica si es valido
      if ($file_video->isValid() && ! $file_video->hasMoved())
      {
         
              //Comprobar si existe la ruta donde se va a guardar el audio
          if (!is_dir('uploads/'.$clave.'/video')) {
              mkdir('./uploads/' .$clave.'/video', 0777, TRUE);
          }

          //Obtenemos el archivo 
          $nombre = 'pregunta-ingles'.$numeropregunta.'.mp4';  
          $ruta_video_basedatos = "uploads/".$clave."/video/".$nombre."";
          $ruta_video = "uploads/".$clave."/video";
          $video_extension= $file_video->getClientExtension();
          $file_video->move($ruta_video,$nombre);

          //Insertamos en la base de datos 
          $sqlvideo ="INSERT INTO pregunta_opcion_video(
              idEvaluacion,
              idPregunta,
              nombre_video,
              ruta_video,
              extension,
              fecha_creacion,
              fecha_ultimo_cambio
              ) VALUES(
              $idEvaluacion,
              $numeropregunta,
              '".$nombre."',
              '".$ruta_video_basedatos."',
              '".$video_extension."',
              '".$hoy."',
              '".$hoy."')";

              $usermodel = new Pregunta_opcion_video($db);
              $usermodel ->query($sqlvideo);
      }else{
          //Si algo sale mal nos marca un error 
          throw new RuntimeException($file_video->getErrorString().'('.$file_video->getError().')');
               }

        }
        //Creamos una variable que nos indica 
        $idtipoevaluacion = $REQUEST->getPost('idtipoevaluacion');	//Si es sistema o exci 
        $nivel = $REQUEST->getPost('nivel');	
        $leccion = $REQUEST->getPost('leccion');	

        // Aqui se valida que no hubo ningun error y que se agrego la pregunta
        $data = ['pregunta-exito'  => 'La pregunta se agrego de forma correcta'];
        $this->session->set($data,true);

        // Aqui se valida si la pregunta no a rebasado el puntaje total permitido de la evaluación.

        return redirect()->to(site_url("Evaluaciones/panel_evaluaciones/$idtipoevaluacion/$nivel/$leccion"));
    

}else{
    return redirect()->to(site_url('Home/salir'));
   }
}

}