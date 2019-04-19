<?php


//Funci�n conexi�n a la BD no abusar para mantener rendimiento


function conexion_bd() {
    
    
    static $conexion;
       
    /*Comprovamos si la conexi�n ya esta abierta 
    as� no es necesario reconectar por cada request a la bd*/
    
    if(!isset($conexion)) {
        
        
         $IP = 'localhost';

        $USER = 'root';

        $PSW = 'root';

        $DB = 'esxstable';
        
        $conexion = mysqli_connect($IP,$USER,$PSW,$DB);
        
    }
    
    
    
    //Comprovamos la conexi�n 
    
    if($conexion === false) {
        
       
        return mysqli_connect_error();
        
        
    }
    
    if (mysqli_connect_errno()) {
		file_put_contents('MysqlErrorLOG.txt',date('[Y-m-d H:i:s]'). mysqli_connect_error()."\r\n", FILE_APPEND); 
		exit();
	}else{
     
		return $conexion;

	}
    
    return false;
    
    
}



//Funci�n hacer request a bd

function request_BD($request){
    
  
	
    $conexion = conexion_bd();
	
	
    
    $resultado = mysqli_query($conexion, $request);
    mysqli_set_charset( $conexion, 'utf8mb4');
    return $resultado;
	
    
    
}


//request a la db pero con cache 
function request_BD_cache($request){
    $archivo = hash("sha256", $request);


    if (!file_exists("./cache/".$archivo.".txt")) {
        # code...
        $fh = fopen("./cache/".$archivo.".txt", 'w');
        $conexion = conexion_bd();
    
    
        $resultado = mysqli_query($conexion, $request);
        mysqli_set_charset( $conexion, 'utf8mb4');
        $rows = array();

        foreach ($resultado as $resdb) {
            # code...
            $rows[] = $resdb;
        }

        
        fclose($fh);
        file_put_contents("./cache/".$archivo.".txt", serialize(json_encode($rows)));
        return $resultado;
    }


    
    if (filemtime("./cache/".$archivo.".txt") < time()-1*300) {
    $conexion = conexion_bd();
    
    
    $resultado = mysqli_query($conexion, $request);
    mysqli_set_charset( $conexion, 'utf8mb4');
    $rows = array();

    foreach ($resultado as $resdb) {
        # code...
        $rows[] = $resdb;
    }

    file_put_contents("./cache/".$archivo.".txt", serialize(json_encode($rows)));

    return $resultado;
    
    }else{

        $data = unserialize(file_get_contents("./cache/".$archivo.".txt"));
        return $data;
    }
    
}






//cerramos la conexion , util para querrys muy grandes quye usan mucha ram
function cerrar_BD($request){
    
    
    $conexion = conexion_bd();
    
    
    $resultado = mysqli_close($conexion);
    
    return $resultado;
    
    
    
}


//Funci�n opcional "Mejora el codigo"

function seleccionar_BD($request){
    
    $filas = array();
    
    $resultado = request_BD($request);
    
    //comprovamos el resultado para evitar bucles y carga inecesaria
    if ($resultado === false){
        
        return false;
    }
    
    
    //check pasado
    
    while ($fila = mysqli_fetch_assoc($resultado)) {
        
        $filas[] = $fila;
    }
    
    
    
    return $filas;
    
}


//Funci�n opcional "Mejora el codigo"

function seleccionar_BD_cache($request){
    
    $filas = array();
    
    $resultado = request_BD_cache($request);
    
    //comprovamos el resultado para evitar bucles y carga inecesaria
    if ($resultado === false){
        
        return false;
    }
    
    
    //check pasado
    if (is_object($resultado)) {
        # code...
    
    while ($fila = mysqli_fetch_assoc($resultado)) {
        
        $filas[] = $fila;
    }
    return $filas;
    }else{
        return json_decode($resultado, true);
    }
    
    
    
    
    
}



function checkRequest($request)
{

	return "'" .str_replace(array("\\", "'"), array("\\\\", "\\'"), $request) . "'";
	
}


//este codigo no es mio y no sirve dde nada xD 
function testArray($array)
    {
		if(is_array($array) === true)
            {
                foreach ($array as $name => $value)
				{
					if(is_array($value) === true)
					{
						testArray($value);
					}
					else
					{
						if(testHelper($array)){
							return true;
						}
						return false;
					}
				}
            }
            else
            {
                if(testHelper($array)){
					return true;
				}
				return false;
            }
        
    }

    function testHelper($varvalue)
    {
        $total = test($varvalue);
        
		if ($total != 0){
			return false;
		}
		
		return true;
    }

    function test($varvalue, $_comment_loop=false)
    {
        $total = 0;
        $varvalue_orig = $varvalue;
        $quote_pattern = '\%27|\'|\%22|\"|\%60|`';
//      detect base64 encoding
        if(preg_match('/^[a-zA-Z0-9\/+]*={0,2}$/', $varvalue) > 0 && base64_decode($varvalue) !== false)
        {
            $varvalue = base64_decode($varvalue);
        }

//      detect and remove comments
        if(preg_match('!/\*.*?\*/!s', $varvalue) > 0)
        {
            if($_comment_loop === false)
            { 
                $total += test($varvalue_orig, true);
                $varvalue = preg_replace('!/\*.*?\*/!s', '', $varvalue);
            }
            else
            {
                $varvalue = preg_replace('!/\*.*?\*/!s', ' ', $varvalue);
            }
            $varvalue = preg_replace('/\n\s*\n/', "\n", $varvalue);
        }
        $varvalue = preg_replace('/((\-\-|\#)([^\\n]*))\\n/si', ' ', $varvalue);

//      detect and replace hex encoding
//      detect and replace decimal encodings
        if(preg_match_all('/&#x([0-9]{2});/', $varvalue, $matches) > 0 || preg_match_all('/&#([0-9]{2})/', $varvalue, $matches) > 0)
        {
//          replace numeric entities
            $varvalue = preg_replace('/&#x([0-9a-f]{2});?/ei', 'chr(hexdec("\\1"))', $varvalue);
            $varvalue = preg_replace('/&#([0-9]{2});?/e', 'chr("\\1")', $varvalue);
//          replace literal entities
            $trans_tbl = get_html_translation_table(HTML_ENTITIES);
            $trans_tbl = array_flip($trans_tbl);
            $varvalue = strtr($varvalue, $trans_tbl);
        }

        $and_pattern = '(\%41|a|\%61)(\%4e|n|%6e)(\%44|d|\%64)';
        $or_pattern = '(\%6F|o|\%4F)(\%72|r|\%52)';
        $equal_pattern = '(\%3D|=)';
        $regexes = array(
                '/(\-\-|\#|\/\*)\s*$/si',
                '/('.$quote_pattern.')?\s*'.$or_pattern.'\s*(\d+)\s*'.$equal_pattern.'\s*\\4\s*/si',
                '/('.$quote_pattern.')?\s*'.$or_pattern.'\s*('.$quote_pattern.')(\d+)\\4\s*'.$equal_pattern.'\s*\\5\s*/si',
                '/('.$quote_pattern.')?\s*'.$or_pattern.'\s*(\d+)\s*'.$equal_pattern.'\s*('.$quote_pattern.')\\4\\6?/si',
                '/('.$quote_pattern.')?\s*'.$or_pattern.'\s*('.$quote_pattern.')?(\d+)\\4?/si',
                '/('.$quote_pattern.')?\s*'.$or_pattern.'\s*('.$quote_pattern.')([^\\4]*)\\4\\5\s*'.$equal_pattern.'\s*('.$quote_pattern.')/si',
                '/((('.$quote_pattern.')\s*)|\s+)'.$or_pattern.'\s+([a-z_]+)/si',
                '/('.$quote_pattern.')?\s*'.$or_pattern.'\s+([a-z_]+)\s*'.$equal_pattern.'\s*(d+)/si',
                '/('.$quote_pattern.')?\s*'.$or_pattern.'\s+([a-z_]+)\s*'.$equal_pattern.'\s*('.$quote_pattern.')/si',
                '/('.$quote_pattern.')?\s*'.$or_pattern.'\s*('.$quote_pattern.')([^\\4]+)\\4\s*'.$equal_pattern.'\s*([a-z_]+)/si',
                '/('.$quote_pattern.')?\s*'.$or_pattern.'\s*('.$quote_pattern.')([^\\4]+)\\4\s*'.$equal_pattern.'\s*('.$quote_pattern.')/si',
                '/('.$quote_pattern.')?\s*\)\s*'.$or_pattern.'\s*\(\s*('.$quote_pattern.')([^\\4]+)\\4\s*'.$equal_pattern.'\s*('.$quote_pattern.')/si',
                '/('.$quote_pattern.'|\d)?(;|%20|\s)*(union|select|insert|update|delete|drop|alter|create|show|truncate|load_file|exec|concat|benchmark)((\s+)|\s*\()/ix',
                '/from(\s*)information_schema.tables/ix',
            );

        foreach ($regexes as $regex)
        {
            $total += preg_match($regex, $varvalue);
        }
        return $total;
    }



