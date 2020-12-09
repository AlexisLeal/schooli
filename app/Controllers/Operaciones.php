<?php namespace App\Controllers;

class Operaciones extends BaseController{

    public function operacioneseliminaSessionNotificacion()
	{
     

            $this->session->remove('notificaciones_usuario');
           
        
	}
}