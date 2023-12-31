<?php 
  require '../../includes/app.php';
  use App\Propiedad;
  
  // Importar Intervention Image
  use Intervention\Image\ImageManagerStatic as Image;

  estaAutenticado();

  $db = conectarDB();

  

  // Consulta para obtener a los vendedores
  $consulta = "SELECT * FROM vendedores";
  $resultado = mysqli_query($db, $consulta);

 
 
  // Crear el objeto
  $propiedad = new Propiedad; 


  // Arreglo con mensajes de errores
  $errores = Propiedad::getErrores();
  
  // Ejecutar el código después de que el usuario envia el formulario
  if($_SERVER['REQUEST_METHOD'] === 'POST') {

    /** CREA UNA NUEVA INSTANCIA */
    $propiedad = new Propiedad($_POST['propiedad']);


    // debuguear($_FILES['propiedad']); 

    /** SUBIDA DE ARCHIVOS */
    

    // Setear la imagen

    // Realiza un resize a la imagen con intervention
    if($_FILES['propiedad']['tmp_name']['imagen']) {
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
        $propiedad->setImage($nombreImagen);
    }
    
    // Validar
    $errores = $propiedad->validar();
 
    if(empty($errores)) {
      // Crear la carpeta para subir imagenes
      if(!is_dir(CARPETA_IMAGENES)) {
        mkdir(CARPETA_IMAGENES);
      }

      // Guarda la imagen en el servidor
      $image->save(CARPETA_IMAGENES . $nombreImagen);

      // Guarda en la base de datos
      $exito = $propiedad->guardar();

      //Mensaje de éxito
      if($exito) {
        // Redirecciona al usuario
        header('Location: /admin?resultado=1');
      }
    }
  }

  incluirTemplate('header');

?>  
    
    <main class="contenedor seccion">
      <h1>Crear</h1>

      <a href="/admin" class="boton boton-verde">Volver</a>

      <?php foreach($errores as $error): ?>
        <div class="alerta error">
          <?php echo $error; ?>
        </div>
      
      <?php endforeach; ?>

      <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_propiedades.php'; ?>
        
        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
      </form>

    </main>

<?php 
  incluirTemplate('footer');
?>