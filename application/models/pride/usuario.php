<?php

class Usuario extends ActiveRecord\Model{
	
	static $table_name = "usuario";

	function nuevoUsuario($rfc,$nombre,$apaterno,$amaterno,$pass,$email) {
		
		$usuario = new Usuario();
		
		$usuario->rfc = $rfc;
		$usuario->nombre = $nombre;
		$usuario->apaterno = $apaterno;
		$usuario->amaterno = $amaterno;
		$usuario->password = md5($pass);
		$usuario->correo = $email;
		
		$usuario->save();
		
	}
	
	
	

	
	
	
	public function add_user()
	{
		
		

		$new = new Usuario(array(
				'rfc'=>$this->input->post('rfc',TRUE),
				'nombre'=>$this->input->post('nombre',TRUE),
				'apaterno'=>$this->input->post('apaterno',TRUE),
				'amaterno'=>$this->input->post('amaterno',TRUE),
				//'password'=>$this->input->post('password',TRUE),
				'password' => md5($this->input->post("password")),
				'correo'=>$this->input->post('correo',TRUE),
		
		));
		$new->save();

	}
	
	
	public function agregar()
	{

		$post=new Usuario;	
		$post->rfc=$_POST['rfc'];
		$post->nombre=$_POST['nombre'];
		$post->apaterno=$_POST['apaterno'];
		$post->amaterno=$_POST['amaterno'];
		$post->correo=$_POST['correo'];
		$post->password=md5($_POST['password']);
		$post->save();
		
		if($post->save())
		{		
				echo "<div id='mensaje'>Profesor Agregado Exitosamente</div>";// los datos son válidos y están insertados/actualizados exitosamente
				
			
		}
		else
		{
			// los datos no son válidos. Llamar a  getErrors() para obtener los mensajes de error
		}
	
	}
	
	
	
	
	
	
	
	
	
	
	
	
}

?>