<?php namespace App\Controllers;

class Operaciones extends BaseController{

    public function eliminarSessionNotificaciones()
	{
     

            $this->session->remove('notificaciones_usuario');
           
        
	}
}