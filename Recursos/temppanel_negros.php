<?php
class Sesion { 
    


    protected $timeSpan;
    protected $inicio = 0;
    
  
    public function __construct($User, $adm = '')
    {

        $this->tiempoTotal = 0;
        $this->tiempoSesion = 0; 
        $this->servicio = false; 
        $this->historial = [];
        $this->User = $User;
        $this->timeSpan = time();
        $this->inicio = 0;
        $this->adm = false;
        $this->NombreAdm = false;
        $timeSpan = time();
    	$array = seleccionar_BD("SELECT * FROM panel_users WHERE USUARIO = '$User' LIMIT 1");
        if ($adm != '') {
            # code...
            $arrayadm = seleccionar_BD("SELECT * FROM panel_users WHERE USUARIO = '$User' LIMIT 1");
            $this->adm = $arrayadm[0]['lvRANGO'];
            $this->NombreAdm = $arrayadm[0]['USUARIO'];
        }
        
    	if (!empty($array[0]))
    	{
    		# code...
              $this->usuario = new \stdClass();
            
    		foreach ($array[0] as $key => $value)
			{
                    if ($key == 'PASS')
                    {
                        # code...
                        $this->usuario->$key = "LOLL";
                    }else{
                        if (is_null($value) || empty($key)) {
                            # code...
                            $value = 0;
                        }

                        $this->usuario->$key = $value;
                    }
   
			    
			}

			if ($this->usuario->servicio != 1 )
			{
				# code...

				$this->servicio = false;
			}else{
				$this->servicio = true;
				$this->tiempoSesion = $timeSpan - $this->usuario->sesionA;
				$this->inicio = $this->usuario->sesionA;
			}

			$this->tiempoTotal = $this->usuario->tiempo;
			


    	}else{
    		return false;
    	}



		
    }
    
   


    public function nueva()
    {
    	# code...
        $User = $this->User;
        $timeSpan = $this->timeSpan;
    	if ($this->servicio == false)
    	{
    		# code...
    		$request = request_BD("INSERT INTO panel_negros (admin, inicio, final, estado, tiempo) VALUES ('$User','$timeSpan', '0', '0', '0')");
    		$request = request_BD("UPDATE panel_users SET servicio = '1', sesionA = '$timeSpan' WHERE USUARIO = '$User'");
    		$this->tiempoSesion = 0;
    		$this->servicio = true;

    		return true;

    	}

    	return false;


    }





    public function finalizar()
    {
    	# code...
        $User = $this->User;
        $timeSpan = $this->timeSpan;
        $inicio = $this->inicio;
    	if ($this->servicio == true && $this->inicio != 0) {
    		# code...
    		$this->tiempoTotal += $this->tiempoSesion;

            $tiempoTotal = $this->tiempoTotal;
            $tiempoSesion = $this->tiempoSesion;
    		$request = request_BD("UPDATE panel_users SET servicio = '0', tiempo = '$tiempoTotal' WHERE USUARIO = '$User'");
    		$request = request_BD("UPDATE panel_negros SET estado = '1', final = '$timeSpan', tiempo = '$tiempoSesion' WHERE inicio = '$inicio'");
    	}


    	return false;
    }


    public function modificarHoras($minutos=0)
    {
        # code...

        if ( $this->adm >= 11 && $minutos != 0) 
        {
            
            # code...
            $staff = $this->User;
            $Adm = $this->NombreAdm;
            $tiempoTotal = $this->tiempoTotal;
            $secs = round(($minutos * 60), 0);
            $tiempoTotal += $secs;

            $request = request_BD("UPDATE panel_users SET tiempo = '$tiempoTotal' WHERE USUARIO = '$staff'");

             $request = request_BD("INSERT INTO panel_logusers (STAFF, TIPO, RAZON, USER, LICENCIA) VALUES ('$Adm','Editado User Open: $minutos', 'open editado','$staff', 'OPEN')");

            $this->tiempoTotal = $tiempoTotal;

            $minutos = 0;

            return true;


        }

        return false;
    }

    public function getHistorial()
    {
    	# code...
        $User = $this->User;


    	$historial = seleccionar_BD("SELECT * FROM panel_negros WHERE admin = '$User' ORDER BY id DESC");

    	if (!empty($historial)) {
    		# code...
            $this->historial = $historial;
    		return $historial;
    	}

    	return false;
    }


    public function getUsersServicio()
    {
        # code...
        if ($this->adm >= 11) {
            # code...
            $enservicio = seleccionar_BD("SELECT * FROM panel_negros WHERE servicio = '1'");

            return $enservicio;

        }


        return false;
    }




    public function getHistorialTotal(){

        if ($this->adm >= 11) {
            # code...
            $enservicio = seleccionar_BD("SELECT * FROM panel_negros ORDER BY id DESC LIMIT 25");



            return $enservicio;

        }


        return false;



    }


    public function modificarSesion($inicio, $minutos)
    {
        # code...
        $User = $this->User;

        $Adm = $this->NombreAdm;
        $request = request_BD("INSERT INTO panel_logusers (STAFF, TIPO, RAZON, USER, LICENCIA) VALUES ('$Adm','Editada Sesion: $minutos', 'open editado','$User', 'OPEN')");


        $minutos = $minutos * 60;

        $request = request_BD("UPDATE panel_negros SET tiempo = '$minutos' WHERE inicio = '$inicio' AND admin = '$User' ");

        

    }




} 
?>
