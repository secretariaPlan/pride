<?php

//un objeto para almacenar los datos personales de un profesor
//Javier Alpizar, 18 Feb 08

class ProfesorPersonales
{
	public $Titulo,$TituloId,$TituloOtro,$Apaterno,$AMaterno,$Sexo,$Rfc,$LugarNacimiento,$FechaNacimiento,
			$Nacionalidad,$NacionalidadId,$NacionalidadOtro,
			$EdoCivil,$EdoCivilId,$EdoCivilOtro,
			$Calle,$NumInterior,$NumExterior,$Colonia,$Deleg,$Cp,
			$Pais,$PaisId,$PaisOtro,
			$Entidad,$EntidadId,$EntidadOtro,$Tel,$Celular,$Curp,
			$Email,$Web,$Foto;
	
	
	public function __construct($titulo,$tituloId,$tituloOtro,$apaterno,$amaterno,$sexo,$sexoId,$rfc,$lugarNacimiento,
					$fechaNacimiento,
					$nacionalidad,$nacionalidadId,$nacionalidadOtro,
					$edoCivil,$edoCivilid,$edoCivilOtro,
					$calle,$numInterior,$numExterior,$colonia,$deleg,$cp,
					$pais,$paisId,$paisOtro,
					$entidad,$entidadId,$entidadOtro,$tel,$celular,$curp,
					$email,$web,$foto)
	{
		$this->Titulo =$titulo;  	
		$this->TituloId =$tituloId;
		$this->TituloOtro =$tituloOtro;
		$this->Apaterno =$apaterno;		
		$this->AMaterno =$aMaterno;		
		$this->Sexo =$sexo;		
		$this->SexoId =$sexoId;
		$this->Rfc =$tfc;		
		$this->LugarNacimiento =$lugarNacimiento;		
		$this->FehaNacimiento =$fechaNacimiento;		
		$this->Nacionalidad =$nacionalidad;		
		$this->NacionalidadId =$nacionalidadId;
		$this->NacionalidadOtro =$nacionalidadOtro;
		$this->EdoCivil =$edoCivil;		
		$this->EdoCivilId =$edoCivilId;
		$this->EdoCivilOtro =$edoCivilOtro;
		$this->Calle =$calle;		
		$this->NumInterior =$numInterior;
		$this->NumExterior =$numExterior;
		$this->Colonia =$colonia;
		$this->Deleg =$deleg;
		$this->Cp =$cp;
		$this->Pais =$pais;
		$this->PaisId =$paisId;
		$this->PaisOtro =$paisOtro;
		$this->Entidad =$entidad;
		$this->EntidadId =$entidadId;
		$this->EntidadOtro =$entidadOtro;
		$this->Tel =tel;
		$this->Celular =$celular;
		$this->Curp =$curp;
		$this->Email=$email;
		$this->Web=$web;
		$this->Foto=$foto;
		
				
	}
	
}

?>