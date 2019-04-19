<?php
class Sesion { 
    


    protected $timeSpan;
    protected $inicio = 0;
    
  
    public function __construct($User)
    {

        $this->tiempoTotal = 0;
        $this->tiempoSesion = 0; 
        $this->servicio = false; 
        $this->historial = [];
        $this->User = $User;
        $this->timeSpan = time();
        $this->inicio = 0;
        $timeSpan = time();
    	$array = seleccionar_BD("SELECT * FROM panel_users WHERE USUARIO = '$User' LIMIT 1");

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

    public function getHistorial()
    {
    	# code...
        $User = $this->User;


    	$historial = seleccionar_BD("SELECT * FROM panel_negros WHERE admin = '$User'");

    	if (!empty($historial)) {
    		# code...
            $this->historial = $historial;
    		return $historial;
    	}

    	return false;
    }




} 
?>
