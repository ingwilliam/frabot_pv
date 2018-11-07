<?php
class SPDO extends PDO 
{
	private static $instance = null;

	public function __construct() 
	{
		$config = Config::singleton();
		parent::__construct('mysql:host=' . $config->get('dbhost') . ';charset=utf8;dbname=' . $config->get('dbname'), $config->get('dbuser'), $config->get('dbpass'));
	}

	public static function singleton() 
	{
		if( self::$instance == null ) 
		{
			self::$instance = new self();
		}
		return self::$instance;
	}
        
        /**
     * Metodo para insertar un registro
     * @param $table = Nombre de la tabla donde se va a insertar el registro
     * @param $fields = array que contiene los campos para el ingreso del registro
     * ejemplo : array( "Nombre"=>"William" ,"Apellido"=>"Barbosa" )
     * @return $query = consulta sql
     */
    public function insert($table, $fields) {        
        $fields_key = "";
        $fields_value = "";

        $table_fields = $this->table_fields($table);


        $query = "INSERT INTO " . $table . " ( ";

        foreach ($fields as $key => $value) {
            if ($key != "0") {
                if (in_array($key, $table_fields)) {
                    $fields_key = $fields_key . "`" . $key . "` , ";
                    if($key=="padre"||$key=="seccion"||$key=="articulo"||$key=="id")
                    {
                        if($value=="")
                            $fields_value = $fields_value ."null , ";
                        else
                            $fields_value = $fields_value . "'" . Resources::sqlInyeccion($value) . "' , ";
                    }
                    else
                    {
                        $fields_value = $fields_value . "'" . Resources::sqlInyeccion($value) . "' , ";
                    }                        
                }
            }
        }

        $fields_key = substr($fields_key, 0, -2);

        $fields_value = substr($fields_value, 0, -2);

        $query = $query . $fields_key . " ) VALUES ( " . $fields_value . " );";

        return $query;
    }

    /**
     * Metodo para modicar un registro
     * @param $table = Nombre de la tabla donde se va a insertar el registro
     * @param $fields = array que contiene los campos para el ingreso del registro
     * ejemplo : array( "Nombre"=>"William" ,"Apellido"=>"Barbosa" )
     * @param $condition = condicion para eliminar el registro
     * @param $console = permite ver la sentencia por pantalla true
     * @return $query = consulta sql
     */
    public function update($table, $fields, $condition = 1) {

        $table_fields = $this->table_fields($table);

        $query = "UPDATE `" . $table . "` SET ";

        $fields_value = "";
        
        foreach ($fields as $key => $value) {        
            if (in_array($key, $table_fields))
            {
                if($key=="padre"||$key=="acudiente"||$key=="tipo_discapacidad"||$key=="seccion"||$key=="articulo")
                {
                    if($value=="")
                        $fields_value = $fields_value . " `" . $key . "` = null , ";
                    else
                        $fields_value = $fields_value . " `" . $key . "` = '" . Resources::sqlInyeccion($value) . "' , ";
                }
                else
                {
                    $fields_value = $fields_value . " `" . $key . "` = '" . Resources::sqlInyeccion($value) . "' , ";
                }
            
            }
        }

        $fields_value = substr($fields_value, 0, -2);

        $query = $query . $fields_value . " WHERE " . $condition . " ;";

        return $query;
    }

    /**
     * Metodo para retornar un array con el nombre de los campos de la tabla
     * @param $table = Nombre de la tabla donde se va a insertar el registro
     * @return $fields = $fields["Nombre","Apellido"]
     */
    public function table_fields($table) {

        $fields = array();

        $resultfields = $this->query("SHOW FIELDS FROM " . $table);

        while ($row = $resultfields->fetch(PDO::FETCH_ASSOC))
            $fields[] = $row["Field"];

        return $fields;
    }
    
    /**
     * Consulta todas los registros de una tabla
     * en el sistema 
     * @return $arrayRegistro 
     */
    public function listArray( $table , $key , $where , $orderby ) {
        //realizamos la consulta de todos los registros    
        $consulta = $this->prepare('SELECT * FROM '.$table.' WHERE '.$where.' ORDER BY '.$orderby);
        $consulta->execute();
        $arrayRegistro = array();
        while( $registro = $consulta->fetch(PDO::FETCH_ASSOC) )
        {
            $arrayRegistro[$registro[$key]] = $registro;            
        }
        
        return $arrayRegistro;
        
    }
    
    /**
     * Consulta todas los registros de una tabla
     * en el sistema 
     * @return $arrayRegistro 
     */
    public function listArraySql( $sql , $key , $consecutivo = false) {
        //realizamos la consulta de todos los registros    
        $consulta = $this->prepare($sql);
        $consulta->execute();
        $arrayRegistro = array();
        $incremento = 0;
        while( $registro = $consulta->fetch(PDO::FETCH_ASSOC) )
        {
            if( $consecutivo == true )
            {
                $arrayRegistro[$incremento] = $registro;
                $incremento++;
            }
            else
            {
                $arrayRegistro[$registro[$key]] = $registro;            
            }
            
            
        }
        
        return $arrayRegistro;
        
    }
    
    public function consultRegistroSql( $sql ) {
        //realizamos la consulta de todos los Articulo
        $consulta = $this->prepare($sql);                 
        $consulta->execute();
        $Registro = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $Registro;        
    }
}
?>