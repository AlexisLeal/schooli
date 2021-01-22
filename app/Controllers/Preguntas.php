<?php namespace App\Controllers;
use  App\Models\Preguntas_model;
use  App\Models\Pregunta_opcion_multiple;
use  App\Models\Pregunta_opcion_audio;
use  App\Models\Pregunta_opcion_video;
use  App\Models\Evaluaciones_model;
class Preguntas extends BaseController{

    public function agregar_preguntas($id_evaluacion)
	{

        if($this->session->get('login') && $this->session->get('roll') == 4){
           
            $usermodel = new Evaluaciones_model($db);
            $usermodel->select('nombre,clave,tipo_evaluacion,usuario_creo');
            $usermodel->where('id',$id_evaluacion);
            $usermodel->where('deleted',0);
            $resultado = $usermodel->get();
            $row = $resultado -> getRow();


            $data['idEvaluacion'] = $id_evaluacion;
            $data['nombre'] = $row->nombre;
            $data['clave'] = $row->clave;
            $data['totalpreguntas'] = getTotalPreguntas($id_evaluacion);
            $data['valorpreguntas'] =  getValorTotalPreguntas($id_evaluacion);
            $nombre =getTipoEvaluacionEspecifico( $row->tipo_evaluacion);
            $data['tipo_evaluacion'] = $nombre->nombre;
            $data['page_title'] = "Preguntas";	

            $usuarioCreo = getUsuarioCreo($row->usuario_creo);
            $data['usuario_creo'] = $usuarioCreo->nombre .' '.$usuarioCreo->apellido_paterno;

            return view('evaluaciones/crear/agregar_preguntas',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }

    public function verEvaluacion($id_evaluacion)
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){

            $usermodel = new Evaluaciones_model($db);
            $usermodel->select('nombre,clave,tipo_evaluacion');
            $usermodel->where('id',$id_evaluacion);
            $usermodel->where('deleted',0);

            $resultado = $usermodel->get();
            $row = $resultado -> getRow();
            $data['idEvaluacion'] = $id_evaluacion;
            $data['nombre'] = $row->nombre;
            $data['clave'] = $row->clave;
            $data['idtipoevaluacion'] = $row->tipo_evaluacion;
            $data['totalpreguntas'] = getTotalPreguntas($id_evaluacion);
            $data['valorpreguntas'] =  getValorTotalPreguntas($id_evaluacion);
            $nombre =getTipoEvaluacionEspecifico($row->tipo_evaluacion);
            $data['tipo_evaluacion'] = $nombre->nombre;
            $data['page_title'] = "Preguntas";	

            return view('evaluaciones/mostrar/evaluacion',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }

    }

    public function editarEvaluacion($id_evaluacion)
    {   
        if($this->session->get('login') && $this->session->get('roll') == 4){
            $usermodel = new Evaluaciones_model($db);
            $usermodel->select('nombre,clave,tipo_evaluacion');
            $usermodel->where('id',$id_evaluacion);
            $usermodel->where('deleted',0);

            $resultado = $usermodel ->get();
            $row = $resultado -> getRow();
            $data['idEvaluacion'] = $id_evaluacion;
            $data['nombre'] = $row->nombre;
            $data['clave'] = $row->clave;
            $data['idtipoevaluacion'] = $row->tipo_evaluacion;
            $data['totalpreguntas'] = getTotalPreguntas($id_evaluacion);
            $data['valorpreguntas'] =  getValorTotalPreguntas($id_evaluacion);
            $nombre = getTipoEvaluacionEspecifico( $row->tipo_evaluacion);
            $data['tipo_evaluacion'] = $nombre->nombre;
            $data['page_title'] = "Preguntas";

        return view('evaluaciones/editar/evaluacion',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }

    public function deletedPreguntas()
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){
            if(isset($_POST['submitAP'])){
                $REQUEST = \Config\Services::request();
                $idEvaluacion = $REQUEST->getPost('idEvaluacion');
                $idPregunta = $REQUEST->getPost('idPregunta');
                $idtipoPregunta = $REQUEST ->getPost('idtipoPregunta');

                EliminarImagenyAudiodePregunta($idPregunta);
                $usermodel = new Preguntas_model($db);
                $usermodel->delete(['id' => $idPregunta]);

             //Opcion multiple
            if($idtipoPregunta == 2){
               
                $usermodel = new Pregunta_opcion_multiple($db);
                $usermodel->where('idEvaluacion',$idEvaluacion);
                $usermodel->where('idPregunta',$idPregunta);
                $usermodel->delete();
            }   
            //Opcion Audio 
            if($idtipoPregunta == 3){
                $usermodel = new Pregunta_opcion_audio($db);
                $usermodel->where('idEvaluacion',$idEvaluacion);
                $usermodel->where('idPregunta',$idPregunta);
                $usermodel->delete();
            
            }
            //Opcion Video
            if($idtipoPregunta == 4){
                $usermodel = new Pregunta_opcion_video($db);
                $usermodel->where('idEvaluacion',$idEvaluacion);
                $usermodel->where('idPregunta',$idPregunta);
                $usermodel->delete();

            }

            $data = ['Eliminacion'  => 'La pregunta se elimino correctamente'];
            $this->session->set($data,true);
            return redirect()->to(site_url("Preguntas/editarEvaluacion/$idEvaluacion"));

        }else{
            return redirect()->to(site_url('Home/salir'));
        }

        }else{
            return redirect()->to(site_url('Home/salir'));
        }

    }

    public function insertarPregunta()
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){
            $REQUEST  = \Config\Services::request();  
            $clave    = $REQUEST->getPost('clave');
            $idEvaluacion   = $REQUEST->getPost('idEvaluacion');
            $valorpreguntas = $REQUEST->getPost('valorpreguntas');//Es el valor total de todas las preguntas
            $valor    = $REQUEST->getPost('valor');//Valor que le da al usuario a la pregunta
            $hoy      = date("Y-m-d H:i:s");
            $tipoPregunta   = $REQUEST->getPost('tipoPregunta');
            $usermodel      = new Preguntas_model($db); 
            $Ruta = ObtenerRutaEvaluacion($idEvaluacion);
            $pregunta   = $REQUEST->getPost('pregunta');
            $pregunta = htmlentities($pregunta);
        if(empty($valorpreguntas)){
              $numeropregunta = 1;
        }else{
          //Vamos a obtener el numero maximo de preguntas
            $usermodel->Select('(SELECT max(num_pregunta) FROM preguntas WHERE idEvaluacion= '.$idEvaluacion.' AND deleted = 0) as ultimo_numero_pregunta ', FALSE);
            $query = $usermodel->get();
            $fila  = $query -> getRow();
            $numeropregunta = $fila->ultimo_numero_pregunta + 1;

        }

        //si la pregunta contiene audio 
            if(isset($_POST['activarCargarAudioPregunta'])){
                $file_audio = $REQUEST->getFile('archivo_audio_pregunta');
                if ($file_audio->isValid() && ! $file_audio->hasMoved()){
          
                //Comprobar si existe la ruta donde se va a guardar el audio
                    if (!is_dir("$Ruta/audio-pregunta")) {
                        mkdir("$Ruta/audio-pregunta", 0777, TRUE);
                    }
                 //Obtenemos el archivo 
                    $audio= 1;
                    $claveAudio = 'pre'.$clave.$numeropregunta.'.mp3';
                 //Ruta para la base de datos 
                    $ruta_audio_basedatos = "$Ruta/audio-pregunta/".$claveAudio."";
                 //Ruta para mover el archivo
                    $ruta_audio = "$Ruta/audio-pregunta";
                    $file_audio->move($ruta_audio,$claveAudio);
                }else{
                }

            }else{
                $audio= 0;
                $ruta_audio_basedatos = null;
                $claveAudio = null;
            }

       
        if(isset($_POST['activarCargarImagen'])){
            $file_imagen = $REQUEST->getFile('archivo_imagen');
            if ($file_imagen->isValid() && ! $file_imagen->hasMoved()){
                //Comprobar si existe la ruta donde se va a guardar el audio
                if (!is_dir("$Ruta/imagen-pregunta")) {
                    mkdir("$Ruta/imagen-pregunta", 0777, TRUE);
                }
            //Obtenemos el archivo 
                $imagen= 1;
                $claveImagen = 'pre'.$clave.$numeropregunta.'.jpg';
                $ruta_imagen_basedatos = "$Ruta/imagen-pregunta/".$claveImagen."";  
                $ruta_imagen = "$Ruta/imagen-pregunta";  
                $file_imagen->move($ruta_imagen,$claveImagen);
            }else{
                echo "Error";
                exit();
            //Si algo sale mal nos marca un error 
            //throw new RuntimeException($file_imagen->getErrorString().'('.$file_imagen->getError().')');
            }

            }else{
                $imagen = 0;
                $ruta_imagen_basedatos = NULL;
                $claveImagen = null;
            }  

            $data = ['idEvaluacion' => $idEvaluacion,
            'num_pregunta' =>$numeropregunta,
            'pregunta' =>$pregunta,
            'valor' =>$valor,
            'idTipoPregunta' =>$tipoPregunta,
            'tiene_imagen' =>$imagen,
            'ruta_imagen' =>$ruta_imagen_basedatos,
            'clave_pregunta_imagen' =>$claveImagen,
            'tiene_audio_pregunta' =>$audio,
            'ruta_audio_pregunta' =>$ruta_audio_basedatos,
            'clave_pregunta_audio' =>$claveAudio,
            'fecha_creacion' =>$hoy,
            'fecha_ultimo_cambio' =>$hoy,
            ];
            $usermodel->insert($data);
            $idPregunta = $usermodel->insertID();
            //$usermodel->query($query);


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
                $idEvaluacion,$idPregunta,'".$opcion1."','".$opcion2."','".$opcion3."','".$opcion4."',$respuesta,'".$hoy."','".$hoy."')";

                $usermodel->query($sqlOpcionMultiple);
        }

        //Cuando sea AUDIO 
        if($tipoPregunta == 3){

            $file_audio = $REQUEST->getFile('archivo_audio');
              //Verifica si es valido
        if ($file_audio->isValid() && ! $file_audio->hasMoved())
        {

                //Comprobar si existe la ruta donde se va a guardar el audio
            if (!is_dir("$Ruta/audio")) {
                mkdir("$Ruta/audio", 0777, TRUE);
            }

            //Obtenemos el archivo 
            $nombre = 'pregunta-ingles'.$numeropregunta.'.mp3';  
            $ruta_audio_basedatos = "$Ruta/audio/".$nombre."";
            $ruta_audio = "$Ruta/audio";

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
                $idPregunta,
                '".$nombre."',
                '".$ruta_audio_basedatos."',
                '".$audio_extension."',
                '".$hoy."',
                '".$hoy."')";

                $usermodel = new Pregunta_opcion_audio($db);
                try{

                    $usermodel ->query($sqlAudio);
                }catch(\Exception $e){
                    
                    die($e->getMessage());
                }
               
        }else{
            //Si algo sale mal nos marca un error 
           // throw new RuntimeException($file_audio->getErrorString().'('.$file_audio->getError().')');
                 }

        }

        
        if($tipoPregunta == 4){
            $file_video = $REQUEST->getFile('archivo_video');
            //Verifica si es valido
            if ($file_video->isValid() && ! $file_video->hasMoved()){
         
              //Comprobar si existe la ruta donde se va a guardar el audio
                if (!is_dir("$Ruta/video")) {
                 mkdir("$Ruta/video", 0777, TRUE);
                }

          //Obtenemos el archivo 
                $nombre = 'pregunta-ingles'.$numeropregunta.'.mp4';  
                $ruta_video_basedatos = "$Ruta/video/".$nombre."";
                $ruta_video = "$Ruta/video";
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
              $idPregunta,
              '".$nombre."',
              '".$ruta_video_basedatos."',
              '".$video_extension."',
              '".$hoy."',
              '".$hoy."')";

              $usermodel = new Pregunta_opcion_video($db);
              $usermodel ->query($sqlvideo);
            }else{
          //Si algo sale mal nos marca un error 
          //throw new RuntimeException($file_video->getErrorString().'('.$file_video->getError().')');
            }

        }
       
        $data = ['pregunta-exito'  => 'La pregunta se agrego de forma correcta'];
        $this->session->set($data,true);

        return redirect()->to(site_url("Preguntas/editarEvaluacion/$idEvaluacion"));
    

        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    
    }

}