<?php

namespace App;

class Propiedad {

  //Base de datos 
  protected static $db;
  protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedores_id'];

  //Errores 
  protected static $errores = [];

  public $id;
  public $titulo;
  public $precio;
  public $imagen;
  public $descripcion;
  public $habitaciones;
  public $wc;
  public $estacionamiento;
  public $creado;
  public $vendedores_id;

  // Definir conexion a la DB
  public static function setDB($database) {
      self::$db = $database;
  }

  public function __construct($args = []) 
  {
      $this->id = $args['id'] ?? ''; 
      $this->titulo = $args['titulo'] ?? ''; 
      $this->precio = $args['precio'] ?? ''; 
      $this->imagen = $args['imagen'] ?? ''; 
      $this->descripcion = $args['descripcion'] ?? ''; 
      $this->habitaciones = $args['habitaciones'] ?? ''; 
      $this->wc = $args['wc'] ?? ''; 
      $this->estacionamiento = $args['estacionamiento'] ?? ''; 
      $this->creado = date('Y/m/d'); 
      $this->vendedores_id = $args['vendedores_id'] ?? 1; 
  }

  public function guardar() {
    if(isset($this->id)) {
        //actualizar
        $this->actualizar();
    } else {
        //crear
        $this->crear();
    }
  }

  public function crear() {

    // Sanitizar los datos
    $atributos = $this->sanitizarAtributos();

    $columnas = join(', ',array_keys($atributos));
    $filas = join("', '",array_values($atributos));
    // debuguear($columnas);
    // debuguear($filas);
    
    //*  Consulta para insertar datos
    $query = "INSERT INTO propiedades($columnas) VALUES ('$filas')";
    // debuguear($query);

    $resultado = self::$db->query($query);

    // debuguear($resultado);
    return $resultado;
      
  }

  public function actualizar() {
    debuguear('actualizando');
  }

  // Identificar y unir los atributos de la DB
  public function atributos() {
      $atributos = [];
      foreach(self::$columnasDB as $columna) {
          if($columna === 'id') continue;
          $atributos[$columna] = $this->$columna;
        }

      return $atributos;
  }

  // Sanitizar atributos
  public function sanitizarAtributos() {
      $atributos = $this->atributos();
      $sanitizado = [];

      foreach( $atributos as $key => $value ) {
          $sanitizado[$key] = self::$db->escape_string($value);
      }

      return $sanitizado;      
  }

  // Subida de archivos
  public function setImage($imagen) {
      // Elimina imagen anterior  

      if(isset($this->id)) {
        // Comprobar si el archivo existe
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if($existeArchivo) {
          unlink(CARPETA_IMAGENES . $this->imagen);
        }
      }

      

      // Asignar al atributo imagen el nombre de la imagen
      if($imagen) {
          $this->imagen = $imagen;
      }
  }

  // Validación
  public static function getErrores() {
      return self::$errores;
  }

  public function validar() {
    if(!$this->titulo) {
        self::$errores[] = "Debes añadir un titulo";
      }
    

      if(!$this->precio) {
        self::$errores[] = "Debes añadir un precio";
      }
      
      if( strlen( $this->descripcion )  < 50 ){
        self::$errores[] = "Debes añadir una descripcion y debe tener mínimo 50 caracteres";
      }
      
      if(!$this->habitaciones) {
        self::$errores[] = "Debes añadir un numero de habitaciones";
      }
      
      if(!$this->wc) {
        self::$errores[] = "Debes añadir un numero de baños";
      }
      
      if(!$this->estacionamiento) {
        self::$errores[] = "Debes añadir un numero de estacionamientos";
      }
      
      if(!$this->vendedores_id) {
        self::$errores[] = "Debes añadir un vendedor";
      }
      
      if(!$this->imagen) {
        self::$errores[] = "La imagen es obligatoria";
      }
  
    return self::$errores;  
  }

  // Lista todas los registros
  public static function all() {
    $query = "SELECT * FROM propiedades";

    $resultado = self::consultarSQL($query);
 
    return $resultado;
  }

  // Busca un registro por su id
  public static function find($id) {
    $query = "SELECT * FROM propiedades WHERE id = ${id}";

    $resultado = self::consultarSQL($query);

    return array_shift($resultado);
  }

  public static function consultarSQL($query) {
    // Consultar la base de dato
    $resultado = self::$db->query($query);

    // Iterar los resultados
    $array = [];
    while($registro = $resultado->fetch_assoc()) {
      $array[] = self::crearObjeto($registro);
      
    }

    // Liberar la memoria
    $resultado->free();

    // Retornar los resultados
    return $array;
  }

  protected static function crearObjeto($registro) {
    $objeto = new self;


    foreach($registro as $key => $value) {
      if( property_exists( $objeto, $key )) {
        $objeto->$key = $value;
      }
    }

    return $objeto;

  } 

  // Sincroniza el objeto en memoria con los cambios realizados por el usuario
  public function sincronizar( $args = [] ) {
    foreach($args as $key => $value) {
      if(property_exists($this, $key ) && !is_null($value)){
        $this->$key = $value;
      }
    }
  }
}